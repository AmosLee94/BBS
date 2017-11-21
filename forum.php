<?php 
	// ini_set("display_errors", "On");
	// error_reporting(E_ALL | E_STRICT);
 ?>
<?php
	require_once "source/library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>万书山</title>
	<meta charset="utf-8">
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" sizes="96x96" href="img/logo-96.png">
	<link rel="stylesheet" type="text/css" href="./css/default.css">
	<script src="./source/javascript/ajax.js" type="text/javascript"></script>
	<script src="./source/javascript/cookie.js" type="text/javascript"></script>
	<script src="./css/javascript/changeWidth.js" type="text/javascript"></script>
</head>
<body>
	<?php include_once($RootPath.'/source/interface/header.php');?>
	<?php include_once($RootPath.'/source/interface/nav.php');?>
	<?php
		$modArr = array('module','home','admin','topic','post','register','boardlists','board','info'
			);
		$mod = 'home';
		if (isset($_GET["mod"])&&in_array($_GET["mod"],$modArr)){
			$mod=$_GET["mod"];
		}
		include($RootPath.'/'.$mod.'.php');
	?>
	<?php include_once($RootPath.'/source/interface/footer.php');?>
	<script src="./source/javascript/necessary_after.js" type="text/javascript"></script>
</body>
</html>
