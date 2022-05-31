<?= $this->extend('halaman/auth/authTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<section class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <img class="img" src="/img/login.jpg">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex justify-content-center">
                            <div class="">
                                <h3 class="mb-4">Sign In</h3>
                            </div>
                        </div>
                        <form action="/auth/auth/cek_login" class="signin-form" method="POST">
                            <!-- FlashData -->
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success text-start d-flex justify-content-between align-items-center" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?> <p class="text-end btnX">x</p>
                                </div>
                            <?php endif; ?>
                            <div class="form-group mb-3">
                                <label class="label" for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-eye-slash" id="iconPassword"></i></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                        </form>
                        <p class="text-center mt-5 fw-bolder">Not a member? <a data-toggle="tab" href="/register">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Content -->
<?= $this->endSection(); ?>