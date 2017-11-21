<?php 
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	if(isset($_GET['userId'])){
		echo getUserNameById($_GET['userId']);
	}

?>