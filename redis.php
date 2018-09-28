<?php
/**
 * Created by PhpStorm.
 * User: gwc
 * Date: 2018/9/12
 * Time: 15:12
 */

//实例化redis
$str = 'LAMP';
$str1 = 'LAMPBrother';
$strc = strcmp($str,$str1);
echo $strc;