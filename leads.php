<?php
	include_once 'includes/connection.inc.php';
	include_once 'header.php';
?>

<style type="text/css">
	form{
		height: 100%;
		width: 100%;
		border:1px;
	}
</style>

<body>
	<div class="container">
		<?php
			$c_id = $_SESSION['c_id'];
			$u_section = $_SESSION['u_section'];
			$sql = "SELECT * FROM holiday WHERE company_id = '$c_id' AND users_section = '$u_section';";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck == 0) {
				echo "<h1>No Tasks</h1>";
			}else{
				echo "<br>";
				while ($row = mysqli_fetch_assoc($result)) {
					$confirm = 'includes/confirmHoliday.inc.php?id=' . $row['holiday_id'];
					$deny = 'includes/denyHoliday.inc.php?id=' . $row['holiday_id'];
					$id = $row['users_id'];
					$sql1 = "SELECT users_first FROM users WHERE users_id ='$id';";
					$first = mysqli_query($conn, $sql1);
					$var = mysqli_fetch_assoc($first);
					$first = $var['users_first'];
					$sql2 = "SELECT users_last FROM users WHERE users_id = '$id';";
					$last = mysqli_query($conn, $sql2);
					$var = mysqli_fetch_assoc($last);
					$last = $var['users_last'];
					echo $first . " " . $last . ": " . $row['holiday_start'] . " - " . $row['holiday_end'] . "<a href='$confirm'><button>Confirm</button></a><form action='$deny' method='POST'>
							<input type='text' name='comm' placeholder='Comment: 0-50'>
							<button type='submit' name='submit'>Deny</button>
						</form>";
				}
			}
		?>
	</div>
</body>
 

<!--
	SELECT * FROM holiday WHERE users_id=(SELECT users_id FROM users WHERE users_section='2' AND company_id = '2' AND users_id != '8');

	SELECT * FROM `holiday` JOIN users ON holiday.users_id = users.users_id JOIN company On holiday.company_id = company.company_id WHERE users.users_section = '2' AND company.company_id = '2' AND users.users_id != '8';
->