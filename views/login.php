<?php 
    include 'proses_login.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1" />
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Milestone">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Milestone">

    <meta name="theme-color" content="#4C7FF0">

    <title>Login</title>

    <!-- page stylesheets -->
    <!-- end page stylesheets -->

    <!-- build:css({.tmp,app}) ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/vendor/pace/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="../assets/styles/app.css" id="load_styles_before" />
    <link rel="stylesheet" href="../assets/styles/app.skins.css" />
    <!-- endbuild -->
</head>

<body>

    <div class="app no-padding no-footer layout-static">
        <div class="session-panel">
            <div class="session">
                <div class="session-content">
                    <div class="card card-block form-layout">
                        <!-- <form role="form" action="index.html" id="validate"> -->
                        <form action="login.php" method="post" onsubmit="return validasi()">
                            <div class="text-xs-center m-b-3">
                                <img src="images/logo-icon.png" height="80" alt="" class="m-b-1" />
                                <h5>
                                    Selamat Datang!
                                </h5>
                                <p class="text-muted">
                                    Masuk ke aplikasi Anda untuk melanjutkan.
                                </p>
                            </div>
                            <fieldset class="form-group">
                                <label for="username">
                                    Enter your username
                                </label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username"
                                    placeholder="username" required />
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="password">
                                    Enter your password
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" placeholder="********" required />
                            </fieldset>
                            <input type="hidden" name="login_input" value="1">
                            <button class="btn btn-primary btn-block btn-lg m-b-3" name="login_button" type="submit">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
    function validasi() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        if (username != "" && password != "") {
            return true;
        } else {
            alert('Username dan Password harus di isi !');
            return false;
        }
    }
    </script>

    <!-- build:js({.tmp,app}) ../assets/scripts/app.min.js -->
    <script src="../assets/vendor/jquery/dist/jquery.js"></script>
    <script src="../assets/vendor/pace/pace.js"></script>
    <script src="../assets/vendor/tether/dist/js/tether.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../assets/vendor/fastclick/lib/fastclick.js"></script>
    <script src="../assets/scripts/constants.js"></script>
    <!-- <script src="../assets/scripts/main.js"></script> -->
    <!-- endbuild -->

    <!-- page scripts -->
    <script src="../assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <!-- <script type="text/javascript">
    $('#validate').validate();
    </script> -->
    <!-- end initialize page scripts -->

</body>

</html>