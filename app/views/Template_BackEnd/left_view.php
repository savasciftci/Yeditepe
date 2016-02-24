<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if (Session::get("presim")) { ?>
                    <img src="<?php echo SITE_PROFILRESIM; ?>/<?php echo Session::get("presim"); ?>" class="img-circle" alt="User Image">
                <?php } else { ?>
                    <img src="<?php echo SITE_BACK_ASSETS_DISTIMG; ?>/user2-160x160.jpg" class="img-circle" alt="User Image">
                <?php } ?> 
            </div>
            <div class="pull-left info">
                <p><?php echo Session::get("kadi"); ?></p>
                <a href="<?php echo SITE_URLA; ?>/Profil"><i class="fa fa-circle text-success"></i> Profil</a>
            </div>
        </div>
        <!-- search form -->
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo SITE_URLA; ?>/Urunler">
                    <i class="fa fa-dashboard"></i> <span>ÜRÜNLER</span> <i class=" pull-right"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_URLA; ?>/Kategoriler">
                    <i class="fa fa-dashboard"></i> <span>KATEGORİLER</span> <i class=" pull-right"></i>
                </a>
            </li>
            <li><a href="<?php echo SITE_URLA; ?>/GenelAyarlar"><i class="fa fa-cog"></i> <span>GENEL AYARLAR</span></a></li>
        </ul>
    </section>
</aside>
