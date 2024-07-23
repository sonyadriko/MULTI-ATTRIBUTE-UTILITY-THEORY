<?php
include '../config/database.php';

if (isset($_GET['GetID'])) {
    $id_history = $_GET['GetID'];

    // Ambil data history detail berdasarkan id_history
    $get_history_detail = mysqli_query($conn, "SELECT * FROM hasil_detail WHERE id_hasil = '$id_history'");
} else {
    // Redirect to history page if no ID is provided
    header('Location: history.php');
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

    <title>Detail History</title>

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
                            Detail History
                        </div>
                        <div class="card-block">
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama</th>
                                        <th>Nilai Utilitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    while ($detail = mysqli_fetch_array($get_history_detail)) {
                                        $nama = $detail['nama'];
                                        $nilai_utilitas = $detail['nilai_utilitas'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $nama ?></td>
                                        <td><?php echo number_format($nilai_utilitas, 2) ?></td>
                                    </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <a href="history.php" class="btn btn-primary">Kembali</a>
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

    <!-- page scripts -->
    <script src="../assets/vendor/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/media/js/dataTables.bootstrap4.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
    $('.datatable').DataTable({});
    </script>
    <!-- end initialize page scripts -->

</body>

</html>