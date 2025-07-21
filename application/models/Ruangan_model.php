<?php

class Ruangan_model extends CI_Model
{
    public function get_ruangan_petugas(): array
    {
        $query = "SELECT petugas.*, ruangan.* FROM petugas
        LEFT JOIN ruangan_petugas ON ruangan_petugas.id_petugas = petugas.id_petugas
        LEFT JOIN ruangan ON ruangan_petugas.id_ruangan = ruangan.id_ruangan
        WHERE petugas.jabatan = 'perawat'";
        return $this->db->query($query)->result();
    }

    public function delete_ruangan_petugas(string $id_petugas): void
    {
        $this->db->where('id_petugas', $id_petugas);
        $this->db->delete('ruangan_petugas');
    }

    public function update_ruangan_petugas(array $data, string $id_petugas): void
    {
        $this->db->where('id_petugas', $id_petugas);
        $this->db->update('ruangan_petugas', $data);
    }
}
