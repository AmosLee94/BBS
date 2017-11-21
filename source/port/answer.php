<?php 
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	if(isset($_POST["tid"])){
		$tid = $_POST["tid"];
		$label = $_POST["label"];
		$uid = $_POST["uid"];
		$fid = $_POST["fid"];
		$content = $_POST["content"];
		if(MySQL_insert("topics","title,label,uid,uid,content","\"$title\",\"$label\",$bid,$uid,\"$content\"")){
			echo "发表成功";
		}else{
			echo "发表失败1";
		}
	}else{
		echo "发表失败2";
	}
?>