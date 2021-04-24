$(document).ready(function(){
    $("#login-form").on("submit", function(){
        
       var email = $("#email").val();
       
       var password = $("#password").val();
       
           // send ajax request
            
            $.ajax({
                url: "http://localhost/todo/todo/backend/api/ajax.php",

                method: "POST",

                data: {
                    authenticate: 1,
                    email: email,
                
                    password: password
                },

                success: function(data){

                    if(data == "Success"){
                        alert(data);
                        location.replace("http://localhost/todo/todo/dashboard/dashboard.php");
                    }
                        
                    else{
                        alert(data);
                        $("#email").html(email);
                        


                    }

                }
            });
            

        
    });
  });