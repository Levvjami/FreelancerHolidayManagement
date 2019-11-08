<?php

include_once 'connection.inc.php';

	$today = date('Y/m/d');

	$sql = "DELETE FROM holiday WHERE holiday_end < '$today'";
	$result = mysqli_query($conn, $sql);

	$sql = "DELETE FROM confirmedholiday WHERE holiday_end < '$today'";
	$result = mysqli_query($conn, $sql);

	$sql = "DELETE FROM deniedholiday WHERE holiday_end < '$today'";
	$result = mysqli_query($conn, $sql);

	$sql = "DELETE FROM extra WHERE extra_end < '$today'";
	$result = mysqli_query($conn, $sql);

	header("Location: ../index.php");
	exit();