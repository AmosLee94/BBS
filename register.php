
	<table align="center" id="registerBox">
		<caption><h3>用户注册</h3></caption>
		<tr><th>　用户名：</th><td><input name="username" id="username" /></td>
			<td><span id="susername"></span></td>
		</tr>
		<tr><th>　　密码：</th><td><input name="psw" id="psw" type="text" /></td>
			<td><span id="spsw"></span></td>
		</tr>
		<tr><th>确认密码：</th><td><input name="repsw" id="repsw" type="text"/></td>
			<td><span id="srepsw"></span></td>
		</tr>
		<tr><td></td><td>
			<button onClick="return SubmitButtonClick();">注册</button>
			<input type="reset" value="重置">
		</td></tr>
	</table>
<script language="javascript" type="text/javascript">
	//每个元素失去焦点验证，通过返回true，不通过返回false
	var inputs = document.getElementsByTagName("input");
	for (var i = inputs.length - 2; i >= 0; i--) {
		inputs[i].addEventListener("blur",CheckInput);
	}
	function CheckInput(obj){
		// var result=false;
		// var span=document.getElementById("s"+obj.name);//确认密码
		// if(obj.name=="repsw"){
		// 	var psw=document.getElementById("psw");
		// 	if(obj.value!=psw.value){
		// 		span.innerHTML="\u2717<font color='red'>密码与确认密码不一致</font>";
		// 		return result;
		// 	}
		// }
		// if(obj.value=="")
		// 	span.innerHTML="\u2717<font color='red'>不得为空</font>";
		// else if(obj.value.length<2 || obj.value.length>16)
		// 	span.innerHTML="\u2717<font color='red'>长度在4~16个字符以内</font>";
		// else{
		// 	result=true;
		// 	span.innerHTML="\u2713";
		// }
		// return result;
	}
	//提交按钮单击事件
	function SubmitButtonClick(){
		var username=document.getElementById("username");
		var psw=document.getElementById("psw");
		var repsw=document.getElementById("repsw");
		return CheckInput(username) && CheckInput(psw) && CheckInput(repsw);
	}
</script>
<script type="text/javascript">
	var registerBox = document.getElementById("registerBox");
	var button = registerBox.getElementsByTagName("button")[0];
	var inputs = registerBox.getElementsByTagName("input");
	var select = registerBox.getElementsByTagName("select")[0];
	button.addEventListener("click",function(){
		var username = inputs[0].value;
		var psw = inputs[1].value;
		var url="<?php echo $RootAddress ?>/source/port/register.php";
	    ajax({
	        method: "get",
	        url: url,
	        data: {
	            "username": username,
	            "password": psw
	        },
	        success: function(result){
	        		alert((result?"注册成功!\n自动登录！":"注册失败!"));
	        		if (result) {
						var loginBox = document.getElementById("loginBox");
						var loginButton = loginBox.getElementsByTagName("button")[0];
						var inputs = loginBox.getElementsByTagName("input");
						inputs[0].value=username;
						inputs[2].value=password;
						loginButton.click();
	        		}
	        },
	        async: true
	    });
	});

</script>
<script type="text/javascript">
	var username = document.getElementById("username");
		// alert(username.outerHTML);
	username.addEventListener("blur",function(){
		// alert("d");
	});
</script>
