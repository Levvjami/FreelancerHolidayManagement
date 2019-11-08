<?php
	include_once 'includes/connection.inc.php';

	$myID = $_SESSION['u_id'];
	$sql = "SELECT * FROM extra WHERE extra_to_id = '$myID'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		$leader = mysqli_query($conn, $sql);
			echo $row['reason'] . ": " . $row['extra_start'] . " - " . $row['extra_end'];
	}
?>

</html>