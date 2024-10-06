<div margin="auto" class="header">
	<?php
		if(!isset($title)){
			echo "<h1 class=\"header\">ERROR</h1>";
		} else {
			echo "<h1 class=\"header\">".$title."</h1>";
		}
		
		echo "<p margin=\"auto\" class=\"secondary\">";
		
		echo "<a href=\"index.php\" class=\"secondary\">Home</a> ";
		
		echo "<a href=\"groups.php\" class=\"secondary\">Groups</a> ";
	
		if(isset($_SESSION["username"])){
			echo "<a href=\"library.php\" class=\"secondary\">Library</a> <a href=\"account.php\"class=\"secondary\">" . $_SESSION["username"] . "</a> "  .
			"<a href=\"logout.php\" class=\"secondary\">Logout</a>";
		} else{
			echo "<a href=\"login.php\" class=\"secondary\">Log in/Sign up</a>";
		}
		
		echo "</p>";
	?>
</div>