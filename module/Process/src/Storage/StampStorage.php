<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

class StampStorage extends AbstractStorage
{
    public function fetchAllStampTypes()
    {
        return $this->_db->fetchAll('stamp_types');
    }
    
    public function insertStampType($data)
    {        
        try {           
            $data['date_created'] = date('Y-m-d H:i:s', time());
            unset($data['image']);
            unset($data['thumbnail']);
            $id = $this->_db->insert('stamp_types', $data);
            if (isset($_FILES['thumbnail'])) {
                error_log(print_r($_FILES, true));
                $this->uploadThumbnail($_FILES['thumbnail']['tmp_name']);
            }
            $message = 'New stamp type created successfully.';
            $code = 200;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = 500;
        }
        return [
            'code' => $code,
            'message' => $message,
        ];
    }
    
    public function deleteStampType($id)
    {
        $this->_db->deleteRecords(['id' => $id]);
    }
    
    private function uploadThumbnail($path)
    {
        $imageInfo = getimagesize($path);
        $w = $imageInfo[0];
        $h = $imageInfo[1];
        $aspect = 'box';
        if ($h > $w) {
            $aspect = 'vertical';
        } elseif ($w > $h) {
            $aspect = 'horizontal';
        }
        $image = $this->loadImage($path);
        
        if ($image === false) {
            error_log('invalid image ' . $path);
            return false;
        }
        switch ($aspect) {
            case 'box':
            case 'horizontal':
                $ratio = $h/$w;
                $resized = imagescale($image, 150, 150 * $ratio);
                break;
        }
       
        imagejpeg($resized, \SmConfig::imagePath . 'test.jpg', 40);
        imagedestroy($image);
        //imgaedestroy($resized);
    }
    
    private function loadImage($path) 
    {
        $type = getimagesize($path);
        
        switch ($type[2]) {
            case IMAGETYPE_GIF:
                return imagecreatefromgif($path);
                break;
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_BMP:
                return imagecreatefromwbmp($path);
        }
        return false;
    }
}