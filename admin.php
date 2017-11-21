<?php 
	$funArr = array('home','banPost','board'
		);
	$fun = 'home';
	if (isset($_GET["fun"])&&in_array($_GET["fun"],$funArr)){
		$fun=$_GET["fun"];
	}
	include($RootPath.'/source/interface/admin/admin_'.$fun.'.php');
?>
