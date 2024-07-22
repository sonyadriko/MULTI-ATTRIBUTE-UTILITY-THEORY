<?php
include '../config/database.php';

$karyawan = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the karyawan data
    $query = "SELECT * FROM karyawan WHERE id_karyawan = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $karyawan = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Karyawan not found or an error occurred.</p>";
        exit();
    }
} else {
    echo "<p>No karyawan ID specified.</p>";
    exit();
}

if (isset($_POST['submit'])) {
    $nama_karyawan = $_POST['nama_karyawan'];
    $lama_kerja = $_POST['lama_kerja'];
    $kedisplinan = $_POST['kedisplinan'];
    $kerjasama = $_POST['kerjasama'];
    $tanggung_jawab = $_POST['tanggung_jawab'];
    $kejujuran = $_POST['kejujuran'];
    $komunikasi = $_POST['komunikasi'];

    // Update the karyawan data
    $query = "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', lama_kerja = '$lama_kerja', kedisplinan = '$kedisplinan', kerjasama = '$kerjasama', tanggung_jawab = '$tanggung_jawab', kejujuran = '$kejujuran', komunikasi = '$komunikasi' WHERE id_karyawan = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: karyawan.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
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

    <title>Edit Karyawan</title>

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
    <style>
    .form-group {
        display: flex;
        align-items: center;
    }

    .form-group label {
        margin-right: 10px;
    }

    .form-group input,
    .form-group select {
        flex: 1;
    }

    .form-group p {
        margin: 0 0 0 10px;
    }
    </style>
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
                            Edit Karyawan
                        </div>
                        <div class="card-block">
                            <form method="POST" action="edit-karyawan.php?id=<?php echo $karyawan['id_karyawan']; ?>">
                                <div class="form-group row">
                                    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                            value="<?php echo $karyawan['nama_karyawan']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lama_kerja" class="col-sm-2 col-form-label">Lama Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="lama_kerja" name="lama_kerja" required>
                                            <option value="1"
                                                <?php if ($karyawan['lama_kerja'] == 1) echo 'selected'; ?>>1 bulan < 1
                                                    tahun Berkerja</option>
                                            <option value="2"
                                                <?php if ($karyawan['lama_kerja'] == 2) echo 'selected'; ?>>> 1 tahun <
                                                    3 Tahun Berkerja</option>
                                            <option value="3"
                                                <?php if ($karyawan['lama_kerja'] == 3) echo 'selected'; ?>>> 3 tahun <
                                                    5 Tahun Berkerja</option>
                                            <option value="4"
                                                <?php if ($karyawan['lama_kerja'] == 4) echo 'selected'; ?>>> 5 tahun <
                                                    7 Tahun Berkerja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kedisplinan" class="col-sm-2 col-form-label">Kedisiplinan</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kedisplinan" name="kedisplinan"
                                            value="<?php echo $karyawan['kedisplinan']; ?>" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali ketidakhadiran tanpa izin</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kerjasama" class="col-sm-2 col-form-label">Kerjasama</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kerjasama" name="kerjasama"
                                            value="<?php echo $karyawan['kerjasama']; ?>" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali ketidakhadiran terhadap tim di perusahaan</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggung_jawab" class="col-sm-2 col-form-label">Tanggung Jawab</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="tanggung_jawab"
                                            name="tanggung_jawab" value="<?php echo $karyawan['tanggung_jawab']; ?>"
                                            required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali tidak menyelesaikan project pekerjaan</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kejujuran" class="col-sm-2 col-form-label">Kejujuran</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kejujuran" name="kejujuran"
                                            value="<?php echo $karyawan['kejujuran']; ?>" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali berperilaku tidak jujur</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="komunikasi" class="col-sm-2 col-form-label">Komunikasi</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="komunikasi" name="komunikasi"
                                            value="<?php echo $karyawan['komunikasi']; ?>" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali jumlah kesalahan komunikasi</p>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                <a href="karyawan.php" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /main area -->
        </div>
        <!-- /content panel -->
    </div>

    <!-- build:js({.tmp,app}) ../assets/scripts/app.min.js -->
    <script src="../assets/vendor/jquery/dist/jquery.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../assets/vendor/pace/pace.js"></script>
    <script src="../assets/scripts/lodash.min.js"></script>
    <script src="../assets/plugins/jquery-pjax/jquery.pjax.js"></script>
    <script src="../assets/scripts/utils/pjax.js"></script>
    <script src="../assets/scripts/utils/loaders.js"></script>
    <!-- <script src="../assets/scripts/app.js"></script> -->
    <!-- endbuild -->

    <!-- page ../assets/scripts -->
    <script src="../assets/vendor/flot/jquery.flot.js"></script>
    <script src="../assets/vendor/flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendor/flot/jquery.flot.orderBars.js"></script>
    <script src="../assets/vendor/flot/jquery.flot.stack.js"></script>
    <script src="../assets/vendor/flot-spline/js/jquery.flot.spline.js"></script>
    <script src="../assets/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/vendor/bower-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="../assets/scripts/tables/table-edit.js"></script>
    <!-- end page ../assets/scripts -->
</body>

</html>