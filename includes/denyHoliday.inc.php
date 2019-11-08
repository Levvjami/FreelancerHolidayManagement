<?php

	include_once 'connection.inc.php';

	$id = $_GET['id'];
	$comm = $_POST['comm'];
	echo $comm;
	$sql1 = "SELECT * FROM holiday WHERE holiday_id = '$id'";
	$result = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_assoc($result);
	$start = $row['holiday_start'];
	$end = $row['holiday_end'];
	$uid = $row['users_id'];
	$cid = $row['company_id'];

	$delete = "DELETE FROM holiday WHERE holiday_id = '$id'";
	$deleteResult = mysqli_query($conn, $delete);
	echo mysqli_error($conn);

	$sql2 = "INSERT INTO deniedholiday (holiday_id, holiday_start, holiday_end, company_id, users_id, comm) VALUES ('$id', '$start', '$end', '$cid', '$uid', '$comm');";
	$result1 = mysqli_query($conn,$sql2);

	header("Location: ../leads.php");
	exit();