<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM EDIT PEMINJAMAN BUKU</b></h2>
<!-- FlashData -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-danger text-start d-flex justify-content-between align-items-center" role="alert">
        <?= session()->getFlashdata('pesan'); ?> <p class="text-end btnX">x</p>
    </div>
<?php endif; ?>
<form action="/admin/peminjaman/update" method="post">
    <input type="hidden" name="id_pinjam" value="<?= $peminjaman['id_pinjam']; ?>">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <select name="judul" class="form-select select2" aria-label="Default select example">
                <?php foreach ($buku as $option) : ?>
                    <option value="<?php echo $option['id_buku'] ?>" <?= ($option['id_buku'] == $peminjaman['id_buku']) ? 'selected' : ''; ?>><?= $option['judul']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-10">
            <select name="nama_anggota" class="form-select select2" aria-label="Default select example">
                <?php foreach ($anggota as $option) : ?>
                    <option value="<?php echo $option['id_anggota'] ?>" <?= ($option['id_anggota'] == $peminjaman['id_anggota']) ? 'selected' : ''; ?>><?= $option['nama_anggota']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
        <div class="col-sm-10">
            <select name="nama_petugas" class="form-select select2" aria-label="Default select example">
                <?php foreach ($petugas as $option) : ?>
                    <option value="<?php echo $option['id_petugas'] ?>" <?= ($option['id_petugas'] == $peminjaman['id_petugas']) ? 'selected' : ''; ?>><?= $option['nama_petugas']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" autocomplete="off" value="<?= (old('tgl_pinjam')) ? old('tgl_pinjam') : $peminjaman['tgl_pinjam']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" autocomplete="off" value="<?= (old('tgl_kembali')) ? old('tgl_kembali') : $peminjaman['tgl_kembali']; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>