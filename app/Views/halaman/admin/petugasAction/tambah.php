<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content -->
<h2 class="text-center mb-5"><b>FORM TAMBAH PETUGAS</b></h2>
<form action="<?= base_url('/admin/petugas/save'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6">
            <div class="row mb-3">
                <label for="nama_petugas" class="col-sm-2 col-form-label ">Nama</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="nama_petugas" name="nama_petugas" autocomplete="off" value="<?= old('nama_petugas'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jk" class="col-sm-2 col-form-label">J. Kelamin</label>
                <div class="col-sm-10">
                    <select name="jk" class="form-select" aria-label="Default select example">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jabatan" class="col-sm-2 col-form-label ">Jabatan</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off" value="<?= old('jabatan'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpon" class="col-sm-2 col-form-label">Telpon</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('telpon')) ? 'is-invalid' : ''; ?>" id="telpon" name="telpon" autocomplete="off" value="<?= old('telpon'); ?>">
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
                    <img src="/img/default.jpg" class="img-thumbnail img-preview">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= old('alamat'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input required type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= old('email'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input required type="text" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autocomplete="off" value="<?= old('username'); ?>">
                    <div class=" invalid-feedback">
                        <?= $validasi->getError('username'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
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