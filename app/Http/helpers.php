<?php

function ProcessUrlParams($params)
{
    $str = array();
    foreach($params as $key=>$param)
    {
        $str[] = "$key=$param";
    }
    $str = implode("&",$str);
    return $str;
}