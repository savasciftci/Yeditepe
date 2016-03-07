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
              
                case "vitrinDuzenle":
                    require "app/otherClasses/class.upload.php";
                    $form->post("sirasi", true);
                    $form->post("url", true);
                    $form->post("vitrinkategorii", true);
                    $form->post("id", true);
                    $sirasi = $form->values['sirasi'];
                    $url = $form->values['url'];
                    $vitrinkategorii = $form->values['vitrinkategorii'];
                    $id = $form->values['id'];
                    if ($sirasi != "") {
                        if ($vitrinkategorii != -1) {
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
                                    $image->image_x = 900;
                                    $image->image_y = 900;
                                    $image->Process("upload/markalar");
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
                                        $image->image_x = 255;
                                        $image->image_y = 168;
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
                                                                                                     
