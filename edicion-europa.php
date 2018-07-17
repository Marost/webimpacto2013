<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//VARIABLES
$header="interno";
$Req_UrlWeb=$web."edicion-europa";

//CATEGORIA
$rst_edAnterior=mysql_query("SELECT * FROM iev_edicion_europa", $conexion);
$fila_edAnterior=mysql_fetch_array($rst_edAnterior);
$num_edAnterior=mysql_num_rows($rst_edAnterior);

if($num_edAnterior>0){
    //VARIABLES
    $Categoria_titulo='Edición Europa';

    ################################################################
    //PAGINACION DE NOTICIAS
    require("libs/pagination/class_pagination.php");

    //INICIO DE PAGINACION
    $page           = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
    $rst_noticias   = mysql_query("SELECT COUNT(*) as count FROM iev_edicion_europa ORDER BY fecha_publicacion DESC;", $conexion);
    $row            = mysql_fetch_assoc($rst_noticias);
    $generated      = intval($row['count']);
    $pagination     = new Pagination("12", $generated, $page, $Req_UrlWeb."&page", 1, 0);
    $start          = $pagination->prePagination();
    $rst_noticias   = mysql_query("SELECT * FROM iev_edicion_europa ORDER BY fecha_publicacion DESC LIMIT $start, 12", $conexion);
}else{
    header("Location:/404");
}

?>
<!DOCTYPE html>
<html lang="es" class="no-js">
    <head>
        <meta charset="utf-8">
        <title><?php echo $Categoria_titulo; ?> | <?php echo $web_nombre; ?></title>

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

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="main-content">
                        <div class="widget kopa-list-posts-widget">

                            <header class="widget-header">
                                <h3 class="widget-title"><a href="#" title="Sección <?php echo $Categoria_titulo; ?>"><?php echo $Categoria_titulo; ?></a></h3>
                            </header>

                            <div id="edicion-anterior" class="widget-content col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <section class="categoria col-lg-8 col-md-8 col-sm-9 col-xs-12">
                                
                                    <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
                                        $noticia_id=$fila_noticias["id"];
                                        $noticia_url=$fila_noticias["url"];
                                        $noticia_titulo=stripslashes($fila_noticias["titulo"]);
                                        $noticia_imagen=$fila_noticias["imagen"];
                                        $noticia_fechaPub=$fila_noticias["fecha_publicacion"];

                                        //URLS
                                        $noticia_UrlWeb=$web."noticia/".$noticia_id."-".$noticia_url;
                                        $noticia_UrlImg=$web."imagenes/revista/".$noticia_imagen;
                                    ?>

                                    <article class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <a href="<?php echo $noticia_url; ?>" target="_blank">
                                            <img class="lazy" data-original="<?php echo $noticia_UrlImg; ?>" src="<?php echo $noticia_UrlImg; ?>" alt="<?php echo $noticia_titulo; ?>" width="130">
                                        </a>
                                    </article>

                                    <?php } ?>

                                </section>

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

            </div>
            <!-- row -->

        </div>
        <!-- container -->

        <?php require_once("w-footer.php"); ?>

        <?php require_once("w-footer-script.php"); ?>

    </body>
</html>