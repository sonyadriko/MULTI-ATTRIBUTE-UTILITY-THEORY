<?php
include '../config/database.php';
// session_start();
// if (!isset($_SESSION['id_users'])) {
//     header('Location: login.php');
// }
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

    <title>Karyawan</title>

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
                            Data Karyawan
                            <a href="tambah-karyawan.php" class="btn btn-primary btn-user">Tambah Karyawan</a>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Nama Karyawan
                                            </th>
                                            <th>
                                                Lama kerja
                                            </th>
                                            <th>
                                                Kedisiplinan
                                            </th>
                                            <th>
                                                Kerjasama
                                            </th>
                                            <th>
                                                tanggung jawab
                                            </th>
                                            <th>
                                                kejujuran
                                            </th>
                                            <th>
                                                komunikasi
                                            </th>
                                            <th>
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $get_data = mysqli_query($conn, "select * from karyawan");
                                            while($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_karyawan'];
                                                $nama = $display['nama_karyawan'];
                                                $lama_kerja = $display['lama_kerja'];
                                                $kedisplinan = $display['kedisplinan'];
                                                $kerjasama = $display['kerjasama'];
                                                $tanggung_jawab = $display['tanggung_jawab'];
                                                $kejujuran = $display['kejujuran'];
                                                $komunikasi = $display['komunikasi'];
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $nama ?></td>
                                            <td><?php echo $lama_kerja ?></td>
                                            <td><?php echo $kedisplinan ?></td>
                                            <td><?php echo $kerjasama ?></td>
                                            <td><?php echo $tanggung_jawab ?></td>
                                            <td><?php echo $kejujuran ?></td>
                                            <td><?php echo $komunikasi ?></td>
                                            <td>
                                                <a href='edit-kriteria.php?GetID=<?php echo $id; ?>'
                                                    style="text-decoration: none; list-style: none;">
                                                    <input type='submit' value='Ubah' id='editbtn'
                                                        class="btn btn-primary btn-user">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                                $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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