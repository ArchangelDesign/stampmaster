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
    /**
     * @var null|bool
     */
    private $cacheEnabled = null;

    public function __construct($db)
    {
        parent::__construct($db);
        $this->deployConfig();
        $this->cache = new CacheStorage();
    }

    /**
     * Add non-existing values to config table
     * from config file
     */
    private function deployConfig()
    {
        $config = \SmConfig::$configTable;
        $currentConfig = $this->_db->fetchAll('config');

        foreach ($config as $k => $v) {
            $exists = false;
            foreach ($currentConfig as $c) {
                if ($c['c_name'] == $k) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $this->_db->insert('config', ['c_name' => $k, 'c_value' => $v]);
            }
        }
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
            $this->_db->insert('config', ['c_name' => $name, 'c_value' => null]);
            return false;
        }
        if ($value['extended'] > 0) {
            $exVal = $this->_db->fetchOne('config_extension', ['id' => $value['extended']]);
            $result = $exVal['c_value'];
        } else {
            $result = $value['c_value'];
        }

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
        return $this->cache->getValue('conf_' . $name);
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
            $this->cache->setValue('conf_' . $name, $value);
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
        $this->storeInCache($name, $value);
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

    public function getConfiguration($level)
    {
        return $this->_db->executeRawQuery(
            "select c.*, e.c_value as e_value from {config} c "
            . "left join {config_extension} e on c.extended=e.id"
        )->toArray();
    }
}