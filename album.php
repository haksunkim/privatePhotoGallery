<?php
	require("include/global/pre_check.php");
	require_once("env/global_env.php");
	require_once("entity/photo.php");
	require_once("module/photoService.php");
	
	if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
		session_destroy();
		header("location: login.php");
		exit();
	}
	
	if (!isset($_GET["id"])) {
		session_destroy();
		header("location: login.php");
		exit();
	}
?>
<head>
    <meta charset='utf-8'/>
	<title><?php echo(WEBPAGE_TITLE);?></title>
	<link rel="stylesheet" href="colorbox.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
</head>
<body style="padding: 0; margin: 0; font-family:Arial, Verdana;background-color:#fff;">
	<script>
		$(document).ready(function(){
			$(".gallery").colorbox({rel:'gallery', photo:true, maxHeight:"600px", maxWidth:"800px"});
		});
	</script>
	<!---a class="gallery" href='view/image.php' title="image not found"><img src='view/image.php'></a--->
	<?php
		$photoServ = new PhotoService();
		$photos = $photoServ->getalbumphotos($_GET["id"]);
		
		foreach($photos as $photo) {
			echo("<a class='gallery' href='view/image.php?type=image&path=".$photo->imagepath."'>");
			echo("<img src='view/image.php?type=thumb&path=".$photo->thumbpath."'>");
			echo("</a>");
		}
	?>
</body>
</html>