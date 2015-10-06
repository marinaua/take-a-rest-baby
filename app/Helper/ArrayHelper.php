<?php

namespace Api\Helper;

class ArrayHelper
{
    /**
     * @param string $key
     * @param array $array
     * @param null|mixed $default
     *
     * @return null|mixed
     */
    public static function get($key, array $array, $default = null)
    {
        return isset($array[$key])? $array[$key] : $default;
    }
}