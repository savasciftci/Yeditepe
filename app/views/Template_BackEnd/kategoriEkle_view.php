<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kategori Ekle
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-md-6">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profil Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Kategori Ad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategoriAd" name="kategoriAd" value="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Kategori İçerik</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kicerik" name="kicerik"  value="" >
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" id="KategoriEkle" class="btn btn-info pull-right" >Kategori Ekle</button>
                            </div><!-- /.box-footer -->
                    </form>
                </div>
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->