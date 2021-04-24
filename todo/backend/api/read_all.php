<?php

//add headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

// Initialize API
require_once("../includes/init.php");

//Get the data
$userid = $_GET['userid'];


// Create instance of task class
$task = new Task($connect);

// attempt to get data
$data = $task->get_all_user_tasks($userid);
$data = json_encode($data);
echo $data;