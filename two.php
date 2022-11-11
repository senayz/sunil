<?php 
$a=2.99999;
$b=199.99999;
echo number_format(floor($a*100)/100, 2); //Returns 2.99
echo "\n";
$numArray=explode(".",$b);
$mynum=$numArray[0].'.'.substr($numArray[1],0,4);
echo $mynum; //return 199.9999
?>