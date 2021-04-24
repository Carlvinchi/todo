$(document).ready(function(){
    $("#ad-task").on("submit", function(){
        $("#myModal").hide();
       var title = $("#title").val();
       var description = $("#description").val();
       var userid = $("#userid").val();
       
       
           // send ajax request
            
            $.ajax({
                url: "http://localhost/todo/todo/backend/api/ajax.php",

                method: "POST",

                data: {
                    ad_task: 1,
                    title: title,
                    description: description,
                    userid: userid
                },

                success: function(data){

                    if(data == "Success"){
                        
                        alert(data);
                        location.replace("http://localhost/todo/todo/dashboard/dashboard.php");
                    }
                        
                    else{
                        alert(data);
                        $("#myModal").modal('show');
                        
                        $("#title").html(title);
                        $("#description").html(description);
                        
                    }

                }
            });
            

        
    });
  });