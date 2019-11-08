<?php
	include_once 'header.php';
	include_once 'includes/connection.inc.php';
?>
<body class="main-container">
	<div class="main-wrapper">
		<form class="signup-form" action="includes/signup.inc.php" method="POST">
			<input type="text" name="first" placeholder="First name">
			<input type="text" name="last" placeholder="Last name">
			<select name="company">
				<?php
					$sql = "SELECT * FROM company";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						$name = $row['company_name'];
						echo "<option>" . $name . "</option>";
					}
				?>
			</select>
			<input type="number" name="section" placeholder="Company section">
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="password" name="password1" placeholder="Re-enter password">
			<button type="submit" name="user">Sign up as employee</button><br>
			<button type="submit" name="leader">Sign up as leader</button>
		</form>
	</div>
</body>
</html>
<!--
	SELECT * FROM users JOIN company ON users.company_id = company.company_id WHERE users.users_Uname = '$username' AND company.company_name = '$company'
-->