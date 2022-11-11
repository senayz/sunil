<?php 
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
create_json_file($csv);
echo json_encode($csv);
//print_r($csv);
echo "\n";

function create_json_file($csv){
    $file = fopen('toscrape_listing.json','w');
    fwrite($file,json_encode($csv));
    fclose($file);
}
?>