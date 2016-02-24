<!-- Start Services Icons -->
<div class="row">

    <section id="home">
        <div id="main-slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                <li data-target="#main-slide" data-slide-to="1"></li>
                <li data-target="#main-slide" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/slider/bg1.jpg" alt="slider">
                </div><!--/ Carousel item end -->
                <div class="item">
                    <img class="img-responsive" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/slider/bg2.jpg" alt="slider">
                </div><!--/ Carousel item end -->
                <div class="item">
                    <img class="img-responsive" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/slider/bg3.jpg" alt="slider">
                </div>
            </div>
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
                <span><i class="fa fa-angle-left"></i></span>
            </a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
                <span><i class="fa fa-angle-right"></i></span>
            </a>
        </div>
    </section>


    <!-- Start Service Icon 1 -->
    <div class="col-lg-2"></div>
    <!-- Start Service Icon 2 -->
    <div class="col-md-4 col-sm-6 service-box service-center">
        <div class="service-boxed">
            <div class="service-icon" style="margin-top:-25px;">
                <img alt="" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/tool36.png" />
            </div>
            <div class="service-content">
                <h4>Yerinde Ölçüm</h4>
                <p>İstediğiniz ürünleri,isteğinize uygun boyutlarda ve şekilde olması amacıyla yerinde ölçüm hizmetini sizlere sunmaktayız.</p>
            </div>
        </div>
    </div>
    <!-- Start Service Icon 4 -->
    <div class="col-md-4 col-sm-6 service-box service-center">
        <div class="service-boxed">
            <div class="service-icon" style="margin-top:-25px;">
                <img alt="" src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/tool37.png"/> 
            </div>
            <div class="service-content">
                <h4>Yerinde Montaj</h4>
                <p>İstediğiniz ürünlerin üretimini yaptıkdan sonra kullanmak istediğiniz yere kadar getirip yerinde montajınızı yapmaktayız.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
<!-- Divider -->
<div class="hr1 margin-top"></div>
<!-- Start Recent Projects Carousel -->
<?php
$kSayisi = count($model[1]);
$urunVarmi = array();
$urunVarmiKi = array();
$uSayisi = count($model[0]);
for ($k = 0; $k < $kSayisi; $k++) {
    for ($a = 0; $a < $uSayisi; $a++) {
        if ($model[1][$k]["ID"] == $model[0][$a]["urun_kategori"]) {
            $urunVarmi[$k] ++;
        }
    }
    ?>
    <div class="recent-projects">
        <h4 class="title"><span><?php echo $urunVarmi[$k] != 0 ? $model[1][$k]["ad"] : null; ?></span></h4>
        <div class="projects-carousel touch-carousel">

            <?php
            for ($a = 0; $a < $uSayisi; $a++) {
                if ($model[1][$k]["ID"] == $model[0][$a]["urun_kategori"]) {
                    ?>
                    <div class="portfolio-item item">
                        <div class="portfolio-border">
                            <div class="portfolio-thumb">
                                <a class="lightbox" title="<?php echo $model[0][$a]["urun_aciklama"]; ?>" href="<?php echo SITE_URLUResim . $model[0][$a]["urun_resim"]; ?>">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    <img alt="" src="<?php echo SITE_URLUResim . $model[0][$a]["urun_resim"]; ?>" />
                                </a>
                            </div>
                            <div class="portfolio-details">
                                <a href="#">
                                    <h4><?php echo $model[0][$a]["urun_aciklama"]; ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $urunVarmi++;
                }
            }
            ?>
        </div>
    </div>
<?php } ?>
<!-- End Recent Projects Carousel -->
<div class="hr1 margin-60"></div>

