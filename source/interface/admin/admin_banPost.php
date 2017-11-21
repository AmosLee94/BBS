<ul style="list-style:none;">
	<li id="banPost">禁言用户：
			id：<input type="text">
			禁言时间：<input type="text" size="5"> 
			<select>
				<option value="minute">分钟</option>
				<option value="hour">小时</option>
				<option value="day">天</option>
			</select>
			<button>禁言</button>
	</li>
	<li id="liftBanPost">解禁：
		id：<input type="text">
		<button>解禁</button>
	</li>
	<li id="queryId">
		用户id查询：<br/>
		用户名：<input type="text">	
		<button>查询</button>
	</li>
	<li id="getBannedList">
		禁言表：<button>刷新</button>
		<table></table>
	</li>
</ul>
<script type="text/javascript">
	var banPost = document.getElementById("banPost");
	var button = banPost.getElementsByTagName("button")[0];
	var inputs = banPost.getElementsByTagName("input");
	var select = banPost.getElementsByTagName("select")[0];
	button.addEventListener("click",function(){
		var banId = inputs[0].value;
		var time = inputs[1].value;
		var unit = select[select.selectedIndex].value;
		var url="<?php echo $RootAddress ?>/source/port/banPost.php";
	    ajax({
	        method: "get",
	        url: url,
	        data: {
	            "banId": banId,
	            "time": time,
	            "unit": unit
	        },
	        success: function(result){
	            	alert(result);
	        },
	        async: true
	    });
	});
	var liftBanPost = document.getElementById("liftBanPost");
	var button = liftBanPost.getElementsByTagName("button")[0];
	var input = liftBanPost.getElementsByTagName("input")[0];
	button.addEventListener("click",function(){
		var liftBanId = input.value;
		var url="<?php echo $RootAddress ?>/source/port/banPost.php";
	    ajax({
	        method: "get",
	        url: url,
	        data: {
	            "liftBanId": liftBanId,
	        },
	        success: function(result){
	            	alert(result);
	        },
	        async: true
	    });
	});
	var queryId = document.getElementById("queryId");
	var button = queryId.getElementsByTagName("button")[0];
	var input = queryId.getElementsByTagName("input")[0];
	button.addEventListener("click",function(){
		var userName = input.value;
		var url="<?php echo $RootAddress ?>/source/port/getIdByName.php";
	    ajax({
	        method: "get",
	        url: url,
	        data: {
	            "userName": userName,
	        },
	        success: function(result){
	            	alert(result);
	        },
	        async: true
	    });
	});

	var getBannedList = document.getElementById("getBannedList");
	var button = getBannedList.getElementsByTagName("button")[0];
	var table = getBannedList.getElementsByTagName("table")[0];
	button.addEventListener("click",function(){
		var userName = input.value;
		var url="<?php echo $RootAddress ?>/source/port/banPost.php";
	    ajax({
	        method: "get",
	        url: url,
	        data: {
	            "getBannedList": getBannedList,
	        },
	        success: function(result){
	        	table.innerHTML=result;
	        },
	        async: true
	    });
	});
</script>
