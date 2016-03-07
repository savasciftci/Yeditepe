<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islemmahalle.js" type="text/javascript"></script>
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css"></link>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Mahalleler</h3>
                    </div><!-- /.box-header --> 
                    <div align="right"> 
                        <button type="button" class="btn btn-primary" id="mahallEkle" title="Yeni Mahalle Ekle" style="margin-right:25px; padding: 10px">Mahalle EKLE</button>
                    </div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Mahalle Adı</th>
                                    <th>Bağlı Olduğu Semt Adı</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($k = 0; $k < count($model[0]); $k++) {
                                    ?>
                                    <tr id="uruntable_<?php echo $model[0][$k]["id"]; ?>">
                                        <td><?php echo $model[0][$k]["MahalleAdi"]; ?></td>
                                        <td value="<?php echo $model[0][$k]["SemtID"]; ?>">      <?php
                                            $miktar = count($model[1]);
                                            for ($a = 0; $a < $miktar; $a++) {
                                                ?>
                                                <?php echo $model[0][$k]["SemtID"] == $model[1][$a]["id"] ? $model[1][$a]["SemtAdi"] : NULL; ?>
                                            <?php } ?>
                                        </td>
                                
                                    <td>
                                        <a id="uduzenle" value="<?php echo $model[0][$k]["id"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                        <a id="mahsil" value="<?php echo $model[0][$k]["id"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
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
    <div id="mahalEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Mahalle Ekle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mahalle Adı</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mahalad" name="durunAciklama" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Semt Adı</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="semtadii" name="semtadii" required>
                                        <option value="-1" selected>Semt Seçiniz</option>
                                        <?php
                                        $miktar = count($model[1]);
                                        for ($k = 0; $k < $miktar; $k++) {
                                            ?>
                                            <option  value="<?php echo $model[1][$k]["id"]; ?>"><?php echo $model[1][$k]["SemtAdi"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>    
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="mahalEklemeIslemi">Ekle</button>
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
                        <h4 class="modal-title">Mahalle Düzenle</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mahalle Adi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="dmahalAciklama" name="durunAciklama" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mahallenin Semti</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" id="mahalkategori" name="semtadii" required>
                                        <option value="-1" selected>Semt Seçiniz</option>
                                        <?php
                                        $miktar = count($model[1]);
                                        for ($k = 0; $k < $miktar; $k++) {
                                            ?>
                                            <option  value="<?php echo $model[1][$k]["id"]; ?>"><?php echo $model[1][$k]["SemtAdi"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>      
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-primary" id="mahalduzenle">Düzenle</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div><!-- /.content-
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
        grupTable = $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
                {"width": "10%", "targets": 2}
            ]
        });
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
