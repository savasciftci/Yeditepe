<script src="<?php echo SITE_BACK_ASSETS_JS; ?>/islem.js" type="text/javascript"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Site Genel Ayarları
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
                        <h3 class="box-title">Ayarlar Form</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <input type="hidden" class="form-control" id="profilid" value="" required>
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Site Başlık</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="baslik" name="genelayarbaslik" placeholder="Site Başlığı" value="<?php echo $model[0]["site_baslik"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Site Açıklaması</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="aciklama" name="genelayarbaslik" placeholder="Site Başlığı" value="<?php echo $model[0]["site_aciklama"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">İş Tel</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"id="is" name="genelayartel" placeholder="Telefon" value="<?php echo $model[0]["is_tel"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cep Tel</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"id="cep" name="genelayarceptel" placeholder="Cep Telefonu" value="<?php echo $model[0]["cep_tel"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-Posta</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"id="mail" name="genelayarmail" placeholder="E-Posta" value="<?php echo $model[0]["site_mail"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3  control-label"> Adres</label>
                                <div class="col-sm-9">
                                    <input type="text" name="genelayaradres" class="form-control" id="adres" placeholder="Adres" value="<?php echo $model[0]["adres"]; ?>" ></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="margin-top:30px">Hakkımızda</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="15" id="hakkinda" style="resize:none"><?php echo $model[0]["hakkinda"]; ?></textarea>
                               </div>
                               </div>


                        </div>
                        <div class="box-footer">
                            <button type="button" id="ayarDuzenle" class="btn btn-info pull-right" >Ayarları Değiştir</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div>
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->