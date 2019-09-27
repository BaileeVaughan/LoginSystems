<?php
//Server Login Variables
	$server_name = "localhost";
	$server_username = "root";
	$sever_password = "";
	$server_database = "nsirpg";
//User Variables
	$username = $_POST["username"];
	$password = $_POST["password"];

//Check Connection
	$conn = new mysqli($server_name, $server_username, $sever_password, $database_name);
	if(!$conn)
	{
		die("Connection Not Successful.".mysqli_connect_error());
	}
//http://localhost/nsirpg/Login.php

//Check users exist
	$namecheckquery = "SELECT username, salt, hash, FROM users WHERE username = '".$username."';";
	$namecheck = mysqli_query($conn, $namecheckquery);
	if(mysqli_num_rows($namecheck)!= 1)
	{
		echo "User Incorrect";
		exit();
	}

//Get login from query
	$existinginfo = mysqli_fetch_assoc($namecheck);
	$salt = $existinginfo["salt"];
	$hash = $existinginfo["hash"];
	
	$loginhash = crypt($password, $salt);
	if($hash != $loginhash)
	{
		echo "Incorrect Password";
		exit();
	}
	else
	{
		echo "Login Successful";
		exit();		
	}
?>