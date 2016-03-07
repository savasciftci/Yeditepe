


$(document).on('click', 'a#ysil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Yaziyi silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "yazisil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#semttable_" + id).remove();
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





$(document).on('click', '#yaziEkle', function (e) {
    $("#yaziEkleModal").modal('show');
});

$(document).on('click', '#yaziEklemeIslemi', function (e) {

    var baslik = CKEDITOR.instances['eyazibaslik'].getData();
    var yazii = CKEDITOR.instances['eyazii'].getData();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"baslik": baslik, "yazii": yazii, "tip": "yaziEkle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#yaziEkleModal").modal('hide');
                return false;
            } else {
                var addRow = ('<tr><td>' + baslik + '</td><td>' + yazii + '</td><td><a id="yduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="ysil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#yaziEkleModal").modal('hide');
                return false;
            }
        }
    });
});



$(document).on('click', 'a#yduzenle', function (e) {
    var id = $(this).attr("value");
    var baslik = $(this).parent().parent().find('td:eq(0)').text();
    var yazii = $(this).parent().parent().find('td:eq(1)').text();
    $("#sakliID").val(id);
    CKEDITOR.instances['dyazibaslik'].setData(baslik);
    CKEDITOR.instances['dyazii'].setData(yazii);
    $("#myModal").modal('show');
});
$(document).on('click', '#yaziduzenle', function (e) {

    var baslik = CKEDITOR.instances['dyazibaslik'].getData();
    var yazii = CKEDITOR.instances['dyazii'].getData();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"baslik": baslik, "yazii": yazii, "id": id, "tip": "yaziduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#myModal").modal('hide');
                return false;
            } else {
                $("tr#semttable_" + id + " td:eq(0)").text(baslik);
                $("tr#semttable_" + id + " td:eq(1)").text(yazii);
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
