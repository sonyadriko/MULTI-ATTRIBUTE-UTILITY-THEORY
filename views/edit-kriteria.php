<?php
include '../config/database.php';
// session_start();
// if (!isset($_SESSION['id_users'])) {
//     header('Location: login.php');
// }

$id_kriteria = $_GET['GetID'];

$query = "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'";
$result = mysqli_query($conn, $query);
$kriteria = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kriteria = $_POST['nama_kriteria'];
    $bobot_kriteria = $_POST['bobot_kriteria'];

    $update_query = "UPDATE kriteria SET nama_kriteria='$nama_kriteria', bobot_kriteria='$bobot_kriteria' WHERE id_kriteria='$id_kriteria'";
    if (mysqli_query($conn, $update_query)) {
        header('Location: kriteria.php');
        exit();
    } else {
        $error_message = "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}
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
    <meta name="application-name" content="Multi Attribute Utility Theory">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Multi Attribute Utility Theory">

    <meta name="theme-color" content="#4C7FF0">

    <title>Ubah Kriteria</title>

    <!-- page ../assets/stylesheets -->
    <link rel="../assets/stylesheet" href="../assets/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="../assets/vendor/datatables/media/css/dataTables.bootstrap4.css">
    <!-- end page ../assets/stylesheets -->

    <!-- build:css({.tmp,app}) ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/vendor/pace/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="../assets/styles/app.css" id="load_../assets/styles_before" />
    <link rel="stylesheet" href="../assets/styles/app.skins.css" />
    <!-- endbuild -->
</head>

<body>

    <div class="app">
        <!--sidebar panel-->
        <?php include 'layouts/sidebar.php' ?>
        <!-- /sidebar panel -->
        <!-- content panel -->

        <div class="main-panel">
            <!-- top header -->
            <?php include 'layouts/header.php' ?>

            <!-- /top header -->

            <!-- main area -->
            <div class="main-content">
                <div class="content-view">
                    <div class="card">
                        <div class="card-header no-bg b-a-0">
                            Ubah Kriteria
                        </div>
                        <div class="card-block">
                            <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                            <?php endif; ?>
                            <form method="POST" action="edit-kriteria.php?GetID=<?php echo $id_kriteria; ?>">
                                <div class="form-group">
                                    <label for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria"
                                        value="<?php echo $kriteria['nama_kriteria']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="bobot_kriteria">Bobot</label>
                                    <input type="number" step="0.01" class="form-control" id="bobot_kriteria"
                                        name="bobot_kriteria" value="<?php echo $kriteria['bobot_kriteria']; ?>"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="kriteria.php" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- bottom footer -->
                <?php include 'layouts/footer.php' ?>
                <!-- /bottom footer -->
            </div>
            <!-- /main area -->
        </div>
        <!-- /content panel -->

    </div>

    <?php include 'layouts/scripts.php' ?>

</body>

</html>