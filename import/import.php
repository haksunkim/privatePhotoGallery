<?php
	require($_SERVER['DOCUMENT_ROOT']."/include/global/pre_check.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/module/albumService.php");
	require($_SERVER['DOCUMENT_ROOT']."/env/global_env.php");
	
	if (isset($_POST["btn_import"]) && $_POST["btn_import"] == "Import") {
		
	}
?>
<html>
<head>
    <meta charset='utf-8'/>
	<title><?php echo(WEBPAGE_TITLE." - Import Photos");?></title>
	<link rel="stylesheet" href="../colorbox.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="../js/jquery.colorbox-min.js"></script>
	<script>
		$(document).ready(function(){
			$(".gallery").colorbox({rel:'gallery', photo:true, maxWidth:"800px"});
		});
	</script>
</head>
<body>
	<h1>Import Folder</h1></br></br>
	<form name="form_import" method="post" action="processImport.php">
	Album Name: <input type=text id="albumname" name="albumname" value=""/> 
	<input type="submit" id="btn_import" name="btn_import" value="Import" class="processImport"/></form></br>
	<?php
		$albumServ = new AlbumService(); 
		
		$photos = $albumServ->getphotosfromimportpath(IMPORT_PATH);
			 
		foreach($photos as $photo) {
			echo("<a class='gallery' href='../view/image.php?type=image&path=".$photo->imagepath."'>");
			echo("<img src='../view/image.php?type=thumb&path=".$photo->imagepath."'>");
			echo("</a>");
		}
	?>
</body>
</html>