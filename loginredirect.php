<?php

{
session_start();

	require_once 'include/DB_Connect.php' ;
	
	/*********DB Connection************/
	$db=new DB_Connect();
	$con=$db->connect();


/**********Session variables************/
	$username=$_SESSION['username'];
	$uniqueid=$_SESSION['uniqueid'];

/************Result variables************/
	$unique_id_result="";
	$verified_status="";


/*****************Hitting databse*********************/
	$check_query="select unique_id,verified from user where username='$username'";
	
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
				echo "success12";
			}


		else{
			/***********************Device is not same*******************/
			echo "another device";
			}
	}

	else{
		/***************************Device login first time so update its id in db***************/
		$newlogin="update user set verified= 1,unique_id='$uniqueid' where username='$username'";
		echo "ddd";
		$res=mysqli_query($con,$newlogin);
		echo json_encode($res);
		echo "wedwd";

	}


}

?>