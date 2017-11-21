<?php
	require_once "../../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	@session_start();
	if(!isset($_SESSION['permission'])||$_SESSION['permission']<9){
		echo false;
	}else{
		if(isset($_POST['lid'])){
			MySQL_delete("boardlists","where id = ".$_POST['lid']);
		}
	}
?>