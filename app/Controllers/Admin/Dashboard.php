<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard | E-LIBRARY',
        ];
        return view('halaman/admin/dashboard', $data);
    }
}
