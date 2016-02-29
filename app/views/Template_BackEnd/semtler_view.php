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
                        <h3 class="box-title">Semtler</h3>
                    </div><!-- /.box-header -->  <div align="right"> <button type="button" class="btn btn-primary" id="semtEkle" title="Yeni Semt Ekle" style="margin-right:25px; padding: 10px">Semt EKLE</button></div> 
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Semt Adı</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $miktar = count($model);
                                for ($k = 0; $k < $miktar; $k++) {
                                    ?>
                                    <tr id="semttable_<?php echo $model[$k]["id"]; ?>">

                                        <td><?php echo $model[$k]["SemtAdi"]; ?></td>
                                        <td>
                                            <a id="sduzenle" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                            <a id="ssil" value="<?php echo $model[$k]["id"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>İşlemler</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
    <div id="semtEkleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Semt Ekle</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Semt Adı</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="esemtadi" name="ekategoriadi" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <button type="button" class="btn btn-primary" id="semtEklemeIslemi">Ekle</button>
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
                <h4 class="modal-title">Semt Düzenle</h4>
            </div>
            <div class="modal-body">
                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semt Adı</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="dsemtadi" name="dkategoriadi" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary" id="semtduzenle">Düzenle</button>
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
