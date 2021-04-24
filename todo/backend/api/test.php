<?php
require_once("../includes/init.php");
/* Variables for creating an account */
$email = "oc90699@yaho.com";
$username = "Carlvinchi";
$password = "Realerno@20";

//http://localhost/todo/backend/api/test.php
//$user = new User($connect);
$task = new Task($connect);
//$test = $user->create_user($email, $username, $password);
//$test = $user->user_login($email, $password);
//$add = $task->create_task("Will Wash", "I will wash today", 1);
//$get = $task->get_all_task();
$data = $task->get_all_user_tasks(2);
//$update = $task->update_task(1,3,"Will Dance","I will Dance this evening","Completed");
//$del = $task->delete_task(1,2);
//$delAll = $task->delete_all_user_tasks(1);

 //$result = json_decode($data);
 foreach($data as $item){
    echo $item["title"];
 }
 
//var_dump($data[0]);