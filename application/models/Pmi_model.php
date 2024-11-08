<?php

class Pmi_model extends CI_Model
{
    public function get_all_pmi(): array
    {
        $this->db->trans_begin();
        $result = $this->db->get('pmi');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diambil karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pmi berhasil diambil.', 'data' => $result->result()];
        }
    }

    public function insert_pmi(array $data): array
    {
        $this->db->trans_begin();
        $this->db->insert('pmi', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pmi berhasil disimpan.'];
        }
    }

    public function update_pmi(string $id_pmi, array $data): array
    {
        $this->db->trans_begin();
        $this->db->where('id_pmi', $id_pmi);
        $this->db->update('pmi', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pmi berhasil diperbarui.'];
        }
    }

    public function delete_pmi(string $id_pmi): array
    {
        $this->db->trans_begin();
        $this->db->where('id_pmi', $id_pmi);
        $this->db->delete('pmi');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => 'Data gagal diproses karena kesalahan sistem.'];
        } else {
            $this->db->trans_commit();
            return ['status' => true, 'message' => 'Data pmi berhasil dihapus.'];
        }
    }
}
