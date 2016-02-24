$(document).on("click", "button#profilDuzenle", function (e) {
    var formData = new FormData();
    var ad = $("#ad").val();
    var adres = $("#adres").val();
    var sehir = $("input[name=sehir]").val();
    var cinsiyettext = $("#cinsiyet option:selected").text();
    var cinsiyetval = $("#cinsiyet option:selected").val();
    var email = $(".email").val();
    var fileInput = $("#fileInput").val();
    formData.append('ad', ad);
    formData.append('adres', adres);
    formData.append('sehir', sehir);
    formData.append('cinsiyetval', cinsiyetval);
    formData.append('email', email);
    formData.append('file', $("#fileInput")[0].files[0]);
    formData.append('tip', "profilDuzenle")
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
                return false;
            }
        }
    });
});
$(document).on("click", "button#ayarDuzenle", function (e) {
    var baslik = $("#baslik").val();
    var aciklama = $("#aciklama").val();
    var is = $("#is").val();
    var cep = $("#cep").val();
    var mail = $("#mail").val();
    var adres = $("#adres").val();
    var hakkinda = $("#hakkinda").val();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"baslik": baslik, "aciklama": aciklama, "is": is, "cep": cep, "mail": mail, "adres": adres,"hakkinda":hakkinda, "tip": "ayarDuzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                reset();
                alertify.success(cevap.result);
                return false;
            }
        }
    });
});

$(document).on('click', 'a#usil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Silmek İstiyormusunuz", function (e) {
        if (e) {
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"id": id, "tip": "urunSil"},
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

$(document).on("click", "button#profilSil", function (e) {
    reset();
    alertify.confirm("Silmek İstiyormusunuz", function (e) {
        if (e) {
            var id = $("#profilid").val();
            $.ajax({
                type: "post",
                url: SITE_URL + "/Admin_Ajax",
                cache: false,
                dataType: "json",
                data: {"yeniveri": id, "tip": "profilSil"},
                success: function (cevap) {
                    if (cevap.hata) {
                        reset();
                        alertify.alert(cevap.hata);
                        return false;
                    } else {
                        reset();
                        alertify.alert(cevap.result);
                        return false;
                    }
                }
            });
        } else {
            alertify.error("Silme İşlemi iptal edildi");
        }
    });
});


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

$(document).on("click", "button#KategoriEkle", function (e) {
    var kategoriAd = $("#kategoriAd").val();
    var kicerik = $("#kicerik").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"kategoriAd": kategoriAd, "kicerik": kicerik, "tip": "KategoriEkle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                reset();
                alertify.success(cevap.result);
                return false;
            }
        }
    });
});

$(document).on("click", "button#urunekle", function (e) {
    var urunresim = $("#urunresim").val();
    var urunaciklama = $("#urunaciklama").val();
    var urunkategori = $("#urunkategori").val();
    var urunfiyat = $("#urunfiyat").val();

    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"urunresim": urunresim, "urunaciklama": urunaciklama, "urunkategori": urunkategori, "urunfiyat": urunfiyat, "tip": "urunekle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                return false;
            } else {
                reset();
                alertify.success(cevap.result);
                return false;
            }
        }
    });
});


$(document).on('click', 'a#uduzenle', function (e) {
    var id = $(this).attr("value");
    var aciklama = $(this).parent().parent().find('td:eq(0)').text();
    var fiyat = $(this).parent().parent().find('td:eq(1)').text();
    var kategoriID = $(this).parent().parent().find('td:eq(2)').attr("value");
    var urun_resim = $("#urun_resim").val();
    $("#sakliID").val(id);
    $("#durunAciklama").val(aciklama);
    $("#durunFiyat").val(fiyat);

    $("#urunresim").val(urun_resim);
    $("#urunkategori").val(kategoriID);
    $("#urunModal").modal('show');
});


$(document).on('click', '#urunDuzenle', function (e) {
    var formData = new FormData();
    var aciklama = $("#durunAciklama").val();
    var fiyat = $("#durunFiyat").val();
    var kategoriID = $("#urunkategori").val();
    var kategoriAdi = $("#urunkategori option[value=" + kategoriID + "]").text();
    var id = $("#sakliID").val();
    formData.append('aciklama', aciklama);
    formData.append('kategoriID', kategoriID);
    formData.append('fiyat', fiyat);
    formData.append('id', id);
    formData.append('file', $("#resimGuncelle")[0].files[0]);
    formData.append('tip', "urunDuzenle");
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
                $("tr#uruntable_" + id + " td:eq(0)").text(aciklama);
                $("tr#uruntable_" + id + " td:eq(1)").text(fiyat);
                $("tr#uruntable_" + id + " td:eq(2)").text(kategoriAdi);
                reset();
                alertify.success(cevap.result);
                $("#urunModal").modal('hide');
                return false;
            }
        }
    });
});
$(document).on('click', '#urunEkle', function (e) {
    $("#urunEkleModal").modal('show');
});

$(document).on('click', '#urunEklemeIslemi', function (e) {
    var formData = new FormData();
    var aciklama = $("#edurunAciklama").val();
    var kategori = $("#edurunKategori").val();
    var fiyat = $("#edurunFiyat").val();
    formData.append('urunaciklama', aciklama);
    formData.append('urunkategori', kategori);
    formData.append('urunfiyat', fiyat);
    formData.append('file', $("#fileInput")[0].files[0]);
    formData.append('tip', "urunEkle");
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
                $("#urunEkleModal").modal('hide');
                return false;
            }
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
    var anasayfadurum = $(this).parent().parent().find('td:eq(1)').text();
    $("#sakliID").val(id);
    $("#dkategoriadi").val(ad);
    $("#dgozuksun").val(anasayfadurum);
    $("#myModal").modal('show');
});
$(document).on('click', '#katduzenle', function (e) {

    var ad = $("#dkategoriadi").val();
     var anasayfadurum = $("#dgozuksun option:selected").val();
    var id = $("#sakliID").val();
    $.ajax({
        type: "post",
        url: SITE_URL + "/Admin_Ajax",
        cache: false,
        dataType: "json",
        data: {"ad": ad, "anasayfadurum": anasayfadurum, "id": id, "tip": "katduzenle"},
        success: function (cevap) {
            if (cevap.hata) {
                reset();
                alertify.alert(cevap.hata);
                $("#myModal").modal('hide');
                return false;
            } else {
                $("tr#kattable_" + id + " td:eq(0)").text(ad);
                var anasayfadurumText;
                if(anasayfadurum==1){
                    anasayfadurumText='Değiştirildi => Gözüksün';
                }else{
                    anasayfadurumText='Değiştirildi => Gözükmesin';
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

$(".sidebar-toggle").click(function() {
	if($('body').hasClass("sidebar-collapse" )){
		 $('body').removeClass("sidebar-collapse");
	}else{
		 $('body').addClass("sidebar-collapse");
	}
});

}

