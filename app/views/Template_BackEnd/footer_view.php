<script type="text/javascript">
    $(document).ready(function () {

        var pluginURL = '<?php echo SITE_BACK_ASSETS_PLUGINS; ?>';
        $('textarea').each(function () {
            if (!$(this).hasClass('nock')) {
                var id = $(this).attr('id');
                CKEDITOR.replace(id, {
                    filebrowserBrowseUrl: '/browser/browse.php',
                    filebrowserImageBrowseUrl: '/browser/browse.php?type=Images',
                    filebrowserUploadUrl: '/uploader/upload.php',
                    filebrowserImageUploadUrl: '/uploader/upload.php?type=Images',
                    filebrowserWindowWidth: '900',
                    filebrowserWindowHeight: '400',
                    filebrowserBrowseUrl: pluginURL + '/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: pluginURL + '/ckfinder/ckfinder.html?Type=Images',
                            filebrowserFlashBrowseUrl: pluginURL + '/ckfinder/ckfinder.html?Type=Flash',
                    filebrowserUploadUrl: pluginURL + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl: pluginURL + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserFlashUploadUrl: pluginURL + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                });
            }
        });

    });
</script>
<footer class="main-footer">
    <strong>Tüm Hakları Saklıdır.</strong>
</footer>
<div class="control-sidebar-bg"></div>
</body>
</html>
