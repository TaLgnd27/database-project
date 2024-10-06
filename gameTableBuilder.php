<?php
	////REQUIRES $result TO CONTAIN TABLE TO BUILD
	
	//$cols = mysqli_fetch_fields($result);
	//$test = mysqli_fetch_assoc($result);
	
	echo "<Table>";
	//foreach ($cols as $val) {
	//	echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">".$val->name."</td>";
	//}
	//echo "</tr>";
	for ($i = 0; $i < mysqli_num_rows($result); $i++){
		echo "<tr>";
		for($j = 0; $j < 3; $j++){
			$row = mysqli_fetch_array($result);
			
			if(isset($row))
				echo "<td><a href=\"game.php?AppID=" . $row["AppID"] . "\"><img alt=\"". $row["Name"] ."\" src = \"" . $row["Header image"] . "\"></a></td>";
		}
		
		echo "</tr>";
	}
	echo "</Table>"
?>