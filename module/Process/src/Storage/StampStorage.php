<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

use Common\Common;

class StampStorage extends AbstractStorage
{
    public function fetchAllStampTypes()
    {
        return $this->_db->fetchAll('stamp_types');
    }

    public function fetchStamp($id)
	{
		return $this->_db->fetchOne('stamp_types', ['id' => $id]);
	}
    
    public function insertStampType($data)
    {        
        try {           
            $data['date_created'] = date('Y-m-d H:i:s', time());
            unset($data['image']);
            unset($data['thumbnail']);
            $id = $this->_db->insert('stamp_types', $data);
            if (isset($_FILES['thumbnail'])) {               
                $thumbnailFileName = $this->uploadThumbnail($_FILES['thumbnail']['tmp_name']);
            } else {
                $thumbnailFileName = "no-thumbnail.jpg";
            }
            if (isset($_FILES['image'])) {
                $imageFileName = $this->uploadImage($_FILES['image']['tmp_name']);
            } else {
                $imageFileName = "no-thumbnail.jpg";
            }
            
            $this->_db->update(
                    'stamp_types', 
                    [
                        'id' => $id, 
                        'thumbnail' => $thumbnailFileName,
                        'large_image' => $imageFileName,
                    ]
                    );
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

	/**
	 * @param $id
	 */
    public function deleteStampType($id)
    {
        $this->_db->deleteRecords('stamp_types', ['id' => $id]);
    }

	/**
	 * @param array $record
	 * @throws Exception
	 */
    public function updateStampType(array $record)
	{
		if (!isset($record['id']) || empty($record['id'])) {
			throw new Exception("Invalid record. Missing record ID");
		}
		$record['date_modified'] = date('Y-m-d H:i:s', time());

		$this->_db->update('stamp_types', $record);

		if (isset($_FILES['thumbnail'])) {
			$thumbnail = $this->uploadThumbnail($_FILES['thumbnail']['tmp_name']);
		}
	}

	/**
	 * @param string $path source path
	 * @return bool|string uploaded filename
	 */
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
            default:
                $ratio = $w/$h;
                $resized = imagescale($image, 150 * $ratio, 150);
        }
        $filename = md5(Common::generateRandomString(20)) . '.jpg';
        imagejpeg($resized, \SmConfig::imagePath . $filename, 40);
        imagedestroy($image);
        imagedestroy($resized);
        return $filename;
    }
    
    private function uploadImage($path)
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
                $resized = imagescale($image, 900, 900 * $ratio);
                break;
            default:
                $ratio = $w/$h;
                $resized = imagescale($image, 900 * $ratio, 900);
        }
        $filename = md5(Common::generateRandomString(20)) . '.jpg';
        imagejpeg($resized, \SmConfig::imagePath . $filename, 60);
        imagedestroy($image);
        imagedestroy($resized);
        return $filename;
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
                break;
			case IMAGETYPE_PNG:
				return imagecreatefrompng($path);
				break;
        }
        return false;
    }
}