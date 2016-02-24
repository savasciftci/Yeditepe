<?php

class Login extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->login();
    }

    //daha önce login oldu ise
    function login() {
        if (session::get("login") == true) {
            header("Location:" . SITE_URL . "/Admin");
        } else {
            if ($_POST) {
                $form = $this->load->otherClasses('Form');
                $model = $this->load->model("Panel_Model");
                $form->post('email', true);
                $form->post('password', true);
                $loginEmail = $form->values['email'];
                $loginPassword = $form->values['password'];
                if ($loginEmail != "") {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if ($loginPassword != "") {
                            $result = $model->loginselect($loginEmail, md5($loginPassword));
                            if ($result) {
                                Session::set("login", TRUE);
                                $ID = $result[0]["fwkullaniciID"];
                                $kadi = $result[0]["fwkullaniciAd"];
                                $email = $result[0]["fwkullaniciEmail"];
                                $profilresim = $result[0]["fwkullanici_Resim"];
                                Session::set("email", $email);
                                Session::set("presim", $profilresim);
                                Session::set("kadi", $kadi);
                                Session::set("ID", $ID);
                                header("Location:" . SITE_URL . "/Admin");
                            } else {
                                $this->load->view("Entry/loginForm");
                            }
                        } else {
                            echo "Kullanıcı Şifresi boş girilemez";
                        }
                    } else {
                        error_log("Geçersiz email");
                    }
                } else {
                    echo "Kullanıcı Emaili boş girilemez";
                }
            } else {
                $this->load->view("Entry/loginForm");
            }
        }
    }
    public function logout() {
        session::destroy();
         header("Location:" . SITE_URL . "/Login");
    }

}
?>


