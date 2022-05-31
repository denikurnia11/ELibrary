<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table      = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $allowedFields = ['nama_petugas', 'jk', 'jabatan', 'telpon', 'alamat', 'username', 'password', 'foto', 'email'];

    public function search($keyword)
    {
        return $this->like('nama_petugas', $keyword)->orlike('jk', $keyword)->orlike('jabatan', $keyword)->orlike('telpon', $keyword)->orlike('username', $keyword)->orlike('password', $keyword)->orlike('email', $keyword)->paginate(5, 'petugas');
    }
}
