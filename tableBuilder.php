<?php
	////REQUIRES $result TO CONTAIN TABLE TO BUILD
	
	$cols = mysqli_fetch_fields($result);
	$test = mysqli_fetch_assoc($result);
	
	echo "<Table style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\"><tr style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">";
	foreach ($cols as $val) {
		echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">".$val->name."</td>";
	}
	echo "</tr>";
	foreach ($result as $row){
		echo "<tr style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">";
		foreach($row as $val){
			echo "<td style=\"padding: 2rem; border: 2px solid #000000; border-collapse: collapse;\">".$val."</td>";
		}
		echo "</tr>";
	}
	echo "</Table>"
?>