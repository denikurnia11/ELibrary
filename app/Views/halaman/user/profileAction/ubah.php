<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<div class="warpContentProfile">
    <form action="/user/profile/update/<?= $anggota['id_anggota']; ?>" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row mb-3">
                <label for="nama_anggota" class="col-sm-2 col-form-label ">Nama</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control" id="nama_anggota" name="nama_anggota" autocomplete="off" value="<?= $anggota['nama_anggota']; ?>">
                </div>
                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-4">
                    <select name="jk" class="form-select" aria-label="Default select example">
                        <option value="L" <?= ($anggota['jk'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="P" <?= ($anggota['jk'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jurusan" class="col-sm-2 col-form-label ">Jurusan</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control" id="jurusan" name="jurusan" autocomplete="off" value="<?= $anggota['jurusan']; ?>">
                </div>
                <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control <?= ($validasi->hasError('angkatan')) ? 'is-invalid' : ''; ?>" id="angkatan" name="angkatan" autocomplete="off" value="<?= $anggota['angkatan']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('angkatan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= $anggota['alamat']; ?>">
                </div>
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= $anggota['username']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                    <input required type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= $anggota['email']; ?>">
                </div>
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-4">
                    <input required type="text" class="form-control  <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" autocomplete="off" value="<?= $anggota['password']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('password'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-4">
                    <input class="form-control inputFoto <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" type="file" id="foto" name="foto">
                    <p class="keterangan">*Format (jpg, jpeg, png) maks 1mb</p>
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('foto'); ?>
                    </div>
                </div>
                <label class="col-sm-2 col-form-label">Preview Foto</label>
                <div class="col-sm-4">
                    <img src="/img/<?= $anggota['foto']; ?>" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm align-self-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- Berguna apabila user tidak mengubah fotonya -->
            <input type="hidden" name="fotoLama" value="<?= $anggota['foto']; ?>">
            <!-- Berguna apabila user tidak mengubah usernamenya -->
            <input type="hidden" name="usernameLama" value="<?= $anggota['username']; ?>">
            <!-- Untuk mensave berdasarkan id anggota -->
            <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">
    </form>
</div>
</div>
<!-- End Content -->


<?= $this->endSection(); ?>