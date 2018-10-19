<?php include("config/config.php");?> 
<?php 
	if(isset($_POST['submit'])){
		$fullname=mysqli_real_escape_string($connection,trim($_POST['fullname']));
		$username=mysqli_real_escape_string($connection,trim($_POST['username']));
		$email=mysqli_real_escape_string($connection,trim($_POST['email']));
		$password=mysqli_real_escape_string($connection,trim($_POST['password']));
		$fullname_valid = $username_valid = $email_valid = $password_valid= false;

//Check full name vlidation start here
		if(!empty($fullname)){
			if(strlen($fullname)>3 && strlen($fullname) <=20){
				if(!preg_match('/[^a-zA-Z\s]/', $fullname)){

					//ALL TEST PASSED!!
					$fullname_valid=true;
					/*echo "FULLL NAME IS OK!! <br>";*/
				}else{ echo "fullname contain only aplphbates <br>";/*INvalid cahractes*/}
			}else{echo "fullname must be between 3 to 20 char long <br>";/*Invalid length*/}
		}else{echo "fullname can not be blank!!<br>";/*Blank input*/}
//Check full name vlidation end here

//Check username vlidation start here
		if(!empty($username)){
			if(strlen($username)>4 && strlen($username) <=10){
				if(!preg_match('/[^a-zA-Z\d_.]/', $username)){

					//ALL TEST PASSED!!
					$username_valid=true;
					/*echo "USER NAME IS OK!! <br>";*/
				}else{ echo "username contain only aplphbates,digits,underscore and dot symbol <br>";/*INvalid username*/}
			}else{echo "username must be between 4 to 10 char long <br>";/*Invalid length*/}
		}else{echo "username can not be blank!!<br>";/*Blank input*/}
//Check username vlidation end here

//Check email vlidation start here
		if(!empty($email)){
			if(filter_var($email,FILTER_VALIDATE_EMAIL)){

				//ALL TEST PASSED!!
				$email_valid=true;
				/*echo "EMAIL IS OK!! <br>";*/
			}else{echo $email."is an invalid Eamil Addresss <br>";/*Invalid email*/}
		}else{echo "email can not be blank!!<br>";/*Blank input*/}
//Check email vlidation end here

//Check password vlidation start here
		if(!empty($password)){
			if(strlen($password)>=5 && strlen($password) <=15){
				//ALL TEST PASSED!!
				$password_valid=true;
				/*echo "PASSWORD IS OK!! <br>";*/
			}else{echo $password. "=password must be between 5 to 15 charcters long <br>";/*Invalid length*/}
		}else{echo "password can not be blank!!<br>";/*Blank input*/}
//Check password vlidation end here

//Inserting Query Operation Start here
		if($fullname_valid && $username_valid && $email_valid && $password_valid){
			$Sql_Query="INSERT INTO users(fullname,username,email,password)
			VALUES('$fullname','$username','$email','$password')";
			$Execute_Query=mysqli_query($connection,$Sql_Query); //Executing the SQL Query with the help of mysqli_query method
			if($Execute_Query){
				echo "data submitted sucessfully to the database";
			 }
		} 
//Inserting Query Operation End here
	}
?>

<!-- DELETE THE DATA FROM THE DATA BASE START HERE -->
<?php 
	if(isset($_GET['del'])){
		/*echo "its is set"; agr delete ki value set hai to query fire kregey*/
		$id=$_GET['del'];
		/*echo "$id";*/
		$Sql_Query="DELETE FROM users WHERE id=$id";
		$execute_sql_query=mysqli_query($connection,$Sql_Query);
		if($execute_sql_query) echo "data deleted sucessfully";
	}
?>
<!-- DELETE THE DATA FROM THE DATA BASE END HERE -->
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
				<div class="col-lg-8">
					<h3>user data</h3>
					<hr><!-- Display/Read the data from data base -->
					<table class="table table-dark table-striped table-hover">
						<thead>
		      				<tr>
		        			<th>Fullname</th>
		       				<th>Username</th>
		        			<th>Email</th>
		        			<!-- <th>Password</th> -->
		      				</tr>
		    			</thead>
		    			<tbody>
						<?php 
                        	$sql_query_read_data="SELECT * FROM users";
                        	$execute_sql_query=mysqli_query($connection,$sql_query_read_data);
                        	/*if($execute_sql_query) echo "got the data from database";*/
                        	/*echo mysqli_num_rows($execute_sql_query);*//*To know how many rows data we have*/
                        	if(mysqli_num_rows($execute_sql_query)>0){
                        		/*$users_data=mysqli_fetch_assoc($execute_sql_query);*/
                        		/*echo $users_data['fullname']; it will echo the username 'fullname' is column of databse sarfraz Qaazi*/
                        		while($users_data=mysqli_fetch_assoc($execute_sql_query)){?>
                        			<!-- /*echo $users_data['fullname']." ".$users_data['username']." ".$users_data['email']." ".$users_data['password']."<br>";*/ -->
                        			<tr>
                        				<td><?php echo $users_data['fullname'] ?></td>
                        				<td><?php echo $users_data['username'] ?></td>
                        				<td><?php echo $users_data['email'] ?></td>
                        				<!-- <td><?php echo $users_data['password'] ?></td> -->
                        				<td>
        <a class="btn btn-sm btn-danger" href="<?php $_SERVER['PHP_SELF']?> ?del=<?php echo $users_data['id']; ?>">DELETE</a>
                        				</td><!-- DELETE OPERATION WILL START FROM HERE  -->
                        				<td>
        <a class="btn btn-sm btn-info" href="update.php?upd=<?php echo $users_data['id'] ?>">UPDATE</a>
                        				</td>
                        			</tr>
                        			<?php
                        		}
                        	}
						?>
						</tbody>
					</table>						
				</div>
				<!-- Show Data end here -->
				<div class="col-lg-4">
					<h3>Signup</h3>
					<hr>
					<form name="signup" action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="p-sm-5 mx-auto mt-sm-5 rounded" style="border: 1px solid grey; box-shadow: 0 3px 7px 0 rgba(0,0,0,.35);">
						<div class="form-group">
							<!-- <span><?php echo $msg?></span> -->
							<label for="#fullname">First Name</label>
							<input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname">
						</div>
						<div class="form-group">
							<label for="#username">User Name</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="username">
						</div>
						<div class="form-group">
							<label for="#email">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="email">
						</div>
						<div class="form-group">
							<label for="#password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn mt-2 btn-info" name="submit">Sign Up</button>
						</div>
					</form>
				</div>
		</div>
	</div>
</body>
</html>