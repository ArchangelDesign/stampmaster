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