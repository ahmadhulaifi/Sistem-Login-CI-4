<?= $this->extend('layout/template_login'); ?>

<?= $this->section('content'); ?>


<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 reg">
            <div class="col">
                <center>
                    <div class="login100-pic js-tilt p-b-20" data-tilt>
                        <img src="<?= base_url(); ?>/asset/images/logo_fisiart.png" alt="IMG" width="200">
                    </div>
                </center>
                <p id="listError"></p>
                <form class="validate-form register">
                    <?= csrf_field(); ?>
                    <span class="login100-form-title">
                        <?= $halaman; ?>
                    </span>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="nama" id="nama" placeholder="Nama lengkap">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="email" id="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="password" id="password" name="password" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="wrap-input100 validate-input">
                                <input class="input100" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Ulangi Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>

                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="text-center p-b-50 p-t-10">
                        <a class="txt2" href="<?= base_url(); ?>/login">
                            <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                            Halaman Login
                        </a>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>

<?= $this->endSection(); ?>