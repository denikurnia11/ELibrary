<?php

namespace App\Controllers\Auth;

use App\Models\AnggotaModel;
use App\Models\PetugasModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $anggotaModel, $petugasModel;
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->petugasModel = new PetugasModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login | E-LIBRARY',
        ];
        return view('halaman/auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register | E-LIBRARY',
            'validasi' => \Config\Services::validation()
        ];
        return view('halaman/auth/register', $data);
    }
    public function save()
    {
        //Validasi
        if (!$this->validate([
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
            ]
        ])) {
            return redirect()->to('/register')->withInput();
        }

        $this->anggotaModel->save([
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'jk' => "L",
            'jurusan' => "-",
            'angkatan' => "-",
            'alamat' => "-",
            'email' => $this->request->getVar('email'),
            'username' => strtolower($this->request->getVar('username')),
            'password' => $this->request->getVar('password'),
        ]);

        session()->setFlashdata('pesan', 'Akun berhasil dibuat, silakan login.');
        return redirect()->to('/');
    }

    public function cek_login()
    {
        // Ambil data dari form
        $data = $this->request->getVar();

        // Ambil data user di database yang usernamenya sama 
        $user = $this->anggotaModel->where('username', $data['username'])->first();
        $admin = $this->petugasModel->where('username', $data['username'])->first();
        if ($user) {
            $dataUser = $user;
            $idUser = $user['id_anggota'];
            $nama = $user['nama_anggota'];
        } else if ($admin) {
            $dataUser = $admin;
            $idUser = $admin['id_petugas'];
            $nama = $admin['nama_petugas'];
        } else {
            // Jika username tidak ditemukan, balikkan ke halaman login
            session()->setFlashdata('pesan', 'Username tidak ditemukan');
            return redirect()->to('/');
        };

        // Cek password
        // Jika salah arahkan lagi ke halaman login
        if ($dataUser['password'] != $data['password']) {
            session()->setFlashdata('pesan', 'Password salah');
            return redirect()->to('/');
        } else {
            // Jika benar, arahkan user masuk ke aplikasi 
            $sessLogin = [
                'isLogin' => true,
                'idUser' => $idUser,
                'nama' => $nama, // Untuk menampilkan nama di sidebar
                'username' => $dataUser['username'], // Menampilkan username di navbar
                'foto' => $dataUser['foto'], // Foto di sidebar
                'role' => $dataUser['role']
            ];
            session()->set($sessLogin);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
