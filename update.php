<!-- http://localhost/geecon/crudapp/index.php -->
<?php include("config/config.php");?> 
<!-- <?php 
	if(isset($_POST['submit'])){
		$fullname=$_POST['fullname'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		/*$password=md5($_POST['password']);*/
		$Sql_Query="INSERT INTO users(fullname,username,email,password)
					VALUES('$fullname','$username','$email','$password')";
		$Execute_Query=mysqli_query($connection,$Sql_Query); //Executing the SQL Query with the help of mysqli_query method
		if($Execute_Query){
			echo "data submitted sucessfully to the database";
		}
	}
?>

<!-- DELETE THE DATA FROM THE DATA BASE START HERE -->
<!-- <?php 
	if(isset($_GET['del'])){
		/*echo "its is set"; agr delete ki value set hai to query fire kregey*/
		$id=$_GET['del'];
		/*echo "$id";*/
		$Sql_Query="DELETE FROM users WHERE id=$id";
		$execute_sql_query=mysqli_query($connection,$Sql_Query);
		if($execute_sql_query) echo "data deleted sucessfully";
	}
?>
 --> <!-- DELETE THE DATA FROM THE DATA BASE END HERE -->

<!-- UPDATE THE DATA FROM DATA BASE -->
<?php 
	if(isset($_GET['upd'])){
		$id=$_GET['upd'];
		$Sql_Query="SELECT * FROM users WHERE id=$id";
		$execute_sql_query=mysqli_query($connection,$Sql_Query);
		/*if($execute_sql_query) echo "we got the data";*/
		$user_value=mysqli_fetch_assoc($execute_sql_query);

	}
?>

<!--MAIN UPDATE OPERATION IS DONE HERE  -->
<?php
	if(isset($_POST['btnupdate'])){
		$fullname=$_POST['fullname'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];

		$Sql_Query="UPDATE users 
		SET fullname='$fullname',username='$username',email='$email',password='$password'
		WHERE id=$id";
		$execute_sql_query=mysqli_query($connection,$Sql_Query);
		if($execute_sql_query) 
		echo "Data updated sucessfully";
		header('location:index.php');
	}
?>
<!-- UPDATE THE DATA FROM DATA BASE END HERE-->
<!DOCTYPE html>
<html>
<head>
	<title>crud operation</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
				<!--6 Display Data form database Start here --> 
				<!-- SHOW daTA CODE IS HERE -->
				<!-- Show Data end here -->
				<div class="col-lg-4">
					<h3>UPDATE</h3>
					<hr>
					<form name="signup" action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="p-sm-5 mx-auto mt-sm-5 rounded" style="border: 1px solid grey; box-shadow: 0 3px 7px 0 rgba(0,0,0,.35);">
						<div class="form-group">
							<label for="#fullname">First Name</label>
							<input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname" 
							value="<?php echo $user_value['fullname'] ?>">
						</div>
						<div class="form-group">
							<label for="#username">User Name</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="username"
							value="<?php echo $user_value['username'] ?>">
						</div>
						<div class="form-group">
							<label for="#email">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="email"
							value="<?php echo $user_value['email'] ?>">
						</div>
						<div class="form-group">
							<label for="#password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="password"
							value="<?php echo $user_value['password'] ?>">
						</div>
						<div class="form-group">
							<button type="submit" class="btn mt-2 btn-info" name="btnupdate">UPDATE</button>
						</div>
					</form>
				</div>
		</div>
	</div>
</body>
</html>