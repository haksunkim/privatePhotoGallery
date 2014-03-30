<?php
	require("include/global/pre_check.php");
	require_once("env/global_env.php");
	require_once("entity/photo.php");
	require_once("module/photoService.php");
	
	if (!isset($_GET["id"])) {
		session_destroy();
		header("location: login.php");
		exit();
	}
?>
</html>
<head>
    <meta charset='utf-8'/>
	<title><?php echo(WEBPAGE_TITLE);?></title>
	<link rel="stylesheet" href="colorbox.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
	<link rel="stylesheet" href="styles/style.css">
</head>
<body style="padding: 0; margin: 0; font-family:Arial, Verdana;background-color:#fff;">
	<script>
		$(document).ready(function(){
			$(".gallery").colorbox({rel:'gallery', photo:true, maxHeight:"600px", maxWidth:"800px"});
			$(".comments").colorbox({href:"view/comments.php"});
		});
	</script>
	<?php
		include("include/menu/top_nav.php");
		$photoServ = new PhotoService();
		$photos = $photoServ->getalbumphotos($_GET["id"]);
		$column_count = 5;
		$col = 0;
		echo("<table border=0>");
			foreach($photos as $photo) {?>
				
				  <?php 
				  echo("<td style='padding:3px'>");
				  echo("<div class='album'>");
				  echo("<a class='gallery' href='view/image.php?type=image&path=".$photo->imagepath."'>");
				  echo("<img src='view/image.php?type=thumb&path=".$photo->thumbpath."'>");
					echo("</a></br>");
					//echo("<ul class='comments'><li><a href='view/login.php'>Comments <span>".count($photo->comments)."</span></a></li></ul>");
					echo("</div>");
					echo("</td>");
				$col ++;
				if ($col == $column_count) echo("</tr>");
				if ($col == $column_count) $col = 0;
				  ?>
			<?php }
			echo("</table>");
			?>
		
	?>
</body>
</html>