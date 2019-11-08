<?php
session_start();
?>


<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="CSS/header.css">
<head>
	<header>
		<nav>
			<div class="main_wrapper">
				<ul>
					<li>
						<a href="index.php">Home</a>
					</li>
				</ul>
				<div class="nav-login">
					<?php
						if(isset($_SESSION['u_id'])){
						echo '<form action="includes/logout.inc.php" method="POST">
								<button type="submit" name="submit">Logout</button>
								</form>';
						}else{
						echo '<form action="includes/login.inc.php" method="POST">
								<input type="text" name="username" placeholder="Username">
								<input type="password" name="pwd" placeholder="Password">
								<button type="submit" name="submit">Login</button>
								</form>
								<a href="signup.php">Sign up</a>';
						}
					?>
				</div>
			</div>
		</nav>
	</header>
</head>

<!--

	CREATE TABLE leads (
	    leads_id int(11) NOT null AUTO_INCREMENT PRIMARY KEY,
		users_id int(11) NOT null,
	    users_section varchar(256) NOT null,    
	    company_id int(11) NOT null,
	    company_name varchar(256) NOT null,
	    FOREIGN KEY (users_id) REFERENCES users(users_id),
	    FOREIGN KEY (users_section) REFERENCES users(users_section),
	    FOREIGN KEY (company_id) REFERENCES company(company_id),
	    FOREIGN KEY (company_name) REFERENCES company(company_name)
	);



-->