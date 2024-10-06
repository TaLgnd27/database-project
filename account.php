<?php
	session_start();
	include "db_conn.php";
	
	if (!isset ($_SESSION['userID'])) {  
		header("Location: index.php");
		exit();
	} else {  
		$sql = "SELECT * FROM users where " . $_SESSION["userID"] . " = userID";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
	}
?>
<html>
<head>
<?php
	if(!isset($row)){
		echo "<title>ERROR</title>";
	} else {
		echo "<title>".$row["username"]."</title>";
	}
?>
<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
<?php 
	$title = $row["username"];
	include ('header.php'); 
?>
<form method="post" action="accountHandler.php">
<h3>Username</h3>
<p>
<?php
	echo $row["username"]." <input type=\"text\" id=\"newUsername\" name=\"newUsername\" value=\"".$row["username"]."\">";
?>
</p>

<h3>Email</h3>
<p>
<?php
	echo $row["email"]." <input type=\"text\" id=\"newEmail\" name=\"newEmail\" value=\"".$row["email"]."\">";
?>
</p>

<h3>Name</h3>
<p>
<?php
	echo $row["name"]." <input type=\"text\" id=\"newName\" name=\"newName\" value=\"".$row["name"]."\">";
?>
</p>

<button type="submit">Update</button>
</form>
<h1>Stats</h1>

<p> Total Games:
<?php
	$sql = "SELECT count(*) as total FROM librarycontains where " . $_SESSION["libraryID"] . " = librarycontains.libraryID";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	echo $row["total"];
?>
</p>

<p> Total Achievments: 0 /
<?php
	$sql = "SELECT sum(games.Achievements) as total FROM games, librarycontains where " . $_SESSION["libraryID"] . " = librarycontains.libraryID and librarycontains.appID = games.AppID";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	echo $row["total"];
?>
</p>

<p> Groups:
<?php
	$sql = "SELECT interestgroups.name FROM groupjoin, interestgroups where " . $_SESSION["userID"] . " = groupjoin.userID and interestgroups.groupID = groupjoin.groupID";
	$result = mysqli_query($conn, $sql);
	
	$groupList = array();
	foreach($result as $row){
		array_push($groupList, $row["name"]);
	}
	
	
	$groups = implode(", ", $groupList);
	echo $groups;
?>
</p>

<p> Favorite Tag(s):
<?php
	$sql = "SELECT games.Tags FROM games, librarycontains where " . $_SESSION["libraryID"] . " = librarycontains.libraryID and librarycontains.appID = games.AppID";
	$result = mysqli_query($conn, $sql);
	
	$tagList = array();
	foreach($result as $row){
		array_push($tagList, $row["Tags"]);
	}
	
	
	$tags = explode(",", implode(",", $tagList));
	$tagCounts = array_count_values($tags);
	arsort($tagCounts);
	$tagList = array();
	$count = 0;
	foreach($tagCounts as $key => $tag){
		if($tag >= $count){
			$count = $tag;
			array_push($tagList, $key);
		}
	}
	
	echo implode(", ", $tagList);
?>
</p>

</body>
</html>