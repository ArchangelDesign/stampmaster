<?php

namespace Common;

class XmlResponder
{
    private static function _header()
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="no" ?>';
    }
    
    private static function _open()
    {
        $res = '<StampMaster>';
        $res .= '<version>' . Version::getVersion() . '</version>';
        $res .= '</StampMaster>';
    }
    
    private static function _responseOpen()
    {
        return "<response>";
    }
    
    private static function _responseClose()
    {
        return "</response>";
    }
    
    public static function generalResponse($code, $message)
    {
        $res = self::_header();
        $res .= self::_open();
        $res .= self::_responseOpen();
        $res .= "<code>$code</code><message>$message</message>";
        $res.= self::_responseClose();       
    }
}
