<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil Bilgileri
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

                    <input type="hidden" class="form-control" id="profilid" value="6">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group" >
                                <label for="pemail" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <div id="fileDisplayArea" class="col-sm-3">
                                        <img src="<?php echo SITE_PROFILRESIM; ?>/<?php echo Session::get("presim"); ?>" class="img-circle img-responsive" alt="User Image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ad" class="col-sm-2 control-label">Ad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ad" placeholder="Ad" required value="<?php echo $model[0]["Ad"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="adres" class="col-sm-2 control-label">Adres</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="adres" placeholder="Adresinizi Giriniz" style="resize: none"><?php echo $model[0]["Adres"]; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sehir" class="col-sm-2 control-label">Şehir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sehir" name="sehir" placeholder="Şehir" value="<?php echo $model[0]["Sehir"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cinsiyet" class="col-sm-2 control-label">Cinsiyet</label>
                                <div class="col-sm-10">
                                    <select class="form-control"  id="cinsiyet">
                                        <?php if ($model[0]["Cinsiyet"] == 1) { ?>
                                            <option value="1" selected>Erkek</option>
                                        <?php } else if ($model[0]["Cinsiyet"] == 2) { ?>
                                            <option  value="2" selected>Bayan</option>
                                        <?php } else { ?>
                                            <option value="0" selected>Seçiniz</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pemail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" id="pemail" class="form-control email" placeholder="Email" value="<?php echo $model[0]["Mail"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fileInput" class="col-sm-2 control-label">Profil Resmi</label>
                                <div class="col-sm-10">
                                    <input id="fileInput" name="fileInput" class="form-control" type="file" />
                                    <div id="fileDisplayArea" style="margin-top: 2em;width: 100%;overflow-x: auto;"></div>   
                                </div>
                            </div>  
                            <div class="box-footer">
                                <button type="button" id="sifredegis" class="btn btn-info btn-lg pull-right fa fa-key"style="margin-left: 5px" >Şifre Değiştir</button>
                                <button type="button" id="profilDuzenle" class="btn btn-info pull-right btn-lg fa fa-edit" >Profil Duzenle</button>
                            </div><!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div><!--/.col (right) -->
</div>   <!-- /.row -->
</section><!-- /.content -->
<div id="sifredegismodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Şifrenizi değiştirin</h4>
            </div>
            <div class="modal-body">
                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Eski Şifre</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="oldpass" name="ekategoriadi" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Yeni Şifre</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="newpass" name="ekategoriadi" value="" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn btn-primary" id="sifreDegistirmeIslemi">Güncelle</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div><!-- /.content-wrapper -->
