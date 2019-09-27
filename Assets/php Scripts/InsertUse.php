<?php
//Server Variables //Allows us to log into the server
	$server_name = "localhost";
	$server_username = "root";
	$sever_password = "";
	$server_database = "nsirpg";
//User Variables
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"}];
//Connect to the database //Check connection
	$conn = new mysqli($server_name, $server_username, $sever_password, $server_database);
	if(!$conn)
	{
		die("Connection Not Successful.".mysqli_connect_error());
	}
//http://localhost/nsirpg/insertuser.php

//Does the username already exist?
	$namecheckquery = "SELECT username FROM users WHERE username = '".$username."'";
	$namecheck = mysqli_query($conn, $namecheckquery);
	if(mysqli_num_rows($namecheck)>0)
	{
		echo "Username Already In Use";
		exit();
	}
//Does the email already exist
	$emailcheckquery = "SELECT email FROM users WHERE email = '".$email."'";
	$emailcheck = mysqli_query($conn, $emailcheckquery);
	if(mysqli_num_rows($emailcheck)>0)
	{
		echo "Account Exists With This Email";
		exit();
	}
//Create new user
	$salt = "\$5\$round=5000\$"."abcdefghijklmnopqrstuvwxyz1234567890".$username"\$";
	$hash = crypt($password, $salt);
	$insertuserquery = "INSERT INTO users (username, email, salt, hash) VALUES('".$username."', '".$email."', '".$salt."', '".$hash."');";
	mysqli_query($conn, $insertuserquery) or die("Error insert user failed");
	echo "User Successfully Created";
?>