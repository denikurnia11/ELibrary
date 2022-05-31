<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content -->
<h2 class="text-center mb-5"><b>FORM TAMBAH ANGGOTA</b></h2>
<form action="<?= base_url('/admin/anggota/save'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6">
            <div class="row mb-4">
                <label for="nama_anggota" class="col-sm-2 col-form-label ">Nama</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="nama_anggota" name="nama_anggota" autocomplete="off" value="<?= old('nama_anggota'); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <label for="jk" class="col-sm-2 col-form-label">J. Kelamin</label>
                <div class="col-sm-10">
                    <select name="jk" class="form-select" aria-label="Default select example">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="jurusan" class="col-sm-2 col-form-label ">Jurusan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="jurusan" name="jurusan" autocomplete="off" value="<?= old('jurusan'); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('angkatan')) ? 'is-invalid' : ''; ?>" id="angkatan" name="angkatan" autocomplete="off" value="<?= old('angkatan'); ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('angkatan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-8">
                    <input class="form-control inputFoto <?= ($validasi->hasError('foto')) ? 'is-invalid' : ''; ?>" type="file" id="foto" name="foto">
                    <p class="keterangan">*Format (jpg, jpeg, png) maks 1mb</p>
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('foto'); ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img src="/img/default.jpg" class="img-thumbnail img-preview">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-4">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input required type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= old('email'); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= old('alamat'); ?>">
                </div>
            </div>
            <div class="row mb-4">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= old('username'); ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" autocomplete="off" value="<?= old('password'); ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('password'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>