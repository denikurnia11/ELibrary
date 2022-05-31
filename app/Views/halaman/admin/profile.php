<?= $this->extend('layout/Template'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<div class="warpContentProfile text-center">
    <img src="/img/<?= $petugas['foto']; ?>" class="img-thumbnail mt-1">
    <div class="container biodata">
        <div class="row text-start">
            <div class="col ">
                <p>Nama : <?= $petugas['nama_petugas']; ?></p>
                <p>Jenis Kelamin : <?= $petugas['jk']; ?></p>
                <p>Jabatan : <?= $petugas['jabatan']; ?></p>
                <p>Telpon : <?= $petugas['telpon']; ?></p>
                <a href="/admin/profile/edit" class="btn btn-success text-start">Edit</a>
            </div>
            <div class="col">
                <p>Alamat : <?= $petugas['alamat']; ?></p>
                <p>Email : <?= $petugas['email']; ?></p>
                <p>Username : <?= $petugas['username']; ?></p>
                <p>Password : <?= $petugas['password']; ?></p>
            </div>
        </div>
    </div>

</div>
<!-- End Content -->


<?= $this->endSection(); ?>