<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'include/DB_Connect.php';

  /*********DB Connection************/
    $db=new DB_Connect();
    $con=$db->connect();

if(isset($_POST['username'])&&isset($_POST['uniqueid'])){
	$username=$_POST['username'];
	$unique_id=$_POST['uniqueid'];
	$sku=$_POST['sku'];
$query="select access_role from user_records where username= $username and unique_id=$unique_id";

$res=mysqli_query($con,$query);

if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_row($res);
	$access_role=$row["access_role"];

	$query="select * from product where sku=$sku";

	$res=mysqli_carry($con,$query);
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_array($res);
		
	

	/***********************Now give access according toaccess role************************/

	$reponse["detail"]=array();


		$product=array();
		$product[0]=$row[1];	//sku
		$product[1]=$row[0];	//msku
		$product[2]=$row[10];	//images
		$product[3]=$row[4];		//name



	if(strcmp($access_role,"admin")){
		$product[4]=$product[2];	//primary_category
		$product[5]=$product[3];			//category
		$product[6]=$product[5];					//cp
		$product[7]=$product[6];				//mrp
		$product[8]=$product[7];					//sp
		$product[9]=$product[8];			//material
		$product[10]=$product[9];				//color
		$product[11]=$product[10];				//size
		$product[12]=$product[14];			//inventoy
		$product[13]=$product[15];	//inventory_type


		$reponse["editable_access"]="11111111111111";

	}
	else if(strcmp($access_role, "owner")){
		$product[4]=$product[2];	//primary_category
		$product[5]=$product[3];			//category
		$product[6]=$product[5];					//cp
		$product[7]=$product[6];				//mrp
		$product[8]=$product[7];					//sp
		$product[9]=$product[8];			//material
		$product[10]=$product[9];				//color
		$product[11]=$product[10];				//size
		$product[12]=$product[14];			//inventoy
		$product[13]=$product[15];	//inventory_type


		$reponse["editable_access"]="00111111111111";
	}
	else if(strcmp($access_role, "manager")){
		$product[4]=$product[2];	//primary_category
		$product[5]=$product[3];			//category
		$product[6]=$product[5];					//cp
		$product[7]=$product[6];				//mrp
		$product[8]=$product[7];					//sp
		$product[9]=$product[8];			//material
		$product[10]=$product[9];				//color
		$product[11]=$product[10];				//size
		$product[12]=$product[14];			//inventoy
		$product[13]=$product[15];	//inventory_type


		$reponse["editable_access"]="00000000000111";
		
	}
	else if(strcmp($access_role, "merchant")){

		$reponse["editable_access"]="0000";
	}
	else if(strcmp($access_role, "employee")){
		$product[4]=$product[2];	//primary_category
		$product[5]=$product[3];			//category
		$product[6]=$product[6];				//mrp
		$product[7]=$product[7];					//sp
		$product[8]=$product[8];			//material
		$product[9]=$product[9];				//color
		$product[10]=$product[10];				//size
		$product[11]=$product[14];			//inventoy
		$product[12]=$product[15];	//inventory_type

		$reponse["editable_access"]="0000000000000";
	}
}

}
}
?>