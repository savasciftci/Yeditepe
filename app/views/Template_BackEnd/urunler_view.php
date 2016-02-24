<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css"></link>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ürünler</h3>
                    </div><!-- /.box-header --> 
                    <div align="right"> 
                        <button type="button" class="btn btn-primary" id="urunEkle" title="Yeni Ürün Ekle" style="margin-right:25px; padding: 10px">Ürün EKLE</button>
                    </div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Ürün Açıklama</th>
                                    <th>Ürün Fiyat</th>
                                    <th>Ürün Kategori</th>
                                    <th>Ürün Eklenme Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($k = 0; $k < count($model[0]); $k++) {
                                    ?>
                                    <tr id="uruntable_<?php echo $model[0][$k]["urun_id"]; ?>">
                                        <td><?php echo $model[0][$k]["urun_aciklama"]; ?></td>
                                        <td><?php echo $model[0][$k]["urun_fiyat"]; ?></td>
                                        <td value="<?php echo $model[0][$k]["urun_kategori"]; ?>">      <?php
                                            $miktar = count($model[1]);
                                            for ($a = 0; $a < $miktar; $a++) {
                                                ?>
                                                <?php echo $model[0][$k]["urun_kategori"] == $model[1][$a]["ID"] ? $model[1][$a]["ad"] : NULL; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $model[0][$k]["urun_tarih"]; ?>
                                        </td>
                                <input type="hidden" id="urun_resim" value="<?php echo SITE_URLUResim . $model[0][$k]["urun_resim"]; ?>" >
                                    <td>
                                        <a id="uduzenle" value="<?php echo $model[0][$k]["urun_id"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                        <a id="usil" value="<?php echo $model[0][$k]["urun_id"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
                                    </td>
                                    </tr>
                                <?php } ?>
                                </tbody>                               
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
    <div id="urunEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ürün Ekle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Ürün Resmi</label>
                                <input id="fileInput" name="fileInput" class="form-control" type="file" />
                                <div id="fileDisplayArea" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ürün Açıklaması</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edurunAciklama" name="durunAciklama" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ürün Kategorisi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="edurunKategori" name="durunKategori" required>
                                        <option value="-1" selected>Kategori Seçiniz</option>
                                        <?php
                                        $miktar = count($model[1]);
                                        for ($k = 0; $k < $miktar; $k++) {
                                            ?>
                                            <option  value="<?php echo $model[1][$k]["ID"]; ?>"><?php echo $model[1][$k]["ad"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Fiyat</label>
                                <div class="col-sm-9">
                                    <input type="text" id="edurunFiyat" class="form-control" name="durunFiyat" placeholder="Fiyat" value="" required></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="urunEklemeIslemi">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div id="urunModal" class="modal fade">
        <div class="modal-dialog">
            <input type="hidden" id="sakliID" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Ürün Düzenle</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="urunresim">Ürün Resmi</label>
                                    <input id="resimGuncelle" name="resimGuncelle" class="form-control" type="file" />
                                    <div id="dosyaAlani" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Açıklaması</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="durunAciklama" name="durunAciklama" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Kategorisi</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="urunkategori" name="urunkategori" required>
                                            <option value="-1" selected>Kategori Seçiniz</option>
                                            <?php
                                            $miktar = count($model[1]);
                                            for ($k = 0; $k < $miktar; $k++) {
                                                ?>
                                                <option  value="<?php echo $model[1][$k]["ID"]; ?>"><?php echo $model[1][$k]["ad"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>     
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Fiyat</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="durunFiyat" class="form-control" name="durunFiyat" placeholder="Fiyat" value="" required></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-primary" id="urunDuzenle">Düzenle</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div><!-- /.content-wrapper -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- jQuery 2.1.4 --> 
<script src="<?php echo SITE_BACK_ASSETS_PLUGINS; ?>/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo SITE_BACK_ASSETS_PLUGINS; ?>/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SITE_BACK_ASSETS_PLUGINS; ?>/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SITE_BACK_ASSETS_DISTJS; ?>/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo SITE_BACK_ASSETS_DISTJS; ?>/demo.js"></script>
<!-- Bootstrap 3.3.5 -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
