<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





if(isset($_POST['username']) && isset($_POST['password'])&&isset($_POST['uniqueid']))
{
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
		$_SESSION['username']=$username;
		$_SESSION['uniqueid']=$uniqueid;
		
		$row=mysqli_fetch_array($res);

		$_SESSION['access_role']=$row[2];
		
		header("Location:loginredirect.php");
		//header("http://localhost/ecraftindia/loginredirect.php");
		
		exit();
		//$response=array("error"=>true);
		/*$response=$uniqueid;
		echo json_encode($response);*/
		
	}
	else echo 'no';
}
else{
 if(!isset($_POST['username'])) echo "user";
  if(!isset($_POST['password'])) echo "pass";
   if(!isset($_POST['uniqueid'])) echo "uniq";
}
?>