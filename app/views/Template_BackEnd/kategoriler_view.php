<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>

<style type="text/css">
    .well { background: #fff; text-align: center; }
    .modal { text-align: left; }
</style>
<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Kategoriler</h3>
                        </div><!-- /.box-header -->  <div align="right"> <button type="button" class="btn btn-primary" id="katEkle" title="Yeni Kategori Ekle" style="margin-right:25px; padding: 10px">Kategori EKLE</button></div> 
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kategori Adı</th>
                                        <th>Anasayfada Gözükme Durumu</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $miktar = count($model);
                                    for ($k = 0; $k < $miktar; $k++) {
                                        ?>
                                        <tr id="kattable_<?php echo $model[$k]["ID"]; ?>">

                                            <td><?php echo $model[$k]["ad"]; ?></td>
                                            <td><?php echo $model[$k]["anasayfa_durum"] == 1 ? '<i class="fa fa-check "></i>  Gözüksün' : '<i class="fa  fa-times "></i>  Gözükmesin'; ?></td>
                                            <td>
                                                <a id="duzenle" value="<?php echo $model[$k]["ID"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                                <a id="ksil" value="<?php echo $model[$k]["ID"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kategori adı</th>
                                        <th>Anasayfada Gözükme Durumu</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
        <div id="katEkleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Kategori Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori Adı</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ekategoriadi" name="ekategoriadi" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Anasayfada Gözüksünmü</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="gozuksun" name="urunkategori" placeholder="Kategori Seçiniz" required>
                                        <option value="1">Gözüksün</option>

                                        <option  value="2">Gözükmesin</option>

                                    </select>
                                </div>    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-primary" id="katEklemeIslemi">Ekle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <input type="hidden" id="sakliID" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Kategori Düzenle</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori Adı</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dkategoriadi" name="dkategoriadi" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Anasayfada Gözüksünmü</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="dgozuksun" name="urunkategori" placeholder="Kategori Seçiniz" required>
                                        <option value="1">Gözüksün</option>

                                        <option  value="2">Gözükmesin</option>

                                    </select>
                                </div>    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-primary" id="katduzenle">Düzenle</button>
                        </div>
                    </div>
                </div>
        </div>
    </div><!-- /.content-wrapper -->
</div>
<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<script src="<?php echo SITE_BACK_ASSETS_BOOTSTRAPJS; ?>/bootstrap.min.js"></script>
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

    $(".sidebar-toggle").click(function () {
        if ($('body').hasClass("sidebar-collapse")) {
            $('body').removeClass("sidebar-collapse");
        } else {
            $('body').addClass("sidebar-collapse");
        }
    });
</script>
