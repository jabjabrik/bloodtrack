<?php

class Pasien_model extends CI_Model
{
    public function get_all_pasieA(): array
    {
        $this->db->trans_begin();
        $result = $this->db->get('petugas');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diambil karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data petugas berhasil diambil.', 'data' => $result->result()];
        }
    }

    public function insert_petugas(array $data): array
    {
        $this->db->trans_begin();
        $this->db->insert('petugas', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data petugas berhasil disimpan.'];
        }
    }

    public function update_petugas(string $id_petugas, array $data): array
    {
        $this->db->trans_begin();
        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('petugas', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data petugas berhasil diperbarui.'];
        }
    }

    public function delete_petugas(string $id_petugas): array
    {
        $this->db->trans_begin();
        $this->db->where('id_petugas', $id_petugas);
        $this->db->delete('petugas');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data petugas berhasil dihapus.'];
        }
    }
}
