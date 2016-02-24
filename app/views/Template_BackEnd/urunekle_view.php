<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ürünler
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- right column -->
            <div class="col-sm-6">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ürün Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Resim</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="urunresim" name="urunresim" placeholder="Ürün Resmi Seçiniz" value="" required>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Açıklaması</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="urunaciklama" name="urunaciklama" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Kategorisi</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="urunkategori" name="urunkategori" placeholder="Kategori Seçiniz" required>
                                            <option value="-1">Kategori Seçiniz</option>
                                             <?php
                                    $miktar = count($model);
                                    for ($k = 0; $k < $miktar; $k++) {
                                        ?>
                                            <option  value="<?php echo $model[$k]["ID"]; ?>"><?php echo $model[$k]["ad"]; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Fiyat</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="urunfiyat" class="form-control" name="urunfiyat" placeholder="Fiyat" value="" required></input>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" id="urunekle" class="btn btn-info pull-right" >Ürün Ekle</button>
                            </div><!-- /.box-footer -->
                        </form>
                </div>
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->