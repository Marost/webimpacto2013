<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//VARIABLES DE URL
$Req_Id=$_REQUEST["id"];
$Req_Url=$_REQUEST["url"];

//VARIABLES
$header="interno";
$Req_UrlWeb=$web."categoria/".$Req_Id."/".$Req_Url;

//CATEGORIA
$rst_categoria=mysql_query("SELECT * FROM iev_columnista WHERE id=$Req_Id AND url='$Req_Url'", $conexion);
$fila_categoria=mysql_fetch_array($rst_categoria);
$num_categoria=mysql_num_rows($rst_categoria);

if($num_categoria>0){
    //VARIABLES
    $Categoria_titulo=$fila_categoria["nombre_completo"];

    ################################################################
    //PAGINACION DE NOTICIAS
    require("libs/pagination/class_pagination.php");

    //INICIO DE PAGINACION
    $page           = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
    $rst_noticias   = mysql_query("SELECT COUNT(*) as count FROM iev_columnista_columna WHERE columnista=$Req_Id AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC;", $conexion);
    $row            = mysql_fetch_assoc($rst_noticias);
    $generated      = intval($row['count']);
    $pagination     = new Pagination("6", $generated, $page, $Req_UrlWeb."&page", 1, 0);
    $start          = $pagination->prePagination();
    $rst_noticias   = mysql_query("SELECT * FROM iev_columnista_columna WHERE columnista=$Req_Id AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT $start, 6", $conexion);
}else{
    header("Location:/404");
}

?>
<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <title><?php echo $Categoria_titulo; ?></title>

        <!-- PAGINACION -->
        <link rel="stylesheet" href="/libs/pagination/pagination.css" media="screen">

        <?php require_once("w-header-script.php"); ?>

    </head>
    <body class="sub-page">

        <?php require_once("w-header.php"); ?>

        <div class="container">

            <div class="kopa-breadcrumb"></div>
            <!-- kopa-breadcrumb -->

            <div class="row">

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="main-content">
                        <div class="widget kopa-list-posts-widget">

                            <header class="widget-header">
                                <h3 class="widget-title"><?php echo $Categoria_titulo; ?></h3>
                                <i class="fa fa-plus-square-o"></i>
                            </header>

                            <div class="widget-content">
                                <ul class="list-unstyled clearfix">

                                    <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
                                        $noticia_id=$fila_noticias["id"];
                                        $noticia_url=$fila_noticias["url"];
                                        $noticia_titulo=stripslashes($fila_noticias["titulo"]);
                                        $noticia_contenido=soloDescripcion($fila_noticias["contenido"]);
                                        $noticia_imagen=$fila_noticias["imagen"];
                                        $noticia_imagen_carpeta=$fila_noticias["imagen_carpeta"];
                                        $noticia_fechaPub=$fila_noticias["fecha_publicacion"];

                                        //SEPARACION DE FECHA
                                        $fechaPubSep=explode(" ", $noticia_fechaPub);
                                        $fechaSep=explode("-", $fechaPubSep[0]);
                                        $FechaDia=$fechaSep[2];
                                        $FechaMes=mesCorto($fechaSep[1]);
                                        $FechaAnio=$fechaSep[0];

                                        //URLS
                                        $noticia_UrlWeb=$web."noticia/".$noticia_id."-".$noticia_url;
                                        $noticia_UrlImg=$web."imagenes/upload/".$noticia_imagen_carpeta."thumb/".$noticia_imagen;
                                    ?>

                                    <li class="item-outer">
                                        <div class="item">
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
                                                <p></p><?php echo $noticia_contenido; ?></p>
                                                <a href="<?php echo $noticia_UrlWeb; ?>" class="kopa-readmore">Leer más</a>

                                            </div>
                                            <!-- item content -->
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