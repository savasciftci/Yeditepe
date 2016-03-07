
$(document).on('click', 'a#aboutsil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Hakkinda İçeriğini Silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "aboutSil"},
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







$(document).on('click', '#aboutEkle', function (e) {
    $("#aboutEkleModal").modal('show');
});

$(document).on('click', '#aboutEklemeIslemi', function (e) {
    var formData = new FormData();
    var baslik = $("#ebaslik").val();
    var altbaslik = $("#ealtbaslik").val();
    var icerik = CKEDITOR.instances['eicerik'].getData();
    formData.append('baslik', baslik);
    formData.append('altbaslik', altbaslik);
    formData.append('icerik', icerik);
    formData.append('file', $("#fileInput")[0].files[0]);
    formData.append('tip', "aboutEkle");
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
                var addRow = ('<tr><td>' + cevap.yol + '</td><td>' + baslik + '</td><td>' + altbaslik + '</td><td>' + icerik + '</td><td><a id="aboutduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="aboutsil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#aboutEkleModal").modal('hide');
                return false;
            }
        }
    });
});

$(document).on('click', 'a#aboutduzenle', function (e) {
    var dosyaAlaniMarka = document.getElementById('fileDisplayAreaMarka');
    dosyaAlaniMarka.innerHTML = "";
    var id = $(this).attr("value");
    var baslik = $(this).parent().parent().find('td:eq(1)').text();
    var altbaslik = $(this).parent().parent().find('td:eq(2)').text();
    var icerik = $(this).parent().parent().find('td:eq(3)').text();
    $("#fileDisplayAreaMarka").append('<img src="http://localhost/Yeditepe/upload/about/' + $(this).parent().parent().find('td:eq(0)').text() + ' " class="img-responsive" alt="Marka Image">');
    $("#sakliID").val(id);
    $("#dbaslik").val(baslik);
    $("#daltbaslik").val(altbaslik);
    CKEDITOR.instances['dicerik'].setData(icerik);
    $("#aboutModal").modal('show');
});


$(document).on('click', '#aboutDuzenleİslemi', function (e) {
    var formData = new FormData();
    var baslik = $("#dbaslik").val();
    var altbaslik = $("#daltbaslik").val();
    var icerik = CKEDITOR.instances['dicerik'].getData();
    var id = $("#sakliID").val();
    formData.append('baslik', baslik);
    formData.append('altbaslik', altbaslik);
    formData.append('icerik', icerik);
    formData.append('id', id);
    formData.append('file', $("#fileInputMarkaDuzen")[0].files[0]);
    formData.append('tip', "aboutDuzenle");
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
                $("tr#uruntable_" + id + " td:eq(1)").text(baslik);
                $("tr#uruntable_" + id + " td:eq(2)").text(altbaslik);
                $("tr#uruntable_" + id + " td:eq(3)").text(icerik);
                reset();
                alertify.success(cevap.result);
                $("#aboutModal").modal('hide');
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
