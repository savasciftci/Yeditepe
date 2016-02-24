<script type="text/javascript">
    // active class'ını alacak link'in id'si
    activePage = "iletisim";
</script>
<div class="container">
    <!--<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12"></div>--> 
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="portfolio-item item">
            <div class="portfolio-border">
                <div class="portfolio-thumb">
                    <h2>Akzer Mobilya</h2>
                    <hr>
                    <img src="<?php echo SITE_FRONT_ASSETS_DISTIMG; ?>/iletisim.png" />
                    <div class="solalt">
                        <h3 class="title" style="border-color: rgba(85, 85, 85, 0.247059)"></h3>
                        <div class="adress">
                            <p></p><p></p>
                            <b>Adres</b>: <?php echo $model[0]["adres"]; ?> 
                            <div>
                                <span class="fa fa-phone"></span>
                                İs Tel: <?php echo $model[0]["is_tel"]; ?> 
                            </div>
                            <div>
                                <span class="fa fa-phone"></span>
                                Cep Tel : <?php echo $model[0]["cep_tel"]; ?> 
                            </div>
                            <div>
                                <a>
                                    <span class="fa fa-envelope"></span>
                                    Mail: <?php echo $model[0]["site_mail"]; ?> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!DOCTYPE html>
    <html>
        <head>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <script
                src="http://maps.googleapis.com/maps/api/js">
            </script>
            <h2>Neredeyiz</h2>
            <hr>
            <div class="thumbnail">
                <iframe  width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6227.299457459566!2d35.53802446829223!3d38.70288945720976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x152b129417dd7207%3A0xa7bb0c1d4de23aae!2zRmFrw7xsdGUgxLDDp2kgS8O8bWUgRXZsZXJpIE5vOjkyLCBZZW5pZG_En2FuLCAzODI4MCBUYWxhcy9LYXlzZXJp!5e0!3m2!1str!2str!4v1450656198514" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div> 
        </div>
        </head>
        <body>  
        <div id="googleMap" style="width:500px;height:380px;"></div>
        </body>
    </html>
</div>

