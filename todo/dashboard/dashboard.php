<?php
session_start();
    if(!isset($_SESSION["userid"])){
        $domain = "http://localhost/todo/todo/dashboard/login.html";
        header('location: '.$domain);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todo - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Todo</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">

				

					
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-power-off"></em>
					</a>
						<ul class="dropdown-menu dropdown">
							<li><a href="logout.php">
								<div> &emsp; Logout
								</div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $_SESSION['username']?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			
		</div>
		<div class="divider"></div>
		
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-tasks color-blue"></em>
							<div class="large" id="all"></div>
							<div class="text-muted">Total Tasks</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-4 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check-circle color-teal"></em>
							<div class="large" id="completed"></div>
							<div class="text-muted">Completed Task</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding"><em class="fa fa-xl fa-pause-circle color-blue"></em>
							<div class="large" id="pending"></div>
							<div class="text-muted">Pending Task</div>
						</div>
					</div>
				</div>
				
			</div>
			<!--/.row-->
		</div>





		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						To Do List
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
						
						<span class="pull-right">
						<button class="btn btn-danger btn-md" onclick="confirm_delete_all_task()">Delete All</button>
						</span>
						
						<span class="pull-right">&emsp;
									</span>

						<span class="pull-right">
							<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add</button>
							<!-- Button trigger modal -->
			
  
				<!-- Modal  to add task-->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Task</h4>
						</div>
						<div class="modal-body">
							
							<form id="ad-task" onsubmit="return false" autocomplete="off">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="Title" id="title" name="title" required type="text" autofocus="">
										
									</div>
		
									<div class="form-group">
										<input class="form-control" placeholder="Description" id="description" name="description" type="description" required value="">
										
									</div>
		
									<div class="form-group">
										<input class="form-control" name="userid" id="userid" type="hidden" value="<?php echo $_SESSION["userid"] ?>">
									</div>
									
									<div class="form-group">
                                    <input class="btn btn-primary" name="submit" type="submit" value="Save">
									</div>

									</fieldset>
							</form>

						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						</div>
					</div>
					</div>
				</div>
						</span>
					</div>
					<div class="panel-body">
                    <input type="hidden" id="user" value="<?php echo $_SESSION['userid']?>">
					<input type="hidden" id="page_no" value="0">
						
						<table class="table">
							<thead>
							  <tr>
								<th>#</th>
								<th>Title</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Edit</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody id="list">

							  

							</tbody>
						  </table>
						  <center><input class="btn btn-primary" type="button" id="load_more" value="Load More"></center>
					</div>
					
				</div>
			</div>



			      
                <!-- Modal to show delete confirmation-->
				<div class="modal fade bs-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
					<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="deleteModalLabel">Confirm</h4>
						</div>
						<div class="modal-body">
							<p>Do you want to delete?</p>
							<form  class="form-inline"   autocomplete="off" >
								
								
							&emsp;
						
									<div class="form-group">

									<button class="btn btn-primary" id="delete">Yes</button>
									</div>
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									<div class="form-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									</div>

									
							</form>

						</div>
						
					</div>
					</div>
				</div>

				<!-- Modal to show delete all confirmation-->
				<div class="modal fade bs-example-modal-sm" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel">
					<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="deleteAllModalLabel">Confirm</h4>
						</div>
						<div class="modal-body">
							<p>Do you want to delete all?</p>
							<form  class="form-inline"   autocomplete="off" >
								
								
							&emsp;
						
									<div class="form-group">

									<button class="btn btn-primary" id="delete-all">Yes</button>
									</div>
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									&emsp;
									<div class="form-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									</div>

									
							</form>

						</div>
						
					</div>
					</div>
				</div>

				    <!-- Modal  to edit -->
					<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="editModalLabel">Edit Task</h4>
						</div>
						<div class="modal-body" id="append">
							
							

						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						</div>
					</div>
					</div>
				</div>


				                <!-- Modal to show task details -->
								<div class="modal fade" id="showTaskModal" tabindex="-1" role="dialog" aria-labelledby="showTaskModalLabel">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="showTaskModalLabel">Task Details</h4>
						</div>
						<div class="modal-body" id="task-details">
							
							

						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						</div>
					</div>
					</div>
				</div>

		</div><!--/.row-->
		
		
		<div class="row">

			
			
			<div class="col-sm-12">
				<p class="back-link"><a href="index.php">Todo - App</a></p>
			</div>
		</div><!--/.row-->


	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="todojs/add-task.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var userid = document.getElementById("user").value;
			var page_no = document.getElementById("page_no").value;
            load(userid,page_no);
			get_all(userid);
			get_completed(userid);
			get_pending(userid);

			$("#load_more").click(function() {
        
        loadMore();
		
      });
        });

		//  function to automatically load data when page loads
        function load(userid, page_no){
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&fetch-all&page_no="+page_no,
                    method: "GET",

                    success: function(data){
						if(data != 0){
							var content = document.getElementById("list");  
                        content.innerHTML = content.innerHTML + data;
						// We increase the value by 25 because we limit the results by 25
						document.getElementById("page_no").value = Number(page_no) + 25;
						}
						else{
							 $("#load_more").hide();
						}
                       
                    }
                }
            );

        }

		// function to load more data, this for pagination
		function loadMore(){
			var userid = document.getElementById("user").value;
			var page_no = document.getElementById("page_no").value;
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&fetch-all&page_no="+page_no,
                    method: "GET",

                    success: function(data){
						if(data != 0){
							var content = document.getElementById("list");  
                        content.innerHTML = content.innerHTML + data;
						// We increase the value by 25 because we limit the results by 25
						document.getElementById("page_no").value = Number(page_no) + 25;
						}
						else{
							 $("#load_more").hide();
						}
                       
                    }
                }
            );

        }

		//  function to get pending tasks
        function get_pending(userid){
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&pending=1",
                    method: "GET",

                    success: function(data){
						var content = document.getElementById("pending"); 
						append.innerHTML = ""; 
                        content.innerHTML = content.innerHTML + data;
						 
                    }
                }
            );

        }


		//  function to get completed task
        function get_completed(userid){
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&completed=1",
                    method: "GET",

                    success: function(data){
						var content = document.getElementById("completed"); 
						append.innerHTML = ""; 
                        content.innerHTML = content.innerHTML + data;
						 
                    }
                }
            );

        }



		//  function to get total task
        function get_all(userid){
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&all=1",
                    method: "GET",

                    success: function(data){
						var content = document.getElementById("all"); 
						append.innerHTML = ""; 
                        content.innerHTML = content.innerHTML + data;
						
                    }
                }
            );

        }

		// function to confirm user action before deleting
		function confirm_delete(taskid){
		
			$("#deleteModal").modal('show')
			$("#delete").click(function(){
				delete_task(taskid);
			});
			
		}

		// function to confirm user action before deleting all task
		function confirm_delete_all_task(){

			$("#deleteAllModal").modal('show');
			
			$("#delete-all").click(function(){
				$("#deleteAllModal").hide();
				delete_task_all();
			});
			
		}
		
		// for deleting a specific task
		function delete_task(taskid){
			
				var userid = document.getElementById("user").value;
				//var taskid = document.getElementById("taskid").value;
				
				$.ajax(
					{
						url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&taskid="+taskid+"&delete_one=1",

						method: "DELETE",

						

						success: function(data){

							if(data == "Deleted"){
								alert(data);
								location.replace("http://localhost/todo/todo/dashboard/dashboard.php");
							}
								
							else{
								alert(data);
								
							}

						}
					}
				);

		}

		// function for deleting all user tasks
		function delete_task_all(){
		
				console.log("fired now");
				var userid = document.getElementById("user").value;
				//var taskid = document.getElementById("taskid").value;
				
				$.ajax(
					{
						url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&delete_all=1",

						method: "DELETE",

						

						success: function(data){

							if(data == "All Deleted"){
								alert(data);
								location.replace("http://localhost/todo/todo/dashboard/dashboard.php");
							}
								
							else{
								alert(data);
								
							}

						}
					}
				);

		}


		//  function to fetch a task
        function fetch_one(taskid){
			var userid = document.getElementById("user").value;
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&fetch-one&taskid="+taskid,
					
                    method: "GET",

                    success: function(data){
						if(data != 0){
							var append = document.getElementById("append"); 
							append.innerHTML = ""; 
                        append.innerHTML = append.innerHTML + data;
						setTimeout(() => {  $("#editModal").modal('show'); }, 100);
							
						}
						else{
							$("#editModal").hide();
						}
                       
                    }
                }
            );

        }

		//  function to get task details
        function get_task_details(taskid){
			var userid = document.getElementById("user").value;
            $.ajax(
                {
                    url: "http://localhost/todo/todo/backend/api/ajax.php?userid="+userid+"&task-details&taskid="+taskid,
					
                    method: "GET",

                    success: function(data){
						if(data != 0){
							console.log(data);
							var append = document.getElementById("task-details"); 
							append.innerHTML = ""; 
                        append.innerHTML = append.innerHTML + data;
						setTimeout(() => {  $("#showTaskModal").modal('show'); }, 100);
						

						}
						else{
							$("#showTaskModal").hide();
						}
                       
                    }
                }
            );

        }

		 // function updating tasks
		 function fire(){
			console.log("I am fired");
			$("#editModal").hide();
            var title = $("#task_title").val();
            var description = $("#task_description").val();
            var userid = $("#task_userid").val();
            var status = $("#task_status").val();
            var date = $("#created_date").val();
            var taskid = $("#task_id").val();
			// send ajax request
            
            $.ajax({
                url: "http://localhost/todo/todo/backend/api/ajax.php",

                method: "POST",

                data: {
                    edit: 1,
                    title: title,
                    description: description,
                    userid: userid,
                    status: status,
                    date: date,
                    taskid: taskid
                },

                success: function(data){

                    if(data == "Updated"){
                        alert(data);
                        location.replace("http://localhost/todo/todo/dashboard/dashboard.php");
                    }
                        
                    else{
                        alert(data);
                        $("#editModal").modal('show');
                        $("#task_title").html(title);
                        $("#task_description").html(description);
                        $("#task_status").html(status);
                        $("#task_userid").html(userid);
                        $("#task_id").html(taskid);
                        $("#created_date").html(date);
                  
                    }

                }
            });

		}

    </script>	
</body>
</html>