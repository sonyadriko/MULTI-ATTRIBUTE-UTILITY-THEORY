<?php
include '../config/database.php';
// session_start();
// if (!isset($_SESSION['id_users'])) {
//     header('Location: login.php');
// }

function categorizeValue($value) {
    if ($value >= 0 && $value <= 2) {
        return 4;
    } elseif ($value >= 3 && $value <= 4) {
        return 3;
    } elseif ($value >= 5 && $value <= 6) {
        return 2;
    } else {
        return 1;
    }
}

$query = "SELECT SUM(bobot_kriteria) as totalBobot FROM kriteria";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalBobot = $row['totalBobot'];

$totalData = 0;
$selected_ids = isset($_GET['id_karyawan']) ? $_GET['id_karyawan'] : null;
// var_dump($selected_ids);
if ($selected_ids) {
    $query = "SELECT COUNT(*) AS total FROM karyawan WHERE id_karyawan IN ($selected_ids)";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalData = $row['total'];
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

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                <?php if ($totalBobot == 100) { ?>
                <?php if ($totalData > 1) { ?>

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
                                                $get_data = mysqli_query($conn, "select * from karyawan WHERE id_karyawan IN ($selected_ids)");
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
                                            <td>
                                                <?php 
                                                        if ($kedisplinan >= 0 && $kedisplinan <= 2) {
                                                            echo 4;
                                                        } elseif ($kedisplinan >= 3 && $kedisplinan <= 4) {
                                                            echo 3;
                                                        } elseif ($kedisplinan >= 5 && $kedisplinan <= 6) {
                                                            echo 2;
                                                        } elseif ($kedisplinan >= 7) {
                                                            echo 1;
                                                        }
                                                    ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        if ($kerjasama >= 0 && $kerjasama <= 2) {
                                                            echo 4;
                                                        } elseif ($kerjasama >= 3 && $kerjasama <= 4) {
                                                            echo 3;
                                                        } elseif ($kerjasama >= 5 && $kerjasama <= 6) {
                                                            echo 2;
                                                        } elseif ($kerjasama >= 7) {
                                                            echo 1;
                                                        }
                                                    ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        if ($tanggung_jawab >= 0 && $tanggung_jawab <= 2) {
                                                            echo 4;
                                                        } elseif ($tanggung_jawab >= 3 && $tanggung_jawab <= 4) {
                                                            echo 3;
                                                        } elseif ($tanggung_jawab >= 5 && $tanggung_jawab <= 6) {
                                                            echo 2;
                                                        } elseif ($tanggung_jawab >= 7) {
                                                            echo 1;
                                                        }
                                                    ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        if ($kejujuran >= 0 && $kejujuran <= 2) {
                                                            echo 4;
                                                        } elseif ($kejujuran >= 3 && $kejujuran <= 4) {
                                                            echo 3;
                                                        } elseif ($kejujuran >= 5 && $kejujuran <= 6) {
                                                            echo 2;
                                                        } elseif ($kejujuran >= 7) {
                                                            echo 1;
                                                        }
                                                    ?>
                                            </td>
                                            <td>
                                                <?php 
                                                        if ($komunikasi >= 0 && $komunikasi <= 2) {
                                                            echo 4;
                                                        } elseif ($komunikasi >= 3 && $komunikasi <= 4) {
                                                            echo 3;
                                                        } elseif ($komunikasi >= 5 && $komunikasi <= 6) {
                                                            echo 2;
                                                        } elseif ($komunikasi >= 7) {
                                                            echo 1;
                                                        }
                                                    ?>
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
                                                $get_data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan IN ($selected_ids)");
                                                
                                                // Variabel untuk menyimpan nilai maksimal setiap kriteria
                                                $max_lama_kerja = 0;
                                                $max_kedisplinan = 0;
                                                $max_kerjasama = 0;
                                                $max_tanggung_jawab = 0;
                                                $max_kejujuran = 0;
                                                $max_komunikasi = 0;                                            

                                                // Cari nilai maksimal setiap kriteria
                                                while($row = mysqli_fetch_array($get_data)) {
                                                    $lama_kerja = floatval($row['lama_kerja']);
                                                    $kedisplinan = categorizeValue(floatval($row['kedisplinan']));
                                                    $kerjasama = categorizeValue(floatval($row['kerjasama']));
                                                    $tanggung_jawab = categorizeValue(floatval($row['tanggung_jawab']));
                                                    $kejujuran = categorizeValue(floatval($row['kejujuran']));
                                                    $komunikasi = categorizeValue(floatval($row['komunikasi']));

                                                    if ($lama_kerja > $max_lama_kerja) $max_lama_kerja = $lama_kerja;
                                                    if ($kedisplinan > $max_kedisplinan) $max_kedisplinan = $kedisplinan;
                                                    if ($kerjasama > $max_kerjasama) $max_kerjasama = $kerjasama;
                                                    if ($tanggung_jawab > $max_tanggung_jawab) $max_tanggung_jawab = $tanggung_jawab;
                                                    if ($kejujuran > $max_kejujuran) $max_kejujuran = $kejujuran;
                                                    if ($komunikasi > $max_komunikasi) $max_komunikasi = $komunikasi;
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

                                                    $kedisplinan = categorizeValue($kedisplinan);
                                                    $kerjasama = categorizeValue($kerjasama);
                                                    $tanggung_jawab = categorizeValue($tanggung_jawab);
                                                    $kejujuran = categorizeValue($kejujuran);
                                                    $komunikasi = categorizeValue($komunikasi);
                                                    // var_dump($kedisplinan);

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
                                <form method="POST" action="save_ranking.php">
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
                                                foreach ($utilitas as $data) {
                                                    echo "<tr>
                                                            <td>$no</td>
                                                            <td>{$data['nama']}</td>
                                                            <td>".number_format($data['nilai_utilitas'], 2)."</td>
                                                            <td>{$data['ranking']}</td>
                                                            <input type='hidden' name='nama[]' value='{$data['nama']}'>
                                                            <input type='hidden' name='nilai_utilitas[]' value='{$data['nilai_utilitas']}'>
                                                        </tr>";
                                                    $no++;
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary" name="save_ranking">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <?php } else { ?>
                <div class="content-view">
                    <div class="card">
                        <span> Pilih lebih dari satu karyawan untuk melakukan perhitungan.</span>
                        <a href="cek_hitung.php" class="btn btn-primary btn-sm">Kembali</a>
                    </div>
                </div>
                <?php } ?>
                <?php }else { ?>
                <div class="content-view">
                    <div class="card">
                        <span> Bobot kriteria harus sama dengan 100.</span>
                        <a href="kriteria.php" class="btn btn-primary btn-sm">Kembali</a>

                    </div>
                </div>
                <?php } ?>
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
    $('.datatable2').DataTable({});
    </script>
    <!-- end initialize page scripts -->

</body>

</html>