<?php

// Create class for handling tasks
class Task{

    private $conn;
    private $table = "tasks";
    // creating a class constructor
    function __construct($connect)
    {
        $this->conn = $connect;
    }

    /* Create task table if not exist   */
    private function create_table(){

        // Attempt create table
        $sql = "CREATE TABLE IF NOT EXISTS $this->table (
            taskid INT(11) AUTO_INCREMENT,
            title VARCHAR(100) NOT NULL,
            description TEXT(2000) NOT NULL,
            created_date DATETIME,
            userid INT(11),
            status CHAR(20) DEFAULT('Pending'),
            PRIMARY KEY(taskid),
            FOREIGN KEY(userid) REFERENCES users(userid)
            )";

        if($this->conn->query($sql)){

            //echo "Table created successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . $this->conn->error;
        }

    }

    public function create_task($title, $description, $userid){
        $this->create_table();
        date_default_timezone_set("GMT");
        $date   = new DateTime(); //this returns the current date time
        $dResult = $date->format('Y-m-d H:i:s');
        $created_date = $dResult;
        $pre_stmt = $this->conn->prepare("INSERT INTO $this->table (`title`, `description`, `created_date`, `userid`) 
        VALUES (?,?,?,?)");
        $pre_stmt->bind_param("ssss", $title,$description,$created_date, $userid);
        $res = $pre_stmt->execute() or die($this->conn->error);
        if($res){
            return "Success";
            exit;
        }
        else{
            return "Error";
            exit;
        }

    }

    private function getData($pre_stmt) {
        $pre_stmt->execute() or die($this->conn->error); 
        $result = $pre_stmt->get_result();
        if(!$result){
            return $this->conn->error;
            } 

        $data= array();
         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
                $data[]=$row;            
            }
            return $data;
        }

    public function get_all_task(){
        $pre_stmt = $this->conn->prepare("SELECT * FROM $this->table ");
        $data = $this->getData($pre_stmt);
        if(sizeof($data) == 0){
            return json_encode(
                array("message"=>"No data")
            );
            exit;
        }
        return json_encode($data);
        exit;

    }

    public function get_all_user_tasks($userid){
        $pre_stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE userid = ?");
        $pre_stmt->bind_param("s", $userid);
        $data = $this->getData($pre_stmt);
        if(sizeof($data) == 0){
            return json_encode(
                array("message"=>"No data")
            );
            exit;
        }
        return json_encode($data);
        exit;

    }

    public function get_user_task($userid,$taskid){
        $pre_stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE userid = ? AND taskid = ?");
        $pre_stmt->bind_param("ss", $userid, $taskid);
        $data = $this->getData($pre_stmt);
        if(sizeof($data) == 0){
            return json_encode(
                array("message"=>"No data")
            );
            exit;
        }
        return json_encode($data);
        exit;

    }

    public function update_task($userid,$taskid,$title,$description,$status){
        $pre_stmt = $this->conn->prepare("UPDATE $this->table SET title = ?, description = ?, status  = ? WHERE userid = ? AND taskid = ?");
        $pre_stmt->bind_param("sssss", $title, $description, $status, $userid, $taskid);
        $result = $pre_stmt->execute() or die($this->conn->error);
        if($result == TRUE){
            return "Updated";
            exit;
        }
        else{
            return "Error";
            exit;
        }
    }


    public function delete_task($userid,$taskid){
        $pre_stmt = $this->conn->prepare("DELETE FROM $this->table WHERE userid = ? AND taskid = ?");
        $pre_stmt->bind_param("ss", $userid, $taskid);
        $result = $pre_stmt->execute() or die($this->conn->error);
        if($result == TRUE){
            return "Deleted";
            exit;
        }
        else{
            return "Error";
            exit;
        }
    }

    public function delete_all_user_tasks($userid){
        $pre_stmt = $this->conn->prepare("DELETE FROM $this->table WHERE userid = ?");
        $pre_stmt->bind_param("s", $userid);
        $result = $pre_stmt->execute() or die($this->conn->error);
        if($result == TRUE){
            return " All Deleted";
            exit;
        }
        else{
            return "Error";
            exit;
        }
    }
}