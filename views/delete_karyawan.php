<?php 
	
	include '../config/database.php';

	if (isset($_GET['Del'])) {
		// code...
		$id_alternatif = $_GET['Del'];
		$query = "DELETE FROM karyawan WHERE id_karyawan = '".$id_alternatif."'";
		$result = mysqli_query($conn, $query);

		if ($result) {
			// code...
			header("Location:karyawan.php");
		}else {
			echo "Please Check Again";
		}
	}
?>