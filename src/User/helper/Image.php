<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\helper;

/**
 * Description of Image
 *
 * @author WroOth
 */
class Image {

    private $img;

    public function __construct($inputImage) {
        $this->img = $inputImage;
    }

    private function validateInput() {

        $typeName = $this->img['type'];
        $fileParts = explode('.', $this->img['name']);
        $len = count($fileParts);
        $ext = $fileParts[$len - 1];
        $isValid = true;
        if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png']) ||
                !in_array($typeName, ['image/jpg', 'image/jpeg', 'image/png'])) {
            $isValid = false;
        }
        return $isValid;
    }
    
    private  function createImage($id ,$dim){
         $name = $this->img['tmp_name'];
            $imgSrc = imagecreatefromjpeg($name);
            $dimentions = getimagesize($name);
            $imgDst = imagecreatetruecolor($dim, $dim);
            $startY = 0;
            $startX = 0;
            if ($dimentions[0] < $dimentions[1]) {
                $newDim = $dimentions[0];
                $startY = round(($dimentions[1] / 2) - ($newDim / 2));
            } else {
                $newDim = $dimentions[1];
                $startX = round(($dimentions[0] / 2) - ($newDim / 2));
            }
            imagecopyresampled($imgDst, $imgSrc, 0, 0, $startX, $startY, $dim, $dim, $newDim, $newDim);
            header("Content-type: image/jpeg");
            imagejpeg($imgDst, IMAGE_DIR . $id . '_' . $dim . '.jpg', 10);
    }
    public function create($id) {

        if ($this->validateInput()) {
           $this->createImage($id, 150);
           $this->createImage($id, 1000);
        }
    }

}
