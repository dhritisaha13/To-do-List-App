<!DOCTYPE html>
<?php include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <=50 ? (int)$_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "select * from tasks limit ".$start." , ".$perPage." ";

$total = $db -> query("select * from tasks") -> num_rows;
$pages = ceil($total / $perPage);

$rows = $db -> query($sql);

?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>To-Do List App</title>
</head>
<body style="background-image: linear-gradient(pink, white);height: 680px;">
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
           			<ul class="pagination" style="padding-left: 350px;">
           				<h3>Pages : </h3>
           			<?php for($i = 1; $i <= $pages; $i++): ?>
           				<li><a href="?page=<?php echo $i; ?>&perPage=<?php echo $perPage; ?>"><?php echo "<h3>&nbsp;$i &nbsp;&nbsp;</h3>"; ?></a></li>
           			<?php endfor; ?>
           			</ul>
			</div>
		</div>
	</div>
</body>
</html>