<?php 
$date1='Sep 20 2021';
$date2='09092021';

echo myDate($date1);echo "\n";
echo dateformatchange($date2);

function myDate($date){
    return date("Y-m-d", strtotime($date));
}
function dateformatchange($date)
    {
       $date= date_create_from_format('dmY', $date);
       return date_format($date, 'M-d-Y');
            
    }
?>