<?php
	session_start();
	include "db_conn.php";
	
	if (!isset ($_GET['AppID'])) {  
		echo "404 Game Not Found";
	} else {  
		$AppID = $_GET['AppID'];
		$sql = "SELECT * FROM games where " . $AppID . " = AppID";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		
		function purchase($conn){
			$sql = "CALL AddGameToLibrary(".$_SESSION["userID"].", ".$_GET['AppID'].")";
			mysqli_query($conn, $sql);
			$_POST = array();
		}
		
		if(array_key_exists('purchase', $_POST)) { 
			purchase($conn); 
		} 
	}
?>
<html>
<head>
<?php
	if(!isset($row)){
		echo "<title>ERROR</title>";
	} else {
		echo "<title>".$row["Name"]."</title>";
	}
?>
<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
<?php 
	$title = $row["Name"];
	include ('header.php'); 
?> 


<?php
	if(!isset($row)){
		echo "<h1>404 Game Not Found</h1>";
	} else {
		echo "<img src = \"".$row["Header image"]."\">";
		
		echo "<h2 style=\"\">".$row["Name"]."</h2>";
		
		$screenshots = explode(",", $row["Screenshots"]);
		
		echo "<div style=\"width:100%; overflow-x: scroll;\"><Table><tr>";
		
		for($x = 0; $x < count($screenshots); $x++) {
            $screenshot = $screenshots[$x];
            echo "<td padding=\"1rem\" style=\"!important; all:initial;\"><a href=\"".$screenshot."\"><img width=\"auto\" alt=\"". $row["Name"] ."\" src = \"" . $screenshot . "\" height=\"250px\"></a></td>";
        }
		
		echo "</tr></Table></div>";
		
		echo "<h2>Tags</h2>";
		
		echo "<p>".$row["Tags"]."</p>";
		
		echo "<h2>Description:</h2>";
		
		echo "<p>".$row["About the game"]."</p>";
		
		echo "<h3><form method=\"post\">Purchase: ";
		
		if(array_key_exists('libraryID', $_SESSION)){
			$sql = "SELECT librarycontains.appID FROM librarycontains WHERE " . $AppID . " = appID AND libraryID = ".$_SESSION["libraryID"];
			$result = mysqli_query($conn, $sql);
			$inLibrary = mysqli_fetch_array($result);
		
			if(!isset($inLibrary)){
				echo "<input type=\"submit\" name=\"purchase\"class=\"button\" value=\"".$row["Price"]."\"/>";
			} else {
			echo "ALREADY IN LIBRARY";
			}
			echo "</form></h3>";
		} else {
			echo $row["Price"];
			echo "</form></h3>";
			echo "<p><a href=\"login.php\" class=\"secondary\">Log in</a> to make purchases!</p>";
		}
	}
?>

</body>
</html>