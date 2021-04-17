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
$email = $data->email;

$password = $data->password;

// Create instance of user class
$user = new User($connect);

// attempt creating user
$run = $user->user_login($email, $password);

if($run == "Success"){
    echo json_encode(
        array('message' => 'Authenticated')
    );
}else{
    echo json_encode(
        array('message' => $run)
    );
}