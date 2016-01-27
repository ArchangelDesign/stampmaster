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
            $res = $this->_db->insert('stamp_types', $data);
            $message = 'New stamp type created successfully.';
            $code = 200;
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $code = 500;
        }
        return [
            'code' => 500,
            'message' => $message,
        ];
    }
    
    public function deleteStampType($id)
    {
        $this->_db->deleteRecords(['id' => $id]);
    }
}