<?php
session_start();
include "db_conn.php";

if (isset($_POST["username"]) /* && isset($_POST["password"]) */) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["username"]);
    // $pass = validate($_POST["password"]);

    if (empty($uname)/*  || empty($pass) */) {
        header("Location: login.html?error=Username was not filled in");
        exit();
    } else {
        $sql = "SELECT * from users where username=\"". $uname. "\" OR email=\"".$uname ."\"";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row["username"] == $uname || $row["email"] == $uname) {
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["userID"] = $row["userID"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["libraryID"] = $row["libraryID"];
            }
            header("Location: Library.php");
            exit();
        } else {
            header("Location: login.php?error=Either no matches, or more than one match");
        exit();
        }
    }
} else {
    header("Location: login.php?error=Received no input");
    exit();
}