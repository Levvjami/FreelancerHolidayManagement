<?php
	include_once 'includes/connection.inc.php';
	include_once 'header.php';

	if (empty($_SESSION['u_id'])) {
		header("Location: index.php");
		exit();
	}
?>

<style type="text/css">
	div.holiday-wrapper{
		padding-bottom: 0.4%;
		margin-top: 1%;
		margin-left: 5%;
		height: 100%;
		width: 90%;
		float: left;
		align-self: center;
		border-bottom:1px solid;
	}
	div.holiday-wrapper div{
		float: left;
		width: 20%;
		margin: 0 6.5%;
	}
	div.holiday-content{
		padding-bottom: 0.4%;
		margin-top: 1%;
		margin-left: 5%;
		height: 100%;
		width: 90%;
		float: left;
		align-self: center;
	}
	div.holiday-content{
		border-bottom: 1px dashed;
	}
	div.holiday-content div{
		float: left;
	}
	.plan{
		width: 20%;
	}
	.plan form input{
		margin-left: 20%;
		width: 50%;
	}
	.plan form p{
		margin-left:35%;
	}
	.plan form button{
		width: 20%;
		margin-left: 35%;
	}
	.confirmed{
		margin-left: 9%; 
		padding-left: 9%;
		width: 10%;
		border-left:1px solid;

	}
	.denied{
		margin-left: 10%;
		padding-left: 10%;
		width: 31.65%;
		border-left:1px solid;
	}
	.extra{
		float: left;
		margin-left: 5%;
		margin-top: 1%;
		width: 100%;
	}
</style>

<body>
	<div class="holiday-wrapper">
		<div class="plan-holiday">
			<h1>Plan Holiday</h1>
		</div>
		<div class="confirmed-holiday">
			<h1>Confirmed Holiday</h1>
		</div>
		<div class="dinied-holiday">
			<h1>Denied Holiday</h1>
		</div>
	</div>
	<div class="holiday-content">
		<div class="plan">
			<br>
			<form action="includes/insertHoliday.inc.php" method="POST">
				<p>Starting date:</p><input type="date" name="start">
				<p>End date:</p><input type="date" name="end"><br>
				<button type="submit" name="submit">Submit</button>
			</form>
		</div>
		<div class="confirmed">
			<br>
			<?php
				$c_id = $_SESSION['c_id'];
				$u_id = $_SESSION['u_id'];
				$sql = "SELECT * FROM confirmedholiday WHERE company_id = '$c_id' AND users_id = '$u_id';";
				$result = mysqli_query($conn, $sql);
				$error  =mysqli_error($conn);
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<p>" . $row['holiday_start'] . " - " . $row['holiday_end'];
				}

			?>
		</div>
		<div class="denied">
			<br>
			<?php
				$sqlD = "SELECT * FROM deniedholiday WHERE company_id = '$c_id' AND users_id = '$u_id'";
				$resultD = mysqli_query($conn, $sqlD);
				$error  =mysqli_error($conn);
				while ($rowD = mysqli_fetch_assoc($resultD)) {
					echo "<p>" . $rowD['holiday_start'] . " - " . $rowD['holiday_end'] . "; <b>" . $rowD['comm'] . "</b>";
				}
			?>
		</div>
	</div>
	<div class="extra">
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
	</div>
</body>

