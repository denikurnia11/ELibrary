<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM TAMBAH BUKU</b></h2>
<form action="<?= base_url('/admin/buku/save'); ?>" method="post">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control <?= ($validasi->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus autocomplete="off" value="<?= old('judul'); ?>">
            <div class="invalid-feedback">
                <?= $validasi->getError('judul'); ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="penulis" class="col-sm-2 col-form-label">Penulis Buku</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="penulis" name="penulis" autocomplete="off" value="<?= old('penulis'); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="penerbit" class="col-sm-2 col-form-label ">Penerbit Buku</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="penerbit" name="penerbit" autocomplete="off" value="<?= old('penerbit'); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control <?= ($validasi->hasError('tahun_terbit')) ? 'is-invalid' : ''; ?>" id="tahun_terbit" name="tahun_terbit" autocomplete="off" value="<?= old('tahun_terbit'); ?>">
            <div class=" invalid-feedback">
                <?= $validasi->getError('tahun_terbit'); ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="rak" class="col-sm-2 col-form-label">Rak</label>
        <div class="col-sm-10">
            <select name="rak" class="form-select select2" aria-label="Default select example">
                <!-- <option selected>Pilih rak buku...</option> -->
                <?php foreach ($rak as $option) : ?>
                    <option value=<?php echo $option['id_rak'] ?>><?= $option['nama_rak']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>