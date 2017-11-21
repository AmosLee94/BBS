<?php
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	header("Content-Type:text/html;charset=utf-8");
	if (isset($_GET["username"])&&isset($_GET["password"])) {
		$username = addslashes($_GET['username']);
		$password = $_GET['password'];
		if(!getUserIdByName($username)){
			echo register($username,$password);
		}else
		echo false;
	}
?>