<?php

namespace Storage;

class SessionStorage
{
    const SESSION_NAMESPACE = 'stamp-master';

    public static function setValue($key, $value)
    {
        $sess = new \Zend\Session\Container(self::SESSION_NAMESPACE);
        $sess->$key = $value;
    }

    public static function getValue($key)
    {
        $sess = new \Zend\Session\Container(self::SESSION_NAMESPACE);
        return $sess->$key;
    }
}