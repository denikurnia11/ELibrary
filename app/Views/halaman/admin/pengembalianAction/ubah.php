<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content -->
<h2 class="text-center mb-5"><b>FORM EDIT PENGEMBALIAN BUKU</b></h2>
<form action="/admin/pengembalian/update" method="post">
    <input type="hidden" name="id_kembali" value="<?= $pengembalian['id_kembali']; ?>">
    <div class="row mb-3">
        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
        <div class="col-sm-10">
            <select name="judul" class="form-select" aria-label="Default select example">
                <?php foreach ($buku as $option) : ?>
                    <option value="<?php echo $option['id_buku'] ?>" <?= ($option['id_buku'] == $pengembalian['id_buku']) ? 'selected' : ''; ?>><?= $option['judul']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-10">
            <select name="nama_anggota" class="form-select" aria-label="Default select example">
                <?php foreach ($anggota as $option) : ?>
                    <option value="<?php echo $option['id_anggota'] ?>" <?= ($option['id_anggota'] == $pengembalian['id_anggota']) ? 'selected' : ''; ?>><?= $option['nama_anggota']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama_petugas" class="col-sm-2 col-form-label">Nama Petugas</label>
        <div class="col-sm-10">
            <select name="nama_petugas" class="form-select" aria-label="Default select example">
                <?php foreach ($petugas as $option) : ?>
                    <option value="<?php echo $option['id_petugas'] ?>" <?= ($option['id_petugas'] == $pengembalian['id_petugas']) ? 'selected' : ''; ?>><?= $option['nama_petugas']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" autocomplete="off" value="<?= (old('tgl_kembali')) ? old('tgl_kembali') : $pengembalian['tgl_kembali']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="jatuh_tempo" class="col-sm-2 col-form-label">Jatuh Tempo</label>
        <div class="col-sm-10">
            <input required type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" autocomplete="off" value="<?= (old('jatuh_tempo')) ? old('jatuh_tempo') : $pengembalian['jatuh_tempo']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="jumlah_hari" class="col-sm-2 col-form-label">Jumlah Hari</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="jumlah_hari" name="jumlah_hari" autocomplete="off" value="<?= (old('jumlah_hari')) ? old('jumlah_hari') : $pengembalian['jumlah_hari']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="denda" class="col-sm-2 col-form-label">Denda (Rp)</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="denda" name="denda" autocomplete="off" value="<?= (old('denda')) ? old('denda') : $pengembalian['denda']; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="total_denda" class="col-sm-2 col-form-label">Total Denda (Rp)</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="total_denda" name="total_denda" autocomplete="off" value="<?= (old('total_denda')) ? old('total_denda') : $pengembalian['total_denda']; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Ubah</button>
</form>
<!-- End Content -->


<?= $this->endSection(); ?>