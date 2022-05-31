<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM PENGEMBALIAN BUKU</b></h2>
<form action="<?= base_url('/user/pengembalian/save'); ?>" method="post">
    <!-- Dioper ke method save -->
    <input type="hidden" value="<?= $peminjaman['id_pinjam']; ?>" name="id_pinjam">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <select name="judul" class="form-select" aria-label="Default select example">
                <option value=<?php echo $peminjaman['id_buku'] ?>><?= $peminjaman['judul']; ?></option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-10">
            <select name="nama_anggota" class="form-select" aria-label="Default select example">
                <option value=<?php echo $peminjaman['id_anggota'] ?>><?= $peminjaman['nama_anggota']; ?></option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
        <div class="col-sm-10">
            <select name="nama_petugas" class="form-select" aria-label="Default select example">

                <option value=<?php echo $peminjaman['id_petugas'] ?>><?= $peminjaman['nama_petugas']; ?></option>

            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control " id="tgl_kembali" name="tgl_kembali" autocomplete="off">
        </div>
    </div>
    <div class="row mb-3">
        <label for="jatuh_tempo" class="col-sm-2 col-form-label">Jatuh Tempo</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" autocomplete="off" value="<?= $peminjaman['tgl_kembali']; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="jumlah_hari" class="col-sm-2 col-form-label">Jumlah Hari</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari" autofocus autocomplete="off" value="-" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="denda" class="col-sm-2 col-form-label">Denda (Rp)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="denda" name="denda" autofocus autocomplete="off" value="1000" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="total_denda" class="col-sm-2 col-form-label">Total Denda (Rp)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="total_denda" name="total_denda" autofocus autocomplete="off" value="0" readonly>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Selesai</button>
</form>
<!-- End Content -->

<?= $this->endSection(); ?>