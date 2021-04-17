<?php

//add headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With'); 

// Initialize API
require_once("../includes/init.php");

//Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Retrieve posted data into variables
$title = $data->title;
$description = $data->description;
$userid = $data->userid;

// Create instance of task class
$task = new Task($connect);

// attempt creating user
$run = $task->create_task($title,$description,$userid);

if($run == "Success"){
    echo json_encode(
        array('message' => 'Task created.')
    );
}else{
    echo json_encode(
        array('message' => 'Task not created.')
    );
}