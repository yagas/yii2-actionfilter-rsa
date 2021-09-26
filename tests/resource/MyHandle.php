<?php

use yagas\filters\InterfaceSign;

class MyHandle implements InterfaceSign
{
    public function toSign($params)
    {
        return json_encode($params);
    }

    public function getSign()
    {
        return '123456';
    }
}