<?php
session_start();

	require_once 'include/DB_Connect.php' ;
	
	/*********DB Connection************/
	$db=new DB_Connect();
	$con=$db->connect();
	//echo "aloo=   ".$aloo;

/**********Session variables************/
	$username=$_SESSION['username'];
	$uniqueid=$_SESSION['uniqueid'];
	$access_role=$_SESSION['access_role'];

	//echo "abbbb".$_SESSION['username'];
/************Result variables************/
	$unique_id_result="";
	$verified_status="";

/*****************Hitting databse*********************/
	$check_query="select unique_id,verified,access_role from user where username='$username'";
	
	$verified=mysqli_query($con,$check_query);

	if(mysqli_num_rows($verified)>0)
	{
		$row=$verified->fetch_assoc();

		$uniqueid_result=$row['unique_id'];
		$verified_status=$row['verified'];
		

		
	}
	

	/**********************checking login status****************/

	if($verified_status==1){
		if($uniqueid==$uniqueid_result){

			/*************************Device is same********************/
			
				$res["success"]=1;
			}


		else{
			/***********************Device is not same*******************/
			$res["success"]=-1;
			}
	}

	else{
		/***************************Device login first time so update its id in db***************/
		$newlogin="insert into user(username,unique_id,verified,access_role) values('$username','$uniqueid','1','$access_role')";
		$res=mysqli_query($con,$newlogin) or die(mysqli_error($con));
		$res["success"]=1;
		
	

	}

echo json_encode($res);


?>