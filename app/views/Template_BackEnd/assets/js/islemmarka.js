



$(document).on('click', 'a#markasil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Markayı Silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "markSil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#uruntable_" + id).remove();
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





$(document).on('click', '#markEkle', function (e) {
    $("#markEkleModal").modal('show');
});

$(document).on('click', '#markEklemeIslemi', function (e) {
    var formData = new FormData();
    var aciklama = $("#markadii").val();
    var kategori = $("#dmarkakategori").val();
    var markurl = $("#markaurl").val();
    formData.append('urunaciklama', aciklama);
    formData.append('urunkategori', kategori);
    formData.append('urunfiyat', markurl);
    formData.append('file', $("#fileInput")[0].files[0]);
    formData.append('tip', "markEkle");
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
                var kategoritext;
                if (kategori == 1) {
                    kategoritext = 'Klima';
                } else {
                    kategoritext = 'Kombi';
                }
                var addRow = ('<tr><td>' + aciklama + '</td><td>' + cevap.yol + '</td><td>' + markurl + '</td><td>' + kategoritext + '</td><td><a id="markduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="markasil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#markEkleModal").modal('hide');
                return false;
            }
        }
    });
});

$(document).on('click', 'a#markduzenle', function (e) {
    var dosyaAlaniMarka = document.getElementById('fileDisplayAreaMarka');
    dosyaAlaniMarka.innerHTML = "";
    var id = $(this).attr("value");
    var aciklama = $(this).parent().parent().find('td:eq(0)').text();
    var url = $(this).parent().parent().find('td:eq(2)').text();
    var markkategori = $(this).parent().parent().find('td:eq(3)').attr("id");
    $("#fileDisplayAreaMarka").append('<img src="http://localhost/Yeditepe/upload/markalar/' + $(this).parent().parent().find('td:eq(1)').text() + ' " class="img-responsive" alt="Marka Image">');
    $("#sakliID").val(id);
    $("#dmarkadi").val(aciklama);
    $("#dmarkurl").val(url);
    $("#markakategori").val(markkategori);
    $("#markModal").modal('show');
});


$(document).on('click', '#markDuzenle', function (e) {
    var formData = new FormData();
    var aciklama = $("#dmarkadi").val();
    var url = $("#dmarkurl").val();
    var markkategori = $("#markakategori").val();
    var kategoriAdi = $("#markakategori option[value=" + markkategori + "]").text();
    var id = $("#sakliID").val();
    formData.append('aciklama', aciklama);
    formData.append('kategoriID', markkategori);
    formData.append('url', url);
    formData.append('id', id);
    formData.append('file', $("#fileInputMarkaDuzen")[0].files[0]);
    formData.append('tip', "markDuzenle");
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
                $("tr#uruntable_" + id + " td:eq(0)").text(aciklama);
                $("tr#uruntable_" + id + " td:eq(2)").text(url);
                $("tr#uruntable_" + id + " td:eq(3)").text(kategoriAdi);
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
