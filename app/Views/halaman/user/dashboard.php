<?= $this->extend('layout/userTemplate'); ?>

<?= $this->section('content'); ?>

<div class="container text-center d-flex justify-content-evenly">
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="/img/card1.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><b>PEMINJAMAN</b></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/peminjaman" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="/img/card2.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><b>PENGEMBALIAN</b></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/pengembalian" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>