<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM TAMBAH RAK</b></h2>
<form action="<?= base_url('/admin/rak/save'); ?>" method="post">
    <div class="row mb-3">
        <label for="nama_rak" class="col-sm-2 col-form-label">Nama Rak</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control <?= ($validasi->hasError('nama_rak')) ? 'is-invalid' : ''; ?>" id="nama_rak" name="nama_rak" autofocus autocomplete="off" value="<?= old('nama_rak'); ?>">
            <div class="invalid-feedback">
                <?= $validasi->getError('nama_rak'); ?>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>