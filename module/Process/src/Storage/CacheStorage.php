<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

use Zend\Cache\StorageFactory;

class CacheStorage
{
    const CONTAINER_NAME = 'StampMaster';
    /**
     * @var \Zend\Cache\Storage\StorageInterface
     */
    private $container = null;

    public function __construct()
    {
        $this->container = StorageFactory::factory([
            'name' => 'Filesystem',
            'options' => array(
                'cache_dir' => \SmConfig::cacheDir,
                'ttl' => 1500,
            ),
        ]);

    }

    /**
     * Fetches value from cache
     *
     * @param string $name
     * @return string
     */
    public function getValue($name)
    {
        return $this->container->getItem($name);
    }

    /**
     * Sets or removes value from cache
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setValue($name, $value = null)
    {
        if ($value === null) {
            $this->container->removeItem($name);
        } else {
            $this->container->setItem($name, $value);
        }
    }
}