<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends BaseController
{
    protected $anggotaModel;
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        //Mengambil current page untuk penomoran tabel
        $currentPage = $this->request->getVar('page_anggota') ? $this->request->getVar('page_anggota') : 1;
        //Untuk url biar tidak kembali ke halaman awal saat save edit(Mengoper ke function update)
        session()->set('page', $currentPage);

        //Searching
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $anggota = $this->anggotaModel->search($keyword);
        } else {
            $anggota = $this->anggotaModel->paginate(5, 'anggota');
        }

        $data = [
            'title' => 'Data Anggota | E-LIBRARY',
            'anggota' => $anggota,
            'pager' => $this->anggotaModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword // Untuk value di kolom input search
        ];
        return view('halaman/admin/anggota', $data);
    }
    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Anggota',
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/admin/anggotaAction/tambah', $data);
    }
    public function save()
    {
        //Validasi
        if (!$this->validate([
            'angkatan' => [
                'rules' => 'integer',
                'errors' => [
                    'integer' => 'Harus berupa angka.'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[anggota.username]|is_unique[petugas.username]',
                'errors' => [
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'password' => [
                'rules' => 'min_length[5]|max_length[15]',
                'errors' => [
                    'min_length' => 'Password minimal terdiri dari 5 huruf',
                    'max_length' => 'Password maksimal terdiri dari 15 huruf',
                ]
            ],
            'foto' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
        ])) {

            return redirect()->to('/admin/anggota/tambah')->withInput();
        }

        // Mengambil foto
        $fileFoto = $this->request->getFile('foto');
        // Cek apakah mengupload foto
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.jpg';
        } else {
            // Membuat nama random untuk fotonya
            $namaFoto = $fileFoto->getRandomName();
            // Move ke folder public/img
            $fileFoto->move('img', $namaFoto);
        }


        $this->anggotaModel->save([
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk' => $this->request->getVar('jk'),
            'jurusan' => $this->request->getVar('jurusan'),
            'angkatan' => $this->request->getVar('angkatan'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/anggota');
    }
    public function delete($id)
    {
        // Nama foto
        $namaFoto = $this->anggotaModel->find($id);
        // Cek foto default
        if ($namaFoto['foto'] != 'default.jpg') {
            // Hapus file foto
            unlink('img/' . $namaFoto['foto']);
        }

        $this->anggotaModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin/anggota');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Edit Buku',
            'validasi' => \Config\Services::validation(),
            'anggota' => $this->anggotaModel->find($id),
        ];
        return view('halaman/admin/anggotaAction/ubah', $data);
    }
    public function update($id)
    {
        // Cek apakah mengganti username
        $usernameLama = $this->request->getVar('usernameLama');
        $usernameBaru = strtolower($this->request->getVar('username'));
        if ($usernameBaru == $usernameLama) {
            $rules = 'required';
        } else {
            $rules = 'is_unique[anggota.username]|is_unique[petugas.username]';
        }

        if (!$this->validate([
            'angkatan' => [
                'rules' => 'integer',
                'errors' => [
                    'integer' => 'Harus berupa angka.'
                ]
            ],
            'username' => [
                'rules' => $rules,
                'errors' => [
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'password' => [
                'rules' => 'min_length[5]|max_length[15]',
                'errors' => [
                    'min_length' => 'Password minimal terdiri dari 5 huruf',
                    'max_length' => 'Password maksimal terdiri dari 15 huruf',
                ]
            ],
            'foto' => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]'
        ])) {
            return redirect()->to('/admin/anggota/edit/' . $id)->withInput();
        }
        // Mengambil foto baru
        $fileFoto = $this->request->getFile('foto');
        // Mengambil nama foto lama dari input hidden
        $fotoLama = $this->request->getVar('fotoLama');
        // Cek apakah mengupload foto
        if ($fileFoto->getError() == 4) {
            $namaFoto = $fotoLama;
        } else {
            // Membuat nama random untuk fotonya
            $namaFoto = $fileFoto->getRandomName();
            // Move ke folder public/img
            $fileFoto->move('img', $namaFoto);

            // Cek foto default
            if ($fotoLama !== 'default.jpg') {
                // Hapus foto lama di folder img
                unlink('img/' . $fotoLama);
            }
        }
        $this->anggotaModel->replace([
            'id_anggota' => $this->request->getVar('id_anggota'),
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk' => $this->request->getVar('jk'),
            'jurusan' => $this->request->getVar('jurusan'),
            'angkatan' => $this->request->getVar('angkatan'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'username' => $usernameBaru,
            'password' => $this->request->getVar('password'),
            'foto' => $namaFoto
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        $currentPage = session()->get('page');
        return redirect()->to('/admin/anggota/?page_anggota=' . $currentPage);
    }
    public function exportPDF()
    {
        $data = $this->anggotaModel->findAll();
        $table = '';
        $no = 1;
        foreach ($data as $row) {
            $table .= '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $row['nama_anggota'] . '</td>
                                <td>' . $row['jk'] . '</td>
                                <td>' . $row['jurusan'] . '</td>
                                <td>' . $row['angkatan'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['alamat'] . '</td>                             
                                <td>' . $row['username'] . '</td>                             
                                <td>' . $row['password'] . '</td>                             
                                <td><img src="img/' . $row['foto'] . '" width="50"></td>                             
                                                      
                            </tr>';
        }
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<table border="1" id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Foto</th>
                    </tr>
                    </thead>
                    <tbody>
                    ' . $table . '                       
                    </tbody>
                </table>');
        $mpdf->Output('Laporan_data_anggota.pdf', 'I');
        exit;
    }

    public function exportExcel()
    {
        $data = $this->anggotaModel->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Jenis Kelamin')
            ->setCellValue('C1', 'Jurusan')
            ->setCellValue('D1', 'Angkatan')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Alamat')
            ->setCellValue('G1', 'Username')
            ->setCellValue('H1', 'Password')
            ->setCellValue('I1', 'Foto');

        $column = 2;
        // tulis data buku ke cell
        foreach ($data as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama_anggota'])
                ->setCellValue('B' . $column, $data['jk'])
                ->setCellValue('C' . $column, $data['jurusan'])
                ->setCellValue('D' . $column, $data['angkatan'])
                ->setCellValue('E' . $column, $data['email'])
                ->setCellValue('F' . $column, $data['alamat'])
                ->setCellValue('G' . $column, $data['username'])
                ->setCellValue('H' . $column, $data['password']);
            // ->setCellValue('I' . $column, $data['foto']);
            // Menambah foto
            $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $objDrawing->setPath('img' . '/' . $data['foto']);
            $objDrawing->setCoordinates('I' . $column);
            $objDrawing->setOffsetX(5);
            $objDrawing->setOffsetY(5);
            $objDrawing->setWidth(50);
            $objDrawing->setHeight(50);
            $objDrawing->setWorksheet($spreadsheet->getActiveSheet());
            // Mengatur row height
            $spreadsheet->getActiveSheet()->getRowDimension($column)->setRowHeight(50);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Anggota';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
