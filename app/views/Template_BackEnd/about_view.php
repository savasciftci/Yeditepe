<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islemabout.js" type="text/javascript"></script>
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css"></link>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vitrin</h3>
                    </div><!-- /.box-header --> 
                    <div align="right"> 
                        <button type="button" class="btn btn-primary" id="aboutEkle" title="Yeni Hakkımızda Menüsü Ekle" style="margin-right:25px; padding: 10px">EKLE</button>
                    </div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Ekran Resim</th>
                                    <th>Başlık</th>
                                    <th>Alt Başlık</th>
                                    <th>İçerik</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($k = 0; $k < count($model); $k++) {
                                    ?>
                                    <tr id="uruntable_<?php echo $model[$k]["id"]; ?>">
                                        <td><?php echo $model[$k]["resim"]; ?></td>
                                        <td><?php echo $model[$k]["baslik"]; ?></td>
                                        <td><?php echo $model[$k]["altbaslik"]; ?></td>
                                        <td><?php echo $model[$k]["icerik"]; ?></td>

                                <input type="hidden" id="mark_resim" value="<?php echo SITE_URLUResim . $model[$k]["ResimYolu"]; ?>" >
                                <td>
                                    <a id="aboutduzenle" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                    <a id="aboutsil" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
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
    <div id="aboutEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hakkımızda İçeriği Ekle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Ekran Resmi</label>
                                <input id="fileInput" name="fileInput" class="form-control" type="file" />
                                <div id="fileDisplayArea" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Başlık</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ebaslik" name="ebaslik" placeholder="Başlık giriniz.." value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alt Baslık</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ealtbaslik" name="ealtbaslik" placeholder="Alt başlık giriniz.." value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">İçerik</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="15" id="eicerik" ></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="aboutEklemeIslemi">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div id="aboutModal" class="modal fade">
        <div class="modal-dialog">
            <input type="hidden" id="sakliID" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hakkımızda İçeriğini Düzenle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Hakkımızda Resmi</label>
                                <div id="ilkresimm" class="col-sm-3">
                                </div>
                                <input id="fileInputMarkaDuzen" name="fileInputMarkaDuzen" class="form-control" type="file" />
                                <div id="fileDisplayAreaMarka" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Başlık</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dbaslik" name="dbaslik"  value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Alt Baslık</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="daltbaslik" name="daltbaslik" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">İçerik</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="15" id="dicerik" ></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="aboutDuzenleİslemi">Düzenle</button>
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
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
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
                {"width": "60%", "targets": 3}
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
