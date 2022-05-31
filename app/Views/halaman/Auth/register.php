<?= $this->extend('halaman/auth/authTemplate'); ?>

<?= $this->section('content'); ?>


<!-- Content -->
<section class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <img class="img" src="/img/register.jpg">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex justify-content-center">
                            <div class="">
                                <h3 class="mb-4">Sign Up</h3>
                            </div>
                        </div>
                        <form action="/Auth/Auth/save" class="signin-form" method="post">
                            <div class="form-group mb-3">
                                <label class="label" for="nama_anggota">Full Name</label>
                                <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" placeholder="Your Name" value="<?= old('nama_anggota'); ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@gmail.com" value="<?= old('email'); ?>" autocomplete="off" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control <?= ($validasi->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username" value="<?= old('username'); ?>" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    <?= $validasi->getError('username'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control  <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    <?= $validasi->getError('password'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Re-Password" required>
                                <div class="invalid-feedback">
                                    <p id="cekConfirmPassword">Password tidak sama</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                            </div>
                        </form>
                        <p class="text-center mt-5 fw-bolder">Already have an acoount?<a data-toggle="tab" href="/"> Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Content -->
<?= $this->endSection(); ?>