<?php
if(isset($header)){
    if($header=="home"){
        $header_class="header-1";
        $ocultar="dpnone";
        $mostrar="";
        $cambioMB="middle";
    }elseif($header=="interno"){
        $header_class="header-2";
        $ocultar="";
        $mostrar="dpnone";
        $cambioMB="bottom";
    }
}
?>
<header id="kopa-header" class="<?php echo $header_class; ?>">

    <div class="kopa-header-top">
        <div class="container">
            <div class="menu-second pull-left">
                <ul class="list-unstyled clearfix">
                    <li><a href="#">Contactos</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
            <div class="kopa-social pull-right">
                <a href="#" class="fa fa-pinterest"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-youtube"></a>
            </div>
            <!-- social -->
        </div>
    </div>
    <!-- kopa header top -->

    <div class="kopa-header-middle <?php echo $ocultar; ?>">
        <div class="container">

            <div class="kopa-logo pull-left">
                <a href="/"><img src="imagenes/logo.png" alt=""></a>
            </div>
            <!-- logo -->

            <div class="kopa-baner pull-right">
                <a href="#"><img src="placeholders/ads/3.jpg" alt=""></a>
            </div>
            <!-- banner -->

        </div>
        <!-- container -->
    </div>
    <!-- kopa header -->

    <div class="kopa-header-<?php echo $cambioMB; ?>">
        <div class="container">

            <div class="kopa-logo <?php echo $mostrar; ?>">
                <a href="#"><img src="imagenes/logo.png" alt=""></a>
            </div>
            <!-- logo -->

            <div class="main-menu">
                <span class="mobile-menu-icon fa fa-align-justify"></span>
                <ul class="kopa-menu sf-menu">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#">Noticias</a>
                        <ul>
                            <li><a href="#">Noticias 1</a></li>
                            <li><a href="#">Noticias 1</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Internacional</a></li>
                    <li><a href="#">Economía</a></li>
                    <li><a href="#">Literatura</a></li>
                    <li><a href="#">Testimonios</a></li>
                    <li><a href="#">Héroes de la Fe</a></li>
                    <li><a href="#">Eventos</a></li>
                </ul>

                <ul class="kopa-menu mobile-menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#">Noticias</a></li>
                    <li><a href="#">Internacional</a></li>
                    <li><a href="#">Economía</a></li>
                    <li><a href="#">Literatura</a></li>
                    <li><a href="#">Testimonios</a></li>
                    <li><a href="#">Héroes de la Fe</a></li>
                    <li><a href="#">Eventos</a></li>
                </ul>
            </div>
            <!-- main-menu -->
        </div>
        <!-- container -->
    </div>
    <!-- kopa header -->

    <?php if(isset($mostrar)){ if($mostrar==""){ ?>
    <div class="kopa-header-bottom">
        <?php }} ?>

        <div class="kopa-head-line clearfix">
            <div class="container">

                <?php if(isset($mostrar)){ if($mostrar==""){ ?>
                    <div class="kopa-list-news-carousel-widget">
                        <h3 class="widget-title">&nbsp</h3>
                    </div>
                <?php }} ?>

                <!-- widget news carousel -->
                <div class="kopa-search-box">
                    <form action="/" method="post" class="search-form">
                        <input type="text"  name="search-text" onBlur="if (this.value == '')
                                        this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
                                        this.value = '';" value="Buscar" >
                        <span class="fa fa-search"></span>
                        <button type="submit" class="fa fa-search"></button>
                    </form>
                </div>
                <!-- search box -->

            </div>
            <!-- container -->

        </div>
        <!-- kopa head line -->

        <?php if(isset($mostrar)){ if($mostrar==""){ ?>
    </div><!-- kopa header -->
<?php }} ?>

</header>
<!-- page header -->


