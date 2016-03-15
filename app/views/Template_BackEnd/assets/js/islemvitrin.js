
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
                        $("tr#" + id).remove();
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
                var kategoritext;
                if (kategori == 1) {
                    kategoritext = 'Aktif';
                } else {
                    kategoritext = 'Pasif';
                }
                var addRow = ('<tr><td>' + cevap.yol + '</td><td>' + sira + '</td><td>' + markurl + '</td><td>' + kategoritext + '</td><td><a id="vitrinduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="vitrinsil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#vitrinEkleModal").modal('hide');
                return false;
            }
        }
    });
});
var normalsirasi = 0;
$(document).on('click', 'a#vitrinduzenle', function (e) {
    var dosyaAlaniMarka = document.getElementById('fileDisplayAreaMarka');
    dosyaAlaniMarka.innerHTML = "";
    var id = $(this).attr("value");
    normalsirasi = $(this).parent().parent().find('td:eq(1)').text();
    var url = $(this).parent().parent().find('td:eq(2)').text();
    var vitrinkategorii = $(this).parent().parent().find('td:eq(3)').attr("id");
    $("#fileDisplayAreaMarka").append('<img src="http://localhost/Yeditepe/upload/vitrinler/' + $(this).parent().parent().find('td:eq(0)').text() + ' " class="img-responsive" alt="Marka Image">');
    $("#sakliID").val(id);
    $("#dvitrinsirasi").val(normalsirasi);
    $("#dvitrinurl").val(url);
    $("#dvitrinkategori").val(vitrinkategorii);
    $("#markModal").modal('show');
});


$(document).on('click', '#vitrinDuzenle', function (e) {
    console.log("normalsirasi" + normalsirasi);
    var formData = new FormData();
    var sira = $("#dvitrinsirasi").val();
    var url = $("#dvitrinurl").val();
    var vitrinkategorii = $("#dvitrinkategori").val();
    var vitrinAdi = $("#dvitrinkategori option[value=" + vitrinkategorii + "]").text();
    var id = $("#sakliID").val();
    formData.append('vitrinkategorii', vitrinkategorii);
    formData.append('sirasi', sira);
    formData.append('url', url);
    formData.append('id', id);
    formData.append('file', $("#fileInputMarkaDuzen")[0].files[0]);
    formData.append('tip', "vitrinDuzenle");
    formData.append('normalSira', normalsirasi);
    var trlength = $("#vitrintbody tr").length;
    var maksSira = 0;
    var degisecekID = 0;
    if (normalsirasi != sira) {
        for (var a = 0; a < trlength; a++) {
            var trID = $("#vitrintbody tr:eq(" + a + ")").attr("id");
            //console.log("ID-->" + trID);
            var sirasi = $("#vitrinsira" + trID).text();
            //console.log(sirasi);
            if (sira == sirasi) {
                degisecekID = trID;
                console.log("değişecek-->" + degisecekID);
            }
        }
    }
//    alert(normalsirasi);
//    alert(sira);
//    alert(id);
//    alert(degisecekID);
    formData.append('id', id);
    formData.append('degisecekID', degisecekID);
    formData.append('degisecekSira', normalsirasi);
    formData.append('sira', sira);
    formData.append('degisecekID', degisecekID);
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
                    $("tr#" + id + " td:eq(1)").text(cevap.yol);
                }
                $("tr#" + id + " td:eq(1)").text(sirasi);
                $("tr#" + id + " td:eq(2)").text(url);
                var durumText;
                if (vitrinkategorii == 1) {
                    durumText = 'Değiştirildi => Aktif';
                } else {
                    durumText = 'Değiştirildi => Pasif';
                }
                $("tr#" + id + " td:eq(3)").text(durumText);
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
