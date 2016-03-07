
$(document).on('click', 'a#vitrinsil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Vitrini Silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "vitrinSil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#uruntable_" + id).remove();
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







$(document).on('click', '#vitrinEkle', function (e) {
    $("#vitrinEkleModal").modal('show');
});

$(document).on('click', '#vitrinEklemeIslemi', function (e) {
    var formData = new FormData();
    var sira = $("#sirasii").val();
    var kategori = $("#vitrinkategori").val();
    var markurl = $("#vitrinurl").val();
    formData.append('sirasii', sira);
    formData.append('kategorisii', kategori);
    formData.append('urlsii', markurl);
    formData.append('file', $("#fileInput")[0].files[0]);
    formData.append('tip', "vitrinEkle");
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: formData,
        async: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                reset();
                alertify.success(cevap.result);
                $("#vitrinEkleModal").modal('hide');
                return false;
            }
        }
    });
});

$(document).on('click', 'a#vitrinduzenle', function (e) {
    var dosyaAlaniMarka = document.getElementById('fileDisplayAreaMarka');
    dosyaAlaniMarka.innerHTML = "";
    var id = $(this).attr("value");
    var sirasi = $(this).parent().parent().find('td:eq(1)').text();
    var url = $(this).parent().parent().find('td:eq(2)').text();
    var vitrinkategorii = $(this).parent().parent().find('td:eq(3)').attr("id");
    $("#fileDisplayAreaMarka").append('<img src="http://localhost/Yeditepe/upload/vitrinler/' + $(this).parent().parent().find('td:eq(0)').text() + ' " class="img-responsive" alt="Marka Image">');
    $("#sakliID").val(id);
    $("#dvitrinsirasi").val(sirasi);
    $("#dvitrinurl").val(url);
    $("#dvitrinkategori").val(vitrinkategorii);
    $("#markModal").modal('show');
});


$(document).on('click', '#vitrinDuzenle', function (e) {
    var formData = new FormData();
    var sirasi = $("#dvitrinsirasi").val();
    var url = $("#dvitrinurl").val();
    var vitrinkategorii = $("#dvitrinkategori").val();
    var vitrinAdi = $("dvitrinkategori option[value=" + vitrinkategorii + "]").text();
    var id = $("#sakliID").val();
    formData.append('sirasi', sirasi);
    formData.append('vitrinkategorii', vitrinkategorii);
    formData.append('url', url);
    formData.append('id', id);
    formData.append('file', $("#fileInputMarkaDuzen")[0].files[0]);
    formData.append('tip', "vitrinDuzenle");
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: formData,
        async: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                if ($("#fileInputMarkaDuzen")[0].files[0] != "") {
                    $("tr#uruntable_" + id + " td:eq(1)").text(cevap.yol);
                }
                $("tr#uruntable_" + id + " td:eq(1)").text(sirasi);
                $("tr#uruntable_" + id + " td:eq(2)").text(url);
                $("tr#uruntable_" + id + " td:eq(3)").text(vitrinAdi);
                reset();
                alertify.success(cevap.result);
                $("#markModal").modal('hide');
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
    var resimGuncelleMarka = document.getElementById('fileInputMarkaDuzen');
    var dosyaAlaniMarka = document.getElementById('fileDisplayAreaMarka');

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

    resimGuncelleMarka.addEventListener('change', function (e) {
        var file = resimGuncelleMarka.files[0];
        var imageType = /image.*/;
        if (file.type.match(imageType)) {
            var reader = new FileReader();
            reader.onload = function (e) {
                dosyaAlaniMarka.innerHTML = "";

                var img = new Image();
                img.src = reader.result;

                dosyaAlaniMarka.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            dosyaAlaniMarka.innerHTML = "Dosya Yüklenemedi!!"
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
