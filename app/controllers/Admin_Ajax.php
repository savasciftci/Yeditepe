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
                case "mahalleduzenle":
                    $form->post("ad", true);
                    $form->post("anasayfadurum", true);
                    $form->post("id", true);
                    $ad = $form->values['ad'];
                    $anasayfadurum = $form->values['anasayfadurum'];
                    $id = $form->values['id'];
                    if ($ad != "") {
                        if ($anasayfadurum != "" && $anasayfadurum != -1) {
                            // error_log($anasayfadurum);
                            if ($form->submit()) {
                                $datamahal = array(
                                    'MahalleAdi' => $ad,
                                    'SemtID' => $anasayfadurum
                                );
                            }
                            $result = $Panel_Model->mahalleupdate($datamahal, $id);
                            error_log("reslu:" . $result);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                            } else {
                                error_log("reslu:" . $result);
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Mahallenin semtini belirleyiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen mahallenin adını boş girmeyiniz .";
                    }

                    break;
                case "katduzenle":
                    $form->post("ad", true);
                    $form->post("kategoritip", true);
                    $form->post("id", true);
                    $ad = $form->values['ad'];
                    $kategoritip = $form->values['kategoritip'];
                    $id = $form->values['id'];
                    if ($ad != "") {
                        if ($kategoritip != "" && $kategoritip > 0) {
                            // error_log($anasayfadurum);
                            if ($form->submit()) {
                                $dataKategori = array(
                                    'KategoriAdiTR' => $ad,
                                    'tur' => $kategoritip
                                );
                            }
                            $result = $Panel_Model->kategoriupdate($dataKategori, $id);
                            //error_log("reslu:" . $result);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Kategorisini belirleyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen kategori adını boş bırakmayınız.";
                    }
                    break;
                case "changePass":
                    $form->post("oldpass", true);
                    $form->post("newpass", true);
                    $oldpass = $form->values['oldpass'];
                    $newpass = $form->values['newpass'];
                    if ($oldpass != "") {
                        if ($newpass != "") {
                            // error_log($anasayfadurum);
                            if ($form->submit()) {
                                $dataSifre = array(
                                    'fwkullaniciSifre' => md5($newpass)
                                );
                            }
                            $result = $Panel_Model->passwordupdate($dataSifre, md5($oldpass));
                            //error_log("reslu:" . $result);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Yeni Şifre kısmını boş bırakmayınız.";
                        }
                    } else {
                        $sonuc["hata"] = "Eski sifre kısmını boş girmeyiniz.";
                    }
                    break;
                case "yaziduzenle":
                    $baslik = $_POST['baslik'];
                    $yazii = $_POST['yazii'];
                    $form->post("id", true);
                    $id = $form->values['id'];
                    if ($baslik != "") {
                        if ($yazii != "") {
                            // error_log($anasayfadurum);
                            if ($form->submit()) {
                                $dataYazi = array(
                                    'Baslik' => $baslik,
                                    'Yazi' => $yazii
                                );
                            }
                            $result = $Panel_Model->yaziupdate($dataYazi, $id);
                            //error_log("reslu:" . $result);
                            if ($result) {
                                $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Kategorisini belirleyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen kategori adını boş bırakmayınız.";
                    }
                    break;
                case "duyduzenle":
                    $form->post("anasayfadurum", true);
                    $form->post("id", true);
                    $anasayfadurum = $form->values['anasayfadurum'];
                    $id = $form->values['id'];
                    if ($anasayfadurum != "" && $anasayfadurum >= 0) {
                        // error_log($anasayfadurum);
                        if ($form->submit()) {
                            $dataDuyuru = array(
                                'onay' => $anasayfadurum
                            );
                        }
                        $result = $Panel_Model->duyuruupdate($dataDuyuru, $id);
                        if ($result) {
                            $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                        } else {
                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Anasayfada gözüksünmü belirleyiniz";
                    }
                    break;
                case "semtduzenle":
                    $form->post("ad", true);
                    $form->post("id", true);
                    $ad = $form->values['ad'];
                    $id = $form->values['id'];
                    if ($ad != "") {
                        // error_log($anasayfadurum);
                        if ($form->submit()) {
                            $dataSemt = array(
                                'SemtAdi' => $ad
                            );
                        }
                        $result = $Panel_Model->semtupdate($dataSemt, $id);
                        // error_log("reslu:" . $result);
                        if ($result) {
                            $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                        } else {
                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen semt adını boş girmeyiniz.";
                    }
                    break;
                case "katEkle":
                    $form->post("ad", true);
                    $form->post("anasayfadurum", true);
                    $ad = $form->values['ad'];
                    $anasayfadurum = $form->values['anasayfadurum'];
                    if ($ad != "") {
                        if ($anasayfadurum != "" && $anasayfadurum > 0) {
                            if ($form->submit()) {
                                $dataKategori = array(
                                    'KategoriAdiTR' => $ad,
                                    'tur' => $anasayfadurum
                                );
                            }
                            $result = $Panel_Model->kategoriinsert($dataKategori, $id);
                            if ($result) {
                                $sonuc["ID"] = $result;
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
                case "semtEkle":
                    $form->post("ad", true);
                    $ad = $form->values['ad'];
                    if ($ad != "") {
                        if ($form->submit()) {
                            $dataSemt = array(
                                'SemtAdi' => $ad
                            );
                        }
                        $result = $Panel_Model->semtinsert($dataSemt, $id);
                        if ($result) {
                            $sonuc["ID"] = $result;
                            $sonuc["result"] = "Başarılı bir şekilde semt eklenmiştir.";
                        } else {
                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen adınızı boş girmeyiniz.";
                    }
                    break;
                case "yaziEkle":
                    $yazii = $_POST['yazii'];
                    $baslik = $_POST['baslik'];
                    if ($baslik != "") {
                        if ($yazii != "") {
                            if ($form->submit()) {
                                $dataYazi = array(
                                    'Baslik' => $baslik,
                                    'Yazi' => $yazii
                                );
                            }
                            $result = $Panel_Model->yaziinsert($dataYazi, $id);
                            if ($result) {
                                $sonuc["ID"] = $result;
                                $sonuc["result"] = "Başarılı bir şekilde semt eklenmiştir.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen yazı kısmını boş girmeyiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen başlığı boş girmeyiniz.";
                    }
                    break;
                case "mahalekle":
                    $form->post("mahalad", true);
                    $form->post("semtad", true);
                    $mahalle = $form->values['mahalad'];
                    $msemt = $form->values['semtad'];
                    if ($mahalle != "") {
                        if ($msemt != "" && $msemt != -1) {
                            if ($form->submit()) {
                                $dataMahal = array(
                                    'MahalleAdi' => $mahalle,
                                    'SemtID' => $msemt
                                );
                            }
                            $result = $Panel_Model->mahalinsert($dataMahal, $id);
                            if ($result) {
                                $sonuc["ID"] = $result;
                                $sonuc["result"] = "Başarılı bir şekilde kategori eklenmiştir.";
                            } else {
                                $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen bağlı olduğu bir semt seçin.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen mahalle adını boş girmeyiniz.";
                    }
                    break;
                case "duyuruSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->duyurudelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
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
                case "semtsil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->semtdelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "yazisil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->yazidelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "aboutSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->aboutdelete($id);
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
                case "mahSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->mahdelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "markSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->markdelete($id);
                    if ($resultdelete) {
                        $sonuc["result"] = "İşlem Başarılı.";
                    } else {
                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                    }
                    break;
                case "vitrinSil":
                    $form->post("id", true);
                    $id = $form->values['id'];
                    $resultdelete = $Panel_Model->vitrindelete($id);
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
                case "markDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("aciklama", true);
                    $form->post("url", true);
                    $form->post("kategoriID", true);
                    $form->post("id", true);
                    $aciklama = $form->values['aciklama'];
                    $url = $form->values['url'];
                    $kategoriID = $form->values['kategoriID'];
                    $id = $form->values['id'];
                    if ($aciklama != "") {
                        if ($kategoriID != -1) {
                            $realName = $_FILES['file']['name'];
                            if ($realName != "") {
                                $image = new Upload($_FILES['file']);
                                $image = new Upload($_FILES['file']);
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                //oranlama
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                if ($image->uploaded) {
                                    // sadece resim formatları yüklensin
                                    $image->allowed = array('image/*');
                                    $image->image_min_height = 250;
                                    $image->image_min_width = 250;
                                    $image->image_max_height = 2000;
                                    $image->image_max_width = 2000;
                                    $image->file_new_name_body = time();
                                    $image->file_name_body_pre = 'marka_';
                                    $image->image_resize = true;
                                    $image->image_ratio_crop = true;
                                    $image->image_x = 217;
                                    $image->image_y = 122;
                                    $image->Process("upload/markalar");
                                    if ($image->processed) {
                                        if ($form->submit()) {
                                            $dataMark = array(
                                                'MarkaAdi' => $aciklama,
                                                'url' => $url,
                                                'Tur' => $kategoriID,
                                                'ResimYolu' => $image->file_dst_name
                                            );
                                        }
                                        $result = $Panel_Model->markupdate($dataMark, $id);
                                        if ($result) {
                                            $sonuc["yol"] = $image->file_dst_name;
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
                                    $dataMark = array(
                                        'MarkaAdi' => $aciklama,
                                        'url' => $url,
                                        'Tur' => $kategoriID
                                    );
                                }
                                $result = $Panel_Model->markupdate($dataMark, $id);
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
                        $sonuc["hata"] = "Lütfen marka adını boş bırakmayınız.";
                    }
                    break;
                case "ayarDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("baslik", true);
                    $form->post("aciklama", true);
                    $form->post("is", true);
                    $form->post("is3", true);
                    $form->post("is4", true);
                    $form->post("iframe", true);
                    $form->post("cep", true);
                    $form->post("mail", true);
                    $form->post("adres", true);
                    $baslik = $form->values['baslik'];
                    $aciklama = $form->values['aciklama'];
                    $is = $form->values['is'];
                    $is3 = $form->values['is3'];
                    $is4 = $form->values['is4'];
                    $cep = $form->values['cep'];
                    $mail = $form->values['mail'];
                    $adres = $form->values['adres'];
                    $iframe = $form->values['iframe'];
                    if ($baslik != "") {
                        if ($aciklama != "") {
                            $realName = $_FILES['file']['name'];
                            $id = 1;
                            if ($realName != "") {
                                $image = new Upload($_FILES['file']);
                                $image = new Upload($_FILES['file']);
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                //oranlama
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                if ($image->uploaded) {
                                    // sadece resim formatları yüklensin
                                    $image->allowed = array('image/*');
                                    $image->image_min_height = 100;
                                    $image->image_min_width = 100;
                                    $image->image_max_height = 2000;
                                    $image->image_max_width = 2000;
                                    $image->file_new_name_body = time();
                                    $image->file_name_body_pre = 'logo_';
                                    $image->image_resize = true;
                                    $image->image_ratio_crop = true;
                                    $image->image_x = 300;
                                    $image->image_y = 110;
                                    $image->Process("upload/logo");
                                    if ($image->processed) {
                                        if ($form->submit()) {
                                            $dataAyar = array(
                                                'site_baslik' => $baslik,
                                                'site_aciklama' => $aciklama,
                                                'is_tel' => $is,
                                                'is_tel3' => $is3,
                                                'is_tel4' => $is4,
                                                'iframe' => $iframe,
                                                'cep_tel' => $cep,
                                                'site_mail' => $mail,
                                                'adres' => $adres,
                                                'resim' => $image->file_dst_name
                                            );
                                        }
                                        $result = $Panel_Model->ayarupdate($dataAyar, $id);
                                        if ($result) {
                                            $sonuc["yol"] = $image->file_dst_name;
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
                                    $dataAyar = array(
                                        'site_baslik' => $baslik,
                                        'site_aciklama' => $aciklama,
                                        'is_tel' => $is,
                                        'is_tel3' => $is3,
                                        'is_tel4' => $is4,
                                        'iframe' => $iframe,
                                        'cep_tel' => $cep,
                                        'site_mail' => $mail,
                                        'adres' => $adres
                                    );
                                }
                                $result = $Panel_Model->ayarupdate($dataAyar, $id);
                                if ($result) {
                                    $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                } else {
                                    $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                }
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen site açıklamasını giriniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen site başlığını giriniz.";
                    }
                    break;
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
                                if ($email != "") {
                                    $realName = $_FILES['file']['name'];
                                    $id = Session::get("ID");
                                    if ($realName != "") {
                                        $image = new Upload($_FILES['file']);
                                        $image = new Upload($_FILES['file']);
                                        $width = $image->image_src_x;
                                        $height = $image->image_src_y;
                                        $oran = $width / $height;
                                        if ($oran < 1) {
                                            $newheight = 400;
                                            $newwidth = round($height * $oran);
                                        } else if ($oran == 1) {
                                            $newheight = 400;
                                            $newwidth = 500;
                                        } else {
                                            $newheight = round($width / $oran);
                                            $newwidth = 500;
                                        }
                                        //oranlama
                                        $width = $image->image_src_x;
                                        $height = $image->image_src_y;
                                        $oran = $width / $height;
                                        if ($oran < 1) {
                                            $newheight = 400;
                                            $newwidth = round($height * $oran);
                                        } else if ($oran == 1) {
                                            $newheight = 400;
                                            $newwidth = 500;
                                        } else {
                                            $newheight = round($width / $oran);
                                            $newwidth = 500;
                                        }
                                        if ($image->uploaded) {
                                            // sadece resim formatları yüklensin
                                            $image->allowed = array('image/*');
                                            $image->image_min_height = 100;
                                            $image->image_min_width = 100;
                                            $image->image_max_height = 2000;
                                            $image->image_max_width = 2000;
                                            $image->file_new_name_body = time();
                                            $image->file_name_body_pre = 'profil_';
                                            $image->image_resize = true;
                                            $image->image_ratio_crop = true;
                                            $image->image_x = 300;
                                            $image->image_y = 300;
                                            $image->Process("upload/profil");
                                            if ($image->processed) {
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
                                                    $sonuc["yol"] = $image->file_dst_name;
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
                                            $dataProfil = array(
                                                'fwkullaniciAd' => $ad,
                                                'fwkullaniciAdres' => $adres,
                                                'fwkullaniciSehir' => $sehir,
                                                'fwkullaniciCinsiyet' => $cinsiyetval,
                                                'fwkullaniciEmail' => $email
                                            );
                                        }
                                        $result = $Panel_Model->profilupdate($dataProfil, $id);
                                        if ($result) {
                                            $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                        } else {
                                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                        }
                                    }
                                } else {
                                    $sonuc["hata"] = "Lütfen mail adresinizi giriniz.";
                                }
                            } else {
                                $sonuc["hata"] = "Lütfen şehrinizi giriniz.";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen adres alanınızı doldurunuz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen isim kısmını boş girmeyiniz.";
                    }
                    break;
                case "vitrinDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("sirasi", true);
                    $form->post("degisecekSira", true);
                    $form->post("url", true);
                    $form->post("vitrinkategorii", true);
                    $form->post("id", true);
                    $form->post("degisecekID", true);
                    $sirasi = $form->values['sirasi'];
                    $degisecekSira = $form->values['degisecekSira'];
                    $url = $form->values['url'];
                    $vitrinkategorii = $form->values['vitrinkategorii'];
                    $id = $form->values['id'];
                    $degisecekID = $form->values['degisecekID'];
//                    error_log("değişecek sira".$degisecekSira);
//                    error_log("normal yeni sirasi".$sirasi);
//                    error_log("id siiii".$id);
//                    error_log("değişeceğin id si".$degisecekID);
                    if ($sirasi != "") {
                        if ($vitrinkategorii != -1) {
                            $realName = $_FILES['file']['name'];
                            if ($realName != "") {
                                $image = new Upload($_FILES['file']);
                                $image = new Upload($_FILES['file']);
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                //oranlama
                                $width = $image->image_src_x;
                                $height = $image->image_src_y;
                                $oran = $width / $height;
                                if ($oran < 1) {
                                    $newheight = 400;
                                    $newwidth = round($height * $oran);
                                } else if ($oran == 1) {
                                    $newheight = 400;
                                    $newwidth = 500;
                                } else {
                                    $newheight = round($width / $oran);
                                    $newwidth = 500;
                                }
                                if ($image->uploaded) {
                                    // sadece resim formatları yüklensin
                                    $image->allowed = array('image/*');
                                    $image->image_min_height = 250;
                                    $image->image_min_width = 250;
                                    $image->image_max_height = 2000;
                                    $image->image_max_width = 2000;
                                    $image->file_new_name_body = time();
                                    $image->file_name_body_pre = 'yeditepe_v6';
                                    $image->image_resize = true;
                                    $image->image_ratio_crop = true;
                                    $image->image_x = 1200;
                                    $image->image_y = 500;
                                    $image->Process("upload/vitrinler");
                                    if ($image->processed) {
                                        if ($form->submit()) {
                                            $dataVitrin = array(
                                                'Sira' => $sirasi,
                                                'url' => $url,
                                                'Aktiflik' => $vitrinkategorii,
                                                'VitrinResim' => $image->file_dst_name
                                            );
                                        }
                                        $result = $Panel_Model->vitrinupdate($dataVitrin, $id);
                                        if ($result) {
                                            if (degisecekID != 0) {
                                                $dataSira = array(
                                                    'Sira' => $degisecekSira
                                                );
                                                $result = $Panel_Model->vitrinsiraupdate($dataSira, $degisecekID);
                                            }
                                            $sonuc["yol"] = $image->file_dst_name;
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
                                    $dataVitrin = array(
                                        'Sira' => $sirasi,
                                        'url' => $url,
                                        'Aktiflik' => $vitrinkategorii
                                    );
                                }
                                $result = $Panel_Model->vitrinupdate($dataVitrin, $id);
                                if ($result) {
                                    if (degisecekID != 0) {
                                        $dataSira = array(
                                            'Sira' => $degisecekSira
                                        );
                                        $result = $Panel_Model->vitrinsiraupdate($dataSira, $degisecekID);
                                    }
//                                            error_log($degisecekID);
                                    $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                } else {
                                    $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                }
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen durumunu seçiniz.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen vitrin sırası belirleyiniz.";
                    }
                    break;
                case "aboutDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $icerik = $_POST['icerik'];
                    $form->post("baslik", true);
                    $form->post("altbaslik", true);
                    $form->post("id", true);
                    $baslik = $form->values['baslik'];
                    $altbaslik = $form->values['altbaslik'];
                    $id = $form->values['id'];
                    if ($baslik != "") {
                        if ($altbaslik != "") {
                            if ($icerik != "") {
                                $realName = $_FILES['file']['name'];
                                if ($realName != "") {
                                    $image = new Upload($_FILES['file']);
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    //oranlama
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    if ($image->uploaded) {
                                        // sadece resim formatları yüklensin
                                        $image->allowed = array('image/*');
                                        $image->image_min_height = 250;
                                        $image->image_min_width = 250;
                                        $image->image_max_height = 2000;
                                        $image->image_max_width = 2000;
                                        $image->file_new_name_body = time();
                                        $image->file_name_body_pre = 'hakkinda_';
                                        $image->image_resize = true;
                                        $image->image_ratio_crop = true;
                                        $image->image_x = 1170;
                                        $image->image_y = 366;
                                        $image->Process("upload/about");
                                        if ($image->processed) {
                                            if ($form->submit()) {
                                                $dataAbout = array(
                                                    'baslik' => $baslik,
                                                    'altbaslik' => $altbaslik,
                                                    'icerik' => $icerik,
                                                    'resim' => $image->file_dst_name
                                                );
                                            }
                                            $result = $Panel_Model->aboutupdate($dataAbout, $id);
                                            if ($result) {
                                                $sonuc["yol"] = $image->file_dst_name;
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
                                        $dataAbout = array(
                                            'baslik' => $baslik,
                                            'altbaslik' => $altbaslik,
                                            'icerik' => $icerik
                                        );
                                    }
                                    $result = $Panel_Model->aboutupdate($dataAbout, $id);
                                    if ($result) {
                                        $sonuc["result"] = "Başarılı bir şekilde güncellenme olmuştur.";
                                    } else {
                                        $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                                    }
                                }
                            } else {
                                $sonuc["hata"] = "Lütfen içerik kısmını doldurunuz.";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen altbaşlığı boş bırakmayınız.";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen başlığı boş bırakmayınız.";
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
                case "markEkle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("urunaciklama", true);
                    $form->post("urunkategori", true);
                    $form->post("urunfiyat", true);
                    $markaadi = $form->values['urunaciklama'];
                    $markakategori = $form->values['urunkategori'];
                    $markaurl = $form->values['urunfiyat'];
                    if ($markaadi != "") {
                        if ($markakategori != "") {
                            if ($markakategori != "") {
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
                                        $image->file_name_body_pre = 'marka_';
                                        $image->image_resize = true;
                                        $image->image_ratio_crop = true;
                                        $image->image_x = 217;
                                        $image->image_y = 122;
                                        $image->Process("upload/markalar");

                                        if ($image->processed) {
                                            if ($form->submit()) {
                                                $datamarka = array(
                                                    'MarkaAdi' => $markaadi,
                                                    'Tur' => $markakategori,
                                                    'url' => $markaurl,
                                                    'ResimYolu' => $image->file_dst_name
                                                );
                                            }
                                            $result = $Panel_Model->markainsert($datamarka);
                                            if ($result) {
                                                $sonuc["yol"] = $image->file_dst_name;
                                                $sonuc["ID"] = $result;
                                                $sonuc["result"] = "Başarılı bir şekilde eklenmiştir.";
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
                                $sonuc["hata"] = "Lütfen url giriniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen markanın kategorisini seciniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen Marka adını  boş girmeyiniz.";
                    }
                    break;
                case "vitrinEkle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("sirasii", true);
                    $form->post("kategorisii", true);
                    $form->post("urlsii", true);
                    $vitrinsirasi = $form->values['sirasii'];
                    $vitrinkategori = $form->values['kategorisii'];
                    $vitrinurl = $form->values['urlsii'];
                    if ($vitrinsirasi != "") {
                        if ($vitrinkategori != "") {
                            if ($vitrinurl != "") {
                                $realName = $_FILES['file']['name'];
                                if ($realName != "") {
                                    $image = new Upload($_FILES['file']);
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    //oranlama
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    if ($image->uploaded) {
                                        // sadece resim formatları yüklensin
                                        $image->allowed = array('image/*');
                                        $image->image_min_height = 250;
                                        $image->image_min_width = 250;
                                        $image->image_max_height = 2000;
                                        $image->image_max_width = 2000;
                                        $image->file_new_name_body = time();
                                        $image->file_name_body_pre = 'yeditepe_v6';
                                        $image->image_resize = true;
                                        $image->image_ratio_crop = true;
                                        $image->image_x = 1200;
                                        $image->image_y = 500;
                                        $image->Process("upload/vitrinler");

                                        if ($image->processed) {
                                            if ($form->submit()) {
                                                $datavitrin = array(
                                                    'Sira' => $vitrinsirasi,
                                                    'Aktiflik' => $vitrinkategori,
                                                    'url' => $vitrinurl,
                                                    'VitrinResim' => $image->file_dst_name
                                                );
                                            }
                                            $result = $Panel_Model->vitrininsert($datavitrin);
                                            if ($result) {
                                                $sonuc["yol"] = $image->file_dst_name;
                                                $sonuc["ID"] = $result;
                                                $sonuc["result"] = "Başarılı bir şekilde eklenmiştir.";
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
                                $sonuc["hata"] = "Lütfen url giriniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen Aktifliğini seçiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen vitrin sırasını belirleyiniz.";
                    }
                    break;
                case "aboutEkle":
                    require "app/otherClasses/class.upload.php";
                    $icerik = $_POST['icerik'];
                    $form->post("baslik", true);
                    $form->post("altbaslik", true);
                    $baslik = $form->values['baslik'];
                    $altbaslik = $form->values['altbaslik'];
                    if ($baslik != "") {
                        if ($altbaslik != "") {
                            if ($icerik != "") {
                                $realName = $_FILES['file']['name'];
                                if ($realName != "") {
                                    $image = new Upload($_FILES['file']);
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    //oranlama
                                    $width = $image->image_src_x;
                                    $height = $image->image_src_y;
                                    $oran = $width / $height;
                                    if ($oran < 1) {
                                        $newheight = 400;
                                        $newwidth = round($height * $oran);
                                    } else if ($oran == 1) {
                                        $newheight = 400;
                                        $newwidth = 500;
                                    } else {
                                        $newheight = round($width / $oran);
                                        $newwidth = 500;
                                    }
                                    if ($image->uploaded) {
                                        // sadece resim formatları yüklensin
                                        $image->allowed = array('image/*');
                                        $image->image_min_height = 250;
                                        $image->image_min_width = 250;
                                        $image->image_max_height = 2000;
                                        $image->image_max_width = 2000;
                                        $image->file_new_name_body = time();
                                        $image->file_name_body_pre = 'hakkinda_';
                                        $image->image_resize = true;
                                        $image->image_ratio_crop = true;
                                        $image->image_x = 1170;
                                        $image->image_y = 366;
                                        $image->Process("upload/about");

                                        if ($image->processed) {
                                            if ($form->submit()) {
                                                $dataabout = array(
                                                    'baslik' => $baslik,
                                                    'altbaslik' => $altbaslik,
                                                    'icerik' => $icerik,
                                                    'resim' => $image->file_dst_name
                                                );
                                            }
                                            $result = $Panel_Model->aboutinsert($dataabout);
                                            if ($result) {
                                                $sonuc["yol"] = $image->file_dst_name;
                                                $sonuc["ID"] = $result;
                                                $sonuc["result"] = "Başarılı bir şekilde eklenmiştir.";
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
                                $sonuc["hata"] = "Lütfen içerik giriniz";
                            }
                        } else {
                            $sonuc["hata"] = "Lütfen alt başlık giriniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen başlık giriniz.";
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
                                                                                                     
