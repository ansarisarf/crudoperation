<!-- http://localhost/geecon/crudapp/config/config.php -->
<?php
$connection=mysqli_connect("localhost","root","");  //Establishing coonection with db
$selected_db=mysqli_select_db($connection,"phpcrud2"); //Selecting with the Db

/*if($connection){
	echo "heloo world";
}else{
	echo "ja mrja";
}
?>*/