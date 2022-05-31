<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM PENGEMBALIAN BUKU</b></h2>
<form action="<?= base_url('/admin/pengembalian/save'); ?>" method="post">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <select name="judul" class="form-select select2" aria-label="Default select example">
                <?php foreach ($buku as $option) : ?>
                    <option value=<?php echo $option['id_buku'] ?>><?= $option['judul']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-10">
            <select name="nama_anggota" class="form-select select2" aria-label="Default select example">
                <?php foreach ($anggota as $option) : ?>
                    <option value=<?php echo $option['id_anggota'] ?>><?= $option['nama_anggota']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
        <div class="col-sm-10">
            <select name="nama_petugas" class="form-select select2" aria-label="Default select example">
                <?php foreach ($petugas as $option) : ?>
                    <option value=<?php echo $option['id_petugas'] ?>><?= $option['nama_petugas']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" autocomplete="off" value="<?= old('tgl_kembali'); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="jatuh_tempo" class="col-sm-2 col-form-label">Jatuh Tempo</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" autocomplete="off" value="<?= old('jatuh_tempo'); ?>" disabled>
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

    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>