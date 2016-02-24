<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
    <head>
        <!-- Basic -->
    <title>Akzer Mobilya</title>
    <link rel="shortcut icon" href="<?php echo SITE_FRONT_ASSETS_DISTIMG;?>/favicon.ico">
    <meta charset="utf-8">
    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Page Description and Author -->
    <meta name="description" content="Akzer mobilya,kayseri mobilya,akzer,mobilya">
    <meta name="author" content="BAYSS">
    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/bootstrap.min.css" type="text/css" media="screen">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/font-awesome.min.css" type="text/css" media="screen" />
        <!-- Margo CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/style.css" media="screen"/>
        <!-- Responsive CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/responsive.css" media="screen"/>
        <!-- Css3 Transitions Styles  -->
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/animate.css" media="screen"/>
        <!-- Color CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_FRONT_ASSETS_DISTCSS; ?>/colors/blue.css" title="blue" media="screen" />


        <!-- Margo JS  -->
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.migrate.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/modernizrr.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.fitvids.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/nivo-lightbox.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.appear.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/count-to.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.textillate.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.lettering.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.easypiechart.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/jquery.parallax.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/script.js"></script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/app.js"></script>
        <script>
            var SITE_URL = "http://localhost/BadoFramework";
            function reset() {
                alertify.set({
                    labels: {
                        ok: "Tamam",
                        cancel: "Kapat"
                    },
                    delay: 3000,
                    buttonReverse: false,
                    buttonFocus: "ok"
                });
            }
        </script>
        <script type="text/javascript" src="<?php echo SITE_FRONT_ASSETS_DISTJS; ?>/frontIslem.js"></script>
  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <!-- Container -->
 <div>       
    <div id="container">
        <!-- Start Header -->
        <div class="hidden-header"></div>
        <header class="clearfix">
            <!-- Start Header ( Logo & Naviagtion ) -->
            <div class="navbar navbar-default navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Stat Toggle Nav Link For Mobiles -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- End Toggle Nav Link For Mobiles -->
                        <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><img alt="" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/margo.png"></a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <!-- Start Navigation List -->
                        <ul id="mainMenu" class="nav navbar-nav navbar-right">
                            <li>
                                <a id="anasayfa" class="active" href="<?php echo SITE_URL; ?>">ANASAYFA</a>
                            </li>
                            <li>
                                <a id="hakkimizda" href="<?php echo SITE_URL; ?>/home/hakkimizda">HAKKIMIZDA</a>
                            </li>
                            <li>
                                <a id="urunlerimiz" href="">ÜRÜNLERİMİZ</a>
                                <form action="<?php echo SITE_URL; ?>/home/urunler" style="cursor:pointer">
                                    <ul class="dropdown">
                                        <?php
                                        $kSayisi = count($model);
                                        for ($k = 0; $k < $kSayisi; $k++) {
                                            ?>
                                            <li>
                                                <a class="urunIslem" id ="<?php echo $model[$k]["ID"]; ?>" ><?php echo $model[$k]["ad"] ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </form>
                            </li>
                            <li>
                                <a id="iletisim" href="<?php echo SITE_URL; ?>/home/iletisim">İLETİŞİM</a>
                            </li>
                        </ul>
                        <!-- End Navigation List -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->
        <!-- Bu divin kapanışı footer_view.php'nin en başında -->
        <div class="container" style='padding-top: 20px;'>