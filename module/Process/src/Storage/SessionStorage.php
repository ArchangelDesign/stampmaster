<?php

namespace Storage;

class SessionStorage
{
    const SESSION_NAMESPACE = 'StampMaster';

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

    public static function setUserId($uid)
	{
		self::setValue('user-id', $uid);
	}

	public static function getUserId()
	{
		return self::getValue('user-id');
	}

	public static function userLoggedIn()
	{
		$v = self::getValue('user-logged-in');
		if ($v !== true) {
			return false;
		}
		return true;
	}

	public static function setNextRoute($route)
	{
		self::setValue('next-route', $route);
	}

	public static function getNextRoute()
	{
		return self::getValue('next-route');
	}
}