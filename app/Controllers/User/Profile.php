<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class Profile extends BaseController
{
    protected $anggota;
    public function __construct()
    {
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profile | E-LIBRARY',
            'anggota' => $this->anggota->find(session()->idUser)
        ];
        return view('halaman/user/profile', $data);
    }
    public function edit()
    {
        $data = [
            'title' => 'Profile Edit | E-LIBRARY',
            'anggota' => $this->anggota->find(session()->idUser),
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/user/profileAction/ubah', $data);
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
            'angkatan' => [
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
            return redirect()->to('/user/profile/edit/' . $id)->withInput();
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

            // Cek foto default biar tidak terhapus
            if ($fotoLama !== 'default.jpg') {
                // Hapus foto lama di folder img
                unlink('img/' . $fotoLama);
            }
        }
        $this->anggota->replace([
            'id_anggota' => $this->request->getVar('id_anggota'),
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk' => $this->request->getVar('jk'),
            'jurusan' => $this->request->getVar('jurusan'),
            'angkatan' => $this->request->getVar('angkatan'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'foto' => $namaFoto
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        session()->set('foto', $namaFoto); // Dioper ke userTemplate untuk foto di sidebar
        return redirect()->to('/user/profile');
    }
}
