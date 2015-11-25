<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Process;

use ArchangelDB\ADB2;

class StorageProcess
{
    /**
     * @var ArchangelDB\ADB2
     */
    private $_db;

    public function __construct($db)
    {
        if (!$db instanceof ADB2) {
            throw new \Exception("StorageProcess: Invalid DB handle.");
        }
        $this->_db = $db;
    }

    public function fetchOrders()
    {
        $orders = $this->_db->fetchAll('orders');
    }
}

?>