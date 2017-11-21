<?php 
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	if(isset($_POST["title"])){
		$title = $_POST["title"];
		$label = $_POST["label"];
		$bid = $_POST["bid"];
		$uid = $_POST["uid"];
		$content = $_POST["content"];
		$id = MySQL_insert("topics","title,label,bid,uid,content","\"$title\",\"$label\",$bid,$uid,\"$content\"");
		if($id){
			MySQL_createtable(' topics_'.$id.' (aid smallint(5) unsigned NOT NULL AUTO_INCREMENT,replyto smallint(5) unsigned NOT NULL ,uid smallint(5) unsigned DEFAULT NULL,createtime datetime DEFAULT CURRENT_TIMESTAMP,content mediumtext,PRIMARY KEY (aid));');
			echo "发表成功";
		}else{
			echo "发表失败1";
		}
	}else{
		echo "发表失败2";
	}
?>