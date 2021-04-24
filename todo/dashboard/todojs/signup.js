$(document).ready(function(){
    $("#signup-form").on("submit", function(){
        
       var email = $("#email").val();
       var username = $("#username").val();
       var password = $("#password").val();
       var pass2 = $("#confirm_password").val();
        // do validations

        if(password != pass2){
            alert("passwords do not match");
        }
           // send ajax request
            
            $.ajax({
                url: "http://localhost/todo/todo/backend/api/ajax.php",

                method: "POST",

                data: {
                    signup: 1,
                    email: email,
                    username: username,
                    password: password
                },

                success: function(data){

                    if(data == "User created"){
                        alert(data);
                        location.replace("http://localhost/todo/todo/dashboard/login.html");
                    }
                        
                    else{
                        alert(data);
                        $("#email").html(email);
                        $("#username").html(username);


                    }

                }
            });
            

        
    });
  });