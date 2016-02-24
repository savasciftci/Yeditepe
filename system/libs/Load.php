<?php

/*
 * Load sınıfı ile istenilen dosyalara daha rahat ulaşabilmeyi sağlamaktadır.Yani gelen filename adı ile istenilen
 * klasör altındaki istenilen sınıfa $this->load->$filename('') şeklinde ulaşabileceğiz
 */

class Load {

    public function __construct() {
        
    }

    public function controllers($fileName) {
        include "app/controllers/" . $fileName . ".php";
        return new $fileName;
    }

    public function view($fileName, $model = false) {
        if ($model == true) {
            extract($model);
        }
        include "app/views/" . $fileName . "_view.php";
    }

    public function model($fileName) {
        include "app/models/" . $fileName . ".php";
        return new $fileName;
    }

    //other class lar için
    public function otherClasses($fileName) {
        include "app/otherClasses/" . $fileName . ".php";
        return new $fileName;
    }

    //other class lar için
    public function folder($fileName) {
        include "app/folder/" . $fileName . ".php";
        return new $fileName;
    }

}
?>

