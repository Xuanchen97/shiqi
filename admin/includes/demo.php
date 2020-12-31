<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require 'address.php';
$string = '刘轩辰，13291028818，江苏省徐州市金狮小区';
$r = Address::smart($string);
print_r($r);

