<?php

namespace App\Controllers\User;


use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;

class Pengembalian extends BaseController
{

    protected $bukuModel, $pengembalianModel, $peminjamanModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->pengembalianModel = new PengembalianModel();
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
        return view('halaman/user/pengembalian', $data);
    }

    public function riwayat()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_pengembalian') ? $this->request->getVar('page_pengembalian') : 1;

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengembalian = $this->pengembalianModel->searchAnggota($keyword);
        } else {
            $pengembalian = $this->pengembalianModel->get_kembali_by_idAnggota();
        }

        $data = [
            'title' => 'Data pengembalian | E-LIBRARY',
            'pengembalian' => $pengembalian,
            'pager' => $this->pengembalianModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/user/riwayatPeminjaman', $data);
    }
    public function kembali($id)
    {
        $data = [
            'title' => 'Form Pengembalian Buku',
            'peminjaman' => $this->peminjamanModel->get_pinjam_by_id($id),
        ];

        return view('halaman/user/pengembalianAction/tambah', $data);
    }

    public function save()
    {
        $this->pengembalianModel->save([
            'id_buku' => $this->request->getVar('judul'),
            'id_anggota' => $this->request->getVar('nama_anggota'),
            'id_petugas' => $this->request->getVar('nama_petugas'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'jatuh_tempo' => $this->request->getVar('jatuh_tempo'),
            'jumlah_hari' => $this->request->getVar('jumlah_hari'),
            'denda' => $this->request->getVar('denda'),
            'total_denda' => $this->request->getVar('total_denda'),
        ]);

        session()->setFlashdata('pesan', 'Buku berhasil dikembalikan.');
        // Delete data peminjaman buku
        $id_pinjam = $this->request->getVar("id_pinjam");
        $this->peminjamanModel->delete($id_pinjam);

        return redirect()->to('/user/pengembalian');
    }
    public function delete($id)
    {
        $this->pengembalianModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/user/pengembalian/riwayat');
    }
}
