<?php include 'PHPExcel/Classes/PHPExcel/IOFactory.php';


require_once 'include/DB_Connect.php' ;
    
    /*********DB Connection************/
    $db=new DB_Connect();
    $con=$db->connect();



$inputFileName = 'Mobile App Data.ods';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
   }

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
//$query="insert into products (mastersku,category,name,sp,color) values";
//  Loop through each row of the worksheet in turn
try{
for ($row = 2; $row <=$highestRow ;$row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);


 
    
    foreach ($rowData as $val) {
        # code...
    
    {
        

            $mastersku=$val[1];
            $sku=$val[2];
            $primary_category=$val[3];
            $category=$val[4];
            $name=$val[5];
            $cp=$val[6];
            $mrp=$val[7];
            $sp=$val[8];
            $material=$val[9];
            $color=$val[10];
            $images=$val[11];
            $access_role=$val[12];
            $specific_access=$val[13];
            $last_access_time=$val[14];
            $last_access_by=$val[15];
            $updated_by=$val[16];
            $updated_ts=$val[17];
            $created_by=$val[18];
            $created_ts=$val[19];
            $size=$val[20];
            $inventory=$val[21];
            $inventory_type=$val[22];
            $status=$val[23];
           
//echo $specific_access;
 if(strcmp($status,"add")==0){
    echo "ok","<br>";
   $query=" insert into products (mastersku,sku,primary_category,category,name,cp,mrp,sp,material,color,images,size,access_role,specific_access,inventory,inventory_type,last_access_time,last_access_by,updated_by,updated_ts,created_by,created_ts) values('$mastersku','$sku','$primary_category','$category','$name','$cp','$mrp','$sp','$material','$color','$images','$size','$access_role','$specific_access','$inventory','$inventory_type','$last_access_time','$last_access_by','$updated_by','$updated_ts','$created_by','$created_ts') ";

   $res=mysqli_query($con,$query) ;
  echo json_encode(mysqli_error($con));
}
else if(strcmp($status,"update")==0){
$query="update products set mastersku='$mastersku',primary_category='$primary_category',category='$category',name='$name',cp='$cp',mrp='$mrp',sp='$sp',material='$material',color='$color',images='$images',size='$size',access_role='$access_role',specific_access='$specific_access',inventory='$inventory',inventory_type='$inventory_type',last_access_time='$last_access_time',last_access_by='$last_access_by',updated_by='$updated_by',updated_ts='$updated_ts',created_by='$created_by',created_ts='$created_ts' where sku='$sku'";
   
    $res=mysqli_query($con,$query) ;
  echo json_encode(mysqli_error($con));
}
        
    


        }   
        }


}

}
catch(Exception $e){echo $e->getMessage();}


?>