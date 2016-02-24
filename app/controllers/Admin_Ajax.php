<?php

class Admin_Ajax extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->ajaxCall();
    }

    public function ajaxCall() {
        //session güvenlik kontrolü
        $form = $this->load->otherClasses('Form');

        if ($_POST && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
            $sonuc = array();
            //model bağlantısı
            $Panel_Model = $this->load->model("Panel_Model");
            $form->post("tip", true);
            $tip = $form->values['tip'];
            Switch ($tip) {
                case "profilDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("ad", true);
                    $form->post("adres", true);
                    $form->post("sehir", true);
                    $form->post("cinsiyetval", true);
                    $form->post("email", true);
                    $ad = $form->values['ad'];
                    $adres = $form->values['adres'];
                    $sehir = $form->values['sehir'];
                    $cinsiyetval = $form->values['cinsiyetval'];
                    $email = $form->values['email'];
                    if ($ad != "") {
                        if ($adres != "") {
                            if ($sehir != "") {
                                if ($cinsiyetval != 0) {
                                    if ($email != "") {
                                        $realName = $_FILES['file']['name'];
                                        if ($realName != "") {
                                            $image = new Upload($_FILES['file']);
                                            if ($image->uploaded) {
                                                // sadece resim formatları yüklensin
                                                $image->allowed = array('image/*');
                                                $image->image_min_height = 250;
                                                $image->image_min_width = 250;
                                                $image->image_max_height = 2000;
                                                $image->image_max_width = 2000;
                                                $image->file_new_name_body = time();
                                                $image->file_name_body_pre = 'profil_';
                                                $image->image_resize = true;
                                                $image->image_ratio_crop = true;
                                                $image->image_x = 900;
                                                $image->image_y = 900;
                                                $image->Process("upload/profil");
                                                if ($image->processed) {
                                                    $id = Session::get("ID");
                                                    if ($form->submit()) {
                                                        Session::set("presim", $image->file_dst_name);
                                                        $dataProfil = array(
                                                            'fwkullaniciAd' => $ad,
                                                            'fwkullaniciAdres' => $adres,
                                                            'fwkullaniciSehir' => $sehir,
                                                            'fwkullaniciCinsiyet' => $cinsiyetval,
                                                            'fwkullaniciEmail' => $email,
                                                            'fwkullanici_Resim' => $image->file_dst_name
                                                        );
                                                    }
                                                    $result = $Panel_Model->profilupdate($dataProfil, $id);
                                                    if ($result) {
                                                        $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                                    } else {
                                                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                                    }
                                                } else {
                                                    $sonuc["hata"] = $image->error;
                                                }
                                            } else {
                                                $sonuc["hata"] = $image->error;
                                            }
                                        } else {
                                            $sonuc["hata"] = "Lütfen Resim Seçiniz";
                                        }
                                    } else {
                                        $sonuc["hata"] = "Lütfen maili boş girmeyiniz.";
                                    }
                                } else {
                                    $sonuc["hata"] = "Lütfen cinsiyeti boş girmeyiniz.";
                                }
                            } else {
                                $sonuc["hata"] = "Lütfen şehri boş girmeyiniz.";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen adresi boş girmeyiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen adınızı boş girmeyiniz.";
                    }
                    break;
                case "ayarDuzenle":
                    $form->post("baslik", true);
                    $form->post("aciklama", true);
                    $form->post("is", true);
                    $form->post("cep", true);
                    $form->post("mail", true);
                    $form->post("adres", true);
                    $form->post("hakkinda", true);
                    $baslik = $form->values['baslik'];
                    $aciklama = $form->values['aciklama'];
                    $is = $form->values['is'];
                    $cep = $form->values['cep'];
                    $mail = $form->values['mail'];
                    $adres = $form->values['adres'];
                    $hakkinda = $form->values['hakkinda'];
                    if ($baslik != "") {
                        if ($aciklama != "") {
                            if ($is != "") {
                                if ($cep != "") {
                                    if ($mail != "") {
                                        if ($adres != "") {
                                            if ($hakkinda != "") {
                                                $id = 1;
                                                if ($form->submit()) {
                                                    $dataAyar = array(
                                                        'site_baslik' => $baslik,
                                                        'site_aciklama' => $aciklama,
                                                        'is_tel' => $is,
                                                        'cep_tel' => $cep,
                                                        'site_mail' => $mail,
                                                        'adres' => $adres,
                                                        'hakkinda' => $hakkinda
                                                    );
                                                }
                                                $result = $Panel_Model->ayarupdate($dataAyar, $id);
                                                if ($result) {
                                                    $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                                } else {
                                                    $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                                }
                                            } else {
                                                $sonuc["hata"] = "Lütfen hakkında sayfası iceriğini giriniz";
                                            }
                                        } else {
                                            $sonuc["hata"] = "Lütfen adresi boş bırakmayınız.";
                                        }
                                    } else {
                                        $sonuc["hata"] = "Lütfen maili boş girmeyiniz.";
                                    }
                                } else {
                                    $sonuc["hata"] = "Lütfen cep telefonu boş bırakmayınız.";
                                }
                            } else {
                                $sonuc["hata"] = "Lütfen is telefonu boş bırakmayınız.";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen acıklamayı boş bırakmayınız.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen basliği boş girmeyiniz.";
                    }
                    break;
                case "profilSil":
                    $form->post("yeniveri", true);
                    $id = $form->values['yeniveri'];
                    $resultdelete = $Panel_Model->profildelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "KategoriEkle":
                    $form->post("kategoriAd", true);
                    $form->post("kicerik", true);
                    $kategoriAd = $form->values['kategoriAd'];
                    $kicerik = $form->values['kicerik'];

                    if ($kicerik != "") {
                        if ($kategoriAd != "") {
                            if ($form->submit()) {
                                $dataKategori = array(
                                    'ad' => $kategoriAd,
                                    'icerik' => $kicerik
                                );
                                $result = $Panel_Model->kategoriinsert($dataKategori);
                                if ($result) {
                                    $sonuc["result"] = "Başarılı bir şekilde kategori eklenmiştir.";
                                } else {
                                    $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                }
                            } else {
                                
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen kategoriyi boş girmeyiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen iceriği boş girmeyiniz.";
                    }
                    break;
                case "katduzenle":
                    $form->post("ad", true);
                    $form->post("anasayfadurum", true);
                    $form->post("id", true);
                    $ad = $form->values['ad'];
                    $anasayfadurum = $form->values['anasayfadurum'];
                    $id = $form->values['id'];
                    if ($ad != "") {
                        if ($anasayfadurum != "") {
                            error_log($anasayfadurum);
                            if ($form->submit()) {
                                $dataKategori = array(
                                    'ad' => $ad,
                                    'anasayfa_durum' => $anasayfadurum
                                );
                            }
                            $result = $Panel_Model->kategoriupdate($dataKategori, $id);
                            error_log("reslu:" . $result);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Anasayfada gözüksünmü belirleyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen adınızı boş girmeyiniz.";
                    }
                    break;
                case "katEkle":
                    $form->post("ad", true);
                    $form->post("anasayfadurum", true);
                    $ad = $form->values['ad'];
                    $anasayfadurum = $form->values['anasayfadurum'];
                    if ($ad != "") {
                        if ($anasayfadurum != "") {
                            if ($form->submit()) {
                                $dataKategori = array(
                                    'ad' => $ad,
                                    'anasayfa_durum' => $anasayfadurum
                                );
                            }
                            $result = $Panel_Model->kategoriinsert($dataKategori, $id);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde kategori eklenmiştir.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen ekranda gözükmesini seciniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen adınızı boş girmeyiniz.";
                    }
                    break;
                case "kategoriSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->kategoridelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "urunSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->urundelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "urunDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("aciklama", true);
                    $form->post("fiyat", true);
                    $form->post("kategoriID", true);
                    $form->post("id", true);

                    $aciklama = $form->values['aciklama'];
                    $fiyat = $form->values['fiyat'];
                    $kategoriID = $form->values['kategoriID'];
                    $id = $form->values['id'];
                    if ($aciklama != "") {
                        if ($kategoriID != -1) {
                            $realName = $_FILES['file']['name'];
                            if ($realName != "") {
                                $image = new Upload($_FILES['file']);
                                if ($image->uploaded) {
                                    // sadece resim formatları yüklensin
                                    $image->allowed = array('image/*');
                                    $image->image_min_height = 250;
                                    $image->image_min_width = 250;
                                    $image->image_max_height = 2000;
                                    $image->image_max_width = 2000;
                                    $image->file_new_name_body = time();
                                    $image->file_name_body_pre = 'mobilya_';
                                    $image->image_resize = true;
                                    $image->image_ratio_crop = true;
                                    $image->image_x = 900;
                                    $image->image_y = 900;
                                    $image->Process("upload/urunler");
                                    if ($image->processed) {
                                        if ($form->submit()) {
                                            $dataUrun = array(
                                                'urun_aciklama' => $aciklama,
                                                'urun_fiyat' => $fiyat,
                                                'urun_kategori' => $kategoriID,
                                                'urun_resim' => $image->file_dst_name
                                            );
                                        }
                                        $result = $Panel_Model->urunupdate($dataUrun, $id);
                                        if ($result) {
                                            $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                        } else {
                                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                        }
                                    } else {
                                        $sonuc["hata"] = $image->error;
                                    }
                                } else {
                                    $sonuc["hata"] = $image->error;
                                }
                            } else {
                                if ($form->submit()) {
                                    $dataUrun = array(
                                        'urun_aciklama' => $aciklama,
                                        'urun_fiyat' => $fiyat,
                                        'urun_kategori' => $kategoriID
                                    );
                                }
                                $result = $Panel_Model->urunupdate($dataUrun, $id);
                                if ($result) {
                                    $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                } else {
                                    $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                }
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen bir kategori seçiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen açıklamayı boş girmeyiniz.";
                    }
                    break;
                case "urunEkle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("urunaciklama", true);
                    $form->post("urunkategori", true);
                    $form->post("urunfiyat", true);
                    $urunaciklama = $form->values['urunaciklama'];
                    $urunkategori = $form->values['urunkategori'];
                    $urunfiyat = $form->values['urunfiyat'];
                    if ($urunaciklama != "") {
                        if ($urunkategori != "") {
                                $realName = $_FILES['file']['name'];
                                if ($realName != "") {
                                    $image = new Upload($_FILES['file']);
                                    if ($image->uploaded) {
                                        // sadece resim formatları yüklensin
                                        $image->allowed = array('image/*');
                                        $image->image_min_height = 250;
                                        $image->image_min_width = 250;
                                        $image->image_max_height = 2000;
                                        $image->image_max_width = 2000;
                                        $image->file_new_name_body = time();
                                        $image->file_name_body_pre = 'mobilya_';
                                        $image->image_resize = true;
                                        $image->image_ratio_crop = true;
                                        $image->image_x = 900;
                                        $image->image_y = 900;
                                        $image->Process("upload/urunler");

                                        if ($image->processed) {
                                            if ($form->submit()) {
                                                $dataurun = array(
                                                    'urun_aciklama' => $urunaciklama,
                                                    'urun_kategori' => $urunkategori,
                                                    'urun_fiyat' => $urunfiyat,
                                                    'urun_resim' => $image->file_dst_name
                                                );
                                            }
                                            $result = $Panel_Model->uruninsert($dataurun);
                                            if ($result) {
                                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                            } else {
                                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                            }
                                        } else {
                                            $sonuc["hata"] = $image->error;
                                        }
                                    } else {
                                        $sonuc["hata"] = $image->error;
                                    }
                                } else {
                                    $sonuc["hata"] = "Lütfen Resim Seçiniz";
                                }
                           
                        } else {
                            $sonuc["hata"] = "Lütfen kategori seciniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen açıklamayı  boş girmeyiniz.";
                    }



                    break;
                default :
                    header("Location:" . SITE_URL);
                    break;
            }
            echo json_encode($sonuc);
        } else {
            header("Location:" . SITE_URL);
        }
    }

}
?>
                                                                                                     
