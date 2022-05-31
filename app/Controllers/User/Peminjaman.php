<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $bukuModel, $peminjamanModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_peminjaman') ? $this->request->getVar('page_peminjaman') : 1;
        //Untuk url biar tidak kembali ke halaman awal saat save edit(Mengoper ke function update)
        session()->set('page', $currentPage);

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $peminjaman = $this->peminjamanModel->searchAnggota($keyword);
        } else {
            $peminjaman = $this->peminjamanModel->get_pinjam_by_idAnggota();
        }

        $data = [
            'title' => 'Data Peminjaman | E-LIBRARY',
            'peminjaman' => $peminjaman,
            'pager' => $this->peminjamanModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/user/peminjaman', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Peminjaman Buku',
            'buku' => $this->bukuModel->findAll(),
        ];
        return view('halaman/user/peminjamanAction/tambah', $data);
    }

    public function save()
    {
        // Cek tanggal pengembalian
        $tgl_pinjam = $this->request->getVar('tgl_pinjam');
        $tgl_kembali = $this->request->getVar('tgl_kembali');
        if ($tgl_kembali < $tgl_pinjam) {
            session()->setFlashdata('pesan', 'Tanggal pengembalian tidak valid. ');
            return redirect()->to('/user/peminjaman/tambah');
        } else {
            $this->peminjamanModel->save([
                'id_buku' => $this->request->getVar('judul'),
                'id_anggota' => session()->idUser,
                'id_petugas' => 1,
                'tgl_pinjam' =>  $tgl_pinjam,
                'tgl_kembali' => $tgl_kembali
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/user/peminjaman');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Peminjaman',
            'peminjaman' => $this->peminjamanModel->get_pinjam_by_id($id),
            'buku' => $this->bukuModel->findAll(),
        ];
        return view('halaman/user/peminjamanAction/ubah', $data);
    }

    public function update()
    {
        $idPinjam = $this->request->getVar('id_pinjam');
        // Cek tanggal pengembalian
        $tgl_pinjam = $this->request->getVar('tgl_pinjam');
        $tgl_kembali = $this->request->getVar('tgl_kembali');
        if ($tgl_kembali < $tgl_pinjam) {
            session()->setFlashdata('pesan', 'Tanggal pengembalian tidak valid. ');
            return redirect()->to('/user/peminjaman/edit/' .  $idPinjam);
        } else {
            $this->peminjamanModel->replace([
                'id_pinjam' =>  $idPinjam,
                'id_buku' => $this->request->getVar('judul'),
                'id_anggota' => session()->idUser,
                'id_petugas' =>  $this->request->getVar('id_petugas'),
                'tgl_pinjam' => $tgl_pinjam,
                'tgl_kembali' =>  $tgl_kembali
            ]);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            $currentPage = session()->get('page');
            return redirect()->to('/user/peminjaman/?page_peminjaman=' . $currentPage);
        }
    }
}
