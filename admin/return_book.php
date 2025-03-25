<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Return Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
   	<script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
   	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></span></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="#">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Change Password</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>

	<center><h4>Return Book</h4><br></center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">
				<div class="form-group">
					<label for="book_no">Book Number:</label>
					<input type="text" name="book_no" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="student_id">Student ID:</label>
					<input type="text" name="student_id" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="return_date">Return Date:</label>
					<input type="text" name="return_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
				</div>
				<button type="submit" name="return_book" class="btn btn-primary">Return Book</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

<?php
	// if(isset($_POST['return_book']))
	// {
	// 	$connection = mysqli_connect("localhost","root","");
	// 	$db = mysqli_select_db($connection,"lms");
	// 	$query = "DELETE FROM issued_books WHERE book_no=$_POST[book_no] AND student_id=$_POST[student_id]";
	// 	$query_run = mysqli_query($connection,$query);
	// 	if($query_run){
	// 		echo "<script>alert('Book returned successfully!'); window.location.href='admin_dashboard.php';</script>";
	// 	} else {
	// 		echo "<script>alert('Error returning book.');</script>";
	// 	}
    // }
    if(isset($_POST['return_book']))
{
    $connection = mysqli_connect("localhost", "root", "", "lms");

    // Sanitize input to prevent SQL injection
    $book_no = mysqli_real_escape_string($connection, $_POST['book_no']);
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);

    // Use quotes for values in SQL query
    $query = "DELETE FROM issued_books WHERE book_no='$book_no' AND student_id='$student_id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<script>alert('Book returned successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error returning book.');</script>";
    }
}

?>

