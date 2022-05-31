<?php


namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\RakModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class Rak extends BaseController
{

    protected $rakModel;
    public function __construct()
    {
        $this->rakModel = new RakModel();
    }
    public function index()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_rak') ? $this->request->getVar('page_rak') : 1;
        //Untuk url biar tidak kembali ke halaman awal saat save edit(Mengoper ke function update)
        session()->set('page', $currentPage);

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $rak = $this->rakModel->search($keyword);
        } else {
            $rak = $this->rakModel->paginate(5, 'rak');
        }

        $data = [
            'title' => 'Data Rak | E-LIBRARY',
            'rak' => $rak,
            'pager' => $this->rakModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/admin/rak', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Rak',
            'rak' => $this->rakModel->findAll(),
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/admin/rakAction/tambah', $data);
    }
    public function save()
    {
        //Validasi
        if (!$this->validate([
            'nama_rak' => [
                'rules' => 'is_unique[rak.nama_rak]',
                'errors' => [
                    'is_unique' => 'Nama sudah digunakan.'
                ]
            ],
        ])) {

            return redirect()->to('/admin/rak/tambah')->withInput();
        }

        $this->rakModel->save([
            'nama_rak' => $this->request->getVar('nama_rak'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/rak');
    }

    public function delete($id)
    {
        $this->rakModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/rak');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit rak',
            'validasi' => \Config\Services::validation(),
            'rak' => $this->rakModel->find($id)
        ];
        return view('halaman/admin/rakAction/ubah', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama_rak' => [
                'rules' => 'is_unique[rak.nama_rak]',
                'errors' => [
                    'is_unique' => 'Nama sudah digunakan.'
                ]
            ],
        ])) {
            return redirect()->to('/admin/rak/edit/' . $id)->withInput();
        }
        $this->rakModel->replace([
            'id_rak' => $this->request->getVar('id_rak'),
            'nama_rak' => $this->request->getVar('nama_rak')
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        $currentPage = session()->get('page');
        return redirect()->to('/admin/rak/?page_rak=' . $currentPage);
    }
    public function exportPDF()
    {
        $data = $this->rakModel->findAll();
        $table = '';
        $no = 1;
        foreach ($data as $row) {
            $table .= '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $row['nama_rak'] . '</td>                           
                            </tr>';
        }
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<table border="1" id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Rak</th>
                    </tr>
                    </thead>
                    <tbody>
                    ' . $table . '                       
                    </tbody>
                </table>');
        $mpdf->Output('Laporan_data_rak.pdf', 'I');
        exit;
    }

    public function exportExcel()
    {
        $data = $this->rakModel->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id Rak')
            ->setCellValue('B1', 'Nama Rak');

        $column = 2;
        // tulis data rak ke cell
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['id_rak'])
                ->setCellValue('B' . $column, $data['nama_rak']);

            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data rak';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
