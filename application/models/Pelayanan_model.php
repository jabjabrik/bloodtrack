<?php

class Pelayanan_model extends CI_Model
{

    public function get_pelayanan(string $id_pasien, $user_data, $tanggal = null): array
    {
        $this->db->trans_begin();
        $query = "SELECT pelayanan.id_pelayanan, pelayanan.rekam_medis, pelayanan.diagnosa, pelayanan.tanggal_pelayanan, pelayanan.jumlah_darah,
        dokter.nama_dokter, ruangan.nama_ruangan, pasien.golongan_darah
        FROM pelayanan
        JOIN pasien ON pelayanan.id_pasien = pasien.id_pasien
        JOIN ruangan ON pelayanan.id_ruangan = ruangan.id_ruangan
        JOIN ruangan_petugas ON ruangan.id_ruangan = ruangan_petugas.id_ruangan
        JOIN dokter ON pelayanan.id_dokter = dokter.id_dokter
        WHERE pasien.id_pasien = $id_pasien";
        if ($tanggal) {
            $query .= " AND DATE(pelayanan.tanggal_pelayanan) = '" . $this->db->escape_str($tanggal) . "'";
        }
        if ($user_data['jabatan'] == 'perawat') {
            $query .= " AND ruangan_petugas.id_petugas =" . $user_data['id_petugas'];
        }
        $query .= " ORDER BY pelayanan.id_pelayanan";
        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_crossmatch(string $id_pelayanan): array
    {
        $this->db->trans_begin();

        $query = "SELECT crossmatch.*, penerimaan.no_kantong, darah.jenis_darah, darah.golongan_darah, IF(crossmatch.hasil = 'compatible' AND crossmatch.status = 'transfusi', darah.harga_jual, '75000') AS tarif
        FROM crossmatch
        JOIN pelayanan ON crossmatch.id_pelayanan = pelayanan.id_pelayanan
        JOIN penerimaan ON crossmatch.id_penerimaan = penerimaan.id_penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        WHERE crossmatch.id_pelayanan = $id_pelayanan";

        $result = $this->db->query($query)->result();
        return $result;
    }

    public function get_darah_tersedia(string $golongan_darah): array
    {
        $query = "SELECT penerimaan.no_kantong, darah.jenis_darah, darah.golongan_darah, penerimaan.id_penerimaan
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        WHERE penerimaan.status = '1' AND CURDATE() < penerimaan.tanggal_kadaluarsa AND darah.golongan_darah = '$golongan_darah'";
        return $this->db->query($query)->result();
    }

    public function get_stok_darah(string $golongan_darah): array
    {
        $query = "SELECT darah.jenis_darah, darah.golongan_darah, COUNT(darah.jenis_darah) AS stok
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        WHERE penerimaan.status = '1' AND CURDATE() < penerimaan.tanggal_kadaluarsa AND darah.golongan_darah = '$golongan_darah'
        GROUP BY darah.jenis_darah, darah.golongan_darah";

        return $this->db->query($query)->result();
    }

    public function get_total_stok_darah(string $golongan_darah): string
    {
        $query = "SELECT COUNT(*) AS stok
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        WHERE penerimaan.status = '1' AND CURDATE() < penerimaan.tanggal_kadaluarsa AND darah.golongan_darah = '$golongan_darah'";

        return $this->db->query($query)->row('stok');
    }

    public function insert_crossmatch($id_penerimaan, $data): void
    {
        $this->db->insert('crossmatch', $data);

        $this->db->where("id_penerimaan", $id_penerimaan);
        $this->db->update('penerimaan', ['status' => '0']);
    }

    public function insert(string $table_name, array $data, string $jumlah_kantong): void
    {
        $this->db->trans_begin();

        $this->db->insert($table_name, $data);
        $id = $this->db->insert_id();

        $data = [
            'kode_bank_darah' => mt_rand(100000, 999999) . '-KDBKDH',
            'id_penerimaan' => $id,
            'stok' => $jumlah_kantong,
        ];

        $this->db->insert('bank_darah', $data);


        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
        }
    }

    public function update(string $table_name, array $data, string $id): void
    {
        $this->db->trans_begin();
        $this->db->where("id_$table_name", $id);
        $this->db->update($table_name, $data);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
        }
    }

    public function action_remove(string $table_name, string $type, string $id): void
    {
        $this->db->trans_begin();

        $query = '';
        if ($type == 'delete') {
            $query .= "DELETE FROM $table_name WHERE id_$table_name = '$id'";
        }
        if ($type == 'nonactive') {
            $query .= "UPDATE $table_name SET is_active = '0' WHERE id_$table_name = '$id'";
        }
        if ($type == 'active') {
            $query .= "UPDATE $table_name SET is_active = '1' WHERE id_$table_name = '$id'";
        }

        $this->db->query($query);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
        }
    }

    public function get_data_by(string $table_name, string $field, string $value): array
    {
        $this->db->trans_begin();
        $result = $this->db->get_where($table_name, [$field => $value]);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
            return ['status' => TRUE, "data" => $result];
        }
    }

    public function get_pelayanan_by_tanggal($tanggal, $user_data): array
    {
        $this->db->trans_begin();
        $query = "SELECT pelayanan.id_pelayanan, pelayanan.rekam_medis, pelayanan.diagnosa, pelayanan.tanggal_pelayanan, pelayanan.jumlah_darah,
        dokter.nama_dokter, ruangan.nama_ruangan, pasien.golongan_darah, pasien.nama_pasien
        FROM pelayanan
        JOIN pasien ON pelayanan.id_pasien = pasien.id_pasien
        JOIN ruangan ON pelayanan.id_ruangan = ruangan.id_ruangan
        JOIN ruangan_petugas ON ruangan.id_ruangan = ruangan_petugas.id_ruangan
        JOIN dokter ON pelayanan.id_dokter = dokter.id_dokter
        WHERE DATE(pelayanan.tanggal_pelayanan) = '" . $this->db->escape_str($tanggal) . "'";

        if ($user_data['jabatan'] == 'perawat') {
            $query .= " AND ruangan_petugas.id_petugas =" . $user_data['id_petugas'];
        }

        $result = $this->db->query($query)->result();
        return $result;
    }
}
