<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islemvitrin.js" type="text/javascript"></script>
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
                        <button type="button" class="btn btn-primary" id="vitrinEkle" title="Yeni Vitrin Ekle" style="margin-right:25px; padding: 10px">Vitrin EKLE</button>
                    </div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Vitrin Resim</th>
                                    <th>Sıra</th>
                                    <th>Url</th>
                                    <th>Aktiflik</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody id="vitrintbody">
                                <?php
                                for ($k = 0; $k < count($model); $k++) {
                                    ?>
                                    <tr id="uruntable_<?php echo $model[$k]["VitrinID"]; ?>">
                                        <td><?php echo $model[$k]["VitrinResim"]; ?></td>
                                        <td><?php echo $model[$k]["Sira"]; ?></td>
                                        <td><?php echo $model[$k]["url"]; ?></td>
                                        <td id="<?php echo $model[$k]["Aktiflik"]; ?>"><?php echo $model[$k]["Aktiflik"] == 1 ? '<i class="fa fa-check-square-o fa fa-success "></i>  Aktif' : '<i class="fa fa-times"></i>  Pasif'; ?></td>
                                        <input type="hidden" id="mark_resim" value="<?php echo SITE_URLUResim . $model[$k]["ResimYolu"]; ?>" >
                                        <td>
                                            <a id="vitrinduzenle" value="<?php echo $model[$k]["VitrinID"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                            <a id="vitrinsil" value="<?php echo $model[$k]["VitrinID"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
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
    <div id="vitrinEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Vitrin Ekle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Vitrin Resmi</label>
                                <input id="fileInput" name="fileInput" class="form-control" type="file" />
                                <div id="fileDisplayArea" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Sıra</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="sirasii" name="markadii" placeholder="Sırasını belirleyiniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Aktiflik Durumu</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="vitrinkategori" name="dmarkakategori" placeholder="Kategori Seçiniz" required>
                                        <option value="1">Aktif</option>
                                        <option  value="0">Pasif</option>
                                    </select>
                                </div>    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Url</label>
                                <div class="col-sm-9">
                                    <input type="text" id="vitrinurl" class="form-control" name="markaurl" placeholder="Url adresini giriniz" value="" required></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="vitrinEklemeIslemi">Ekle</button>
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
                    <h4 class="modal-title">Vitrin Düzenle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="urunresim">Vitrin Resmi</label>
                                <div id="ilkresimm" class="col-sm-3">
                                 </div>
                                <input id="fileInputMarkaDuzen" name="fileInputMarkaDuzen" class="form-control" type="file" />
                                <div id="fileDisplayAreaMarka" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Sırası</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="dvitrinsirasi" name="dvitrinsirasi" placeholder="Ürün ile ilgili açıklamanızı giriniz" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Durumu</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="dvitrinkategori" name="vitrinkategori" required>
                                        <option value="-1" selected>Durum Seçiniz</option>
                                        <option  value="1">Aktif</option>
                                        <option  value="0">Pasif</option>
                                    </select>
                                </div>     
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" id="dvitrinurl" class="form-control" name="dmarkurl" placeholder="Url" value="" required></input>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="vitrinDuzenle">Düzenle</button>
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
