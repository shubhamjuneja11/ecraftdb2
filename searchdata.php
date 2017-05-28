<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'include/DB_Connect.php';
$db=new DB_Connect();
$con=$db->connect();
//$arr=array();


if(isset($_POST['query'])){
	$q=$_POST['query'];
	//echo "$q";
	
echo $q;
	$query="select name,sku,cp,mrp,images from products where sku like '%{$q}%' or name like '%{$q}%'" ;
	echo $query;
	$res=mysqli_query($con,$query);

	/*$res=array_map(function($r) {
  $r['text'] = utf8_encode($r['text']);
  return $r;
}, $res);*/

	/*$res=utf8_encode($res);*/
	$arr["products"]=array();
	echo "3";
	$i=0;
	while($row=mysqli_fetch_assoc($res)){

		echo json_encode($row);
		$product=array();
		$product['name']=$row['name'];
		$product['sku']=$row['sku'];
		$product['cp']=$row['cp'];
		$product['mrp']=$row['mrp'];
		$product['images']=$row['images'];

		
		array_push($arr["products"],$product);

		}
	echo json_encode($arr);



}//echo mysql_error($con);

else echo "fdf";
?>