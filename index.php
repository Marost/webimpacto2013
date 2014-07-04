<?php
require_once("panel@impacto/conexion/conexion.php");
require_once("panel@impacto/conexion/funciones.php");

//WIDGETS
$sc_addthis=true;
$sc_royalslider=true;
$sc_galinferior=true;
$sc_videos=true;
$sc_saludos=true;
$sc_slider=true;

//NOTICIA INFERIORES
$rst_noticias=mysql_query("SELECT * FROM iev_noticia WHERE fecha_publicacion<='$fechaActual' AND destacada=2 AND publicar=1 AND categoria=12 ORDER BY fecha_publicacion DESC LIMIT 4", $conexion);

//DEVOCIONALES
$rst_devoc=mysql_query("SELECT * FROM iev_noticia WHERE fecha_publicacion<='$fechaActual' AND destacada=2 AND publicar=1 AND categoria=7 ORDER BY fecha_publicacion DESC LIMIT 1", $conexion);

//EVENTOS
$rst_eventos=mysql_query("SELECT * FROM iev_noticia WHERE fecha_publicacion<='$fechaActual' AND destacada=2 AND publicar=1 AND categoria=8 ORDER BY fecha_publicacion DESC LIMIT 1", $conexion);

//GALERIA
$rst_galeria=mysql_query("SELECT * FROM iev_galeria ORDER BY id DESC LIMIT 4", $conexion);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Impacto Evangelistico</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <?php require_once("w-script.php"); ?>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <header>

            <?php require_once("w-header.php"); ?>
            
        </header>

        <?php require_once("w-slider.php"); ?>

        <section id="news">
            
            <div class="interior">
                
                <!-- SECCION SUPERIOR -->
                <section id="nws">

                    <div class="nwizq">

                        <?php require_once("w-portada.php"); ?>

                        <?php require_once("w-idiomas.php"); ?>

                        <?php require_once("w-columnistas.php"); ?>

                        <?php require_once("w-facebook.php"); ?>
                    
                    </div>

                    <div class="nwder">

                        <section>

                            <h3>NOTICIAS</h3>

                            <?php while($fila_noticias=mysql_fetch_array($rst_noticias)){
                                    $noticias_id=$fila_noticias["id"];
                                    $noticias_url=$fila_noticias["url"];
                                    $noticias_urlFinal=$web."noticia/".$noticias_id."-".$noticias_url;
                                    $noticias_titulo=$fila_noticias["titulo"];
                                    $noticias_imagen=$fila_noticias["imagen"];
                                    $noticias_imagen_carpeta=$fila_noticias["imagen_carpeta"];
                                    $noticias_contenido=primerParrafo($fila_noticias["contenido"]);
                                    $fechaPubNoticia=$fila_noticias["fecha_publicacion"];
                                    $fechaNoticia=explode(" ", $fechaPubNoticia);
                                    $fechaExpNoticia=explode("-", $fechaNoticia[0]);
                                    $noticias_fecha=nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]);
                            ?>

                            <article>

                                <div class="imagen">
                                    <img src="imagenes/upload/<?php echo $noticias_imagen_carpeta."thumb/".$noticias_imagen; ?>" 
                                    alt="<?php echo $noticias_titulo; ?>" width="290" height="220">
                                </div>

                                <div class="datos">
                                    <h2><a href="<?php echo $noticias_urlFinal; ?>" title="<?php echo $noticias_titulo; ?>">
                                        <?php echo $noticias_titulo; ?></a></h2>
                                    <?php echo $noticias_contenido; ?>
                                </div>

                                <div class="fecha_social">
                                    <p><?php echo $noticias_fecha; ?></p>

                                    <!-- COMPARTIR -->
                                    <div class="addthis_toolbox addthis_default_style"
                                        addthis:url="<?php echo $noticias_urlFinal; ?>" addthis:title="<?php echo $noticias_titulo; ?>">
                                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                        <a class="addthis_button_tweet"></a>
                                    </div>
                                </div>
                                
                            </article>

                            <?php } ?>

                        </section>

                        <section>

                            <h3>DEVOCIONALES</h3>

                            <?php while($fila_devoc=mysql_fetch_array($rst_devoc)){
                                    $devoc_id=$fila_devoc["id"];
                                    $devoc_url=$fila_devoc["url"];
                                    $devoc_urlFinal=$web."noticia/".$devoc_id."-".$devoc_url;
                                    $devoc_titulo=$fila_devoc["titulo"];
                                    $devoc_imagen=$fila_devoc["imagen"];
                                    $devoc_imagen_carpeta=$fila_devoc["imagen_carpeta"];
                                    $devoc_contenido=primerParrafo($fila_devoc["contenido"]);
                                    $fechaPubNoticia=$fila_devoc["fecha_publicacion"];
                                    $fechaNoticia=explode(" ", $fechaPubNoticia);
                                    $fechaExpNoticia=explode("-", $fechaNoticia[0]);
                                    $devoc_fecha=nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]);
                            ?>

                            <article>

                                <div class="imagen">
                                    <img src="imagenes/upload/<?php echo $devoc_imagen_carpeta."thumb/".$devoc_imagen; ?>" 
                                    alt="<?php echo $devoc_titulo; ?>" width="290" height="220">
                                </div>

                                <div class="datos">
                                    <h2><a href="<?php echo $devoc_urlFinal; ?>" title="<?php echo $devoc_titulo; ?>">
                                        <?php echo $devoc_titulo; ?></a></h2>
                                    <?php echo $devoc_contenido; ?>
                                </div>

                                <div class="fecha_social">
                                    <p><?php echo $devoc_fecha; ?></p>

                                    <!-- COMPARTIR -->
                                    <div class="addthis_toolbox addthis_default_style"
                                        addthis:url="<?php echo $devoc_urlFinal; ?>" addthis:title="<?php echo $devoc_titulo; ?>">
                                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                        <a class="addthis_button_tweet"></a>
                                    </div>                                  
                                </div>
                                
                            </article>

                            <?php } ?>
                            
                        </section>

                        <section>

                            <h3>EVENTOS</h3>

                            <?php while($fila_eventos=mysql_fetch_array($rst_eventos)){
                                    $eventos_id=$fila_eventos["id"];
                                    $eventos_url=$fila_eventos["url"];
                                    $eventos_urlFinal=$web."noticia/".$eventos_id."-".$eventos_url;
                                    $eventos_titulo=$fila_eventos["titulo"];
                                    $eventos_imagen=$fila_eventos["imagen"];
                                    $eventos_imagen_carpeta=$fila_eventos["imagen_carpeta"];
                                    $eventos_contenido=primerParrafo($fila_eventos["contenido"]);
                                    $fechaPubNoticia=$fila_eventos["fecha_publicacion"];
                                    $fechaNoticia=explode(" ", $fechaPubNoticia);
                                    $fechaExpNoticia=explode("-", $fechaNoticia[0]);
                                    $eventos_fecha=nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]);
                            ?>

                            <article>

                                <div class="imagen">
                                    <img src="imagenes/upload/<?php echo $eventos_imagen_carpeta."thumb/".$eventos_imagen; ?>" 
                                    alt="<?php echo $eventos_titulo; ?>" width="290" height="220">
                                </div>

                                <div class="datos">
                                    <h2><a href="<?php echo $eventos_urlFinal; ?>" title="<?php echo $eventos_titulo; ?>">
                                        <?php echo $eventos_titulo; ?></a></h2>
                                    <?php echo $eventos_contenido; ?>
                                </div>

                                <div class="fecha_social">
                                    <p><?php echo $eventos_fecha; ?></p>

                                    <!-- COMPARTIR -->
                                    <div class="addthis_toolbox addthis_default_style"
                                        addthis:url="<?php echo $eventos_urlFinal; ?>" addthis:title="<?php echo $eventos_titulo; ?>">
                                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                        <a class="addthis_button_tweet"></a>
                                    </div>                                  
                                </div>
                                
                            </article>

                            <?php } ?>
                            
                        </section>
                        
                    </div>

                </section>
                <!-- SECCION SUPERIOR FIN -->

                <!-- SECCION CENTRO -->
                <section id="nwm">
                    <div class="nwizq">

                        <div id="galeria-datos">
                            <h3><span></span>GALERIA DE IMÁGENES</h3>
                            <p><a href="galerias">Más Galerías</a></p>
                        </div>

                        <div id="galeria-contenido" class="royalSlider rsUni">

                            <?php while($fila_galeria=mysql_fetch_array($rst_galeria)){
                                    $galeria_id=$fila_galeria["id"];
                                    $galeria_url=$fila_galeria["url"];
                                    $galeria_titulo=$fila_galeria["titulo"];

                                    //IMAGEN
                                    $rst_galimagen=mysql_query("SELECT * FROM iev_galeria_slide WHERE noticia=$galeria_id ORDER BY orden ASC LIMIT 1;");
                                    $fila_galimagen=mysql_fetch_array($rst_galimagen);

                                    //VARIABLES
                                    $galimagen_imagen=$fila_galimagen["imagen"];
                                    $galimagen_imagen_carpeta=$fila_galimagen["imagen_carpeta"];

                                    //URL
                                    $galeria_UrlWeb=$web."galeria/".$galeria_id."-".$galeria_url;
                                    $galeria_UrlImg=$web."imagenes/galeria/".$galimagen_imagen_carpeta."".$galimagen_imagen;
                                    $galeria_UrlImgThumb=$web."imagenes/galeria/".$galimagen_imagen_carpeta."thumb/".$galimagen_imagen;
                            ?>
                            <div>
                                <img class="rsImg" data-rsbigimg="<?php echo $galeria_UrlImg; ?>" src="<?php echo $galeria_UrlImg; ?>" />
                                <figure class="rsCaption">
                                    <a href="<?php echo $galeria_UrlWeb; ?>" title="<?php echo $galeria_titulo; ?>">
                                        <?php echo $galeria_titulo; ?>
                                    </a>
                                </figure>
                                <img width="96" height="72" class="rsTmb" src="<?php echo $galeria_UrlImgThumb; ?>">
                            </div>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="nwder">
                        <?php require_once("w-saludos.php"); ?>

                        <?php require_once("w-infografias.php"); ?>

                    </div>

                </section>
                <!-- SECCION CENTRO FIN -->

                <!-- SECCION INFERIOR -->
                <section id="nwi">

                    <?php require_once("w-videos.php"); ?>

                </section>
                <!-- SECCION INFERIOR FIN -->

            </div>

        </section>

        <!-- FOOTER -->
        <footer>
            
            <?php require_once("w-footer.php"); ?>

        </footer>
        <!-- FOOTER FIN -->

    </body>
</html>
