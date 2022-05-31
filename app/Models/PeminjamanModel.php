<?php

namespace App\Models;

use CodeIgniter\Model;
use Mpdf\Tag\Select;

class PeminjamanModel extends Model
{
    protected $table      = 'peminjaman';
    protected $primaryKey = 'id_pinjam';
    protected $allowedFields = ['id_pinjam', 'tgl_pinjam', 'tgl_kembali', 'id_petugas', 'id_anggota', 'id_buku'];

    public function get_pinjam()
    {
        return $this->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->paginate(5, 'peminjaman');
    }
    public function get_pinjam_all() // Untuk export
    {
        return $this->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->findAll();
    }
    public function get_pinjam_by_id($id_pinjam)
    {
        return $this->where(['id_pinjam' => $id_pinjam])->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->first();
    }
    public function get_pinjam_by_idAnggota() // Untuk view peminjaman per-user
    {
        return $this->where(['anggota.id_anggota' => session()->idUser])->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->paginate(5, 'peminjaman');
    }
    public function search($keyword)
    {
        return $this->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->like('judul', $keyword)->orlike('nama_anggota', $keyword)->orlike('nama_petugas', $keyword)->paginate(5, 'peminjaman');
    }
    public function searchAnggota($keyword) // Untuk view user
    {
        return $this->where(['anggota.id_anggota' => session()->idUser])->join('buku', 'peminjaman.id_buku = buku.id_buku')->join('petugas', 'peminjaman.id_petugas = petugas.id_petugas')->join('anggota', 'peminjaman.id_anggota = anggota.id_anggota')->like('judul', $keyword)->paginate(5, 'peminjaman');
    }
}
