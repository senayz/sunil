<?php 
$re = '/[^_@\.]+/';
$str = 'senayz_azaib@gmail.com';
preg_match_all($re, $str, $matches);
print_r($matches[0]);


?>