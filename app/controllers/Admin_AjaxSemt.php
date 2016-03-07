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
                            $sonuc["result"] = "Başarılı bir şekilde semt eklenmiştir.";
                        } else {
                            $sonuc["hata"] = "Bir hata oluştu.Tekrar deneyiniz";
                        }
                    } else {
                        $sonuc["hata"] = "Lütfen adınızı boş girmeyiniz.";
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
                                                                                                     
