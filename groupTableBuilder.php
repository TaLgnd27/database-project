<?php
	////REQUIRES $result TO CONTAIN TABLE TO BUILD
	
	$sql = "SELECT * FROM interestgroups";
	$result = mysqli_query($conn, $sql);
	
	if(isset($_SESSION["username"])){
		echo "Create A Group:<form action=\"groupHandler.php\" method=\"post\"><label for=\"groupName\">Group Name</label><input type=\"text\" id=\"groupName\" name=\"groupName\" placeholder=\"Group Name\"><label for=\"gameName\">Game Name (Optional)</label><input type=\"text\" id=\"gameName\" name=\"gameName\" placeholder=\"Game Name\"><button type=\"submit\" id=\"isNew\" name=\"isNew\" value=\"1\">Create Group</button>";
	}
	
	echo "<Table style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse; margin: 2rem;\"><tr style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">";
	echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">Group Name</td><td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">Members</td><td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">Game</td><td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">JOIN/LEAVE</td>";
	echo "</tr>";
	foreach ($result as $row){
		echo "<tr style=\"border: 2px solid #000000; border-collapse: collapse;\">";
		
		echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">".$row["name"]."</td>";
		
		$sql = "SELECT users.username FROM groupjoin, users where ".$row["groupID"]." = groupjoin.groupID and groupjoin.userID = users.userID order by users.username";
		$members = mysqli_query($conn, $sql);
		$memberList = array();
		$userIsIn = false;
		foreach($members as $member){
			array_push($memberList, $member["username"]);
			if(!$userIsIn and isset($_SESSION["username"])){
				if($member["username"] == $_SESSION["username"])
					$userIsIn = true;
			}
		}
		$memberListStr = implode(", ", $memberList);
		echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">".$memberListStr."</td>";
		
		if(isset($row["appID"])){
			$sql = "SELECT games.Name, games.AppID, games.`Header image` FROM games where ".$row["appID"]." = games.AppID";
			$game = mysqli_fetch_array(mysqli_query($conn, $sql));
			echo "<td><a href=\"game.php?AppID=" . $game["AppID"] . "\"><img alt=\"". $game["Name"] ."\" src = \"" . $game["Header image"] . "\"></a></td>";
		} else {
			echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\"></td>";
		}
		
		if(isset($_SESSION["username"]) and !$userIsIn){
			echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\"><form action=\"groupHandler.php\" method=\"post\"><button type=\"submit\" name=\"groupJoinID\"class=\"button\" value=\"".$row["groupID"]."\"/>JOIN</button></form></td>";
		} else if ($userIsIn){
			echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\"><form action=\"groupHandler.php\" method=\"post\"><button type=\"submit\" name=\"groupLeaveID\"class=\"button\" value=\"".$row["groupID"]."\"/>LEAVE</button></form></td>";
		} else {
			echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">You must be logged in to join a group</td>";
		}
		
		echo "</tr>";
	}
	echo "</Table>";
?>