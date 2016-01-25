<?php

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
