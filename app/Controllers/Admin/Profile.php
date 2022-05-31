<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PetugasModel;

class Profile extends BaseController
{
    protected $petugas;
    public function __construct()
    {
        $this->petugas = new PetugasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profile | E-LIBRARY',
            'petugas' => $this->petugas->find(session()->idUser)
        ];
        return view('halaman/admin/profile', $data);
    }
    public function edit()
    {
        $data = [
            'title' => 'Profile Edit | E-LIBRARY',
            'petugas' => $this->petugas->find(session()->idUser),
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/admin/profileAction/ubah', $data);
    }
    public function update($id)
    {
        // Cek jika username tidak diubah
        $usernameLama = $this->request->getVar('usernameLama');
        $usernameBaru = strtolower($this->request->getVar('username'));
        if ($usernameBaru == $usernameLama) {
            $rules = 'required';
        } else {
            $rules = 'is_unique[anggota.username]|is_unique[petugas.username]';
        }
        if (!$this->validate([
            'username' => [
                'rules' => $rules,
                'errors' => [
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'telpon' => [
                'rules' => 'integer',
                'errors' => [
                    'integer' => 'Harus berupa angka.'
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
            return redirect()->to('/admin/profile/edit/' . $id)->withInput();
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
        $this->petugas->replace([
            'id_petugas' => $this->request->getVar('id_petugas'),
            'nama_petugas' => $this->request->getVar('nama_petugas'),
            'jk' => $this->request->getVar('jk'),
            'jabatan' => $this->request->getVar('jabatan'),
            'telpon' => $this->request->getVar('telpon'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'username' => $usernameBaru,
            'password' => $this->request->getVar('password'),
            'foto' => $namaFoto
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        session()->set('foto', $namaFoto); // Dioper ke Template untuk foto di sidebar
        return redirect()->to('/admin/profile');
    }
}
