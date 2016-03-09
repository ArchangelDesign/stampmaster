<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;


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
        return $result;
    }

    /**
     * @param $name
     * @return string
     */
    private function fetchFromCache($name)
    {

    }

    /**
     * @param $name
     * @return string
     */
    public function getValue($name)
    {

    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    public function setValue($name, $value)
    {

    }
}