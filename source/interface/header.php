

<header>
	<div class="h_left">
		万书山
	</div>
	<div class="h_right">
		<div id="loginBox">
			<table>
				<tr>
					<td>用户名</td>
					<td><input type="text" name="id" id="username" ></td>
					<td><input type="checkbox" name="cookietime" disabled="true">自动登录</td>
					<td><a href="#">找回密码</a></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="password" name="id" id="password"></td>
					<td><button style="width: 100%;">登录</button></td>
					<td><a href="forum.php?mod=register">立即注册</a></td>
				</tr>
			</table>
		</div>
		<div id="loginedBox" class="uerInfo" style="display: none;">
			<div class="left">
				<div class="userInfoNav">
					<span>
						<a href="forum.php?mod=admin">管理中心</a>
					</span>
					<a href="forum.php?mod=info">个人中心</a>
					<a href="javascript:;" id ="logout">
						退出登录
					</a>
				</div>
				<div class="userInfoBody">
					用户名：<span>undefined</span>
					用户组：<span>undefined</span>
				</div>
			</div>
			<div class="right">
				<img src="img/headshot/default.jpg" width = 50px;>
			</div>
		</div>
		<script type="text/javascript">
			var loginBox = document.getElementById("loginBox");
			var button = loginBox.getElementsByTagName("button")[0];
			var inputs = loginBox.getElementsByTagName("input");
			var loginedBox = document.getElementById("loginedBox");
			var adminBox = loginedBox.getElementsByTagName("span")[0];
			var infoName = loginedBox.getElementsByTagName("span")[1];
			var infoGroup = loginedBox.getElementsByTagName("span")[2];
			button.addEventListener("click",function(){
				var username = inputs[0].value;
				var password = inputs[2].value;
			    ajax({
			        method: "post",
			        url: "source/port/login.php",
			        data: {
			            "username": username,
			            "password": password
			        },
			        success: function(result){
		            	checkLog();
			        },
			        async: true
			    });
			});
			function checkLog(){
				var Userjson = getCookie("UserInfo");
				if(isJSON(Userjson)){
					loginBox.style = "display: none;";
					loginedBox.style = "display: block;";
					var info = JSON.parse(Userjson);
					infoName.innerHTML=info['username'];
					infoGroup.innerHTML=info['permission']>8?"管理员":"新手上路";
					if(info['permission']<=8){
						adminBox.style= "display:none;";
					}else{
						adminBox.style= "display:inline-block;";
					}
				}else{
					loginBox.style = "display: block;";
					loginedBox.style = "display: none;";
				}
			}
			checkLog();
			var logout=document.getElementById("logout");
			logout.addEventListener("click",function(){
				ajax({
			        method: "post",
			        url: "source/port/logout.php",
			        data: {
			        },
			        success: function(result){
			            checkLog();
			        },
			        async: true
			    });
			});

		</script>
	</div>
</header>