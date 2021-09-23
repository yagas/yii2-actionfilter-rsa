<?php

use yagas\filters\InterfaceSign;

class MyHandle implements InterfaceSign
{
    public function Sign($params)
    {
        return json_encode($params);
    }
}