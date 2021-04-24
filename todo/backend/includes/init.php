<?php
session_start();
    // including all files for initialization

    require_once("config.php");
    require_once("../database/db.php");
    require_once("User.php");
    require_once("Task.php");

    // create the database
    $db = new Database();
    $result = $db->create_db($db_host,$db_user,$db_password,$db_name);

    // connecting to db
    $connect = $db->con($db_host,$db_user,$db_password,$db_name);
