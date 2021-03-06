<?php

/**
 * Stamp Master
 * General configuration file
 * @author Rafal Martinez-Marjanski
 * @copy Archangel Design <http://archangel-design.com>
 */

class SmConfig
{
    const domain    = 'sm.dev';
    const http      = 'http://sm.dev';
    //const cacheDir  = '/var/www/sm/data/cache';
    const cacheDir = 'f:\1work\stampmaster\data\cache';
    public static $configTable = [
        'cacheConfig'       => '1',
        'company-name'      => 'The Stamp Company',
        'page-title'        => 'The STamp Company Store Online',
    ];
    const imagePath = '/var/www/sm/public/stamp-images/';
    const imagePublicPath = 'stamp-images/';

    public static function getImagePublicPath()
    {
        if (strpos(self::imagePublicPath, '/') != strlen(self::imagePublicPath)-1) {
            return self::imagePublicPath . '/';
        }
        return self::imagePublicPath;
    }
}