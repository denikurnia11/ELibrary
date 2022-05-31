<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM EDIT PEMINJAMAN BUKU</b></h2>
<!-- FlashData -->
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-danger text-start d-flex justify-content-between align-items-center" role="alert">
        <?= session()->getFlashdata('pesan'); ?> <p class="text-end btnX">x</p>
    </div>
<?php endif; ?>
<form action="/user/peminjaman/update" method="post">
    <input type="hidden" name="id_pinjam" value="<?= $peminjaman['id_pinjam']; ?>">
    <input type="hidden" name="id_petugas" value="<?= $peminjaman['id_petugas']; ?>">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <select name="judul" id="judul" class="form-select select2" aria-label="Default select example" style="width: 100%">
                <?php foreach ($buku as $option) : ?>
                    <option value=<?php echo $option['id_buku'] ?> <?= ($option['id_buku'] == $peminjaman['id_buku']) ? 'selected' : ''; ?>><?= $option['judul']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" autocomplete="off" value="<?= session()->nama ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control " id="tgl_pinjam" name="tgl_pinjam" autocomplete="off" value="<?= $peminjaman['tgl_pinjam']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control " id="tgl_kembali" name="tgl_kembali" autocomplete="off" value="<?= $peminjaman['tgl_kembali']; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>