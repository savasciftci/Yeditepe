<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
        <section class="content">
        <div class="row">
            
    <section class="content-header">
        <div style="text-align: center ">
            <h1>
                <big>Akzer Mobilya</big> 
                <big style="">Kontrol Paneli</big>
            </h1>
        </div>    
    </section>

    <div class="col-lg-4 col-sm-6 col-xs-12" style="margin-top: 50px">
        <!-- small box -->
        
            <div class="small-box bg-yellow">
                <div style="text-align: center" class="inner">
                    <p style="font-size: 26px">ÜRÜNLER</p>
                    <h3><?php echo $model[0];?></h3>
                </div>
                <a href="<?php echo SITE_URLA; ?>/Urunler" class="small-box-footer">Ürünlere Git<i class="fa fa-arrow-circle-right"></i></a>
            </div>
       
    </div><!-- ./col -->

    <div class="col-lg-4 col-sm-6 col-xs-12" style="margin-top: 50px">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div style="text-align: center" class="inner">
                <p style="font-size: 26px">KATEGORİLER</p>
                <h3><?php echo $model[1];?></h3>
            </div>
            <a href="<?php echo SITE_URLA; ?>/Kategoriler" class="small-box-footer">Kategorilere Git <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        
    </div><!-- ./col -->

    <div class="col-lg-4 col-sm-6 col-xs-12" style="margin-top: 50px">
        <!-- small box -->
        <div class="small-box bg-yellow" >
            <div style="text-align: center"class="inner">
                <p style="font-size: 26px">Genel Ayarlar</p>
                 <h3>1</h3>
            </div>
            <a href="<?php echo SITE_URLA; ?>/GenelAyarlar" class="small-box-footer">Genel Ayarlara Git <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
       </div>   <!-- /.row -->
    </section>
</div><!-- /.content-wrapper -->