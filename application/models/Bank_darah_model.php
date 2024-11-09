<?php

class Bank_darah_model extends CI_Model
{
    public function get_all(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT 
            darah.kode_darah,
            darah.jenis_darah,
            darah.golongan_darah,
            darah.rhesus,
            darah.stok_minimal,
            darah.stok_maksimal,
            darah.harga_beli,
            darah.harga_jual,
            SUM(penerimaan.jumlah_kantong) AS total_stok_awal,
            SUM(bank_darah.stok) AS total_stok_sisa
        FROM 
            bank_darah
        JOIN penerimaan 
            ON bank_darah.id_penerimaan = penerimaan.id_penerimaan
        JOIN darah 
            ON penerimaan.id_darah = darah.id_darah
        WHERE 
            CURDATE() < penerimaan.tanggal_kadaluarsa
        GROUP BY 
            darah.jenis_darah, darah.golongan_darah, darah.rhesus, darah.stok_minimal, darah.stok_maksimal, darah.harga_beli, darah.harga_jual
        ORDER BY total_stok_sisa DESC";
        // $query = "SELECT 
        //     darah.jenis_darah,
        //     darah.golongan_darah,
        //     darah.rhesus,
        //     darah.stok_minimal,
        //     darah.stok_maksimal,
        //     darah.harga_beli,
        //     darah.harga_jual,
        //     SUM(bank_darah.stok) AS total_stok_sisa,
        //     SUM(penerimaan.jumlah_kantong) AS total_stok_awal,
        //     IF(penerimaan.tanggal_kadaluarsa >= CURDATE(), '1', '0') AS status_kadaluarsa
        // FROM 
        //     bank_darah
        // JOIN penerimaan 
        //     ON bank_darah.id_penerimaan = penerimaan.id_penerimaan
        // JOIN darah 
        //     ON penerimaan.id_darah = darah.id_darah
        // GROUP BY 
        //     darah.jenis_darah, darah.golongan_darah, darah.rhesus, status_kadaluarsa, darah.stok_minimal, darah.stok_maksimal, darah.harga_beli, darah.harga_jual
        // ORDER BY status_kadaluarsa, total_stok_sisa DESC
        // ";
        // $query = "SELECT bank_darah.kode_bank_darah, bank_darah.stok AS stok_tersisa,
        // penerimaan.no_kantong, penerimaan.jumlah_kantong AS stok_awal, penerimaan.tanggal_terima, penerimaan.tanggal_aftap, penerimaan.tanggal_kadaluarsa, 
        // darah.kode_darah, darah.jenis_darah, darah.golongan_darah, darah.rhesus
        // FROM bank_darah
        // JOIN penerimaan ON bank_darah.id_penerimaan = penerimaan.id_penerimaan
        // JOIN darah ON penerimaan.id_darah = darah.id_darah
        // ORDER BY bank_darah.stok";

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

    public function get_kadaluarsa(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT 
        darah.kode_darah, darah.jenis_darah, darah.golongan_darah, darah.rhesus, darah.stok_minimal, 
        darah.stok_maksimal, darah.harga_beli, darah.harga_jual, penerimaan.tanggal_kadaluarsa,
        SUM(bank_darah.stok) AS total_stok_sisa
        FROM 
            bank_darah
        JOIN penerimaan 
            ON bank_darah.id_penerimaan = penerimaan.id_penerimaan
        JOIN darah 
            ON penerimaan.id_darah = darah.id_darah
        WHERE 
            CURDATE() >= penerimaan.tanggal_kadaluarsa
        GROUP BY 
            darah.jenis_darah, darah.golongan_darah, darah.rhesus, darah.stok_minimal, darah.stok_maksimal,
            darah.harga_beli, darah.harga_jual, penerimaan.tanggal_kadaluarsa
        ORDER BY total_stok_sisa DESC";

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
