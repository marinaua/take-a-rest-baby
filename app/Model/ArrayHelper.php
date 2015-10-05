<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marik
 * Date: 05.10.15
 * Time: 20:53
 * To change this template use File | Settings | File Templates.
 */

namespace Api\Model;

class ArrayHelper
{
    public static function get($key, $array, $default = null)
    {
        return isset($array[$key])? $array[$key] : $default;
    }
}