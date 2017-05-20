<?php
class DB_Connect{
	private $con;

	function __construct(){
		require_once 'Config.php';

		$this->con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
		
	}
	public function connect(){

		return $this->con;
	}
}
?>