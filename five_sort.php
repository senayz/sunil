<?php
$firstRun = true;
$file = fopen('toscrape_listing.csv','r');

$headers = array();

while (($result = fgetcsv($file)) !== false)
{
    if(!$headers){
        $headers = $result;
        continue;
    }
    $csv[] = array_combine($headers,$result);
}

fclose($file);

echo "\n";

array_multisort(array_column($csv, 'rating'), SORT_DESC, $csv);
// print_r($csv);
addToCSV($csv,$firstRun);
function addToCSV($data,&$firstRun){
foreach($data as $myData){
    if($firstRun){
        $file = fopen('reviews_desc.csv','w');
        fputcsv($file, array_keys($myData));
        fclose($file);  
        $firstRun = false;
    }
    $file = fopen('reviews_desc.csv','a');
    fputcsv($file, $myData);
    fclose($file); 
}


    
}