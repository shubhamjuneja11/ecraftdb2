<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'include/DB_Connect.php';

  /*********DB Connection************/
    $db=new DB_Connect();
    $con=$db->connect();


  	$username=$_POST['username'];
  	$unique_id=$_POST['uniqueid'];
  	$offset=$_POST['count'];
	$offset=$offset*20;
	$limit=$offset+20;
	

  	$query="select access_role from user where username = '$username' and unique_id= '$unique_id' limit $limit offset $offset";
  
  	$res=mysqli_query($con,$query) or die(mysqli_error($con));
  

  	if(mysqli_num_rows($res)>0) {
  		//user exist, now get its role
  		$row=mysqli_fetch_array($res);
  		$access_role=$row[0];

  	//now get data according to its role

  	$query="select sku,name,cp,sp,images from products limit $limit offset $offset";
  	$res=mysqli_query($con,$query) or die(mysql_error());

  	$response["products"]=array();
  	$response["success"]=1;
  	if(mysqli_num_rows($res)>0){
  		while($row=mysqli_fetch_array($res)){
  	
  			$product=array();
  			$product['sku']=$row[0];
  			$product['name']=$row[1];
  			$product['cp']=$row[2];
  			$product['sp']=$row[3];
  			$product['images']=$row[4];

  			array_push($response['products'],$product);
  			
  		}
  	}
  		else $response["success"]=0;
  	}
  	
  
  	//
	
	else 	$response["success"]=-1;
	echo json_encode($response);

?>