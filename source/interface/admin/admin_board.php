<table width="80%" class="center menu" id="boardBox">
	<tr>
		<td>版块名称/版块ID</td><td>操作</td>
	</tr>
	<?php 
		$boardlists = MySQL_select("boardlists","*");
		if ($boardlists) {
			foreach ($boardlists as $key => $boardlist) {
				echo '<tr><td>'.$boardlist['name'].'/<span>'.$boardlist['id'].'</span></td><td><a href="javascript:;" name="'.$boardlist['id'].'">删除</a></td></tr>';
				$boards = MySQL_select("boards","*","where belong = ".$boardlist['id']);
				if ($boards) {
					foreach ($boards as $key => $board) {
							echo '<tr><td>|-------'.$board['name'].'/<span>'.$board['id'].'</span></td><td><a href="javascript:;" name="'.$boardlist['id'].'" id="'.$board['id'].'">删除</a></td></tr>';
					}
				}
				echo '<td>|-------添加版块：<input type="text"><button name="'.$boardlist['id'].'">添加</button></td>';
			}
		}
	?>
	<tr>
		<td>添加分区：<input type="text"><button>添加</button></td><td></td>
	</tr>
</table>
<script type="text/javascript">
	var boardBox = document.getElementById('boardBox');
	var a = boardBox.getElementsByTagName("a");
	for (var i = a.length - 1; i >= 0; i--) {
		a[i].addEventListener("click",function(){
			if(this.name){
				if (this.id) {
					deleteBoard(this.id);
				}else{
					deleteBoardlist(this.name);
				}
			}
		});
	}
	var buttons = boardBox.getElementsByTagName("button");
	for (var i = buttons.length - 1; i >= 0; i--) {
		buttons[i].addEventListener("click",function(){
			var name = this.previousSibling.value;
			if (name == "") {
				alert("名字不可为空！");
				return;
			}
			if(this.name){
				var lid = this.name;
				addBoard(lid,name);
			}else{
				addBoardlist(name);
			}
		});
	}
	function deleteBoard(bid){
	    ajax({
	        method: "post",
	        url: "<?php echo $RootAddress ?>/source/port/admin/deleteBoard.php",
	        data: {
	            "bid": bid
	        },
	        success: function(result){
            	alert(result);
	        },
	        async: true
	    });
	}
	function deleteBoardlist(lid){
	    ajax({
	        method: "post",
	        url: "<?php echo $RootAddress ?>/source/port/admin/deleteBoardlist.php",
	        data: {
	            "lid": lid
	        },
	        success: function(result){
            	alert(result);
	        },
	        async: true
	    });
	}
	function addBoard(lid,name){
	    ajax({
	        method: "post",
	        url: "<?php echo $RootAddress ?>/source/port/admin/addBoard.php",
	        data: {
	            "lid": lid,
	            "name": name
	        },
	        success: function(result){
            	alert(result);
	        },
	        async: true
	    });
	}
	function addBoardlist(name){
	    ajax({
	        method: "post",
	        url: "<?php echo $RootAddress ?>/source/port/admin/addBoardlist.php",
	        data: {
	            "name": name
	        },
	        success: function(result){
            	alert(result);
	        },
	        async: true
	    });
	}
</script>

