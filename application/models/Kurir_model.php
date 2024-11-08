<?php

class Kurir_model extends CI_Model
{
    public function get_all_kurir(): array
    {
        $this->db->trans_begin();
        $result = $this->db->get('kurir');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diambil karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data kurir berhasil diambil.', 'data' => $result->result()];
        }
    }

    public function insert_kurir(array $data): array
    {
        $this->db->trans_begin();
        $this->db->insert('kurir', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data kurir berhasil disimpan.'];
        }
    }

    public function update_kurir(string $id_kurir, array $data): array
    {
        $this->db->trans_begin();
        $this->db->where('id_kurir', $id_kurir);
        $this->db->update('kurir', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data kurir berhasil diperbarui.'];
        }
    }

    public function delete_kurir(string $id_kurir): array
    {
        $this->db->trans_begin();
        $this->db->where('id_kurir', $id_kurir);
        $this->db->delete('kurir');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data kurir berhasil dihapus.'];
        }
    }
}
