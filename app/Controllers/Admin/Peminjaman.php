<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\RakModel;
use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;
use App\Models\PetugasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Peminjaman extends BaseController
{

    protected $bukuModel, $rakModel, $peminjamanModel, $anggotaModel, $petugasModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->rakModel = new RakModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->anggotaModel = new AnggotaModel();
        $this->petugasModel = new PetugasModel();
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
            $peminjaman = $this->peminjamanModel->search($keyword);
        } else {
            $peminjaman = $this->peminjamanModel->get_pinjam();
        }

        $data = [
            'title' => 'Data Peminjaman | E-LIBRARY',
            'peminjaman' => $peminjaman,
            'pager' => $this->peminjamanModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/admin/peminjaman', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => 'Form Peminjaman Buku',
            'buku' => $this->bukuModel->findAll(),
            'rak' => $this->rakModel->findAll(),
            'anggota' => $this->anggotaModel->findAll(),
            'petugas' => $this->petugasModel->findAll(),
        ];
        return view('halaman/admin/peminjamanAction/tambah', $data);
    }
    public function save()
    {
        // Cek tanggal pengembalian
        $tgl_pinjam = $this->request->getVar('tgl_pinjam');
        $tgl_kembali = $this->request->getVar('tgl_kembali');
        if ($tgl_kembali < $tgl_pinjam) {
            session()->setFlashdata('pesan', 'Tanggal pengembalian tidak valid. ');
            return redirect()->to('/admin/peminjaman/tambah');
        } else {
            $this->peminjamanModel->save([
                'id_buku' => $this->request->getVar('judul'),
                'id_anggota' => $this->request->getVar('nama_anggota'),
                'id_petugas' => $this->request->getVar('nama_petugas'),
                'tgl_pinjam' =>  $tgl_pinjam,
                'tgl_kembali' =>  $tgl_kembali
            ]);

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
            return redirect()->to('/admin/peminjaman');
        }
    }
    public function delete($id)
    {
        $this->peminjamanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/peminjaman');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Peminjaman',
            'peminjaman' => $this->peminjamanModel->get_pinjam_by_id($id),
            'buku' => $this->bukuModel->findAll(),
            'rak' => $this->rakModel->findAll(),
            'anggota' => $this->anggotaModel->findAll(),
            'petugas' => $this->petugasModel->findAll()
        ];
        return view('halaman/admin/peminjamanAction/ubah', $data);
    }
    public function update()
    {
        $idPinjam = $this->request->getVar('id_pinjam');
        // Cek tanggal pengembalian
        $tgl_pinjam = $this->request->getVar('tgl_pinjam');
        $tgl_kembali = $this->request->getVar('tgl_kembali');
        if ($tgl_kembali < $tgl_pinjam) {
            session()->setFlashdata('pesan', 'Tanggal pengembalian tidak valid. ');
            return redirect()->to('/admin/peminjaman/edit/' . $idPinjam);
        } else {
            $this->peminjamanModel->replace([
                'id_pinjam' => $idPinjam,
                'id_buku' => $this->request->getVar('judul'),
                'id_anggota' => $this->request->getVar('nama_anggota'),
                'id_petugas' => $this->request->getVar('nama_petugas'),
                'tgl_pinjam' => $tgl_pinjam,
                'tgl_kembali' => $tgl_kembali
            ]);
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
            $currentPage = session()->get('page');
            return redirect()->to('/admin/peminjaman/?page_peminjaman=' . $currentPage);
        }
    }
    public function exportPDF()
    {
        $data = $this->peminjamanModel->get_pinjam_all();
        $table = '';
        $no = 1;
        foreach ($data as $row) {
            $table .= '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $row['judul'] . '</td>
                                <td>' . $row['nama_anggota'] . '</td>
                                <td>' . $row['nama_petugas'] . '</td>
                                <td>' . $row['tgl_pinjam'] . '</td>
                                <td>' . $row['tgl_kembali'] . '</td>                         
                        </tr>';
        }
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<table border="1" id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Nama Anggota</th>
                        <th>Nama Petugas</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                    </tr>
                    </thead>
                    <tbody>
                    ' . $table . '                       
                    </tbody>
                </table>');
        $mpdf->Output('Laporan_data_peminjaman.pdf', 'I');
        exit;
    }

    public function exportExcel()
    {
        $data = $this->peminjamanModel->get_pinjam_all();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Judul Buku')
            ->setCellValue('B1', 'Nama Anggota')
            ->setCellValue('C1', 'Nama Petugas')
            ->setCellValue('D1', 'Tanggal Pinjam')
            ->setCellValue('E1', 'Tanggal Kembali');

        $column = 2;
        // tulis data buku ke cell
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['judul'])
                ->setCellValue('B' . $column, $data['nama_anggota'])
                ->setCellValue('C' . $column, $data['nama_petugas'])
                ->setCellValue('D' . $column, $data['tgl_pinjam'])
                ->setCellValue('E' . $column, $data['tgl_kembali']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Peminjaman Buku';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
