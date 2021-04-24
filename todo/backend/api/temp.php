<?php

/*
    <!-- Modal -->
				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Task</h4>
						</div>
						<div class="modal-body">
							
							<form id="edit-task" onsubmit="return false" autocomplete="off" >
								<fieldset>
									<div class="form-group">
                                        <label>Title</label>
										<input class="form-control" placeholder="Title" id="task_title" name="task_title" required type="text" value="<?php echo $item['title']?>">
										
									</div>
		
									<div class="form-group">
                                    <label>Description</label>
										<input class="form-control" placeholder="Description" id="task_description" name="task_description" type="text" required value="<?php echo $item['description']?>">
										
									</div>

                                    <div class="form-group">
                                    <label>Status</label>
										<input class="form-control" id="task_status" name="task_status" type="text" required value="<?php echo $item['status']?>">
										
									</div>
		
									<div class="form-group">
										<input class="form-control" name="task_userid" id="task_userid" type="hidden" value="<?php echo $_SESSION["userid"] ?>">
                                        <input class="form-control" name="date_created" id="created_date" type="hidden" value="<?php echo $item["created_date"] ?>">
                                        <input class="form-control" name="task_id" id="task_id" type="hidden" value="<?php echo $item["taskid"] ?>">
                                        
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