window.addEventListener('load', function(){
	function boxInit(box){
		var header = box.getElementsByClassName("box_header")[0];
		if(header){
			var button = document.createElement("div");
			button.innerHTML = '-';
			button.setAttribute("class", "right"); 
			header.appendChild(button); 
			button.addEventListener("click",function(){
				var body = this.parentNode.parentNode.getElementsByClassName("box_body")[0];
				if (this.innerHTML == '+') {
					this.innerHTML = '-';
					body.style.display = "block";
				}else{
					this.innerHTML = '+';
					body.style.display = "none";
				}
			});
		}
		else{
			for(var key in box.style){
				box.style.borderTopWidth = "20px";
				// console.log(key);
			}
		}
	}
	var boxes = document.getElementsByClassName('box');
	for (var i = boxes.length - 1; i >= 0; i--) {
		boxInit(boxes[i]);
	}
});

