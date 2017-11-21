<?php
define("SQLservername",'localhost');
define("SQLusername",'root');
define("SQLpassword",'SmileSmile1125');
define("SQLdbname",'bbs');
header("Content-Type:text/html;charset=utf-8");
function connectMySQL(){
	$MySQL_connet = new mysqli(constant("SQLservername"), constant("SQLusername"), constant("SQLpassword"), constant("SQLdbname"));
	if ($MySQL_connet->connect_error) {  
		echo 'MySQL_connet_crror:'.$MySQL_connet->connect_error.'('.__FILE__.')';  
	}else{
		mysqli_query($MySQL_connet,"set names utf8"); 
		return $MySQL_connet;
	}
}
function MySQL_select($table_name){
	$column_name = "*";
	$condition = "";
	$args = func_get_args();
	if (isset($args[1]))
		$column_name = $args[1];	
	if (isset($args[2]))
		$condition = $args[2];
	$sql = "select $column_name from $table_name $condition";
	$MySQL_connet=connectMySQL();
	$result = mysqli_query($MySQL_connet,$sql);
	// if(!$result||$result->num_rows == 0) $result = false;
	if ($result) {
		$result=mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
	$MySQL_connet->close();
	return $result;
}
function MySQL_insert($table_name,$columns,$value){
	$MySQL_connet=connectMySQL();
	$sql = "INSERT INTO $table_name ($columns) VALUES ($value)";
	echo "[MySQL_insert]".$sql;
	mysqli_query($MySQL_connet,$sql);
	// $result = $MySQL_connet->query($sql);
	$result = mysqli_insert_id($MySQL_connet);
	$MySQL_connet->close();
	return $result;
}
function connectMySQL2(){
	$MySQL_connet = new mysqli(constant("SQLservername"), constant("SQLusername"), constant("SQLpassword"), "topics");
	if ($MySQL_connet->connect_error) {  
		echo 'MySQL_connet_crror:'.$MySQL_connet->connect_error.'('.__FILE__.')';  
	}else{
		mysqli_query($MySQL_connet,"set names utf8"); 
		return $MySQL_connet;
	}
}
function MySQL_insert2($table_name,$columns,$value){
	$MySQL_connet=connectMySQL2();
	$sql = "INSERT INTO $table_name ($columns) VALUES ($value)";
	echo "[MySQL_insert]".$sql;
	mysqli_query($MySQL_connet,$sql);
	// $result = $MySQL_connet->query($sql);
	$result = mysqli_insert_id($MySQL_connet);
	$MySQL_connet->close();
	return $result;
}

function MySQL_select2($table_name){
	$column_name = "*";
	$condition = "";
	$args = func_get_args();
	if (isset($args[1]))
		$column_name = $args[1];	
	if (isset($args[2]))
		$condition = $args[2];
	$sql = "select $column_name from $table_name $condition";
	echo "MySQL_select2";
	$MySQL_connet=connectMySQL2();
	$result = mysqli_query($MySQL_connet,$sql);
	// if(!$result||$result->num_rows == 0) $result = false;
	if ($result) {
		$result=mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
	$MySQL_connet->close();
	return $result;
}
function MySQL_createtable($table){ 
	$MySQL_connet=connectMySQL2();
	echo "CREATE TABLE $table";
	$sql = "CREATE TABLE $table";
	mysqli_query($MySQL_connet,$sql);
	$result = $MySQL_connet->query($sql);
	$MySQL_connet->close();
	return $result;
}
function MySQL_delete($table_name,$condition){
	$SQLtablename='username';
	$MySQL_connet=connectMySQL();
	$sql = "DELETE FROM $table_name $condition";
	$result =  $MySQL_connet->query($sql);
	$MySQL_connet->close();
	return $result;
}
function getUserIdByName($userName){
	return MySQL_select("users","id","where username =\"".addslashes($userName).'"')[0]['id'];
}	
function getUserNameById($userId){
	if (is_numeric($userId)) {
		return MySQL_select("users","username","where id =$userId")[0]['username'];
	}
}
function topic($tid){
	return MySQL_select("topics","*","where tid=".$tid)[0];
}
function reply($tid){
	return MySQL_select2("topic_".$tid,"*");
}
function readNav(){
	return MySQL_select("nav","*","order by weight");
}
function getBoardNameByBid($bid){
	if (is_numeric($bid)) {
		$result = MySQL_select("boards","name","where id =$bid");
		if ($result) return $result[0]['name'];
		return false;
	}
}
function readBoardLists($lid){
	$result = MySQL_select("boardlists","*",($lid?" where id = $lid":""));
	if($result){
		foreach ($result as $key => $value) {
			$lid=$value['id'];
			$name=$value['name'];
			echo '<div class="box"><div class="box_header"><a href="forum.php?mod=boardlists&lid='.$lid.'">'.$name.'</a></div><div class="box_body"><table>';
			readBoards($lid);
			echo '</table></div></div>';
		}
	}
}
function readBoards($lid){
	$result = MySQL_select("boards","*","where belong = $lid");
	if($result){
		foreach ($result as $key => $value) {
			$bid=$value['id'];
			$name=$value['name'];
			echo '<tr onclick="location=\'forum.php?mod=board&bid='.$bid.'\'"><td>'.$name.'</td></tr>';
		}
	}
}
function register($username,$password){
	$SQLtablename='username';
	$MySQL_connet=connectMySQL();
	$sql = "INSERT INTO users (username,password,permission) VALUES ('$username','$password',1)";
	return $MySQL_connet->query($sql);
	$MySQL_connet->close();
}
?>