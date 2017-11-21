<?php	
	@session_start();
	//setcookie('PHPSESSID',"",time()-1);
	setcookie("UserInfo","",time()-1,"/");
	setcookie(session_name(),"",time()-1,"/");
	session_destroy();
?>