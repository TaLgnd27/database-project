<?php
	session_start();
	include "db_conn.php";

	if(isset($_POST["newName"])){
		if(isset($_SESSION["userID"]))
		$sql = "call UpdateUserDetails(".$_SESSION["userID"].",'".$_POST["newName"]."','".$_POST["newUsername"]."','".$_POST["newEmail"]."')";
		mysqli_query($conn, $sql);
		$_SESSION["username"] = $_POST["newUsername"];
		$_SESSION["name"] = $_POST["newName"];
		$_SESSION["email"] = $_POST["newEmail"];
	}
	
	header("Location: account.php");
	exit();
?>