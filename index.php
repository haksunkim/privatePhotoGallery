<?php
	require("include/global/pre_check.php");
	require_once("entity/organizer.php");
	
	if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
		session_destroy();
		header("location: login.php");
		exit();
	}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Thumbnail Navigator Skin 07 - Jssor Slider, Slideshow with Javascript Source Code</title>
</head>
<body style="padding: 0; margin: 0; font-family:Arial, Verdana;background-color:#fff;">
    <!-- use jssor.slider.min.js instead for release -->
    <!-- jssor.slider.min.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="../js/jssor.core.js"></script>
    <script type="text/javascript" src="../js/jssor.utils.js"></script>
    <script type="text/javascript" src="../js/jssor.slider.js"></script>
    <script>
        jssor_slider1_starter = function (containerId) {
            var jssor_slider1 = new $JssorSlider$(containerId, {
                $AutoPlay: false,                                   //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
				$FillMode: 1,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actuall size, default value is 0
                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					
                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                           //[Optional] The offset position to park thumbnail
                }
            });
        };
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles (except 'top', 'left', 'width' and 'height') to css file or css block. -->
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;
        height: 600px; background: #24262e; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 600px; overflow: hidden;">
            <?php
				$organizer = new Organizer();
				$albums = $organizer->getAlbums("/home/familyphoto/gallery");
				foreach($albums as $album) {
					$album->setPhotos();
					foreach($album->getPhotos() as $photo) {
						echo("<div>");
							//echo("<a u=image href='#'><img src='".$album->getFolderPath()."/image/image_".$photo->getName()."'></a>");
							echo("<a u=image href='#'><img src='view/image.php'></a>");
							echo("<a u=image href='#'><img src='view/image.php'></a>");
							//echo("<a u=thumb href='#'><img src='".$album->getFolderPath()."/thumb/thumb_".$photo->getName()."'></a>");
						echo("</div>");
					}
				}
			?>
        </div>
        
        <!-- ThumbnailNavigator Skin Begin -->
        <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 07 css */
                /*
                .jssort07 .p            (normal)
                .jssort07 .p:hover      (normal mouseover)
                .jssort07 .pav          (active)
                .jssort07 .pav:hover    (active mouseover)
                .jssort07 .pdn          (mousedown)
                */
                .jssort07 .i
                {
                    position:absolute;
                    top: 0px;
                    left: 0px;
                    width: 72px;
                    height: 72px;
                	filter: alpha(opacity=80);
                	opacity: .8;
                }
                .jssort07 .p:hover .i, .jssort07 .pav .i
                {
                	filter: alpha(opacity=100);
                	opacity: 1;
                }
                .jssort07 .o
                {
                    position: absolute;
                    top:0px;
                    left:0px;
                    width:70px;
                    height:70px;
                    
                    border: 1px solid #000;
                    
                    transition: border-color .6s;
                    -moz-transition: border-color .6s;
                    -webkit-transition: border-color .6s;
                    -o-transition: border-color .6s;
                }
                * html .jssort07 .o
                {
                	/* ie quirks mode adjust */
                	width /**/: 72px;
                	height /**/: 72px;
                }
                .jssort07 .pav .o, .jssort07 .p:hover .o
                {
                	border-color: #fff;
                }
                .jssort07 .pav:hover .o
                {
                	border-color: #0099FF;
                }
                .jssort07 .p:hover .o
                {
                	transition: none;
                    -moz-transition: none;
                    -webkit-transition: none;
                    -o-transition: none;
                }
            </style>
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 72px; HEIGHT: 72px; TOP: 0; LEFT: 0;">
                    <ThumbnailTemplate class="i" style="position:absolute;"></ThumbnailTemplate>
                    <div class="o">
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">jQuery Image Slider</a>
        <!-- Trigger -->
        <script>
            jssor_slider1_starter('slider1_container');
        </script>
    </div>
</body>
</html>