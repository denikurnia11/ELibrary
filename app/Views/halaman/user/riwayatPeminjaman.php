<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<div class="row text-start">
    <!-- FlashData -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success text-start d-flex justify-content-between align-items-center" role="alert">
            <?= session()->getFlashdata('pesan'); ?> <p class="text-end btnX">x</p>
        </div>
    <?php endif; ?>
    <div class="col-8">
        <a href="/user/pengembalian" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Pengembalian</a>
    </div>
    <div class="col-4">
        <form action="" class="d-flex" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan keyword..." name="keyword" autocomplete="off" value="<?= $keyword ?>">
                <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
            </div>
        </form>
    </div>
</div>


<table class="table table-striped table-hover border-top ">
    <thead class="">
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Anggota</th>
            <th scope="col">Petugas</th>
            <th scope="col" class="text-center">Tanggal Kembali</th>
            <th scope="col" class="text-center">Jatuh Tempo</th>
            <th scope="col" class="text-center">Jumlah Hari</th>
            <th scope="col" class="text-center">Denda (Rp)</th>
            <th scope="col" class="text-center">Total Denda (Rp)</th>
            <th class="text-center" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 + (5 * ($currentPage - 1)) ?>
        <?php foreach ($pengembalian as $row) : ?>
            <tr>
                <th scope="row" class="text-center"><?= $no++; ?></th>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['nama_anggota']; ?></td>
                <td><?= $row['nama_petugas']; ?></td>
                <td class="text-center"><?= $row['tgl_kembali']; ?></td>
                <td class="text-center"><?= $row['jatuh_tempo']; ?></td>
                <td class="text-center"><?= $row['jumlah_hari']; ?></td>
                <td class="text-center"><?= $row['denda']; ?></td>
                <td class="text-center"><?= $row['total_denda']; ?></td>
                <td class="text-center">
                    <a href="/user/pengembalian/delete/<?= $row['id_kembali']; ?>" onclick="return confirm('Lanjutkan hapus?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Pagination -->
<div class="d-flex justify-content-center">
    <?= $pager->links('pengembalian', 'pagination'); ?>
</div>

<!-- End Content -->


<?= $this->endSection(); ?>