<?php
include '../config/database.php';


require '../vendor/autoload.php'; // Make sure this path is correct

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['import'])) {
        // Process the uploaded Excel file for import
        if (isset($_FILES['excelFile'])) {
            $fileError = $_FILES['excelFile']['error'];
            if ($fileError == UPLOAD_ERR_OK) {
                $excelFile = $_FILES['excelFile']['tmp_name'];

                try {
                    // Load the Excel file
                    $spreadsheet = IOFactory::load($excelFile);
                    $worksheet = $spreadsheet->getActiveSheet();

                    // Prepare the statement for inserting data into the 'handphone' table
                    $stmtInsert = $conn->prepare('INSERT INTO karyawan (nama_karyawan, lama_kerja, kedisplinan, kerjasama, tanggung_jawab, kejujuran, komunikasi) VALUES (?, ?, ?, ?, ?, ?, ?)');

                    // Initialize variable for counting successful inserts
                    $successCount = 0;

                    // Iterate through rows and insert data into the 'handphone' table
                    // Proses iterasi pada setiap baris Excel
                    foreach ($worksheet->getRowIterator() as $row) {
                        $rowData = [];
                        foreach ($row->getCellIterator() as $cell) {
                            $rowData[] = $cell->getValue();
                        }

                        // Menyesuaikan jumlah kolom dari Excel
                        if (count($rowData) == 7) {
                            $nama = $rowData[0];  // Nama
                            $lama_kerja = $rowData[1];  // K1
                            $kedisplinan = $rowData[2]; // K2
                            $kerjasama = $rowData[3];   // K3
                            $tanggung_jawab = $rowData[4];  // K4
                            $kejujuran = $rowData[5];   // K5
                            $komunikasi = $rowData[6];  // K6

                            // Bind parameter
                            $stmtInsert->bind_param('sssssss', $nama, $lama_kerja, $kedisplinan, $kerjasama, $tanggung_jawab, $kejujuran, $komunikasi);
                            
                            if ($stmtInsert->execute()) {
                                $successCount++;
                            }
                        }
                    }
                    // Check if any data was successfully inserted
                    if ($successCount > 0) {
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Import successful!',
                                    text: 'Total $successCount rows inserted.',
                                    showConfirmButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'karyawan.php';
                                    }
                                });
                            });
                        </script>";
                    } else {
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                        echo "<script>
                         document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No data inserted',
                                    text: 'Please check your file and try again.',
                                    showConfirmButton: true
                                });
                                });
                              </script>";
                    }
                    

                    // exit();
                } catch (Exception $e) {
                    echo '<script>alert("Error processing the file: ' . $e->getMessage() . '");</script>';
                }
            } else {
                echo '<script>alert("Error uploading the file.");</script>';
            }
        } else {
            echo '<script>alert("No file uploaded.");</script>';
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Multi Attribute Utility Theory">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Multi Attribute Utility Theory">

    <meta name="theme-color" content="#4C7FF0">

    <title>Karyawan</title>

    <!-- page ../assets/stylesheets -->
    <link rel="stylesheet" href="../assets/vendor/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
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
    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .pr-3 {
        padding-right: 1rem;
    }

    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .card-header .btn {
            margin-top: 10px;
        }
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
                        <div class="card-header no-bg b-a-0 position-relative m-b-1 m-t-1">
                            Upload Data Training
                        </div>
                        <div class="card-block">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="excelFile" class="form-label">Choose Excel File</label>
                                    <input type="file" class="form-control" id="excelFile" name="excelFile"
                                        accept=".xls, .xlsx" required>
                                    <div id="fileError" class="invalid-feedback"></div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="import">Upload</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-header no-bg b-a-0 position-relative m-b-1 m-t-1">
                            Data Karyawan
                            <a href="tambah-karyawan.php" class="btn btn-primary m-t-1 btn-user position-absolute"
                                style="right: 1rem;">Tambah Karyawan</a>
                        </div>
                        <!-- File Upload Form -->
                        <div class="card-block">
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered datatable mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Karyawan</th>
                                            <th>Lama kerja</th>
                                            <th>Kedisiplinan</th>
                                            <th>Kerjasama</th>
                                            <th>Tanggung Jawab</th>
                                            <th>Kejujuran</th>
                                            <th>Komunikasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $get_data = mysqli_query($conn, "SELECT * FROM karyawan");
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
                                            <td>
                                                <?php 
                                                    if ($lama_kerja == 1) {
                                                        echo "1 bulan < 1 tahun Berkerja";
                                                    } elseif ($lama_kerja == 2) {
                                                        echo "> 1 tahun < 3 Tahun Berkerja";
                                                    } elseif ($lama_kerja == 3) {
                                                        echo "> 3 tahun < 5 Tahun Berkerja";
                                                    } elseif ($lama_kerja == 4) {
                                                        echo "> 5 tahun < 7 Tahun Berkerja";
                                                    } else {
                                                        echo $lama_kerja . " tahun";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $kedisplinan . " kali ketidakhadiran tanpa izin." ?></td>
                                            <td><?php echo $kerjasama . " kali ketidakhadiran terhadap tim di perusahaan" ?>
                                            </td>
                                            <td><?php echo $tanggung_jawab . " kali tidak menyelesaikan project pekerjaan" ?>
                                            </td>
                                            <td><?php echo $kejujuran . " kali berperilaku tidak jujur" ?></td>
                                            <td><?php echo $komunikasi . " kali jumlah kesalahan komunikasi" ?></td>
                                            <td>
                                                <a href='edit-karyawan.php?id=<?php echo $id; ?>'
                                                    class="btn btn-primary btn-user">Ubah</a>
                                                <a href='delete_karyawan.php?Del=<?php echo $id; ?>'
                                                    class="btn btn-danger btn-user">Hapus</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- end page scripts -->

    <!-- initialize page scripts -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable({
            responsive: true
        });
    });
    </script>
    <!-- end initialize page scripts -->

</body>

</html>