<?php

namespace yagas\filters;

interface InterfaceSign {

    /**
     * 生成待签名字符串
     * 
     * @param mixed $params 待签名的数据
     */
    public function toSign($params);

    /**
     * 数字签名串
     */
    public function getSign();
}