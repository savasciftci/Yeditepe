$(document).on("click", "a.urunIslem", function (e) {
    var id = $(this).attr("id");
    $.ajax({
        type: "post",
        url: SITE_URL + "/Front_Ajax/ajaxCall",
        cache: false,
        dataType: "json",
        data: {"id": id, "tip": "urunkat"},
        success: function (cevap) {
            window.location.href = SITE_URL + '/Home/urunler';
        }
    });
});