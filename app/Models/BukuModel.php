<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'id_rak'];
    public function get_buku()
    {
        return $this->join('rak', 'buku.id_rak = rak.id_rak')->paginate(5, 'buku');
    }
    public function get_buku_by_id($id_buku)
    {
        return $this->where(['id_buku' => $id_buku])->join('rak', 'buku.id_rak = rak.id_rak')->first();
    }
    public function search($keyword)
    {
        return $this->like('judul', $keyword)->orlike('penulis', $keyword)->orlike('penerbit', $keyword)->orlike('tahun_terbit', $keyword)->join('rak', 'buku.id_rak = rak.id_rak')->paginate(5, 'buku');
    }
}
