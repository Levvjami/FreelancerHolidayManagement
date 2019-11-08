<?php
	session_start();
	include_once 'connection.inc.php';

	$start = $_POST['start'];
	$end = $_POST['end'];
	$u_id = $_SESSION['u_id'];
	$c_id = $_SESSION['c_id'];
	$u_section = $_SESSION['u_section'];
	$sql = "INSERT INTO holiday (holiday_start, holiday_end, users_id, company_id, users_section) VALUES ('$start', '$end', '$u_id', '$c_id', '$u_section');";
	mysqli_query($conn, $sql);
		if (!empty(mysqli_error($conn))) {
			echo mysqli_error($conn);
		}else{
			header("Location: ../users.php?submit=success");
			exit();
		}