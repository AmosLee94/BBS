<?php 
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	if(isset($_POST["uid"])){
		$tid = $_POST["tid"];
		$replyto = $_POST["replyto"];
		$uid = $_POST["uid"];
		$content = $_POST["content"];
		$id = MySQL_insert2("topics_".$tid,"replyto,uid,content","$replyto,$uid,\"$content\"");
		if($id){
			echo "发表成功";
		}else{
			echo "发表失败1";
		}
	}else{
		echo "发表失败2";
	}
?>