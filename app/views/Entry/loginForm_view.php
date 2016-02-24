<link href="<?php echo SITE_ENTRY_ASSETSCSS; ?>/custom.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo SITE_ENTRY_ASSETSJS; ?>/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_ENTRY_ASSETSJS; ?>/custom.js" type="text/javascript"></script>
<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Giriş Yap</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" action="<?php echo SITE_URL; ?>/Login" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-Posta" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Şifre" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Hatırla Beni
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Giriş Yap">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>