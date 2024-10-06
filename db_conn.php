<?php

$sname = "66.175.204.40";
$uname = "databaseUser";
$password = "kn4i\$F9RyzxS9cJQ";
$db_name = "databaseproject";
$port = "9386";

$conn = mysqli_connect(hostname:$sname, username:$uname, password:$password, database:$db_name, port: $port);

// Check connection
if (mysqli_connect_errno()) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
$listdbtables = array_column($conn->query('SHOW TABLES')->fetch_all(),0);
foreach($listdbtables as $table ){
  $describedbtable = array_column($conn->query('describe '. $table)->fetch_all(),0);
}
}