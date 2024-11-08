<?php

class Pasien_model extends CI_Model
{
    public function get_all_pasien(): array
    {
        $this->db->trans_begin();
        $result = $this->db->get('pasien');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diambil karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pasien berhasil diambil.', 'data' => $result->result()];
        }
    }

    public function insert_pasien(array $data): array
    {
        $this->db->trans_begin();
        $this->db->insert('pasien', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pasien berhasil disimpan.'];
        }
    }

    public function update_pasien(string $id_pasien, array $data): array
    {
        $this->db->trans_begin();
        $this->db->where('id_pasien', $id_pasien);
        $this->db->update('pasien', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pasien berhasil diperbarui.'];
        }
    }

    public function delete_pasien(string $id_pasien): array
    {
        $this->db->trans_begin();
        $this->db->where('id_pasien', $id_pasien);
        $this->db->delete('pasien');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pasien berhasil dihapus.'];
        }
    }
}
