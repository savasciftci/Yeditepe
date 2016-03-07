
$(document).on('click', 'a#duysil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Duyuruyu silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "duyuruSil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#kattable_" + id).remove();
                        reset();
                        alertify.success(cevap.result);
                        return false;
                    }
                }
            });
        } else {
            alertify.error("Silme İşlemi iptal edildi");
        }
    });
});



$(document).on('click', 'a#duyduzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    var anasayfadurum = $(this).parent().parent().find('td:eq(1)').attr("id");
    $("#sakliID").val(id);
    $("#dkategoriadi").val(ad);
    $("#dgozuksun").val(anasayfadurum);
    $("#myModal").modal('show');
});
$(document).on('click', '#duyurduzenle', function (e) {
    var anasayfadurum = $("#duygozuksun option:selected").val();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"anasayfadurum": anasayfadurum, "id": id, "tip": "duyduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#myModal").modal('hide');
                return false;
            } else {
                var anasayfadurumText;
                if (anasayfadurum == 1) {
                    anasayfadurumText = 'Değiştirildi => Gözüksün';
                } else {
                    anasayfadurumText = 'Değiştirildi => Gözükmesin';
                }
                $("tr#kattable_" + id + " td:eq(2)").text(anasayfadurumText);
                reset();
                alertify.success(cevap.result);
                $("#myModal").modal('hide');
                return false;
            }
        }
    });
});



window.onload = function () {
    var fileInput = document.getElementById('fileInput');
    var fileDisplayArea = document.getElementById('fileDisplayArea');
    var resimGuncelle = document.getElementById('resimGuncelle');
    var dosyaAlani = document.getElementById('dosyaAlani');

    fileInput.addEventListener('change', function (e) {
        var file = fileInput.files[0];
        var imageType = /image.*/;
        if (file.type.match(imageType)) {
            var reader = new FileReader();
            reader.onload = function (e) {
                fileDisplayArea.innerHTML = "";

                var img = new Image();
                img.src = reader.result;

                fileDisplayArea.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            fileDisplayArea.innerHTML = "Dosya Yüklenemedi!!"
        }
    });

    resimGuncelle.addEventListener('change', function (e) {
        var file = resimGuncelle.files[0];
        var imageType = /image.*/;
        if (file.type.match(imageType)) {
            var reader = new FileReader();
            reader.onload = function (e) {
                dosyaAlani.innerHTML = "";

                var img = new Image();
                img.src = reader.result;

                dosyaAlani.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            dosyaAlani.innerHTML = "Dosya Yüklenemedi!!"
        }
    });

$(".sidebar-toggle").click(function() {
	if($('body').hasClass("sidebar-collapse" )){
		 $('body').removeClass("sidebar-collapse");
	}else{
		 $('body').addClass("sidebar-collapse");
	}
});

}
