<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['nama_anggota', 'jk', 'jurusan', 'angkatan', 'alamat', 'username', 'password', 'foto', 'email'];

    public function search($keyword)
    {
        return $this->like('nama_anggota', $keyword)->orlike('jk', $keyword)->orlike('jurusan', $keyword)->orlike('angkatan', $keyword)->orlike('username', $keyword)->orlike('password', $keyword)->orlike('email', $keyword)->paginate(5, 'anggota');
    }
}
