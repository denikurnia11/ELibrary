<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<div class="row text-start">
    <div class="col-8">

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
            <th scope="col">Penulis</th>
            <th scope="col">Penerbit</th>
            <th scope="col" class="text-center">Tahun Terbit</th>
            <th scope="col" class="text-center">Rak</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 + (5 * ($currentPage - 1)) ?>
        <?php foreach ($buku as $row) : ?>
            <tr>
                <th scope="row" class="text-center"><?= $no++; ?></th>
                <td><?= $row['judul']; ?></td>
                <td><?= $row['penulis']; ?></td>
                <td><?= $row['penerbit']; ?></td>
                <td class="text-center"><?= $row['tahun_terbit']; ?></td>
                <td class="text-center"><?= $row['nama_rak']; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Pagination -->
<div class="d-flex justify-content-center">
    <?= $pager->links('buku', 'pagination'); ?>
</div>

<!-- End Content -->


<?= $this->endSection(); ?>