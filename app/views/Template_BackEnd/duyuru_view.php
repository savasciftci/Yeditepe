<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islemduyuru.js" type="text/javascript"></script>


<link rel="stylesheet" href="<?php echo SITE_BACK_ASSETS_PLUGINS_DATATABLES; ?>/dataTables.bootstrap.css">
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Duyurular</h3>
                        </div><!-- /.box-header -->   
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Duyuru Başlığı</th>
                                        <th>Duyuru Aciklama</th>
                                        <th>Anasayfada Gözükme Durumu</th>
                                        <th>Düzenle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $miktar = count($model);
                                    for ($k = 0; $k < $miktar; $k++) {
                                        ?>
                                        <tr id="kattable_<?php echo $model[$k]["DuyuruID"]; ?>">
                                            <td><?php echo $model[$k]["BaslikTR"]; ?></td>
                                            <td><?php echo $model[$k]["AciklamaTR"]; ?></td>
                                            <td id="<?php echo $model[$k]["onay"]; ?>"><?php echo $model[$k]["onay"] == 1 ? '<i class="fa fa-check-square-o fa fa-success "></i>  Gozuksünn' : '<i class="fa fa-times"></i>  Gozukmesin'; ?></td>
                                            <td>
                                                <a id="duyduzenle" value="<?php echo $model[$k]["DuyuruID"]; ?>" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a>
                                                <a id="duysil" value="<?php echo $model[$k]["DuyuruID"]; ?>" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a>
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
       
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <input type="hidden" id="sakliID" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Duyuru Durumunu Güncelle</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kategori Türü</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="duygozuksun" name="urunkategori" placeholder="Kategori Seçiniz" required>
                                        <option value="1">Gözüksün</option>

                                        <option  value="0">Gözükmesin</option>

                                    </select>
                                </div>    
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-primary" id="duyurduzenle">Düzenle</button>
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
        grupTable = $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
                {"width": "50%", "targets": 1}
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
