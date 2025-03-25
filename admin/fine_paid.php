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
				<div class="form-group">
					<label for="fine">Fine (if any):</label>
					<input type="text" name="fine" class="form-control">
				</div>
				<div class="form-group">
					<label for="fine_paid">Fine Paid:</label>
					<input type="checkbox" name="fine_paid" value="1">
				</div>
				<div class="form-group">
					<label for="remarks">Remarks:</label>
					<textarea name="remarks" class="form-control"></textarea>
				</div>
				<button type="submit" name="return_book" class="btn btn-primary">Return Book</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['return_book']))
	{
		$connection = mysqli_connect("localhost","root","", "lms");
		
		$book_no = $_POST['book_no'];
		$student_id = $_POST['student_id'];
		$return_date = $_POST['return_date'];
		$fine = $_POST['fine'] ?? 0;
		$fine_paid = isset($_POST['fine_paid']) ? 1 : 0;
		$remarks = $_POST['remarks'] ?? '';
		
		if ($fine > 0 && !$fine_paid) {
			echo "<script>alert('Please confirm the fine has been paid before returning the book.');</script>";
		} else {
			$query = "DELETE FROM issued_books WHERE book_no='$book_no' AND student_id='$student_id'";
			$query_run = mysqli_query($connection, $query);
			if($query_run){
				$query_insert = "INSERT INTO returned_books (book_no, student_id, return_date, fine, fine_paid, remarks) VALUES ('$book_no', '$student_id', '$return_date', '$fine', '$fine_paid', '$remarks')";
				mysqli_query($connection, $query_insert);
				echo "<script>alert('Book returned successfully!'); window.location.href='admin_dashboard.php';</script>";
			} else {
				echo "<script>alert('Error returning book.');</script>";
			}
		}
	}
?>
