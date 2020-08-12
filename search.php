<!DOCTYPE html>
<?php include 'db.php';

if(isset($_POST['search'])){

	$name = htmlspecialchars($_POST['search']);
	$sql = "select * from tasks where name like '%$name%'";
	$rows = $db -> query($sql);
}

?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>To-Do List App</title>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-top: 70px;">
			<div class="col-md-10 col-md-offset-1">
				<center><h1>To-do List</h1></center>
				<table class="table table-hover">
					<button type="button" class="btn btn-success" data-target = "#myModal" data-toggle = "modal" style="margin-bottom: 10px;">Add Task</button>
					<button type="button" class="btn btn-success" style="margin-left: 10px; margin-bottom: 10px;" onclick="print()">Print</button>
					<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header" >
				      	<h4 class="modal-title">Add Task</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>
				      <div class="modal-body">
				        <form method="post" action="add.php">
				        	<div class="form-group">
				        		<label>Task Name</label>
				        		<input type="text" required name="task" class="form-control">
				        	</div>
				        	<input type="submit" name="send" value="Add Task" class="btn btn-success">
				        </form>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>
				<div class="col-md-12 text-center">
					<p>Search</p>
					<form action="search.php" method="post" class="form-group">
						<input type="text" placeholder="Search" name="search" class="form-control">
					</form>
				</div>
				<?php if(mysqli_num_rows($rows) < 1): ?>
					<h2 class="text-danger text-center">Nothing found</h2>
					<a href="index.php" class="btn btn-warning">Back</a>

				<?php else: ?>	
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Task</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				    <?php while($row = $rows->fetch_assoc()): ?>
				      <th><?php echo $row['id'] ?></th>
				      <td class="col-md-10"><?php echo $row['name'] ?></td>
				      <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
				      <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
				    </tr>
				    <?php endwhile; ?>	
				  </tbody>
				 </table> 
				  <?php endif; ?>
           		
			</div>
		</div>
	</div>
</body>
</html>