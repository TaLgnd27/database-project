<?php
	session_start();
	include "db_conn.php";
	echo "test1";
	if(isset($_POST["groupJoinID"])){
		if(isset($_SESSION["userID"]))
		$sql = "call AddUserToInterestGroup(".$_SESSION["userID"].",".$_POST["groupJoinID"].")";
		mysqli_query($conn, $sql);
	}
	
	if(isset($_POST["groupLeaveID"])){
		if(isset($_SESSION["userID"]))
		$sql = "call RemoveUserFromGroup(".$_SESSION["userID"].",".$_POST["groupLeaveID"].")";
		mysqli_query($conn, $sql);
	}

	if(isset($_POST["isNew"])){
		$gameName = "";
		if(isset($_POST["gameName"])){
			$gameName = $_POST["gameName"];
		}
		echo "test";
		if(isset($_SESSION["userID"]))
		$sql = "call CreateInterestGroup('".$_POST["groupName"]."', '".$gameName."')";
		mysqli_query($conn, $sql);
	}
	
	header("Location: groups.php");
	exit();
?>