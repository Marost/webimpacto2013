<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//VARIABLES DE URL
$id_url=$_REQUEST["id"];
$url=$_REQUEST["url"];
$url_web=$web."edicion-anterior-".$url;

//WIDGETS
$sc_addthis=true;
$sc_galinferior=false;
$sc_videos=false;
$sc_saludos=true;
$sc_slider=false;

/* PREFIJO EDICIONES ANTERIORES - IDIOMAS */
if($url=="es"){ $pr=""; $title="Edición anterior: Español"; }
elseif($url=="en"){ $pr="_en"; $title="Previous Edition: English"; }
elseif($url=="pr"){ $pr="_pr"; $title="Edição Anterior: Portugues"; }
elseif($url=="it"){ $pr="_it"; $title="Edizione Precedente: Italiana"; }
elseif($url=="fr"){ $pr="_fr"; $title="Édition précédente: Frances"; }
elseif($url=="al"){ $pr="_al"; $title="Vorherigen Ausgabe: Deutsch"; }
elseif($url=="ch"){ $pr="_ch"; $title="前一版：中國"; }

################################################################
//PAGINACION DE NOTICIAS
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page           = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_noticias   = mysql_query("SELECT COUNT(*) as count FROM iev_edicion$pr WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC;", $conexion);
$row            = mysql_fetch_assoc($rst_noticias);
$generated      = intval($row['count']);
$pagination     = new Pagination("12", $generated, $page, $url_web."&page", 1, 0);
$start          = $pagination->prePagination();
$rst_noticias   = mysql_query("SELECT * FROM iev_edicion$pr WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT $start, 12", $conexion);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <base href="<?php echo $web; ?>">

        <!-- PAGINACION -->
        <link rel="stylesheet" href="/libs/pagination/pagination.css" media="screen">

        <?php require_once("w-script.php"); ?>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <header id="interno">

            <?php require_once("w-header.php"); ?>
            
        </header>

        <section id="news">
            
            <div class="container">
                
                <!-- SECCION SUPERIOR -->
                <section id="edicion-anterior" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <section class="categoria col-lg-8 col-md-8 col-sm-9 col-xs-12">

                        <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
                                $noticia_id=$fila_noticias["id"];
                                $noticia_url=$fila_noticias["url"];
                                $noticia_nombre=$fila_noticias["nombre_edicion"];
                                $noticia_imagen=$fila_noticias["imagen"];
                                $noticia_imagen_carpeta=$fila_noticias["carpeta_imagen"];
                                $noticia_fechatotal=explode(" ", $fila_noticias["fecha_publicacion"]);
                                $noticia_fechapub=explode("-", $noticia_fechatotal[0]);

                                //URL
                                $noticia_urlImg=$web."imagenes/revista/".$noticia_imagen_carpeta."".$noticia_imagen;
                        ?>

                        <article class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <a href="<?php echo $noticia_url; ?>" target="_blank">
                                <img src="<?php echo $noticia_urlImg; ?>" alt="<?php echo $noticia_nombre; ?>" width="130">
                            </a>

                        </article>

                        <?php } ?>

                    </section>

                </section><!-- SECCION SUPERIOR FIN -->

                <div id="paginacion">
                    <?php $pagination->pagination(); ?>
                </div><!-- PAGINACION FIN -->

            </div>

        </section>

        <!-- FOOTER -->
        <footer>
            
            <?php require_once("w-footer.php"); ?>

        </footer>
        <!-- FOOTER FIN -->

    </body>
</html>
