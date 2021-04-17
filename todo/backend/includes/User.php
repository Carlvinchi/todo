<?php

class User{
    private $conn;
    private $table = "users";
    // creating a class constructor
    function __construct($connect)
    {
        $this->conn = $connect;
    }

    /* Create user table if not exist   */
    private function create_table(){

        // Attempt create table
        $sql = "CREATE TABLE IF NOT EXISTS $this->table (
            userid INT(11) AUTO_INCREMENT,
            user_email VARCHAR(64),
            username CHAR(16),
            password VARCHAR(255),
            reg_date DATETIME,
            PRIMARY KEY(userid)
            )";

        if($this->conn->query($sql)){

            //echo "Table created successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . $this->conn->error;
        }

    }
    
    /* @params $user_name, $user_email, $password, $name */
    public function create_user($user_email, $username,$password){
        $this->create_table();
        
        if($this->userExists($user_email) == 'Yes'){
            return "User already registered";
            exit;
        }


        date_default_timezone_set("GMT");
        $date   = new DateTime(); //this returns the current date time
        $dResult = $date->format('Y-m-d H:i:s');
        $reg_date = $dResult;
        $hashed_password = password_hash($password,PASSWORD_BCRYPT, ["cost"=>8]);
        
        $pre_stmt = $this->conn->prepare("INSERT INTO $this->table (`user_email`, `username`, `password`, `reg_date`)
        VALUES (?,?,?,?)
        ");
        $pre_stmt->bind_param("ssss", $user_email, $username, $hashed_password, $reg_date);
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


    // Check if user already registered
    private function userExists($email){
        $pre_stmt = $this->conn->prepare("SELECT userid FROM users WHERE user_email = ? ");
        $pre_stmt->bind_param("s", $email);
        $pre_stmt->execute() or die($this->conn->error);
        $result = $pre_stmt->get_result();
        if($result->num_rows > 0){
            return 'Yes';
        }else{
            return 'No';
        }
    }



    public function user_login($email, $password){
        $pre_stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email = ? ");
        $pre_stmt->bind_param("s", $email) ;
        $pre_stmt->execute() or die($this->conn->error);
        $result = $pre_stmt->get_result();
        
        if($result->num_rows < 1){
            return "NOT REGISTERED";
            exit;
        }

        $row = $result->fetch_assoc();
        if(password_verify($password, $row["password"])){
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['username'] = $row['username'];

            return "Success";
            exit;
        }
        else{
            return "invalid password";
            exit;
        }

    }
}