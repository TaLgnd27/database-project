<?php

//include "ChromePhp.php";
include "db_conn.php";
$uname = $_POST["username"];
$email = $_POST["email"];
//$pass = $_POST["password"];
//$passCon = $_POST["passwordConfirm"];
$fName = $_POST["name"];
$sql = "SELECT * from users where username='".$uname."' OR email='".$uname."'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    header("Location: signup.php?error=This user exists already more than one match");
}
echo "test";
$stmt = "Call CreateUserAndLibrary('".$uname."', '".$email."', '".$fName."')";

//$stmt = mysqli_stmt_init($conn);

//if(! mysqli_stmt_prepare($stmt, $sql)){
//    header("Location: signup.php?error=SQL error");
//    ChromePhp::log(mysqli_error($conn));
//}



mysqli_query($conn, $stmt);
header("Location: login.php");
exit();