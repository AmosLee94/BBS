<?php
	if (isset($_GET['tid'])) {
		$topic = topic($_GET['tid']);
		echo '<div class="topic_title">'.$topic['title'].'<span class="topic_label">'.$topic['label'].'</span></div>';
		echo '<div class="floor"><div class="left"><div class="userwall"><img src="img/headshot/default.jpg">'.getUserNameById($topic['uid']).'</div></div><div class="right"><br><br>'.$topic["content"].'<br><br><br><br><div class="bottom"><i>1</i> 楼 '.$topic['createtime'].'|<a href="javascript:" class="gear-button">举报</a>			|<a href="javascript:">回复</a></div></div></div>';
		$replys = reply($_GET['tid']);
		echo "[".$replys."]";
	}
?>
<div class="box" style="width: 100%;margin: 0;">
	<div class="box_header">
		回帖
	</div>
	<div class="box_body" id="answer_box">
		<textarea class="required markItUpEditor" cols="40" name="content" rows="10" style="word-break: break-all; word-wrap: break-word; font-family: Helvetica;width: 100%;"></textarea>
		<button>发表</button>
	</div>
</div>
<script type="text/javascript">
	window.addEventListener("load",function(){
		var answer_box = document.getElementById("answer_box");
		if(answer_box){
			var textarea = answer_box.getElementsByTagName("textarea")[0];
			var button = answer_box.getElementsByTagName("button")[0];
			button.addEventListener("click",function(){
				var Userjson = getCookie("UserInfo");
				if(!isJSON(Userjson)){
					alert("请先登录！");
					return;
				}else{
					var tid = <?php echo $_GET['tid']; ?>;
					var replyto = 1;
					var info = JSON.parse(Userjson);
					var uid = info["id"];
					var content = textarea.value;
					var url = "./source/port/reply.php"; 
					console.log( "tid:"+tid+";uid:"+uid+";replyto:"+replyto+";content:"+content);
					ajax({
				        method: "post",
				        url: url,
				        data: {
				            "tid": tid,
				            "uid": uid,
				            "replyto": replyto,
				            "content": content
				        },
				        success: function(result){
				            	alert(result);
				        },
				        async: true
				    });
				}
			});
		}
	});
</script>