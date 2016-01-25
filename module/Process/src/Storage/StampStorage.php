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
        
    }
    
    public function deleteStampType($id)
    {
        $this->_db->deleteRecords(['id' => $id]);
    }
}