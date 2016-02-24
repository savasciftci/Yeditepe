<?php

class Home extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->front();
    }

    public function front() {
        $model = $this->load->model("Panel_Model");
        $urunarray = array();
        $kategori = array();
        $kategoriler = array();
        $urun = array();

        $urunliste = $model->urunselect();
        $b = 0;
        foreach ($urunliste as $urunlistee) {
            $urun[$b]['urun_id'] = $urunlistee['urun_id'];
            $urun[$b]['urun_resim'] = $urunlistee['urun_resim'];
            $urun[$b]['urun_aciklama'] = $urunlistee['urun_aciklama'];
            $urun[$b]['urun_fiyat'] = $urunlistee['urun_fiyat'];
            $urun[$b]['urun_kategori'] = $urunlistee['urun_kategori'];
            $b++;
        }

        //kategorileri listeleme
        $kategoriliste = $model->kategoriAnasayfa();
        $a = 0;
        foreach ($kategoriliste as $kategorilistee) {
            $kategori[$a]['ID'] = $kategorilistee['ID'];
            $kategori[$a]['ad'] = $kategorilistee['ad'];
            $a++;
        }
        //kategorileri Menü listeleme
        $kategoriMenu = $model->kategoriselect();
        $a = 0;
        foreach ($kategoriMenu as $kategorilistee) {
            $kategoriler[$a]['ID'] = $kategorilistee['ID'];
            $kategoriler[$a]['ad'] = $kategorilistee['ad'];
            $a++;
        }


        $urunarray[0] = $urun;
        $urunarray[1] = $kategori;


        $this->load->view("Template_FrontEnd/header", $kategoriler);
        $this->load->view("Template_FrontEnd/home", $urunarray);
        $this->load->view("Template_FrontEnd/footer");
    }

    public function urunler() {

        $model = $this->load->model("Panel_Model");

        $id = Session::get("urunKatID");
          $kategori = array();
          $urun = array();
          $urunler = array();
          $urunliste = $model->urunListeselect($id);
          $b = 0;
          foreach ($urunliste as $urunlistee) {
          $urun[$b]['urun_id'] = $urunlistee['urun_id'];
          $urun[$b]['urun_resim'] = $urunlistee['urun_resim'];
          $urun[$b]['urun_aciklama'] = $urunlistee['urun_aciklama'];
          $urun[$b]['urun_fiyat'] = $urunlistee['urun_fiyat'];
          $urun[$b]['urun_kategori'] = $urunlistee['urun_kategori'];
          $b++;
          }
          error_log("b sayısı:".$b);
          //kategorileri listeleme
          $kategoriliste = $model->kategoriselect();
          $a = 0;
          foreach ($kategoriliste as $kategorilistee) {
          $kategori[$a]['ID'] = $kategorilistee['ID'];
          $kategori[$a]['ad'] = $kategorilistee['ad'];
          $a++;
          }
          $urunler[0] = $urun;
          $urunler[1] = $kategori;
          $urunler[2] = $id;
      
        $this->load->view("Template_FrontEnd/header", $kategori);
        $this->load->view("Template_FrontEnd/urunler", $urunler);
        $this->load->view("Template_FrontEnd/footer");
    }

    public function hakkimizda() {
                $model = $this->load->model("Panel_Model");

        $kategori = array();
        $ayar = array();
        $ayarlar = $model->ayarselect(1);
        $ayarlar['hakkinda'];


        //kategorileri listeleme
        $kategoriliste = $model->kategoriselect();
        $a = 0;
        foreach ($kategoriliste as $kategorilistee) {
            $kategori[$a]['ID'] = $kategorilistee['ID'];
            $kategori[$a]['ad'] = $kategorilistee['ad'];
            $a++;
        }

        $this->load->view("Template_FrontEnd/header",$kategori);
        $this->load->view("Template_FrontEnd/hakkimizda",$ayarlar);
        $this->load->view("Template_FrontEnd/footer");
    }

    public function iletisim() {
        $model = $this->load->model("Panel_Model");

        $kategori = array();
        $ayar = array();
        $ayarlar = $model->ayarselect(1);
        $b = 0;
        foreach ($ayarlar as $ayarlarr) {
            $ayar[$b]['is_tel'] = $ayarlarr['is_tel'];
            $ayar[$b]['cep_tel'] = $ayarlarr['cep_tel'];
            $ayar[$b]['site_mail'] = $ayarlarr['site_mail'];
            $ayar[$b]['adres'] = $ayarlarr['adres'];
            $b++;
        }

        //kategorileri listeleme
        $kategoriliste = $model->kategoriselect();
        $a = 0;
        foreach ($kategoriliste as $kategorilistee) {
            $kategori[$a]['ID'] = $kategorilistee['ID'];
            $kategori[$a]['ad'] = $kategorilistee['ad'];
            $a++;
        }

        $this->load->view("Template_FrontEnd/header", $kategori);
        $this->load->view("Template_FrontEnd/iletisim", $ayar);
        $this->load->view("Template_FrontEnd/footer");
    }

    public function header() {
        $model = $this->load->model("Panel_Model");
        $kategori = array();

        //kategorileri listeleme
        $kategoriliste = $model->kategoriselect();
        $a = 0;
        foreach ($kategoriliste as $kategorilistee) {
            $kategori[$a]['ID'] = $kategorilistee['ID'];
            $kategori[$a]['ad'] = $kategorilistee['ad'];
            $a++;
        }
        

        return $kategori;
    }

}
?>

