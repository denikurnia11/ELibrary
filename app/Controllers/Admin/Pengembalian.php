<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\RakModel;
use App\Models\PengembalianModel;
use App\Models\AnggotaModel;
use App\Models\PetugasModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengembalian extends BaseController
{

    protected $bukuModel, $rakModel, $pengembalianModel, $anggotaModel, $petugasModel;
    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->rakModel = new RakModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->anggotaModel = new AnggotaModel();
        $this->petugasModel = new PetugasModel();
    }
    public function index()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_pengembalian') ? $this->request->getVar('page_pengembalian') : 1;
        //Untuk url biar tidak kembali ke halaman awal saat save edit(Mengoper ke function update)
        session()->set('page', $currentPage);

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pengembalian = $this->pengembalianModel->search($keyword);
        } else {
            $pengembalian = $this->pengembalianModel->get_kembali();
        }

        $data = [
            'title' => 'Data Pengembalian | E-LIBRARY',
            'pengembalian' => $pengembalian,
            'pager' => $this->pengembalianModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/admin/pengembalian', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => 'Form Pengembalian Buku',
            'pengembalian' => $this->pengembalianModel->findAll(),
            'buku' => $this->bukuModel->findAll(),
            'rak' => $this->rakModel->findAll(),
            'anggota' => $this->anggotaModel->findAll(),
            'petugas' => $this->petugasModel->findAll(),
        ];
        return view('halaman/admin/pengembalianAction/tambah', $data);
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

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/pengembalian');
    }

    public function delete($id)
    {
        $this->pengembalianModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/pengembalian');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Pengembalian',
            'pengembalian' => $this->pengembalianModel->get_kembali_by_id($id),
            'buku' => $this->bukuModel->findAll(),
            'rak' => $this->rakModel->findAll(),
            'anggota' => $this->anggotaModel->findAll(),
            'petugas' => $this->petugasModel->findAll()
        ];
        return view('halaman/admin/pengembalianAction/ubah', $data);
    }
    public function update()
    {
        $this->pengembalianModel->replace([
            'id_kembali' => $this->request->getVar('id_kembali'),
            'id_buku' => $this->request->getVar('judul'),
            'id_anggota' => $this->request->getVar('nama_anggota'),
            'id_petugas' => $this->request->getVar('nama_petugas'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'jatuh_tempo' => $this->request->getVar('jatuh_tempo'),
            'jumlah_hari' => $this->request->getVar('jumlah_hari'),
            'denda' => $this->request->getVar('denda'),
            'total_denda' => $this->request->getVar('total_denda'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        $currentPage = session()->get('page');
        return redirect()->to('/admin/pengembalian/?page_pengembalian=' . $currentPage);
    }
    public function exportPDF()
    {
        $data = $this->pengembalianModel->get_kembali_all();
        $table = '';
        $no = 1;
        foreach ($data as $row) {
            $table .= '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $row['judul'] . '</td>
                                <td>' . $row['nama_anggota'] . '</td>
                                <td>' . $row['nama_petugas'] . '</td>
                                <td>' . $row['tgl_kembali'] . '</td>                         
                                <td>' . $row['jatuh_tempo'] . '</td>
                                <td>' . $row['jumlah_hari'] . '</td>
                                <td>' . $row['denda'] . '</td>
                                <td>' . $row['total_denda'] . '</td>
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
                        <th>Tanggal Kembali</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Hari</th>
                        <th>Denda</th>
                        <th>Total Denda</th>
                    </tr>
                    </thead>
                    <tbody>
                    ' . $table . '                       
                    </tbody>
                </table>');
        $mpdf->Output('Laporan_data_pengembalian.pdf', 'I');
        exit;
    }

    public function exportExcel()
    {
        $data = $this->pengembalianModel->get_kembali_all();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Judul Buku')
            ->setCellValue('B1', 'Nama Anggota')
            ->setCellValue('C1', 'Nama Petugas')
            ->setCellValue('D1', 'Tanggal Kembali')
            ->setCellValue('E1', 'Jatuh Tempo')
            ->setCellValue('F1', 'Jumlah Hari')
            ->setCellValue('G1', 'Denda')
            ->setCellValue('H1', 'Total Denda');

        $column = 2;
        // tulis data buku ke cell
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['judul'])
                ->setCellValue('B' . $column, $data['nama_anggota'])
                ->setCellValue('C' . $column, $data['nama_petugas'])
                ->setCellValue('D' . $column, $data['tgl_kembali'])
                ->setCellValue('E' . $column, $data['jatuh_tempo'])
                ->setCellValue('F' . $column, $data['jumlah_hari'])
                ->setCellValue('G' . $column, $data['denda'])
                ->setCellValue('H' . $column, $data['total_denda']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Pengembalian Buku';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
