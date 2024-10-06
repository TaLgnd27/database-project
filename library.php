<?php 
session_start();
include "db_conn.php";
if(isset($_SESSION["userID"]) && isset($_SESSION["username"])){

	if (!isset ($_GET['filter']) ) {  
		$filter = "`Peak CCU` DESC";  
	} else {  
		$filter = $_GET['filter'];  
	}  

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
		$title = "Library";
		include('header.php');
	?>
    <h2><?php echo $_SESSION['username']; ?></h2>
	<form action="filterHandler.php" method=
'post'>
		<label for="filter">Sort By: </label>
		<select id="filter" name="filter" onchange="this.form.submit()">
			<option value="`Peak CCU` DESC" <?php if($filter=="`Peak CCU` DESC"){ echo "selected";} ?>> Highest Peak CCU</option>
			<option value="`Peak CCU` ASC" <?php if($filter=="`Peak CCU` ASC"){ echo "selected";} ?>> Lowest Peak CCU</option>
			<option value="`Release date` DESC" <?php if($filter=="`Release date` DESC"){ echo "selected";} ?>>Release Date (Newest)</option>
			<option value="`Release date` ASC" <?php if($filter=="`Release date` ASC"){ echo "selected";} ?>>Release Date (Oldest)</option>
			<option value="Price DESC" <?php if($filter=="Price DESC"){ echo "selected";} ?>>Highest Price</option>
			<option value="Price ASC" <?php if($filter=="Price ASC"){ echo "selected";} ?>> Lowest Price</option>
			<option value="`Metacritic score` DESC" <?php if($filter=="`Metacritic score` DESC"){ echo "selected";} ?>>Highest Metacritic Score</option>
			<option value="`Metacritic score` ASC" <?php if($filter=="`Metacritic score` ASC"){ echo "selected";} ?>>Lowest Metacritic Score</option>
			<option value="`User score` DESC" <?php if($filter=="`User score` DESC"){ echo "selected";} ?>>HIghest User Score</option>
			<option value="`User score` ASC" <?php if($filter=="`User score` ASC"){ echo "selected";} ?>>Lowest User Score</option>
		</select>
		<input type="hidden" id="page" name="page" value="library.php" />
	</form>
	
	<?php
		$sql = "SELECT games.* FROM librarycontains, games WHERE librarycontains.libraryID = ".$_SESSION["libraryID"]." AND games.AppID = librarycontains.appID ORDER BY " . $filter;
		$result = mysqli_query($conn, $sql);
	
		include("gameTableBuilder.php");
	?>
</body>
</html>
<?php }else{
    header("Location: index.php");
    exit();
}

?>