
$(document).on('click', 'a#ssil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Semti silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "semtsil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        $("tr#semttable_" + id).remove();
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


$(document).on('click', '#semtEkle', function (e) {
    $("#semtEkleModal").modal('show');
});

$(document).on('click', '#semtEklemeIslemi', function (e) {

    var ad = $("#esemtadi").val();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "tip": "semtEkle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#semtEkleModal").modal('hide');
                return false;
            } else {
                var addRow = ('<tr><td>' + ad + '</td><td><a id="sduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="ssil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#semtEkleModal").modal('hide');
                return false;
            }
        }
    });
});


$(document).on('click', 'a#sduzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    $("#sakliID").val(id);
    $("#dsemtadi").val(ad);
    $("#myModal").modal('show');
});
$(document).on('click', '#semtduzenle', function (e) {

    var ad = $("#dsemtadi").val();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "id": id, "tip": "semtduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#myModal").modal('hide');
                return false;
            } else {
                $("tr#semttable_" + id + " td:eq(0)").text(ad);
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
