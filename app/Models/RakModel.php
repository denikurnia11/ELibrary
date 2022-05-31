<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $table      = 'rak';
    protected $primaryKey = 'id_rak';
    protected $allowedFields = ['nama_rak'];

    public function search($keyword)
    {
        return $this->like('nama_rak', $keyword)->paginate(5, 'rak');
    }
}
