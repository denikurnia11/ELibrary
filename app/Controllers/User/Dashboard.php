<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard | E-LIBRARY',
        ];
        return view('halaman/user/dashboard', $data);
    }
}
