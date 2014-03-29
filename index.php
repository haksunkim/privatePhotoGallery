<?php
	require("include/global/pre_check.php");
	require_once("env/global_env.php");
	require_once("entity/organizer.php");
	require_once("module/albumService.php");
	require_once("entity/album.php");
	
	if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
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
			$(".gallery").colorbox({rel:'gallery', photo:true});
		});
	</script>
	<!---a class="gallery" href='view/image.php' title="image not found"><img src='view/image.php'></a--->
	<?php
		$albumServ = new AlbumService();
		$albums = $albumServ->getAlbums();
		
		foreach($albums as $album) {
			echo("<a href='album.php?id=".$album->id."'>".$album->name."</a></br>");
		}
	?>
</body>
</html>