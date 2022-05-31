<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table      = 'pengembalian';
    protected $primaryKey = 'id_kembali';
    protected $allowedFields = ['id_kembali', 'tgl_kembali', 'jatuh_tempo', 'denda', 'jumlah_hari', 'total_denda', 'id_petugas', 'id_anggota', 'id_buku'];

    public function get_kembali()
    {
        return $this->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->paginate(5, 'pengembalian');
    }
    public function get_kembali_all()
    {
        return $this->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->findAll();
    }
    public function get_kembali_by_id($id_kembali)
    {
        return $this->where(['id_kembali' => $id_kembali])->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->first();
    }
    public function get_kembali_by_idAnggota()
    {
        return $this->where(['anggota.id_anggota' => session()->idUser])->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->paginate(5, 'pengembalian');
    }

    public function search($keyword)
    {
        return $this->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->like('judul', $keyword)->orlike('nama_anggota', $keyword)->orlike('nama_petugas', $keyword)->paginate(5, 'pengembalian');
    }
    public function searchAnggota($keyword) // View riwayat user
    {
        return $this->where(['anggota.id_anggota' => session()->idUser])->join('buku', 'pengembalian.id_buku = buku.id_buku')->join('petugas', 'pengembalian.id_petugas = petugas.id_petugas')->join('anggota', 'pengembalian.id_anggota = anggota.id_anggota')->like('judul', $keyword)->paginate(5, 'pengembalian');
    }
}
