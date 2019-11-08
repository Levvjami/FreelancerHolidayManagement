<?php
	include_once 'includes/connection.inc.php';
	include_once 'header.php';
?>
<body>
	<?php
		if (empty($_SESSION['u_id'])) {
			
		}else{
			$id = $_SESSION['u_id'];
			$sql = "SELECT * FROM leads WHERE users_id ='$id'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck > 0) {
				echo "<a href='leads.php'>
					<button>Return</button>
				</a>";
			}else{
				echo "<a href='users.php'>
					<button>Return</button>
				</a>";
			}
		}
	?>
</body>
</html>