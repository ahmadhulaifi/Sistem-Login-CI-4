<?= $this->extend('layout/template_login'); ?>


<?= $this->section('content'); ?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= base_url(); ?>/asset/images/logo_fisiart.png" alt="IMG">
            </div>
            <form class="login100-form validate-form login">
                <?= csrf_field(); ?>
                <span class="login100-form-title">
                    <?= $halaman; ?>
                </span>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <center>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    </center>

                <?php endif; ?>
                <?php if (session()->getFlashdata('pesanError')) : ?>
                    <center>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('pesanError'); ?>
                        </div>
                    </center>

                <?php endif; ?>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" id="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" name="password" id="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="<?= base_url(); ?>/login/lupa">
                        Username / Password?
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="<?= base_url(); ?>/login/reg">
                        Buat Akun
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>