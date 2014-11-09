<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//VARIABLES
$header="interno";
$Req_UrlWeb=$web."galerias";

################################################################
//PAGINACION DE NOTICIAS
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page           = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_noticias   = mysql_query("SELECT COUNT(*) as count FROM iev_galeria WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC;", $conexion);
$row            = mysql_fetch_assoc($rst_noticias);
$generated      = intval($row['count']);
$pagination     = new Pagination("10", $generated, $page, $Req_UrlWeb."?page", 1, 0);
$start          = $pagination->prePagination();
$rst_noticias   = mysql_query("SELECT * FROM iev_galeria WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT $start, 10", $conexion);

?>
<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Galería de Fotos</title>

        <!-- PAGINACION -->
        <link rel="stylesheet" href="/libs/pagination/pagination.css" media="screen">

        <?php require_once("w-header-script.php"); ?>

    </head>
    <body class="sub-page">

        <?php require_once("w-header.php"); ?>

        <div class="container">
            <?php require_once("w-saludos-formulario.php"); ?>

            <div class="kopa-breadcrumb"></div>
            <!-- kopa-breadcrumb -->

            <div class="row">

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="main-content">
                        <div class="widget kopa-list-posts-widget">

                            <header class="widget-header">
                                <h3 class="widget-title">Galería de Fotos</h3>
                            </header>

                            <div class="widget-content">
                                <ul class="list-unstyled clearfix">

                                    <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
                                        $noticia_id=$fila_noticias["id"];
                                        $noticia_url=$fila_noticias["url"];
                                        $noticia_titulo=stripslashes($fila_noticias["titulo"]);
                                        $noticia_contenido=soloDescripcion($fila_noticias["contenido"]);
                                        $noticia_fechaPub=$fila_noticias["fecha_publicacion"];

                                        //SEPARACION DE FECHA
                                        $fechaPubSep=explode(" ", $noticia_fechaPub);
                                        $fechaSep=explode("-", $fechaPubSep[0]);
                                        $FechaDia=$fechaSep[2];
                                        $FechaMes=mesCorto($fechaSep[1]);
                                        $FechaAnio=$fechaSep[0];

                                        //FOTOS
                                        $rst_notFotos=mysql_query("SELECT * FROM iev_galeria_slide WHERE noticia=$noticia_id AND orden=0", $conexion);
                                        $fila_notFotos=mysql_fetch_array($rst_notFotos);
                                        $noticia_imagen=$fila_notFotos["imagen"];
                                        $noticia_imagen_carpeta=$fila_notFotos["imagen_carpeta"];

                                        //URLS
                                        $noticia_UrlWeb=$web."galeria/".$noticia_id."-".$noticia_url;
                                        $noticia_UrlImg=$web."imagenes/galeria/".$noticia_imagen_carpeta."thumb/".$noticia_imagen;
                                    ?>

                                    <li class="item-outer">
                                        <div class="item">
                                            <div class="item-inner  clearfix">
                                                <div class="post-thumb pull-left">
                                                <a href="<?php echo $noticia_UrlWeb; ?>" class="img-responsive">
                                                    <img class="lazy" data-original="<?php echo $noticia_UrlImg; ?>" src="<?php echo $noticia_UrlImg; ?>" alt="">
                                                </a>
                                                <div class="kopa-date-box">
                                                    <span class="kopa-mon"><?php echo $FechaMes; ?></span>
                                                    <span class="kopa-day"><?php echo $FechaDia; ?></span>
                                                    <span class="kopa-yea"><?php echo $FechaAnio; ?></span>
                                                </div>
                                            </div>
                                            <!-- post thumb -->
                                            <div class="item-content item-right">
                                                <h4 class="post-title">
                                                    <a href="<?php echo $noticia_UrlWeb; ?>"><?php echo $noticia_titulo; ?></a>
                                                </h4>
                                                <div class="kopa-metadata-border">
                                                    <span class="kopa-rate">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </span>
                                                </div>
                                                <!-- metadata -->
                                                <p><?php echo $noticia_contenido; ?></p>
                                                <a href="<?php echo $noticia_UrlWeb; ?>" class="kopa-readmore">Leer más</a>
                                            </div>
                                            <!-- item content -->
                                            </div>
                                            <!-- item inner -->
                                        </div>
                                        <!-- item -->
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>
                            <!-- widget content -->

                            <div id="paginacion">
                                <?php $pagination->pagination(); ?>
                            </div>
                            <!-- PAGINACION -->

                        </div>
                        <!-- kopa-list-posts-widget -->

                    </div>
                    <!-- main content -->

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                    <div id="sidebar" class="widget-area-26">

                        <?php require_once("w-portada.php"); ?>

                        <?php require_once("w-galeria-fotos.php"); ?>

                    </div>
                    <!-- sidebar -->

                </div>

            </div>
            <!-- row -->

        </div>
        <!-- container -->

        <?php require_once("w-footer.php"); ?>

        <?php require_once("w-footer-script.php"); ?>

    </body>
</html>