<?php

namespace yagas\filters;

interface InterfaceSign {

    /**
     * 生成待签名字符串
     * 
     * @param mixed $params 待签名的数据
     */
    public static function Sign($params);
}