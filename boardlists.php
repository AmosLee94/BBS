<?php include_once('source/interface/aside1.php');?>
<?php include_once('source/interface/aside2.php');?>
<section>
	<?php
		if (isset($_GET['lid'])) {
			readBoardLists($_GET['lid']);
		}
	?>
</section>
