<?php 
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
	<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
    <?php
		$title = "Groups";
		include('header.php');
		
		include('groupTableBuilder.php')
	?>
</body>
</html>