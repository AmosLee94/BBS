<?php include_once('source/interface/aside1.php');?>
<?php include_once('source/interface/aside2.php');?>
<section>
<?php
if (isset($_GET['bid'])) {
	$conn = connectMySQL();
	mysqli_query($conn,"set names utf8");
	$sql = "select tid,bid,title,uid,hits,replies,hittime,replytime,createtime,label from topics where bid = '".$_GET['bid']."'";
	$result = mysqli_query($conn,$sql);
			echo '<div class="box"><div class="box_header">'.getBoardNameByBid($_GET['bid']).'</div><div class="box_body"><table><tr><th>标题</th><th>版块</th><th>uid</th><th>作者</th><th>点击数</th><th>点击时间</th><th>回复</th><th>回复时间</th><th>创建时间</th><th>标签</th></tr>';
	if($result->num_rows == 0){
		echo "<tr><td>没有帖子</td></tr>";
		$conn->close();
	}else{

		foreach ($result as $key => $value) {
			$tid=$value['tid'];
			$bid=$value['bid'];
			$title=$value['title'];
			$uid=$value['uid'];
			$topicAuthor=getUserNameById($value['uid']);
			$hits=$value['hits'];
			$replies=$value['replies'];
			$hittime=$value['hittime'];
			$replytime=$value['replytime'];
			$createtime=$value['createtime'];
			$label=$value['label'];
			echo '<tr onclick="location=\'forum.php?mod=topic&tid='.$tid.'\'"><td>'.$title.'</td><td>'.$bid.'</td><td>'.$uid.'</td><td>'.$topicAuthor.'</td><td>'.$hits.'</td><td>'.$hittime.'</td><td>'.$replies.'</td><td>'.$replytime.'</td><td>'.$createtime.'</td><td>'.$label.'</td></tr>';
		}
		$conn->close();
	}
		echo '</table></div></div>';
}
?>

</section>

