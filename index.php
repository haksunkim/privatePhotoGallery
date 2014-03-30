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
<html>
<head>
    <meta charset='utf-8';/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo(WEBPAGE_TITLE);?></title>
	<link rel="stylesheet" href="colorbox.css">
	<link rel="stylesheet" href="styles/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
</head>
<body>
	<script>
		$(document).ready(function(){
			$(".gallery").colorbox({rel:'gallery', photo:true});
		});
	</script>
	<?php
		$albumServ = new AlbumService();
		$albums = $albumServ->getAlbums();
		
		include("include/menu/top_nav.php");
		foreach($albums as $album) {
	?>
		<div class="album">
		  <h3 class="album-title"><?php echo($album->name);?></h3>
		  <?php echo("<img src='view/image.php?type=thumb&path=".$album->cover."'/>");?>
		  <a href="<?php echo("album.php?id=".$album->id);?>" class="album-button">보기</a>
		</div>
	<? }?>
</body>
</html>