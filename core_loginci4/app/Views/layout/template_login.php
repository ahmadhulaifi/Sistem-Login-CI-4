<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/asset/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <!-- ini cara menambah file include
        $this->include('posisi_file'); ?> -->

    <?= $this->renderSection('content'); ?>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/asset/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/asset/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>/asset/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/asset/vendor/select2/select2.min.js"></script>

    <!-- ajax -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>/asset/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->

    <script>
        let input = $('.validate-input .input100');
        $(document).ready(function() {

            $('.register').on('submit', function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>/login/save",
                    dataType: "JSON",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success == true) {
                            window.location = '<?= base_url('/login'); ?>'
                        } else {
                            // let check = true;
                            console.log(data.validation);
                            if (data.validation['nama'] !== '') {
                                showValidate('#nama', data.validation['nama']);
                            }
                            if (data.validation['email'] !== '') {
                                showValidate('#email', data.validation['email']);
                            }
                            if (data.validation['password'] !== '') {
                                showValidate('#password', data.validation['password']);
                            }
                            if (data.validation['passwordRepeat'] !== '') {
                                showValidate('#passwordRepeat', data.validation['passwordRepeat']);
                            }

                        }
                    }
                });
                return false;
            });

            $('.login').on('submit', function() {
                // let email = $("input[name='email']").val();
                // let password = $("input[name='password']").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>/login/cek",
                    dataType: "JSON",
                    data: $(this).serialize(),
                    // data: {
                    //     email: email,
                    //     password: password
                    // },
                    success: function(data) {
                        if (data.success == true) {
                            if (data.responce == 'not') {
                                window.location = '<?= base_url('/login'); ?>'
                                // alert('gagal');
                            } else {
                                alert('berhasil');
                            }
                        } else {
                            if (data.validation['email'] !== '') {
                                showValidate('#email', data.validation['email']);

                            }
                            if (data.validation['password'] !== '') {
                                showValidate('#password', data.validation['password']);

                            }
                        }
                    }
                });
                return false;
            });

        });

        $('.validate-form .input100').each(function() {
            $(this).focus(function() {
                hideValidate(this);
            });
        });

        function showValidate(input, param) {
            let thisAlert = $(input).parent();
            $(thisAlert).addClass('alert-validate');
            $(input).parent().attr("data-validate", param);
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();
            $(thisAlert).removeClass('alert-validate');
        }
    </script>

</body>

</html>