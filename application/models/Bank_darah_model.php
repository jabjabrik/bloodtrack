<?php

class Bank_darah_model extends CI_Model
{
    public function get_all(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT 
        darah.kode_darah, darah.jenis_darah, darah.golongan_darah, darah.stok_maksimal, darah.stok_minimal, darah.harga_beli, darah.harga_jual,
        COUNT(darah.golongan_darah) AS stok
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        WHERE penerimaan.status = '1' AND CURDATE() < penerimaan.tanggal_kadaluarsa
        GROUP BY darah.kode_darah, darah.jenis_darah, darah.golongan_darah, darah.stok_maksimal, darah.stok_maksimal, darah.harga_beli, darah.harga_jual";

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

    public function get_detail_stok(string $table_name): array
    {
        $this->db->trans_begin();

        $query = "SELECT darah.kode_darah, darah.jenis_darah, darah.golongan_darah, 
        darah.stok_maksimal, darah.stok_minimal, darah.harga_beli, darah.harga_jual,
        penerimaan.no_kantong, penerimaan.tanggal_kadaluarsa, penerimaan.status, penerimaan.tanggal_terima
        FROM penerimaan
        JOIN darah ON penerimaan.id_darah = darah.id_darah
        ORDER BY penerimaan.status DESC, penerimaan.tanggal_kadaluarsa DESC";

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

    public function get_total_darah(string $table_name): string
    {
        $query = "SELECT COUNT(*) AS total FROM penerimaan";
        $result = $this->db->query($query)->row('total');
        return $result;
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
