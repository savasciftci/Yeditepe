var activePage = "anasayfa";

$(document).ready(function(){
    activateLink();
    
    // DOM (Document Object Model) yapısını araştır.
    // Bir Örnek :
    //Yalnızca sayfa yüklendiğinde çalışan event fonksiyonu:
    //$(".asd").click(func...);
    //Sayfa yüklendikten sonra da ajax vb. yoluyla yazdırılan elementlerin event fonksiyonu:
    //$(document).on("click", ".asd", function....);
    
});

function activateLink() {
    // active class'ı olandan bu class'ı kaldır.
    $("#mainMenu").find("a.active").removeClass("active");
    // sayfadaki scriptten gelen link id'sine active class'ı ver.
    $("#"+activePage).addClass("active");
}


