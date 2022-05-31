<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<div class="warpContentProfile text-center">
    <img src="/img/<?= $anggota['foto']; ?>" class="img-thumbnail mt-1">
    <div class="container biodata">
        <div class="row text-start">
            <div class="col ">
                <p>Nama : <?= $anggota['nama_anggota']; ?></p>
                <p>Jenis Kelamin : <?= $anggota['jk']; ?></p>
                <p>Jurusan : <?= $anggota['jurusan']; ?></p>
                <p>Angkatan : <?= $anggota['angkatan']; ?></p>
                <a href="/user/profile/edit" class="btn btn-success text-start">Edit</a>
            </div>
            <div class="col">
                <p>Alamat : <?= $anggota['alamat']; ?></p>
                <p>Email : <?= $anggota['email']; ?></p>
                <p>Username : <?= $anggota['username']; ?></p>
                <p>Password : <?= $anggota['password']; ?></p>
            </div>
        </div>
    </div>

</div>
<!-- End Content -->


<?= $this->endSection(); ?>