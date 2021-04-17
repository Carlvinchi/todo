<?php
//add headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With'); 

// Initialize API
require_once("../includes/init.php");

//Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Retrieve posted data into variables
$userid = $data->userid;
$taskid = $data->taskid;

// Create instance of task class
$task = new Task($connect);

// attempt creating user
$run = $task->delete_task($userid,$taskid);

if($run == "Deleted"){
    echo json_encode(
        array('message' => $run)
    );
}else{
    echo json_encode(
        array('message' => $run)
    );
}