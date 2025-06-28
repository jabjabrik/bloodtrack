<?php

class Penerimaan_model extends CI_Model
{
    public function get_all(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT penerimaan.*, 
        darah.id_darah, darah.kode_darah, darah.jenis_darah, darah.golongan_darah,
        pmi.id_pmi, pmi.kode_pmi, pmi.nama_pmi, 
        kurir.id_kurir, kurir.kode_kurir, kurir.nama_kurir, 
        penerima.id_penerima, penerima.kode_penerima, penerima.nama_penerima 
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        JOIN pmi ON penerimaan.id_pmi = pmi.id_pmi
        JOIN kurir ON penerimaan.id_kurir = kurir.id_kurir
        JOIN penerima ON penerimaan.id_penerima = penerima.id_penerima
        ORDER BY penerimaan.id_penerimaan";

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

    public function insert(string $table_name, array $data): void
    {
        $this->db->trans_begin();

        $this->db->insert($table_name, $data);
        $id = $this->db->insert_id();

        // $data = [
        //     'kode_bank_darah' => mt_rand(100000, 999999) . '-KDBKDH',
        //     'id_penerimaan' => $id,
        //     'stok' => $jumlah_kantong,
        // ];

        // $this->db->insert('bank_darah', $data);


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

    public function get_by_date($tanggal)
    {
        $this->db->trans_begin();
        $query = "SELECT penerimaan.*, 
        darah.id_darah, darah.kode_darah, darah.jenis_darah, darah.golongan_darah,
        pmi.id_pmi, pmi.kode_pmi, pmi.nama_pmi, 
        kurir.id_kurir, kurir.kode_kurir, kurir.nama_kurir, 
        penerima.id_penerima, penerima.kode_penerima, penerima.nama_penerima 
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        JOIN pmi ON penerimaan.id_pmi = pmi.id_pmi
        JOIN kurir ON penerimaan.id_kurir = kurir.id_kurir
        JOIN penerima ON penerimaan.id_penerima = penerima.id_penerima
        WHERE DATE(penerimaan.tanggal_terima) = ?
        ORDER BY penerimaan.id_penerimaan";
        $result = $this->db->query($query, [$tanggal]);
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
}
