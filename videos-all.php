<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//VARIABLES DE URL
$id_url=$_REQUEST["id"];
$url=$_REQUEST["url"];
$url_web=$web."videos-all.php";

//WIDGETS
$sc_addthis=true;
$sc_galinferior=false;
$sc_videos=false;
$sc_saludos=true;
$sc_slider=false;

################################################################
//PAGINACION DE NOTICIAS
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page           = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_noticias   = mysql_query("SELECT COUNT(*) as count FROM iev_videos WHERE publicar=1 ORDER BY fecha_publicacion DESC;", $conexion);
$generated      = intval($row['count']);
$pagination     = new Pagination("18", 70, $page, $url_web."?page", 1, 0);
$start          = $pagination->prePagination();
$rst_videos=mysql_query("SELECT * FROM iev_videos WHERE fecha_publicacion<='$fechaActual' and publicar=1 ORDER BY fecha_publicacion DESC LIMIT $start, 18", $conexion);

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Videos</title>
        <meta name="description" content="">
        <base href="<?php echo $web; ?>">

        <!-- PAGINACION -->
        <link rel="stylesheet" href="/libs/pagination/pagination.css" media="screen">

        <?php require_once("w-script.php"); ?>
        
        <!-- Magnific Popup core CSS file -->
    	<link rel="stylesheet" href="libs/magnific-popup/css/magnific-popup.css">

    	<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 

    	<!-- Magnific Popup core JS file -->
    	<script src="libs/magnific-popup/js/jquery.magnific-popup.js"></script>
             
        <script type="text/javascript">
    	$(document).ready(function() {
    	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    	disableOn: 700,
    	type: 'iframe',
    	mainClass: 'mfp-fade',
    	removalDelay: 160,
    	preloader: false,

    	fixedContentPos: false
    	});
    	});
    	</script>

<style type="text/css">
/**
 * Simple fade transition,
 */
.mfp-fade.mfp-bg {
  opacity: 0.001; /* Chrome opacity transition bug */
  -webkit-transition: all 0.15s ease-out; 
  -moz-transition: all 0.15s ease-out; 
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-bg.mfp-ready {
  opacity: 0.8;
}
.mfp-fade.mfp-bg.mfp-removing {
  opacity: 0;
}

.mfp-fade.mfp-wrap .mfp-content {
  opacity: 0;
  -webkit-transition: all 0.15s ease-out; 
  -moz-transition: all 0.15s ease-out; 
  transition: all 0.15s ease-out;
}
.mfp-fade.mfp-wrap.mfp-ready .mfp-content {
  opacity: 1;
}
.mfp-fade.mfp-wrap.mfp-removing .mfp-content {
  opacity: 0;
}
</style>


</head>
<body>
    
        <header id="interno">

            <?php require_once("w-header.php"); ?>
            
        </header>

        <section id="news">
            
            <div class="container">

                <section id="nws">

                    <div class="nwder col-lg-8 col-md-8 col-sm-7 col-xs-12 notawizq">

                        <section class="galeria col-lg-12 col-sm-12 col-xs-12">

                            <h3>Videos</h3>

                            <?php while($fila_videos=mysql_fetch_array($rst_videos)){
                                $videos_titulo=$fila_videos["titulo"];
                                $videos_contenido=$fila_videos["contenido"];
                                $videos_imagen=$fila_videos["imagen"];
                                $videos_imagen_carpeta=$fila_videos["imagen_carpeta"];
                                $videos_video=$fila_videos["video"];

                                //URL
                                $videos_UrlImg=$web."imagenes/upload/".$videos_imagen_carpeta."thumb/".$videos_imagen;
                                $videos_UrlYoutube="http://www.youtube.com/watch?v=".$videos_video;
                            ?>
                            <article class="col-lg-4 col-md-4 col-sm-6">

                                <div class="imagen col-lg-12">
                                    <a class="popup-youtube" href="<?php echo $videos_UrlYoutube; ?>" title="<?php echo $videos_titulo; ?>" >
                                        <img src="<?php echo $videos_UrlImg; ?>" alt="<?php echo $videos_titulo; ?>">
                                    </a>
                                    <div class="titulo">
                                        <h2 class="text">
                                            <a class="popup-youtube" href="<?php echo $videos_UrlYoutube; ?>" title="<?php echo $videos_titulo; ?>" >
                                                <?php echo $videos_titulo; ?>
                                            </a>
                                        </h2>
                                    </div>
                                </div>

                            </article>

                            <?php } ?>

                            <div id="paginacion">
                                <?php $pagination->pagination(); ?>
                            </div>

                        </section>
                        
                    </div>

                    <div class="nwizq col-lg-4 col-md-4 col-sm-5 hidden-xs notawder">

                        <?php require_once("w-portada.php"); ?>

                        <?php require_once("w-idiomas.php"); ?>

                        <?php require_once("w-columnistas.php"); ?>

                        <?php require_once("w-saludos.php"); ?>

                        <?php require_once("w-infografias.php"); ?>
                    
                    </div>

                </section>
                <!-- SECCION SUPERIOR FIN -->

            </div>

        </section>

        <!-- FOOTER -->
        <footer>
            
            <?php require_once("w-footer.php"); ?>

        </footer>
        <!-- FOOTER FIN -->

    </body>
</html>