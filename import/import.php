<?php
	echo($_SERVER['DOCUMENT_ROOT']);
	
	require($_SERVER['DOCUMENT_ROOT']."/include/global/pre_check.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/album.php");
	require($_SERVER['DOCUMENT_ROOT']."/env/global_env.php");
	
?>
<html>
<head>
    <title>Import Photos</title>
</head>
<body>
	Import Folder</br>
	<?php
		$album = new Album("import",IMPORT_PATH); 
		
		$album->setPhotos();
			
		foreach($album->getPhotos() as $photo) {
			echo($photo->getFilePath());
			echo("<img src='".$photo->getFilePath()."'>");
		}
	?>
</body>
</html>