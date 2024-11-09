<?php

class Pelayanan_model extends CI_Model
{
    public function get_all(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT pelayanan.id_pelayanan, pelayanan.kode_pelayanan, pelayanan.tanggal_pelayanan, pasien.rekam_medis, 
        pasien.nama_pasien, dokter.nama_dokter, ruangan.nama_ruangan
        FROM pelayanan
        JOIN pasien ON pelayanan.id_pasien = pasien.id_pasien
        JOIN dokter ON pelayanan.id_dokter = dokter.id_dokter
        JOIN ruangan On pelayanan.id_ruangan = ruangan.id_ruangan
        ORDER BY pelayanan.id_pelayanan";

        $result = $this->db->query($query);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
            return $result->result();
        }
    }

    public function get_permintaan(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT permintaan.id_permintaan, permintaan.kode_permintaan, pasien.rekam_medis, 
        pasien.nama_pasien, pasien.jenis_kelamin, darah.jenis_darah, darah.golongan_darah, darah.rhesus
        FROM permintaan
        JOIN pelayanan ON permintaan.id_pelayanan = pelayanan.id_pelayanan
        JOIN pasien ON pelayanan.id_pasien = pasien.id_pasien
        JOIN bank_darah ON permintaan.id_bank_darah = bank_darah.id_bank_darah
        JOIN penerimaan ON bank_darah.id_penerimaan = penerimaan.id_penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        ORDER BY permintaan.id_permintaan";

        $result = $this->db->query($query);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
            return $result->result();
        }
    }

    public function get_crossmatch($id_permintaan): array
    {
        $this->db->trans_begin();

        $query = "SELECT crossmatch.* FROM crossmatch WHERE crossmatch.id_permintaan = '$id_permintaan' ORDER BY crossmatch.id_crossmatch";

        $result = $this->db->query($query);

        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            print_r('Database Transaction Error: ' . $error['message'] . ' | Code: ' . $error['code']);
            $this->db->trans_rollback();
            die();
        } else {
            $this->db->trans_commit();
            return $result->result();
        }
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
}