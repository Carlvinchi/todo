<?php
// Initialize API
require_once("../includes/init.php");

    if(isset($_POST["signup"])){
        // Retrieve posted data into variables
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        // Create instance of user class
        $user = new User($connect);

        // attempt creating user
        $run = $user->create_user($email, $username, $password);

        if($run == "Success"){
            echo "User created";
        }else{
            echo "User not created";
        }
    }
    elseif(isset($_POST["authenticate"])){
        // Retrieve posted data into variables
        $email = $_POST["email"];
        
        $password = $_POST["password"];

        // Create instance of user class
        $user = new User($connect);

        // attempt creating user
        $run = $user->user_login($email, $password);
        if($run == "Success")
            echo $run;
        else
            echo $run;
    }
    elseif(isset($_POST["ad_task"])){
        // Retrieve posted data into variables
        $title = $_POST["title"];
        $description = $_POST["description"];
        $userid = $_POST["userid"];
        // Create instance of task class
        $task = new Task($connect);

        // attempt creating user
        $run = $task->create_task($title,$description,$userid);

        if($run == "Success") 
            echo $run;
        else
            echo $run;
    }
    elseif(isset($_GET["fetch-all"])){
        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];
        $page_no = $_GET['page_no'];

        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->get_all_user_tasks_paginate($userid, $page_no);

        $result = $data;
        //var_dump($data);

        if(is_array($result)){
            $count = 0;

            foreach($result as $item){
                $count ++;
                ?>

                <tr>
								<td><?php echo $count ?></td>
								<td>
                                
                                <button class="btn btn-default btn-md" onclick="get_task_details(<?php echo $item['taskid'] ?>)"><?php echo $item["title"]?></button>
                           
                                
                                </td>
								<td><?php echo $item["created_date"] ?></td>
								
                                    <?php 
                                        if($item["status"] == "Completed"){

                                            echo '<td>
                                            <button class="btn btn-success btn-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
										<path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
										<path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
									  </svg>
                                      </button>
                                            </td>';
                                        }

                                        else{
                                            echo '<td>
                                            <button class="btn btn-info btn-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-circle" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
										<path d="M5 6.25a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5zm3.5 0a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5z"/>
									  </svg>
                                      </button>
                                      </td>
                                        ';
                                        }
                                    
                                    
                                    ?>
									
								
								<td>
                                <button class="btn btn-warning btn-md" onclick="fetch_one(<?php echo $item['taskid'] ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
								  </svg>
                                </button>
									
                              
								</td>

								<td>
                                
                          

                                
                                      <button class="btn btn-danger btn-md"  onclick="confirm_delete(<?php echo $item['taskid'] ?>)">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									  </svg> 
                                      </button>
									
								</td>
							  </tr>
                <?php


            }

            
        }

        exit;

    }
    elseif(isset($_GET["fetch-one"])){
        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];
        $taskid = $_GET['taskid'];


        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->get_user_task($userid,$taskid);
        if(is_array($data)){
            echo' 
            <form id="edit-task" onsubmit="return false" autocomplete="off" >
            <fieldset>
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Title" id="task_title" name="task_title" required type="text" value='.$data[0]["title"].'>
                    
                </div>

                <div class="form-group">
                <label>Description</label>
                    <textarea class="form-control" placeholder="Description" id="task_description" name="task_description">'.$data[0]["description"].'</textarea
                    
                </div>

                <div class="form-group">
                <label>Status: Completed OR Pending</label>
                    <input class="form-control" id="task_status" name="task_status" type="text" required value='.$data[0]["status"].'>
                    
                </div>

                <div class="form-group">
                    <input class="form-control" name="task_userid" id="task_userid" type="hidden" value='.$_SESSION["userid"].'>
                    <input class="form-control" name="date_created" id="created_date" type="hidden" value='.$data[0]["created_date"].'>
                    <input class="form-control" name="task_id" id="task_id" type="hidden" value='.$data[0]["taskid"].'>
                    
                </div>
                
                <div class="form-group">
                <button class="btn btn-primary" name="submit" onclick="fire()">Save</button>
                </div>

                </fieldset>
        </form>
            ';
        }
        //print_r(json_encode($data));
    }
    elseif(isset($_GET["pending"])){
        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];
        


        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->getPending($userid);
        if(is_array($data))
            echo sizeof($data);
        else
            echo 0;
    }

    elseif(isset($_GET["completed"])){
        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];
        


        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->getCompleted($userid);

        if(is_array($data))
            echo sizeof($data);
        else
            echo 0;
    }

    elseif(isset($_GET["all"])){
        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];


        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->get_all_user_tasks($userid);

        if(is_array($data))
            echo sizeof($data);
        else
            echo 0;
    }

    elseif(isset($_GET["task-details"])){

        // Retrieve posted data into variables
        //Get the data
        $userid = $_GET['userid'];
        $taskid = $_GET['taskid'];


        // Create instance of task class
        $task = new Task($connect);

        // attempt to get data
        $data = $task->get_user_task($userid,$taskid);
        if(is_array($data)){
            echo'
            <form onsubmit="return false" autocomplete="off" >
            <fieldset>
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" readonly type="text" value='.$data[0]['title'].'>
                    
                </div>
    
                <div class="form-group">
                <label>Description</label>
                    <textarea class="form-control" readonly>'.$data[0]['description'].'</textarea>
                    
                </div>
    
                <div class="form-group">
                <label>Status</label>
                    <input class="form-control" type="text" readonly value='. $data[0]['status'].'>
                    
                </div>
    
                <div class="form-group">
                <label>Date Created</label>
                    <input class="form-control" id="task_status"  type="text" value='.$data[0]['created_date'].' readonly>
                    
                </div>
    
                </fieldset>
        </form>
            ';
        }
        
    }
    elseif(isset($_POST["edit"])){
        // Retrieve posted data into variables
        // Retrieve posted data into variables
        $title = $_POST["title"];
        $description = $_POST["description"];
        $userid = $_POST["userid"];
        $status = $_POST["status"];
        $taskid = $_POST["taskid"];

        // Create instance of task class
        $task = new Task($connect);

        // attempt to update task
        $run = $task->update_task($userid,$taskid,$title,$description,$status);

        if($run == "Success")
            echo $run;
        else
            echo $run;
    }
    elseif(isset($_GET["delete_one"])){
       // echo "Hi";
        // Retrieve posted data into variables
        $userid = $_GET["userid"];
        $taskid = $_GET["taskid"];
        
        // Create instance of task class
        $task = new Task($connect);

        // attempt creating user
        $run = $task->delete_task($userid,$taskid);
        if($run == "Deleted")
            echo $run;
        else
            echo $run;
    }
    elseif(isset($_GET["delete_all"])){
        // Retrieve posted data into variables
        $userid = $_GET["userid"];
        

        // Create instance of task class
        $task = new Task($connect);

        // attempt creating user
        $run = $task->delete_all_user_tasks($userid);
        if($run == "All Deleted")
            echo $run;
        else
            echo $run;
    }


