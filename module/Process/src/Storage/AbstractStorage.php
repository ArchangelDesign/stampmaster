<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

use ArchangelDB\ADB2;

abstract class AbstractStorage
{
    /**
     * @var ArchangelDB\ADB2;
     */
    protected $_db;

    public function __construct($db)
    {
        if (!$db instanceof ADB2) {
            throw new \Exception("StorageProcess: Invalid DB handle.");
        }
        $this->_db = $db;
    }
}