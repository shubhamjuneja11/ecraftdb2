<?php
if(isset($_POST['username']) && isset($_POST['password'])&&isset($_POST['uniqueid']))
{session_start();
	require_once 'include/DB_Connect.php' ;
	
	
	$db=new DB_Connect();
	$con=$db->connect();
	
	$user_table='user_records';
	
	$username=$_POST['username'];
	
	$password=$_POST['password'];

	$uniqueid=$_POST['uniqueid'];

	$query="select * from user_records where  password = '$password' and username = '$username' ";

	$res=mysqli_query($con,$query);
	
	
	if(mysqli_num_rows($res)>0){
		
		//echo 'success';
	/*	$_SESSION['username']=$username;
		$_SESSION['uniqueid']=$uniqueid;
		header("Location:loginredirect.php");

		exit();*/
		$response=array("error"=>true);
		echo json_encode($response);
		
	}
	else echo 'no';
}
else{
 if(!isset($_POST['username'])) echo "user";
  if(!isset($_POST['password'])) echo "pass";
   if(!isset($_POST['uniqueid'])) echo "uniq";
}
?>