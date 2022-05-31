<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content -->
<h2 class="text-center mb-5"><b>FORM EDIT PETUGAS</b></h2>
<form action="/admin/petugas/update/<?= $petugas['id_petugas']; ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6">
            <div class="row mb-3">
                <label for="nama_petugas" class="col-sm-2 col-form-label ">Nama</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="nama_petugas" name="nama_petugas" autocomplete="off" value="<?= (old('nama_petugas')) ? old('nama_petugas') : $petugas['nama_petugas']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jk" class="col-sm-2 col-form-label">J. Kelamin</label>
                <div class="col-sm-10">
                    <select name="jk" class="form-select" aria-label="Default select example">
                        <option value="L" <?= ($petugas['jk'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="P" <?= ($petugas['jk'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jabatan" class="col-sm-2 col-form-label ">Jabatan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off" value="<?= (old('jabatan')) ? old('jabatan') : $petugas['jabatan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('telpon')) ? 'is-invalid' : ''; ?>" id="telpon" name="telpon" autocomplete="off" value="<?= (old('telpon')) ? old('telpon') : $petugas['telpon']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('telpon'); ?>
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
                    <img src="/img/<?= $petugas['foto']; ?>" class="img-thumbnail img-preview">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= (old('alamat')) ? old('alamat') : $petugas['alamat']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input required type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= (old('email')) ? old('email') : $petugas['email']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= (old('username')) ? old('username') : $petugas['username']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" autocomplete="off" value="<?= (old('password')) ? old('password') : $petugas['password']; ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('password'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berguna apabila user tidak mengubah fotonya -->
    <input type="hidden" name="fotoLama" value="<?= $petugas['foto']; ?>">
    <!-- Berguna apabila user tidak mengubah usernamenya -->
    <input type="hidden" name="usernameLama" value="<?= $petugas['username']; ?>">
    <!-- Untuk mensave berdasarkan id petugas -->
    <input type="hidden" name="id_petugas" value="<?= $petugas['id_petugas']; ?>">

    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>