<?php
function readBoardLists2($lid){
	$result = MySQL_select("boardlists","*",($lid?" where id = $lid":""));
	if($result){
				foreach ($result as $key => $value) {
					$lid=$value['id'];
					$name=$value['name'];
					echo '<option value="'.$lid.'" disabled>----------<h5>'.$name.'</h5>-------------</option>';
					readBoards2($lid);
				}

	}
}
function readBoards2($lid){
	$result = MySQL_select("boards","*","where belong = $lid");
	if($result){
		foreach ($result as $key => $value) {
			$bid=$value['id'];
			$name=$value['name'];
			echo '<option value="'.$bid.'">'.$name.'</option>';
		}
	}
}
?>
<div class="box">
	<div class="box_header">
		发帖
	</div>
	<div class="box_body">
			<table style="width: 100%;" id="postBox">
		<tr><td class="leftTd">文章标题</td><td><input type="text" name="title" id="title"></td><td class="rightTd">还剩<span id="sleftTd">30</span>个字</td></tr>
		<tr>
			<td class="leftTd">文章内容</td>
			<td>
				<textarea class="required markItUpEditor" cols="40" name="content" rows="20" style="word-break: break-all; word-wrap: break-word; font-family: Helvetica;width: 100%;"></textarea>
			</td><td></td>
		</tr>
		<tr><td class="leftTd">标签</td><td><input type="text" name="label" id="label"></td><td></td></tr>
		<tr><td class="leftTd">板块</td><td>
			<select name="bid">
				<?php readBoardLists2(0); ?>
			</select>	
		</td><td></td></tr>
		<tr><td class="leftTd"></td><td><button>发表</button></td><td></td></tr>
	</table>	
	</div>
</div>
		
<script type="text/javascript">//检查长度
	window.addEventListener("load",function(){
		var title=document.getElementsByName('title')[0];
		title.addEventListener('input',function(){
			if(this.value.length>30){
				this.value=this.value.substring(0,30);
			}
			var sleftTd=document.getElementById('sleftTd');
			sleftTd.innerHTML=30-this.value.length;
		});
	});
</script>
<script type="text/javascript">
	window.addEventListener("load",function(){
		var postBox = document.getElementById("postBox");
		if(postBox){
			var inputs = postBox.getElementsByTagName("input");
			var textarea = postBox.getElementsByTagName("textarea")[0];
			var button = postBox.getElementsByTagName("button")[0];
			var select = postBox.getElementsByTagName("select")[0];

			button.addEventListener("click",function(){
				var Userjson = getCookie("UserInfo");
				if(isJSON(Userjson)){
					var info = JSON.parse(Userjson);
					var uid=info["id"];
				}else{
					alert("请先登录！");
					return;
				}
				var title = inputs[0].value;
				var label = inputs[1].value;
				var bid = select[select.selectedIndex].value;
				var content = textarea.value;
				var url="source/port/post.php"; 
				ajax({
			        method: "post",
			        url: url,
			        data: {
			            "title": title,
			            "label": label,
			            "bid": bid,
			            "uid": uid,
			            "content": content
			        },
			        success: function(result){
			            	alert(result);
			        },
			        async: true
			    });
			});
		}
	});
</script>