<?php
	require_once "../library/path.php";
	require_once $RootPath."/source/library/MySql.php";
	@session_start();
	if(!isset($_SESSION['permission'])||$_SESSION['permission']<9){
		echo false;
	}else{
		if(isset($_GET['banId'])){
			$result = banPostById($_GET['banId'],$_GET['time'],$_GET['unit']);
			if($result){
				echo "禁言成功";
			}else{
				echo  "禁言失败";
			}
		}
		if (isset($_GET['liftBanId'])) {
			if(liftBanPostById($_GET['liftBanId'])==1){
				echo "禁言成功";
			}else{
				echo "禁言失败";
			}
		}
		if (isset($_GET['getBannedList'])) {
			$result =getBannedList();
			if($result->num_rows>0){
				foreach ($result as $key => $value) {
					echo "<tr><td>".$value['id']."</td><td>".$value['time']."</td></tr>";
				}
			}
		}
	}
	function banPostById($userId,$time,$unit){
		if (is_numeric($userId)&&is_numeric($time)&&($unit=='day'||$unit=='hour'||$unit=='minute')){
			$MySQL_connet=connectMySQL();
			$sql = 'select * from bannedlist where id = '.$userId.' and time > DATE_ADD(now(), INTERVAL '.$time.' '.$unit.')';
			$result = mysqli_query($MySQL_connet,$sql);
			if($result->num_rows > 0){//有长禁言，不更新数据
				return true;
			}else{//没有长禁言，看是否有短禁言
				$sql = 'select * from bannedlist where id = '.$userId.' and time < DATE_ADD(now(), INTERVAL '.$time.' '.$unit.')';
			$result = mysqli_query($MySQL_connet,$sql);
				if($result->num_rows > 0){//有短禁言，更新数据
						$sql = 'UPDATE bannedlist SET time = DATE_ADD(now(), INTERVAL '.$time.' '.$unit.') where id = '.$userId;
						if($MySQL_connet->query($sql) === TRUE){
							return true;
						}else{
							return false;
						}
				}{//没短禁言，插入数据
					$sql = 'insert bannedlist value('.$userId.',DATE_ADD(now(), INTERVAL '.$time.' '.$unit.'))';
					if($MySQL_connet->query($sql) === TRUE){
						return true;
					}else{
						return false;
					}
				}
			}
			$MySQL_connet->close();
		}
		return false;
	}
	function liftBanPostById($userId){
		if (is_numeric($userId)){
			$MySQL_connet=connectMySQL();
			$sql = 'select * from bannedlist where id = '.$userId;
			$result = mysqli_query($MySQL_connet,$sql);
			if($result->num_rows == 0){//没有禁言
				return 0;
			}else{
					$sql = 'delete from bannedlist where id = '.$userId;
					if($MySQL_connet->query($sql) === TRUE){
						return true;
					}else{
						return -1;
					}
			}
			$MySQL_connet->close();
		}
		return false;
	}
	function checkBannedList(){
		$conn = connectMySQL();
		$sql = "delete from bannedlist where time < now()";
		$conn->close();
	}
	function checkBanPost($id){

		if (is_numeric($id)) {
			checkBannedList();
			if ($id) {
				$MySQL_connet=connectMySQL();
				$sql = 'select time from bannedlist where time > now() and id ='.$id.' order by time desc';
				$result = mysqli_query($MySQL_connet,$sql);
					if($result->num_rows == 0){
						return false;
					}elseif ($result->num_rows >0) {
						$resultArray = mysqli_fetch_row($result);
						return $resultArray[0];
					}
					else{
						echo 'verifyUser failed!('.__FILE__.')'; 
					}
				$MySQL_connet->close();
			}
		}
	}

	function getBannedList(){
		checkBannedList();
		$MySQL_connet=connectMySQL();
		$sql = 'select * from bannedlist';
		$result = mysqli_query($MySQL_connet,$sql);
		if($result->num_rows == 0){//没有禁言
			return false;
		}else{
			return $result;
		}
		$MySQL_connet->close();
	}









?>