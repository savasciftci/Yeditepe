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
        data: {"baslik": baslik, "aciklama": aciklama, "is": is, "cep": cep, "mail": mail, "adres": adres, "hakkinda": hakkinda, "tip": "ayarDuzenle"},
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

$(document).on('click', 'a#markasil', function (e) {
    var id = $(this).attr("value");
    reset();
    alertify.confirm("Mahalleyi Silmek İstiyormusunuz", function (e) {
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
    var anasayfadurum = $("#mahalkategori option:selected").text();
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
                $("#urunModal").modal('hide');
                return false;
            } else {
                $("tr#uruntable_" + id + " td:eq(0)").text(ad);
                $("tr#uruntable_" + id + " td:eq(1)").text(anasayfadurum);
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
                reset();
                alertify.success(cevap.result);
                $("#markEkleModal").modal('hide');
                return false;
            }
        }
    });
});
$(document).on('click', '#mahallEkle', function (e) {
    $("#urunEkleModal").modal('show');
});

$(document).on('click', '#mahalEklemeIslemi', function (e) {
    var mahalad = $("#mahalad").val();
    var semtad = $("#semtadii").val();

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
                $("#urunEkleModal").modal('hide');
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
                reset();
                alertify.success(cevap.result);
                $("#semtEkleModal").modal('hide');
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
    var kategoriID = $(this).parent().parent().find('td:eq(2)').attr("value");
    var mark_resim = $("#mark_resim").val();
    var markkategori = $(this).parent().parent().find('td:eq(3)').attr("id");
    $("#fileDisplayAreaMarka").append('<img src="http://localhost/Yeditepe/upload/markalar/' + $(this).parent().parent().find('td:eq(1)').text() + ' " class="img-responsive" alt="Marka Image">');
    $("#sakliID").val(id);
    $("#dmarkadi").val(aciklama);
    $("#urunresim").val(mark_resim);
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

$(document).on('click', 'a#duzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    var anasayfadurum = $(this).parent().parent().find('td:eq(1)').attr("value");
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
                if (anasayfadurum == 1) {
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

$(document).on('click', 'a#duyduzenle', function (e) {
    var id = $(this).attr("value");
    var ad = $(this).parent().parent().find('td:eq(0)').text();
    var anasayfadurum = $(this).parent().parent().find('td:eq(1)').attr("value");
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
