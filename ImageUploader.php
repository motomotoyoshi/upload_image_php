<?php

namespace MyApp;

class ImageUploader {

    public function upload() {
        try {
            $this->_validateUpload();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }

    private function _validateUpload() {
        if (!isset($_FILES['image']) || !isset($_FILES['image']['error'])) {
            throw new \Exception(('Upload Error'));
        }

        switch($_FILES['image']['error']) {
            case UPLOAD_ERR_OK:
                return true;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new \Exception('File too large');
            default:
                throw new \Exception('Err: ' . $_FILES['image']['error']);
        }
    }
}