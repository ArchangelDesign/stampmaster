<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Common;

class Common
{
    /**
     * @return string
     */
    public static function generateToken()
    {
        return md5(self::generateRandomString());
    }

    public static function generateRandomString($length = 30) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * @param \ArchangelDB\ADB2 $db
     * @param $table
     * @param $key
     */
    public static function generateUniqueToken(\ArchangelDB\ADB2 $db, $table, $key)
    {
        $token = self::generateToken();
        $check = $db->fetchOne($table, [], $key);
        
    }
}