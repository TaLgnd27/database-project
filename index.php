<?php 
session_start();
include "db_conn.php";

//need to call games 10 at a time.

if (!isset ($_GET['filter']) ) {  
    $filter = "`Peak CCU` DESC";  
} else {  
    $filter = $_GET['filter'];  
}  
$results_per_page = 10;

//$sql = "SELECT AppID, Name, `Header image` FROM games ORDER BY " . $filter;

//$result = mysqli_query($conn, $sql);  
$number_of_result = 10000; //mysqli_num_rows($result);  

$number_of_page = ceil ($number_of_result / $results_per_page);  

if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
}  
$page_first_result = ($page-1) * $results_per_page; 

$sql = "SELECT AppID, Name, `Header image` FROM games ORDER BY " . $filter . " LIMIT " . $page_first_result . ',' . $results_per_page;

$result = mysqli_query($conn, $sql);  


?>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="primary">
<?php
	$title = "Home";
	include('header.php');
?>
<h2 style="text-decoration: underline;">Games</h2>
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
		<input type="hidden" id="page" name="page" value="index.php" />
		
	</form>
<Table>
    <tr>
        <Th colspan="100%" align="left" >Popular games</Th>
    </tr>
    <tr>
        <?php
		$table = mysqli_fetch_all($result);
        for($x = 0; $x < 10; $x++) {
            $row = $table[$x];
            echo "<td><a href=\"game.php?AppID=" . $row[0] . "\"><img alt=\"". $row[1] ."\" src = \"" . $row[2] . "\"></a></td>";
            if(($x+1)%2 == 0){
                echo "</tr>
                <tr>";
            }
        }  
        ?>
    </tr>
</Table>
<a <?php if($page == 1){echo "disabled=\"true\"";}else{echo "href=\"index.php?page=" . $page-1 . "&filter=". $filter . "\"";} ?> class="primary">Previous Page</a>
<a <?php if($page == $number_of_page){echo "disabled=\"true\"";}else{echo "href=\"index.php?page=" . $page+1 . "&filter=". $filter . "\"";} ?> class="primary">Next Page</a>

</body>
</html>