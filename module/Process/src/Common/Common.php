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
     * @throws \Exception
     * @return string
     */
    public static function generateUniqueToken(\ArchangelDB\ADB2 $db, $table, $key)
    {
        $token = self::generateToken();
        $check = $db->fetchOne($table, [$key => $token], $key);
        $attempts = 0;
        while (!empty($check)) {
            $attempts++;
            $token = self::generateToken();
            $check = $db->fetchOne($table, [$key => $token], $key);
            if ($attempts > 10) {
                throw new \Exception("Unique token generation error. Too many attempts.");
            }
        }
        return $token;
    }
}