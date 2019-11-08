<?php

session_start();

if (isset($_POST['submit'])) {
	
	include 'connection.inc.php';

	$uid = $_POST['username'];
	$pwd = $_POST['pwd'];

	//ERROR handlers
	//check if empty inputs
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	}else{
		$sql = "SELECT * FROM users WHERE users_Uname='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error1");
			exit();			
		}else{
			$row = mysqli_fetch_assoc($result);
			if ($row == true){
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['users_pwd']);
				if ($hashedPwdCheck == false) {			
					header("Location: ../index.php?login=error2");
					exit();
				}elseif ($hashedPwdCheck == true){
					//Log in the user
					$_SESSION['u_name'] = $row['users_Uname'];
					$_SESSION['u_id'] = $row['users_id'];
					$_SESSION['u_section'] = $row['users_section'];
					$_SESSION['c_name'] = $row['company_name'];
					$_SESSION['c_id'] = $row['company_id'];
					$sql = "SELECT * FROM leads JOIN users on leads.users_id = users.users_id WHERE leads.users_id=(SELECT users.users_id FROM users WHERE users.users_Uname = '$uid')";
					$query = mysqli_query($conn, $sql);
					$resultCheck = mysqli_num_rows($query);
					if ($resultCheck > 0) {
						header("Location: ../leads.php");
						exit();
					}else{
						header("Location: ../users.php");
						exit();
					}
				}
			}
		}
	}
}else{
	header("Location: ../index.php?login=error");
	exit();
}

