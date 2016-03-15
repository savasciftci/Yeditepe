

$(document).on('click', 'a#ksil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Kategoriyi silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "kategoriSil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#kattable_" + id).remove();
                        reset();
                        setTimeout(function() { window.location=window.location;},2000);
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




$(document).on('click', '#katEkle', function (e) {
    $("#katEkleModal").modal('show');
});
$(document).on('click', '#katEklemeIslemi', function (e) {

    var ad = $("#ekategoriadi").val();
    var anasayfadurum = $("#gozuksun option:selected").val();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "anasayfadurum": anasayfadurum, "tip": "katEkle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#katEkleModal").modal('hide');
                return false;
            } else {
                var kategoritext;
                if (anasayfadurum == 1) {
                    kategoritext = 'Klima';
                } else {
                    kategoritext = 'Kombi';
                }
                var addRow = ('<tr><td>' + ad + '</td><td><i class="fa fa-check-square-o fa fa-success "></i>' + kategoritext + '</td><td><a id="duzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="ksil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#katEkleModal").modal('hide');
                return false;
            }
        }
    });
     
});



$(document).on('click', 'a#duzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    var kategoritip = $(this).parent().parent().find('td:eq(1)').attr("id");
    $("#sakliID").val(id);
    $("#dkategoriadi").val(ad);
    $("#dkategoritipi").val(kategoritip);
    $("#myModal").modal('show');
});
$(document).on('click', '#katduzenle', function (e) {

    var ad = $("#dkategoriadi").val();
    var kategoritip = $("#dkategoritipi").val();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "kategoritip": kategoritip, "id": id, "tip": "katduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                $("tr#kattable_" + id + " td:eq(0)").text(ad);
                var anasayfadurumText;
                if (kategoritip == 1) {
                    anasayfadurumText = 'Değiştirildi => Klima';
                } else {
                    anasayfadurumText = 'Değiştirildi => Kombi';
                }
                $("tr#kattable_" + id + " td:eq(1)").text(anasayfadurumText);
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

    $(".sidebar-toggle").click(function () {
        if ($('body').hasClass("sidebar-collapse")) {
            $('body').removeClass("sidebar-collapse");
        } else {
            $('body').addClass("sidebar-collapse");
        }
    });

}
