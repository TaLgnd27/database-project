<?php 
session_start();
if (isset($_POST["filter"]) && isset($_POST["page"])){
    header("Location: ". $_POST["page"] . "?filter=" . $_POST["filter"]);
} else {
    header("Location: ". $_POST["page"]);
}

