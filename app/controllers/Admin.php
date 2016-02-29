<?php

class Admin extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->home();
    }

    public function home() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $durum = array();
            $urunler = $model->urunselect();
            $kategoriler = $model->kategoriselect();
            $semtler = $model->semtselect();
            $mahalleler = $model->mahalleselect();
            $duyurular = $model->duyuruselect();
            $durum[0] = count($urunler);
            $durum[1] = count($kategoriler);
            $durum[2] = count($semtler);
            $durum[3] = count($mahalleler);
            $durum[4] = count($duyurular);
            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/home", $durum);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function Profil() {
        $id = Session::get("ID");
        if ($id < 0) {
            header("Refresh:0; url=" . SITE_URL);
        } else {
            $model = $this->load->model("Panel_Model");
            $profilarray = array();
            $profil = array();
            $kategori = array();
            //kategorileri listeleme
            $profilliste = $model->profilselect($id);
            foreach ($profilliste as $profillistee) {
                $profil['ID'] = $id;
                $profil['Ad'] = $profillistee['fwkullaniciAd'];
                $profil['Adres'] = $profillistee['fwkullaniciAdres'];
                $profil['Sehir'] = $profillistee['fwkullaniciSehir'];
                $profil['Cinsiyet'] = $profillistee['fwkullaniciCinsiyet'];
                $profil['Mail'] = $profillistee['fwkullaniciEmail'];
                $profil['Resim'] = $profillistee['fwkullanici_Resim'];
            }

            $kategoriliste = $model->kategoriselect();
            $a = 0;
            foreach ($kategoriliste as $kategorilistee) {
                $kategori[$a]['KategoriID'] = $kategorilistee['ID'];
                $kategori[$a]['Kategoriad'] = $kategorilistee['ad'];
                $kategori[$a]['KategoriIcerik'] = $kategorilistee['icerik'];
                $a++;
            }
            $profilarray[0] = $profil;
            $profilarray[1] = $kategori;

            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/profil", $profilarray);
            $this->load->view("Template_BackEnd/footer");
        }
    }

    public function kategoriler() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $kategori = array();
            //kategorileri listeleme
            $kategoriliste = $model->kategoriselect();
            $sayac = 0;
            foreach ($kategoriliste as $kategorilistee) {
                $kategori[$a]['KategoriID'] = $kategorilistee['KategoriID'];
                $kategori[$a]['KategoriAdiTR'] = $kategorilistee['KategoriAdiTR'];
                $kategori[$a]['tur'] = $kategorilistee['tur'];
                $sayac++;
            }

            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/kategoriler", $kategoriliste);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }
    
    public function duyuru() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $duyuru = array();
            //kategorileri listeleme
            $duyuruliste = $model->duyuruselect();
            $sayac = 0;
            foreach ($kategoriliste as $duyurulistee) {
                $duyuru[$a]['DuyuruID'] = $duyurulistee['DuyuruID'];
                $duyuru[$a]['BaslikTR'] = $duyurulistee['BaslikTR'];
                $duyuru[$a]['AciklamaTR'] = $duyurulistee['AciklamaTR'];
                $duyuru[$a]['Tarih'] = $duyurulistee['Tarih'];
                $duyuru[$a]['OzetTR'] = $duyurulistee['OzetTR'];
                $sayac++;
            }

            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/duyuru", $duyuruliste);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function semtler() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $semt = array();
            //kategorileri listeleme
            $semtliste = $model->semtselect();
            $sayac = 0;
            $a = 0;
            foreach ($semtliste as $semtlistee) {
                $semt[$a]['id'] = $semtlistee['id'];
                $semt[$a]['SemtAdi'] = $semtlistee['SemtAdi'];

                // $kategori[$a]['tur'] = $kategorilistee['tur'];
                $sayac++;
                $a++;
            }
           /// error_log(count($semt));
            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/semtler", $semt);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function urunler() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $urunarray = array();
            $kategori = array();
            $urun = array();

            $urunliste = $model->urunselect();
            $b = 0;
            foreach ($urunliste as $urunlistee) {
                $urun[$b]['urun_id'] = $urunlistee['urun_id'];
                $urun[$b]['urun_resim'] = $urunlistee['urun_resim'];
                $urun[$b]['urun_aciklama'] = $urunlistee['urun_aciklama'];
                $urun[$b]['urun_fiyat'] = $urunlistee['urun_fiyat'];
                $urun[$b]['urun_kategori'] = $urunlistee['urun_kategori'];
                $urun[$b]['urun_tarih'] = $urunlistee['urun_tarih'];
                $b++;
            }

            //kategorileri listeleme
            $kategoriliste = $model->kategoriselect();
            $a = 0;
            foreach ($kategoriliste as $kategorilistee) {
                $kategori[$a]['ID'] = $kategorilistee['ID'];
                $kategori[$a]['ad'] = $kategorilistee['ad'];
                $kategori[$a]['icerik'] = $kategorilistee['icerik'];
                $a++;
            }

            $urunarray[0] = $urun;
            $urunarray[1] = $kategori;


            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/urunler", $urunarray);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }
    
     public function mahalle() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $mahallearray = array();
            $semt = array();
            $mahal = array();

            $mahalleliste = $model->mahalleselect();
            $b = 0;
            foreach ($mahalleliste as $mahallelistee) {
                $mahal[$b]['id'] = $mahallelistee['id'];
                $mahal[$b]['MahalleAdi'] = $mahallelistee['MahalleAdi'];
                $mahal[$b]['SemtID'] = $mahallelistee['SemtID'];
                $b++;
            }

            //kategorileri listeleme
           $semtliste = $model->semtselect();
            $a = 0;
            foreach ($semtliste as $semtlistee) {
                $semt[$a]['id'] = $semtlistee['id'];
                $semt[$a]['SemtAdi'] = $semtlistee['SemtAdi'];

                // $kategori[$a]['tur'] = $kategorilistee['tur'];
                $sayac++;
                $a++;
            }

            $mahallearray[0] = $mahal;
            $mahallearray[1] = $semt;


            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/mahalle", $mahallearray);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function genelayarlar() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $ayararray = array();
            $ayarliste = $model->ayarselect();


            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/genelayarlar", $ayarliste);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function kategoriekle() {
        if (session::get("login") == true) {
            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/kategoriEkle");
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function urunekle() {
        if (session::get("login") == true) {
            $model = $this->load->model("Panel_Model");
            $kategori = array();
            //kategorileri listeleme
            $kategoriliste = $model->kategoriselect();
            $sayac = 0;
            foreach ($kategoriliste as $kategorilistee) {
                $kategori[$a]['ID'] = $kategorilistee['ID'];
                $kategori[$a]['ad'] = $kategorilistee['ad'];
                $kategori[$a]['icerik'] = $kategorilistee['icerik'];
                $sayac++;
            }


            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/urunEkle", $kategoriliste);
            $this->load->view("Template_BackEnd/footer");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

    public function iletisim() {
        if (session::get("login") == true) {
            $this->load->view("Template_BackEnd/header");
            $this->load->view("Template_BackEnd/left");
            $this->load->view("Template_BackEnd/iletisim");
            $this->load->view("Template_BackEnd/footer");
            $this->load->view("Template_BackEnd/right");
        } else {
            $this->load->view("Entry/loginForm");
        }
    }

}
?>

