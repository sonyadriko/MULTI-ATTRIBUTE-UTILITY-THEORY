<?php
include '../config/database.php';
// session_start();
// if (!isset($_SESSION['id_users'])) {
//     header('Location: login.php');
// }

if (isset($_POST['submit'])) {
    $nama_karyawan = $_POST['nama_karyawan'];
    $lama_kerja = $_POST['lama_kerja'];
    $kedisplinan = $_POST['kedisplinan'];
    $kerjasama = $_POST['kerjasama'];
    $tanggung_jawab = $_POST['tanggung_jawab'];
    $kejujuran = $_POST['kejujuran'];
    $komunikasi = $_POST['komunikasi'];

    $query = "INSERT INTO karyawan (nama_karyawan, lama_kerja, kedisplinan, kerjasama, tanggung_jawab, kejujuran, komunikasi) VALUES ('$nama_karyawan', '$lama_kerja', '$kedisplinan', '$kerjasama', '$tanggung_jawab', '$kejujuran', '$komunikasi')";
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

    <title>Tambah Karyawan</title>

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
        .form-group input {
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
                            Tambah Karyawan
                        </div>
                        <div class="card-block">
                            <form action="tambah-karyawan.php" method="post">
                                <div class="form-group row">
                                    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                        required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lama_kerja" class="col-sm-2 col-form-label">Lama Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="lama_kerja" name="lama_kerja" required>
                                            <option value="1">1 bulan < 1 tahun Berkerja</option>
                                            <option value="2">> 1 tahun < 3 Tahun Berkerja</option>
                                            <option value="3">> 3 tahun < 5 Tahun Berkerja</option>
                                            <option value="4">> 5 tahun < 7 Tahun Berkerja</option>
                                        </select>
                                    </div>
                                    <!-- <input type="number" class="form-control" id="lama_kerja" name="lama_kerja" required> -->
                                </div>
                                <div class="form-group row">
                                    <label for="kedisplinan" class="col-sm-2 col-form-label">Kedisiplinan</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kedisplinan" name="kedisplinan" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali ketidakhadiran tanpa izin</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kerjasama" class="col-sm-2 col-form-label">Kerjasama</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kerjasama" name="kerjasama" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali ketidakhadiran terhadap tim di perusahaan</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggung_jawab" class="col-sm-2 col-form-label">Tanggung Jawab</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="tanggung_jawab" name="tanggung_jawab" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali tidak menyelesaikan project pekerjaan</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kejujuran" class="col-sm-2 col-form-label">Kejujuran</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="kejujuran" name="kejujuran" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali berperilaku tidak jujur</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="komunikasi" class="col-sm-2 col-form-label">Komunikasi</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="komunikasi" name="komunikasi" required>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-center">
                                        <p>kali jumlah kesalahan komunikasi</p>
                                    </div>
                                </div>
                                <!-- <select class="form-control" id="kedisplinan" name="kedisplinan" required>
                                        <option value="1">>= 7 kali ketidakhadiran tanpa izin</option>
                                        <option value="2">5-6 kali ketidakhadiran tanpa izin</option>
                                        <option value="3">3-4 kali ketidakhadiran tanpa izin</option>
                                        <option value="4">0-2 kali ketidakhadiran tanpa izin</option>
                                    </select> -->
                                <!-- <div class="form-group">
                                    <label for="kerjasama">Kerjasama</label>
                                    <select class="form-control" id="kerjasama" name="kerjasama" required>
                                        <option value="1">>= 7 kali ketidakhadiran tim di perusahaan</option>
                                        <option value="2">5-6 kali ketidakhadiran tim di perusahaan</option>
                                        <option value="3">3-4 kali ketidakhadiran tim di perusahaan</option>
                                        <option value="4">0-2 kali ketidakhadiran tim di perusahaan</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="tanggung_jawab">Tanggung Jawab</label>
                                    <select class="form-control" id="tanggung_jawab" name="tanggung_jawab" required>
                                        <option value="1">>= 7 kali tidak menyelesaikan project pekerjaan</option>
                                        <option value="2">5-6 kali tidak menyelesaikan project pekerjaan</option>
                                        <option value="3">3-4 kali tidak menyelesaikan project pekerjaan</option>
                                        <option value="4">0-2 kali tidak menyelesaikan project pekerjaan</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="kejujuran">Kejujuran</label>
                                    <select class="form-control" id="kejujuran" name="kejujuran" required>
                                        <option value="1">>= 7 kali tidak berperilaku tidak jujur</option>
                                        <option value="2">5-6 kali tidak berperilaku tidak jujur</option>
                                        <option value="3">3-4 kali tidak berperilaku tidak jujur</option>
                                        <option value="4">0-2 kali tidak berperilaku tidak jujur</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="komunikasi">Komunikasi</label>
                                    <select class="form-control" id="komunikasi" name="komunikasi" required>
                                        <option value="1">>= 7 kali jumlah kesalahan komunikasi</option>
                                        <option value="2">5-6 kali jumlah kesalahan komunikasi</option>
                                        <option value="3">3-4 kali jumlah kesalahan komunikasi</option>
                                        <option value="4">0-2 kali jumlah kesalahan komunikasi</option>
                                    </select>
                                </div> -->
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                <a href="karyawan.php" class="btn btn-secondary">Batal</a>
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