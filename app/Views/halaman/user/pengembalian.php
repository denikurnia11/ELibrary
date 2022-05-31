<?= $this->extend('layout/UserTemplate'); ?>

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
        <a href="/user/pengembalian/riwayat" class="btn btn-danger mb-2"><i class="fas fa-history"></i></i> Riwayat Peminjaman</a>

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
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Petugas</th>
            <th scope="col" class="text-center">Tanggal Pinjam</th>
            <th scope="col" class="text-center">Tanggal Kembali</th>
            <th class="text-center" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 + (5 * ($currentPage - 1)) ?>
        <?php foreach ($peminjaman as $row) : ?>
            <tr>
                <th scope="row" class="text-center"><?= $no++; ?></th>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['nama_anggota']; ?></td>
                <td><?= $row['nama_petugas']; ?></td>
                <td class="text-center"><?= $row['tgl_pinjam']; ?></td>
                <td class="text-center"><?= $row['tgl_kembali']; ?></td>
                <?php if (session()->idUser === $row['id_anggota']) : ?>
                    <td class="text-center">
                        <a href="/user/pengembalian/kembali/<?= $row['id_pinjam']; ?>" class="btnAction btn btn-success btn-sm"><i class="fas fa-exchange-alt"></i> Kembalikan</a>
                    </td>
                <?php else : ?>
                    <td class="text-center"> </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Pagination -->
<div class="d-flex justify-content-center">
    <?= $pager->links('peminjaman', 'pagination'); ?>
</div>

<!-- End Content -->


<?= $this->endSection(); ?>