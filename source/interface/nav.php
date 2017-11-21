 <nav>
<?php 
	$nav = readNav();
	if($nav){
		foreach ($nav as $key => $value) {
			$weight = $value['weight'];
			$name = $value['name'];
			$style = $value['style'];
			$url = $value['url'];
			$basal = $value['basal'];
			$home = $value['home'];
			$disabled = $value['disabled'];
			$floatright = $value['floatright'];
			echo '<a href="'.$url.'" class = "'.($home?"home ":"").($floatright?"right ":"").'">'.$name.'</a>';

		}
	}
?>
</nav>