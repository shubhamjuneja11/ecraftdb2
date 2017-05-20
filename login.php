<?php
if(isset($_POST['username']) && isset($_POST['password']))
{
	require_once 'include/DB_Connect.php' ;
	
	
	$db=new DB_Connect();
	$con=$db->connect();
	
	$user_table='user';
	
	$username=$_POST['username'];
	
	$password=$_POST['password'];

	echo $username.$password;
	$query="select * from user_records where  password = '$password' and username = '$username' ";

	$res=mysqli_query($con,$query);
	
	
	if(mysqli_num_rows($res)>0){
		echo 'success';
	}
	else echo 'no';
}

?>