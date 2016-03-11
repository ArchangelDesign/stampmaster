<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

use Storage\CacheStorage;

class ConfigStorage extends AbstractStorage
{
    /**
     * @var CacheStorage
     */
    private $cache = null;
    private $cacheEnabled = null;

    public function __construct($db)
    {
        parent::__construct($db);
        $this->cache = new CacheStorage();
    }

    /**
     * @return bool
     */
    private function isCacheEnabled()
    {
        if (is_bool($this->cacheEnabled)) {
            return $this->cacheEnabled;
        }
        return $this->cacheEnabled = $this->fetchValue('cacheConfig');
    }

    /**
     * @param $name
     * @return bool|string
     */
    private function fetchValue($name)
    {
        $value = $this->_db->fetchOne('config', ['c_name' => $name]);
        $result = '';
        if (is_null($value)) {
            $this->_db->insert($name, ['c_name' => $name, 'c_value' => null]);
            return false;
        }
        if ($value['extended'] > 0) {
            $exVal = $this->_db->fetchOne('config_extension', ['id' => $value['extended']]);
            $result = $exVal['c_value'];
        } else {
            $result = $value['c_value'];
        }
        $this->storeInCache($name, $value);
        return $result;
    }

    /**
     * Return single value from cache
     * 
     * @param $name
     * @return string
     */
    private function fetchFromCache($name)
    {
        return $this->cache->getValue($name);
    }

    /**
     * Stores in cache only if enabled
     *
     * @param $name
     * @param $value
     * @return void
     */
    private function storeInCache($name, $value)
    {
        if ($this->isCacheEnabled()) {
            $this->cache->setValue($name, $value);
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function getValue($name)
    {
        $value = null;
        if ($this->isCacheEnabled()) {
            $value = $this->fetchFromCache($name);
        }
        if (empty($value)) {
            $value = $this->fetchValue($name);
        }
        return $value;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public function setValue($name, $value)
    {
        $previousValue = $this->_db->fetchOne('config', ['c_name' => $name]);
        if (empty($previousValue)) {
            $this->_db->insert('config', ['c_name' => $name, 'c_value' => $value]);
        } else {
            $this->_db->update('config', ['c_name' => $name, 'c_value' => $value], 'c_value');
        }
        $this->storeInCache($name, $value);
    }
}