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

    <title>Penilaian</title>

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
                            Data Penilaian
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Karyawan</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                            <th>K5</th>
                                            <th>K6</th>
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

                    <div class="card">
                        <div class="card-header no-bg b-a-0">
                            Hasil Normalisai Matrik MAUT
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Karyawan</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                            <th>K5</th>
                                            <th>K6</th>
                                            <th>Nilai Utilitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;

                                            $bobot_kriteria = [];
                                            $q = mysqli_query($conn, 'SELECT bobot_kriteria FROM kriteria ORDER BY id_kriteria');
                                            while ($row = mysqli_fetch_assoc($q)) {
                                                $bobot_kriteria[] = floatval($row['bobot_kriteria']); // Cast to float to ensure the values are numerical
                                            }                                       
                                            // Ambil data karyawan
                                            $get_data = mysqli_query($conn, "SELECT * FROM karyawan");
                                            
                                            // Variabel untuk menyimpan nilai maksimal setiap kriteria
                                            $max_lama_kerja = 0;
                                            $max_kedisplinan = 0;
                                            $max_kerjasama = 0;
                                            $max_tanggung_jawab = 0;
                                            $max_kejujuran = 0;
                                            $max_komunikasi = 0;

                                            // Cari nilai maksimal setiap kriteria
                                            while($row = mysqli_fetch_array($get_data)) {
                                                if ($row['lama_kerja'] > $max_lama_kerja) $max_lama_kerja = $row['lama_kerja'];
                                                if ($row['kedisplinan'] > $max_kedisplinan) $max_kedisplinan = $row['kedisplinan'];
                                                if ($row['kerjasama'] > $max_kerjasama) $max_kerjasama = $row['kerjasama'];
                                                if ($row['tanggung_jawab'] > $max_tanggung_jawab) $max_tanggung_jawab = $row['tanggung_jawab'];
                                                if ($row['kejujuran'] > $max_kejujuran) $max_kejujuran = $row['kejujuran'];
                                                if ($row['komunikasi'] > $max_komunikasi) $max_komunikasi = $row['komunikasi'];
                                            }

                                            // Reset pointer ke awal
                                            mysqli_data_seek($get_data, 0);

                                            // Array untuk menyimpan hasil utilitas
                                            $utilitas = array();

                                            // Tampilkan data dan hitung utilitas
                                            while($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_karyawan'];
                                                $nama = $display['nama_karyawan'];
                                                $lama_kerja = $display['lama_kerja'];
                                                $kedisplinan = $display['kedisplinan'];
                                                $kerjasama = $display['kerjasama'];
                                                $tanggung_jawab = $display['tanggung_jawab'];
                                                $kejujuran = $display['kejujuran'];
                                                $komunikasi = $display['komunikasi'];

                                                // Normalisasi nilai kriteria
                                                $normalized_lama_kerja = ($lama_kerja-1) / ($max_lama_kerja-1);                                        
                                                $normalized_kedisplinan = ($kedisplinan-2) / ($max_kedisplinan-2);
                                                $normalized_kerjasama = ($kerjasama-2) / ($max_kerjasama-2);
                                                $normalized_tanggung_jawab = ($tanggung_jawab-2) / ($max_tanggung_jawab-2);
                                                $normalized_kejujuran = ($kejujuran-2) / ($max_kejujuran-2);
                                                $normalized_komunikasi = ($komunikasi-1) / ($max_komunikasi-1);

                                                // Hitung nilai utilitas
                                                $nilai_utilitas = ($normalized_lama_kerja * ($bobot_kriteria[0]/100)) +
                                                                  ($normalized_kedisplinan * ($bobot_kriteria[1]/100)) +
                                                                  ($normalized_kerjasama * ($bobot_kriteria[2]/100)) +
                                                                  ($normalized_tanggung_jawab * ($bobot_kriteria[3]/100)) +
                                                                  ($normalized_kejujuran * ($bobot_kriteria[4]/100)) +
                                                                  ($normalized_komunikasi * ($bobot_kriteria[5]/100));

                                                // Simpan ke array
                                                $utilitas[] = array(
                                                    'nama' => $nama,
                                                    'nilai_utilitas' => $nilai_utilitas
                                                );

                                                // Tampilkan data
                                                echo "<tr>
                                                        <td>$no</td>
                                                        <td>$nama</td>
                                                        <td>".number_format($normalized_lama_kerja, 2)."</td>
                                                        <td>".number_format($normalized_kedisplinan, 2)."</td>
                                                        <td>".number_format($normalized_kerjasama, 2)."</td>
                                                        <td>".number_format($normalized_tanggung_jawab, 2)."</td>
                                                        <td>".number_format($normalized_kejujuran, 2)."</td>
                                                        <td>".number_format($normalized_komunikasi, 2)."</td>
                                                        <td>".number_format($nilai_utilitas, 2)."</td>
                                                      </tr>";

                                                $no++;
                                            }

                                            // Sort array utilitas berdasarkan nilai_utilitas dari terbesar ke terkecil
                                            usort($utilitas, function($a, $b) {
                                                return $b['nilai_utilitas'] <=> $a['nilai_utilitas'];
                                            });

                                            // Tambahkan ranking ke array utilitas
                                            $ranking = 1;
                                            foreach ($utilitas as &$value) {
                                                $value['ranking'] = $ranking++;
                                            }
                                            unset($value);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Hasil Normalisasi -->
                    <div class="card">
                        <div class="card-header no-bg b-a-0">
                            Hasil Keputusan
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Karyawan</th>
                                            <th>Nilai Total</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach ($utilitas as $row) {
                                                echo "<tr>
                                                        <td>$no</td>
                                                        <td>{$row['nama']}</td>
                                                        <td>".number_format($row['nilai_utilitas'], 2)."</td>
                                                        <td>{$row['ranking']}</td>
                                                      </tr>";
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