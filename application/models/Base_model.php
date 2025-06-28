<?php

class Base_model extends CI_Model
{
    public function get_all(string $table_name, bool $is_active): array
    {
        $this->db->trans_begin();
        $query = "SELECT * FROM $table_name WHERE 1=1";

        if ($is_active) {
            $query .= " AND is_active = '1'";
        } else {
            $query .= " AND is_active = '0'";
        }

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
            return $result->result();
        }
    }

    public function generate_kode($tabel): string
    {
        $this->db->select("RIGHT(kode_$tabel,3) as kode", FALSE);
        $this->db->order_by("kode_$tabel", 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($tabel);

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        return str_pad($kode, 3, "0", STR_PAD_LEFT);
    }

    public function generate_rm(): string
    {
        $this->db->select("RIGHT(rekam_medis,3) as rm", FALSE);
        $this->db->order_by("rekam_medis", 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pelayanan');

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $rm = intval($data->rm) + 1;
        } else {
            $rm = 1;
        }

        return str_pad($rm, 3, "0", STR_PAD_LEFT);
    }
}
