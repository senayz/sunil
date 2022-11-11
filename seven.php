<?php 
$jsonData = file_get_contents('https://dummyjson.com/products/categories');

$jsonData = json_decode($jsonData, true);

$file = fopen('categories.csv', 'w');
fputcsv($file, ['Category']);
foreach ($jsonData as $data) {
    fputcsv($file, [$data]);
}
fclose($file);

?>