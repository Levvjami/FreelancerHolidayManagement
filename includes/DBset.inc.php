<?php
	$dbServer = "Localhost";
	$dbUname = "root";
	$dbPw = "";
	$dbName = "Holiday";

	$conn = mysqli_connect($dbServer, $dbUname, $dbPw);

	$sql = "CREATE DATABASE Holiday";
	mysqli_query($conn, $sql);
	$conn = mysqli_connect($dbServer, $dbUname, $dbPw, $dbName);

$company = "CREATE TABLE company(
	company_id int NOT null PRIMARY KEY AUTO_INCREMENT,
    company_name varchar(256) not null,
    company_sections int(11) not null
);";

mysqli_query($conn, $company);

$users = "CREATE TABLE users(
	users_id int NOT null AUTO_INCREMENT PRIMARY KEY,
    users_first varchar(256) NOT null,
    users_last varchar(256) NOT null,
    users_Uname varchar(256) NOT null,
    users_pwd varchar(256) NOT null,
    company_section varchar(256) NOT null,
    company_id int(11) NOT null
);";

mysqli_query($conn, $users);

$leads = "CREATE TABLE leads (
        leads_id int(11) NOT null AUTO_INCREMENT PRIMARY KEY,
        users_id int(11) NOT null,
        users_section varchar(256) NOT null,    
        company_id int(11) NOT null,
        company_name varchar(256) NOT null
    );";

mysqli_query($conn, $leads);

$holiday = "CREATE TABLE holiday (
    holiday_id int(11) NOT null PRIMARY KEY,
    holiday_start date,
    holiday_end date,
    company_id int(11),
    users_id int(11),
    users_section int(11)
);";

mysqli_query($conn, $holiday);

$deny = "CREATE TABLE deniedholiday (
    holiday_id int(11) NOT null PRIMARY KEY,
    holiday_start date,
    holiday_end date,
    company_id int(11),
    users_id int(11),
    comm varchar(50)
);";

mysqli_query($conn, $deny);

$confirm = "CREATE TABLE confirmedholiday (
    holiday_id int(11) NOT null PRIMARY KEY,
    holiday_start date,
    holiday_end date,
    company_id int(11),
    users_id int(11)
);";

mysqli_query($conn, $confirm);

$extra = "CREATE TABLE extra (
	extra_id int(11) NOT null AUTO_INCREMENT PRIMARY KEY,
    extra_start date,
    extra_end date,
    extra_from_id int(11),
    extra_to_id int(11),
    reason varchar(100)
);";

mysqli_query($conn, $extra);

	$comp = array(array('Name'=>'Frost', 'Sections' => '7'),array('Name'=>'Lava', 'Sections' => '5'),array('Name'=>'Something', 'Sections' => '3'),array('Name'=>'Water', 'Sections' => '11'),array('Name'=>'Mountain', 'Sections' => '15'));
	$arrlen  =count($comp);

	for ($i=0; $i < $arrlen; $i++) { 
		$nam = $comp[$i];
		$name = $nam['Name'];
		$sect = $comp[$i];
		$section = $sect['Sections'];
		$sql = "INSERT INTO company (company_name, company_sections) VALUES ('$name', '$section')";
		mysqli_query($conn, $sql);
	}
header("Location: ../index.php");
exit();