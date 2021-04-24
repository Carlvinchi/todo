<?php
session_start();
$domain = "http://localhost/todo/todo/dashboard/login.html";
if(isset($_SESSION["userid"])){
    session_unset();
    session_destroy();
}
header("location: $domain");
    exit();
?>