<?php

	if (isset($_POST['user']) || isset($_POST['leader'])) {

		include_once 'connection.inc.php';

		$first = $_POST['first'];
		$last = $_POST['last'];
		$company = $_POST['company'];
		$section = $_POST['section'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password1 = $_POST['password1'];
		//check for empty inputs
		if (!empty($first) || !empty($last) || !empty($company) || !empty($section) || !empty($username) || !empty($password) || !empty($password1)) {
			//valid inputs in firstname, lastname and section
			if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last) || !preg_match("/^[0-9]*$/", $section)) {
				header("Location: ../signup.php?data=3rror");
				exit();
			}else{
				//existing company
				$sql = "SELECT * FROM company WHERE company_name = '$company'";
				$query = mysqli_query($conn, $sql);
				$queryResult = mysqli_num_rows($query);
				if ($queryResult < 1) {
					header("Location: ../signup.php?data=nocompany");
					exit();
				}else{
					//check if username is available
					$sql = "SELECT * FROM users JOIN company ON users.company_id = company.company_id WHERE users.users_Uname = '$username'";
					$query = mysqli_query($conn, $sql);
					$queryResult = mysqli_num_rows($query);
					if ($queryResult > 0) {
						header("Location: ../signup.php?data=nouser");
						echo "0";
						exit();
					}else{
						//check if section exists within company
						$sql = "SELECT * FROM company WHERE company_sections > $section AND company_name = '$company'";
						$query = mysqli_query($conn, $sql);
						$queryResult = mysqli_num_rows($query);
						if ($queryResult < 1) {
							header("Location: ../signup.php?nosection");
							exit();
						}else{
							//check if pw1 and pw2 correspond
							if ($password != $password1) {
								header("Location: ../signup.php?pwerror");
								exit();
							}else{
								//hash password
								$hashedpw = password_hash($password, PASSWORD_DEFAULT);
								//get company id
								$sql = "SELECT company_id FROM company WHERE company_name = '$company'";
								$companyID = mysqli_query($conn, $sql);
								//insert user in database
								$sql = "INSERT INTO users (users_first, users_last, company_id, users_Uname, users_pwd, users_section) VALUES ('$first', '$last', (SELECT company_id FROM company WHERE company_name = '$company') ,'$username', '$hashedpw', '$section' );";
								mysqli_query($conn, $sql);
									if (isset($_POST['leader'])) {
										$sql = "SELECT * FROM users WHERE users_Uname = '$username'";
										$result = mysqli_query($conn, $sql);
										echo mysqli_error($conn);
										$row = mysqli_fetch_assoc($result);
										$uid = $row['users_id'];
										$cid = $row['company_id'];
										$lead = "INSERT INTO leads (users_id, users_section, company_id, company_name) VALUES ('$uid', '$section', '$cid', '$company');";
										mysqli_query($conn, $lead);
										echo mysqli_error($conn);
									}
								header("Location: ../index.php?signup=succes");
								exit();
							}
						}
					}
				}
			}
		}else{
			header("Location: ../signup.php?data=empty");
			exit();
		}
	}else{
		header("Location: ../signup.php");
		exit();
	}