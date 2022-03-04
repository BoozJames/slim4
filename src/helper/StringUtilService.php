<?php

namespace Yuri\Slim\helper;

class StringUtilService
{
    public static function fullNameFormat($fname, $mname, $lname, $ext): string
    {
        return ucwords(strtolower($fname)) . " " .
            ucwords(strtolower($mname)) . " " .
            ucwords(strtolower($lname)) .
            ((strcmp($ext, "")) ? "" : " " . ucfirst(strtolower($ext)));
    }

    public static function nameFormatStd($fname, $mname, $lname, $ext): string
    {
        return ucwords(strtolower($fname)) . " " .
            StringUtilService::getInitial($mname) . ". " .
            ucwords(strtolower($lname)) .
            ((strcmp($ext, "")) ? "" : " " . ucfirst(strtolower($ext)));
    }

    public static function nameFormat($obj): string
    {
        if (is_array($obj)) {
            return self::nameFormatFromArray($obj);
        }
        if (is_object($obj)) {
            return self::nameFormatFromObject($obj);
        }
        return null;
    }

    public static function nameFormatFromArray($params): string
    {
        $fname = $params['fname'];
        $mname = $params['mname'];
        $lname = $params['lname'];
        $ext = $params['ext'];
        return ucwords(strtolower($fname)) . " " .
            StringUtilService::getInitial($mname) . ". " .
            ucwords(strtolower($lname)) .
            ((strcmp($ext, "")) ? "" : " " . ucfirst(strtolower($ext)));
    }

    public static function nameFormatFromObject($obj): string
    {
        $fname = $obj->fname;
        $mname = $obj->mname;
        $lname = $obj->lname;
        $ext = $obj->ext;
        return ucwords(strtolower($fname)) . " " .
            StringUtilService::getInitial($mname) . ". " .
            ucwords(strtolower($lname)) .
            ((strcmp($ext, "")) ? "" : " " . ucfirst(strtolower($ext)));
    }

    public static function getInitial($name)
    {
        return strtoupper(substr($name, 0, 1));
    }
}
