

$(document).on('click', 'a#mahsil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Mahalleyi Silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "mahSil"},
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



$(document).on('click', 'a#uduzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    var anasayfadurum = $(this).parent().parent().find('td:eq(1)').attr("value");
    $("#sakliID").val(id);
    $("#dmahalAciklama").val(ad);
    $("#mahalkategori").val(anasayfadurum);
    $("#urunModal").modal('show');
});
$(document).on('click', '#mahalduzenle', function (e) {
    var ad = $("#dmahalAciklama").val();
    var anasayfadurum = $("#mahalkategori option:selected").val();
    var semtismi = $("#mahalkategori option:selected").text();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "anasayfadurum": anasayfadurum, "id": id, "tip": "mahalleduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                $("tr#uruntable_" + id + " td:eq(0)").text(ad);
                $("tr#uruntable_" + id + " td:eq(1)").text(semtismi);
                reset();
                alertify.success(cevap.result);
                $("#urunModal").modal('hide');
                return false;
            }
        }
    });
});



$(document).on('click', '#mahallEkle', function (e) {
    $("#mahalEkleModal").modal('show');
});

$(document).on('click', '#mahalEklemeIslemi', function (e) {
    var mahalad = $("#mahalad").val();
    var semtad = $("#semtadii").val();
    var semtadd = $("#semtadii option:selected").text();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"mahalad": mahalad, "semtad": semtad, "tip": "mahalekle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                var addRow = ('<tr><td>' + mahalad + '</td><td>' + semtadd + '</td><td><a id="uduzenle" value="' + cevap.ID + '" class="btn btn-sm btn-success" style="cursor:pointer" title="Düzenle"><i  class="fa fa-edit"></i></a><a id="mahsil" value="' + cevap.ID + '" class="btn btn-sm btn-danger" style="cursor:pointer" title="Sil"><i  class="fa fa-trash"></i></a></td></tr>');
                grupTable.rows.add($(addRow)).draw();
                reset();
                alertify.success(cevap.result);
                $("#mahalEkleModal").modal('hide');
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
