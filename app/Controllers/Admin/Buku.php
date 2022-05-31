<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\RakModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        return view('halaman/admin/buku', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'rak' => $this->rakModel->findAll(),
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/admin/bukuAction/tambah', $data);
    }
    public function save()
    {
        //Validasi
        if (!$this->validate([
            'judul' => [
                'rules' => 'is_unique[buku.judul]',
                'errors' => [
                    'is_unique' => 'Judul buku sudah tersedia.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'integer',
                'errors' => [
                    'integer' => 'Harus berupa angka.'
                ]
            ]
        ])) {

            return redirect()->to('/admin/buku/tambah')->withInput();
        }

        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'id_rak' => $this->request->getVar('rak')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/buku');
    }

    public function delete($id)
    {
        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/buku');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Buku',
            'validasi' => \Config\Services::validation(),
            'buku' => $this->bukuModel->get_buku_by_id($id),
            'rak' => $this->rakModel->findAll(),
        ];
        return view('halaman/admin/bukuAction/ubah', $data);
    }
    public function update($id)
    {
        // Cek apakah judul buku diganti
        $judulLama = $this->request->getVar('judulLama');
        $judulBaru = $this->request->getVar('judul');
        if ($judulBaru == $judulLama) {
            $rules = 'required';
        } else {
            $rules = 'is_unique[buku.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rules,
                'errors' => [
                    'is_unique' => 'Judul buku sudah tersedia.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'integer',
                'errors' => [
                    'integer' => 'Harus berupa angka.'
                ]
            ]
        ])) {
            return redirect()->to('/admin/buku/edit/' . $id)->withInput();
        }
        $this->bukuModel->replace([
            'id_buku' => $this->request->getVar('id_buku'),
            'judul' =>  $judulBaru,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'id_rak' => $this->request->getVar('rak')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        $currentPage = session()->get('page');
        return redirect()->to('/admin/buku/?page_buku=' . $currentPage);
    }
    public function exportPDF()
    {
        $data = $this->bukuModel->join('rak', 'buku.id_rak = rak.id_rak')->findAll();
        $table = '';
        $no = 1;
        foreach ($data as $row) {
            $table .= '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $row['judul'] . '</td>
                                <td>' . $row['penulis'] . '</td>
                                <td>' . $row['penerbit'] . '</td>
                                <td>' . $row['tahun_terbit'] . '</td>
                                <td>' . $row['nama_rak'] . '</td>                             
                            </tr>';
        }
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<table border="1" id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Rak</th>
                    </tr>
                    </thead>
                    <tbody>
                    ' . $table . '                       
                    </tbody>
                </table>');
        $mpdf->Output('Laporan_data_buku.pdf', 'I');
        exit;
    }

    public function exportExcel()
    {
        $data = $this->bukuModel->join('rak', 'buku.id_rak = rak.id_rak')->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Judul')
            ->setCellValue('B1', 'Penulis')
            ->setCellValue('C1', 'Penerbit')
            ->setCellValue('D1', 'Tahun Terbit')
            ->setCellValue('E1', 'Nama Rak');

        $column = 2;
        // tulis data buku ke cell
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['judul'])
                ->setCellValue('B' . $column, $data['penulis'])
                ->setCellValue('C' . $column, $data['penerbit'])
                ->setCellValue('D' . $column, $data['tahun_terbit'])
                ->setCellValue('E' . $column, $data['nama_rak']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Buku';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
