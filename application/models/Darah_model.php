<?php

class Darah_model extends CI_Model
{
    public function get_all_darah(): array
    {
        $this->db->trans_begin();
        $result = $this->db->get('darah');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diambil karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data darah berhasil diambil.', 'data' => $result->result()];
        }
    }

    public function insert_darah(array $data): array
    {
        $this->db->trans_begin();
        $this->db->insert('darah', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data darah berhasil disimpan.'];
        }
    }

    public function update_darah(string $id_darah, array $data): array
    {
        $this->db->trans_begin();
        $this->db->where('id_darah', $id_darah);
        $this->db->update('darah', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data darah berhasil diperbarui.'];
        }
    }

    public function delete_darah(string $id_darah): array
    {
        $this->db->trans_begin();
        $this->db->where('id_darah', $id_darah);
        $this->db->delete('darah');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data darah berhasil dihapus.'];
        }
    }
}
