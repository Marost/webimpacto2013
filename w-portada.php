<?php
//EDICION IMPRESA
$rst_edicion=mysql_query("SELECT * FROM iev_edicion WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 1", $conexion);
$fila_edicion=mysql_fetch_array($rst_edicion);

//VARIABLES
$edicion_id=$fila_edicion["id"];
$edicion_url=$fila_edicion["url"];
$edicion_titulo=$fila_edicion["titulo"];
$edicion_imagen=$fila_edicion["imagen"];
$edicion_imagen_carpeta=$fila_edicion["carpeta_imagen"];
?>
<aside class="col-lg-12 col-md-11 col-sm-11">

    <div class="edimpreso col-xs-12">
        
        <div class="datos col-xs-3">
            <h3>Edición del mes</h3>
            <h3 class="numedicion">N° <?php echo $edicion_titulo; ?></h3>
        </div>

        <div class="imagen col-xs-8">
            <a href="<?php echo $edicion_url; ?>" title="<?php echo $edicion_titulo; ?>" target="_blank">
                <img class="col-xs-12" src="imagenes/revista/<?php echo $edicion_imagen_carpeta."".$edicion_imagen; ?>" alt="<?php echo $edicion_titulo; ?>" width="185">
            </a>
        </div>

    </div>

    <div class="edanterior col-xs-12">
        <h3><a href="edicion-anterior-es">
            EDICIONES ANTERIORES
            </a>
        </h3>
    </div>
    
</aside>