<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content -->
<h2 class="text-center mb-5"><b>FORM EDIT ANGGOTA</b></h2>
<form action="/admin/anggota/update/<?= $anggota['id_anggota']; ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6">
            <div class="row mb-3">
                <label for="nama_anggota" class="col-sm-2 col-form-label ">Nama</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="nama_anggota" name="nama_anggota" autocomplete="off" value="<?= (old('nama_anggota')) ? old('nama_anggota') : $anggota['nama_anggota']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jk" class="col-sm-2 col-form-label">J. Kelamin</label>
                <div class="col-sm-10">
                    <select name="jk" class="form-select" aria-label="Default select example">
                        <option value="L" <?= ($anggota['jk'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="P" <?= ($anggota['jk'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jurusan" class="col-sm-2 col-form-label ">Jurusan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="jurusan" name="jurusan" autocomplete="off" value="<?= (old('jurusan')) ? old('jurusan') : $anggota['jurusan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('angkatan')) ? 'is-invalid' : ''; ?>" id="angkatan" name="angkatan" autocomplete="off" value="<?= (old('angkatan')) ? old('angkatan') : $anggota['angkatan']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('angkatan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-8">
                    <input class="form-control inputFoto <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" type="file" id="foto" name="foto">
                    <p class="keterangan">*Format (jpg, jpeg, png) maks 1mb</p>
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('foto'); ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img src="/img/<?= $anggota['foto']; ?>" class="img-thumbnail img-preview">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input required type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= (old('email')) ? old('email') : $anggota['email']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= (old('alamat')) ? old('alamat') : $anggota['alamat']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= (old('username')) ? old('username') : $anggota['username']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" autocomplete="off" value="<?= (old('password')) ? old('password') : $anggota['password']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('password'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berguna apabila user tidak mengubah fotonya -->
    <input type="hidden" name="fotoLama" value="<?= $anggota['foto']; ?>">
    <!-- Berguna apabila user tidak mengubah usernamenya -->
    <input type="hidden" name="usernameLama" value="<?= $anggota['username']; ?>">
    <!-- Untuk mensave berdasarkan id anggota -->
    <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">

    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>