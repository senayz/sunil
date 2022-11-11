<?php 
$a=1234;
$b='apple';
$c=5.678;
$d='456';

if(is_int($a))echo 'a is integer';echo "\n";
echo is_int($b)? 'b is integer':'b is not integer';echo "\n";
echo is_int($c)? 'c is integer':'c is not integer';echo "\n";
echo is_int($d)? 'd is integer':'d is not integer';echo "\n";
    
if(is_numeric($a))echo 'a is numeric';echo "\n";
echo is_numeric($b)? 'b is numeric':'b is not numeric';echo "\n";
echo is_numeric($c)? 'c is numeric':'c is not numeric';echo "\n";
echo is_numeric($d)? 'd is numeric':'d is not numeric';echo "\n";
    
if(is_integer($a))echo 'a is integer';echo "\n";
echo is_integer($b)? 'b is integer':'b is not integer';echo "\n";
echo is_integer($c)? 'c is integer':'c is not integer';echo "\n";
echo is_integer($d)? 'd is integer':'d is not integer';echo "\n";
//is_int and is_integer are same...


?>