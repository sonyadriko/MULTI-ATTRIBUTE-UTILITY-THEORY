<?php
// Database connection
// include '../config/database.php';

// if (isset($_POST['save_ranking'])) {
//     // Insert into history table
//     $insert_history = "INSERT INTO history () VALUES ()";
//     mysqli_query($conn, $insert_history);
//     $id_history = mysqli_insert_id($conn);

//     // Insert into history_detail table
//     for ($i = 0; $i < count($_POST['nama']); $i++) {
//         $nama = $_POST['nama'][$i];
//         $nilai_utilitas = $_POST['nilai_utilitas'][$i];
//         $ranking = $i + 1;

//         $insert_detail = "INSERT INTO history_detail (id_history, nama, nilai_utilitas, ranking) 
//                           VALUES ('$id_history', '$nama', '$nilai_utilitas', '$ranking')";
//         mysqli_query($conn, $insert_detail);
//     }

//     // Redirect to success page or display a success message
//     header('Location: index.php');
// }
?>

<?php
// Database connection
include '../config/database.php';

if (isset($_POST['save_ranking'])) {
    // Insert into history table
    $insert_history = "INSERT INTO history () VALUES ()";
    mysqli_query($conn, $insert_history);
    $id_history = mysqli_insert_id($conn);

    // Insert into history_detail table
    $success = true;
    for ($i = 0; $i < count($_POST['nama']); $i++) {
        $nama = $_POST['nama'][$i];
        $nilai_utilitas = $_POST['nilai_utilitas'][$i];
        $ranking = $i + 1;

        $insert_detail = "INSERT INTO history_detail (id_history, nama, nilai_utilitas, ranking) 
                          VALUES ('$id_history', '$nama', '$nilai_utilitas', '$ranking')";
        if (!mysqli_query($conn, $insert_detail)) {
            $success = false;
            break;
        }
    }

    // Use JavaScript alert and redirect
    if ($success) {
        echo "<script>
                alert('Data penilaian berhasil disimpan ke history!');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 100); // 100 milliseconds delay
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data!');
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 100); // 100 milliseconds delay
              </script>";
    }
    exit();
}
?>

