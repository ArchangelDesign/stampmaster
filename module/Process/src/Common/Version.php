<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Common;

class Version 
{
    const _majorVersion = 1;
    const _minorVersion = 0;
    const _revision = 1;
    
    public static function getVersion() 
    {
        return self::_majorVersion 
                . '.' . self::_minorVersion
                . '.' . self::_revision;
    }
}
