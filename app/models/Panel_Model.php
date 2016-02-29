<?php

class Panel_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function select() {
        $sql = "SELECT * FROM table";
        return $this->db->select($sql);
    }

    public function insert($data) {
        return ($this->db->insert("table", $data));
    }

    public function update($data, $gelenid) {
        return ($this->db->update("table", $data, "table_id=$gelenid"));
    }

    public function delete($gelenid) {
        return ($this->db->delete("table", "table_id=$gelenid"));
    }

    //login select formu
    public function loginselect($email, $sifre) {
        $sql = "SELECT fwkullaniciID,fwkullaniciAd,fwkullaniciEmail,fwkullanici_Resim FROM fwkullanicilar WHERE fwkullaniciEmail='$email' AND fwkullaniciSifre='$sifre'";
        return $this->db->select($sql);
    }

    //login select formu
    public function profilselect($id) {
        $sql = "SELECT fwkullaniciAd,fwkullaniciAdres,fwkullaniciSehir,fwkullaniciCinsiyet,fwkullaniciEmail FROM fwkullanicilar WHERE fwkullaniciID=$id";
        return $this->db->select($sql);
    }

    //kategori select formu
    public function kategoriselect() {
        $sql = "SELECT KategoriID,KategoriAdiTR,tur FROM kategori";
        return $this->db->select($sql);
    }
    
     public function duyuruselect() {
        $sql = "SELECT * FROM duyuru";
        return $this->db->select($sql);
    }

    public function semtselect() {
        $sql = "SELECT * FROM semtler";
        error_log($sql);
        return $this->db->select($sql);
    }

    public function kategoriAnasayfa() {
        $sql = "SELECT ID,ad,anasayfa_durum FROM kategori where anasayfa_durum=1 ";
        return $this->db->select($sql);
    }

    public function profilupdate($dataProfil, $gelenid) {
        return ($this->db->update("fwkullanicilar", $dataProfil, "fwkullaniciID=$gelenid"));
    }

    public function profildelete($id) {
        return ($this->db->delete("fwkullanicilar", "fwkullaniciID=$id"));
    }

    public function logininsert($data) {
        return ($this->db->insert("fwkullanicilar", $data));
    }

    public function kategoriinsert($data) {
        return ($this->db->insert("kategori", $data));
    }

    public function semtinsert($data) {
        return ($this->db->insert("semtler", $data));
    }
    
      public function mahalinsert($dataMahal) {
        return ($this->db->insert("mahalleler", $dataMahal));
    }

    public function uruninsert($dataurun) {
        return ($this->db->insert("urunler", $dataurun));
    }

    //kategori select formu
    public function urunselect() {
        $sql = "SELECT urun_id,urun_resim,urun_aciklama,urun_fiyat,urun_kategori,urun_tarih FROM urunler";
        return $this->db->select($sql);
    }
    
    public function mahalleselect() {
        $sql = "SELECT * FROM mahalleler";
        return $this->db->select($sql);
    }

    public function urunListeselect($katid) {
        $sql = "SELECT urun_id,urun_resim,urun_aciklama,urun_fiyat,urun_kategori,urun_tarih FROM urunler where urun_kategori=$katid";
        error_log("sql->" . $sql);
        return $this->db->select($sql);
    }

    public function urunAnasayfa() {
        $sql = "SELECT urun_id,urun_resim,urun_aciklama,urun_fiyat,urun_kategori FROM urunler order by urun_id desc limit 0,6";
        return $this->db->select($sql);
    }

    public function kategoriupdate($dataKategori, $gelenid) {
        return ($this->db->update("kategori", $dataKategori, "KategoriID=$gelenid"));
    }
    
     public function duyuruupdate($dataDuyuru, $gelenid) {
        return ($this->db->update("duyuru", $dataDuyuru, "DuyuruID=$gelenid"));
    }
    
    public function mahalleupdate($datamahal, $id) {
        return ($this->db->update("mahalleler", $datamahal, "id=$id"));
    }
    
      public function semtupdate($dataSemt, $gelenid) {
        return ($this->db->update("semtler", $dataSemt, "id=$gelenid"));
    }

    public function urunupdate($dataUrun, $gelenid) {
        return ($this->db->update("urunler", $dataUrun, "urun_id=$gelenid"));
    }

    public function urundelete($gelenid) {
        return ($this->db->delete("urunler", "urun_id=$gelenid"));
    }
    
      public function mahdelete($gelenid) {
        return ($this->db->delete("mahalleler", "id=$gelenid"));
    }

    public function kategoridelete($gelenid) {
        return ($this->db->delete("kategori", "KategoriID=$gelenid"));
    }
    
     public function duyurudelete($gelenid) {
        return ($this->db->delete("duyuru", "DuyuruID=$gelenid"));
    }
    
     public function semtdelete($gelenid) {
        return ($this->db->delete("semtler", "id=$gelenid"));
    }

    //login select formu
    public function ayarselect($id) {
        $sql = "SELECT site_baslik,site_aciklama,is_tel,cep_tel,site_mail,adres,hakkinda FROM ayar WHERE id=1";
        return $this->db->select($sql);
    }

    public function ayarupdate($dataAyar, $id) {
        return ($this->db->update("ayar", $dataAyar, "id=$id"));
    }

}

?>
