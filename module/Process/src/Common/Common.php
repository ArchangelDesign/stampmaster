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
    public static function generateToken()
    {
        return md5(time());
    }
}