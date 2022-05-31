<?= $this->extend('layout/template'); ?>

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
        <a href="/admin/petugas/tambah" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
        <a href="/admin/petugas/exportPDF" class="btn btn-danger mb-2"><i class="fas fa-file-pdf"></i> PDF</a>
        <a href="/admin/petugas/exportExcel" class="btn btn-success mb-2"><i class="fas fa-file-excel"></i> Excel</a>
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
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Jabatan</th>
            <th scope="col" class="text-center">Telpon</th>
            <th scope="col" class="text-center">Alamat</th>
            <th scope="col" class="text-center">Email</th>
            <th scope="col" class="text-center">Username</th>
            <th scope="col" class="text-center">Password</th>
            <th scope="col" class="text-center">Foto</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 + (5 * ($currentPage - 1)) ?>
        <?php foreach ($petugas as $row) : ?>
            <tr>
                <th scope="row" class="text-center"><?= $no++; ?></th>
                <td><?= $row['nama_petugas']; ?></td>
                <td><?= $row['jk']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td class="text-center"><?= $row['telpon']; ?></td>
                <td class="text-center"><?= $row['alamat']; ?></td>
                <td class="text-center"><?= $row['email']; ?></td>
                <td class="text-center"><?= $row['username']; ?></td>
                <td class="text-center"><?= $row['password']; ?></td>
                <td class="text-center"><img class="foto" src="/img/<?= $row['foto']; ?>"></td>
                <td class="text-center">
                    <a href="/admin/petugas/edit/<?= $row['id_petugas']; ?>" class="btnAction btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="/admin/petugas/delete/<?= $row['id_petugas']; ?>" onclick="return confirm('Lanjutkan hapus?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Pagination -->
<div class="d-flex justify-content-center">
    <?= $pager->links('petugas', 'pagination'); ?>
</div>

<!-- End Content -->


<?= $this->endSection(); ?>