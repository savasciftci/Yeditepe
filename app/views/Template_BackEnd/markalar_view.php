<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islemmarka.js" type="text/javascript"></script>
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css"></link>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Markalar</h3>
                    </div><!-- /.box-header --> 
                    <div align="right"> 
                        <button type="button" class="btn btn-primary" id="markEkle" title="Yeni Marka Ekle" style="margin-right:25px; padding: 10px">Marka EKLE</button>
                    </div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Marka Adı</th>
                                    <th>Resim Adı</th>
                                    <th>URL</th>
                                    <th>Kategori Tipi</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($k = 0; $k < count($model); $k++) {
                                    ?>
                                    <tr id="uruntable_<?php echo $model[$k]["id"]; ?>">
                                        <td><?php echo $model[$k]["MarkaAdi"]; ?></td>
                                        <td><?php echo $model[$k]["ResimYolu"]; ?></td>
                                        <td><?php echo $model[$k]["url"]; ?></td>
                                        <td id="<?php echo $model[$k]["Tur"]; ?>"><?php echo $model[$k]["Tur"] == 1 ? '<i class="fa fa-check-square-o fa fa-success "></i>  Klima' : '<i class="fa fa-check-square"></i>  Kombi'; ?></td>
                                        <input type="hidden" id="mark_resim" value="<?php echo SITE_URLUResim . $model[$k]["ResimYolu"]; ?>" >
                                        <td>
                                            <a id="markduzenle" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                            <a id="markasil" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
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
    <div id="markEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Marka Ekle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Marka Resmi</label>
                                <input id="fileInput" name="fileInput" class="form-control" type="file" />
                                <div id="fileDisplayArea" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Marka Adı</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="markadii" name="markadii" placeholder="Marka adını giriniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori Turu</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="dmarkakategori" name="dmarkakategori" placeholder="Kategori Seçiniz" required>
                                        <option value="1">Klima</option>
                                        <option  value="2">Kombi</option>
                                    </select>
                                </div>    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Url</label>
                                <div class="col-sm-9">
                                    <input type="text" id="markaurl" class="form-control" name="markaurl" placeholder="Url adresini giriniz" value="" required></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="markEklemeIslemi">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div id="markModal" class="modal fade">
        <div class="modal-dialog">
            <input type="hidden" id="sakliID" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Marka Düzenle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Marka Resmi</label>
                                <div id="ilkresimm" class="col-sm-3">
                                 </div>
                                <input id="fileInputMarkaDuzen" name="fileInputMarkaDuzen" class="form-control" type="file" />
                                <div id="fileDisplayAreaMarka" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Marka Adı</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dmarkadi" name="dmarkadi" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Marka Kategorisi</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="markakategori" name="urunkategori" required>
                                        <option value="-1" selected>Kategori Seçiniz</option>
                                        <option  value="1">Klima</option>
                                        <option  value="2">Kombi</option>
                                    </select>
                                </div>     
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" id="dmarkurl" class="form-control" name="dmarkurl" placeholder="Url" value="" required></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="markDuzenle">Düzenle</button>
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
        grupTable = $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
                {"width": "10%", "targets": 4}
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
