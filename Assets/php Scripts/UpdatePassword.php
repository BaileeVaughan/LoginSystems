<?php
//Server login variables
	$server_name = "localhost";
	$server_username = "root";
	$server_password = "";
	$database_name = "nsirpg";
	
	$password = $_POST["username_Post"];
	$password = $_POST["password_Post"}];

//Check Connection
	$conn = new mysqli($server_name, $server_username, $sever_password, $database_name);
	if(!$conn)
	{
		die("Connection Not Successful.".mysqli_connect_error());
	}
//http://localhost/nsirpg/updatepassword.php
	
//Change password by creating new hash
	$salt = "\$5\$round=5000\$"."abcdefghijklmnopqrstuvwxyz1234567890".$username"\$";
	$hash = crypt($password, $salt);
	
	$updatePassword = "UPDATE users SET salt, hash = '".$hash."', '".$salt."' WHERE username = '".$username."'";
	$updateResult = mysqli_query($conn, $updatePassword)or die("error insert failed");
	if($updateResult)
	{
		echo "Password Successfully Changed";
	}
?>