<?php

namespace App\Controllers\User;


use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\RakModel;


class Buku extends BaseController
{

    protected $bukuModel, $rakModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->rakModel = new RakModel();
    }

    public function index()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1;
        //Untuk url biar tidak kembali ke halaman awal saat save edit(Mengoper ke function update)
        session()->set('page', $currentPage);

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $buku = $this->bukuModel->search($keyword);
        } else {
            $buku = $this->bukuModel->get_buku();
        }

        $data = [
            'title' => 'Data Buku | E-LIBRARY',
            'buku' => $buku,
            'pager' => $this->bukuModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/user/buku', $data);
    }
}
