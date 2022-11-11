<?php

include_once "simple_html_dom.php";
$feeds = "https://books.toscrape.com/";
$html = file_get_html($feeds);
$links = array();
$firstRun = true;
//echo $html->find('title')[0]->plaintext . "\n";die;

// a
foreach ($html->find('.side_categories li a') as $e) {
    $t = trim($e->plaintext);
    if (!in_array($t, array('Science', 'Historical Fiction'))) {
        continue;
    }
    $links[] = array('url' => $feeds . $e->href, 'text' => $t);

}
//print_r($links);die;

//b
foreach ($links as $link) {
    echo $link['url'] . "\n";
    $page=1;
    $total_pages=1;
    while ($page <= $total_pages){
        $url=$link['url'];
        if($page>1){
        $url= str_replace('index.html', "page-$page.html", $link['url']);}
        $linkData = file_get_html($url);
        $pages=$linkData->find('.current');
        if($pages){
            $pages=$pages[0]->plaintext;
            preg_match('/of (\d+)/',$pages,$matches);
            if($matches[1]){
                $total_pages=$matches[1];
            }
        }
        $base_url = $url;
        $base = basename($base_url);
        if (preg_match('/\.html/i', $base)) {
            $base_url = str_replace($base, '', $base_url);
        }
        //echo $base_url . PHP_EOL;
    
        foreach ($linkData->find('ol.row li') as $e) {
            $new_url = $base_url . $e->find('h3 a')[0]->href;
            getDetails($link['url'],$link['text'],$new_url,$firstRun);
        }
        $page++;
}

}
function getDetails($url,$category,$link,&$firstRun)
{
    $number=array(
        'one'=>1,
        'two'=>2,
        'three'=>3,
        'four'=>4,
        'five'=>5,
    );
    $linkData = file_get_html($link);
    $array = [];
    $stockValue =  $linkData->find('.product_main p.availability')[0]->plaintext;
    preg_match('/\s*(.*)\s*\((\d+).*\)/',$stockValue,$stock);
    $array['id']=alphanumeric(8);
    $array['category'] = $category;
    $array['category_url'] = $url;
    $array['title'] = $linkData->find('.product_main h1')[0]->plaintext;
    $array['price'] = $linkData->find('.product_main p.price_color')[0]->plaintext;
    $array['stock'] = $stock[1];
    $array['stock_qty'] = $stock[2];
    $array['upc']= $linkData->find('table tr[plaintext*="UPC"] td')[0]->plaintext;
    $array['rating']=$number[strtolower(trim(str_replace('star-rating','',$linkData->find('.star-rating')[0]->getAttribute('class'))))];
    $array['reviews']= $linkData->find('table tr[plaintext*="reviews"] td')[0]->plaintext;
    $array['url'] = $link;
 //  echo "\n";print_r($array);echo "\n";
addToCSV($array,$firstRun);
}
function addToCSV($data,&$firstRun){
    if($firstRun){
        $file = fopen('toscrape_listing.csv','w');
        fputcsv($file, array_keys($data));
        fclose($file);  
        $firstRun = false;
    }
    $file = fopen('toscrape_listing.csv','a');
    fputcsv($file, $data);
    fclose($file);  
}
function alphanumeric($string_length)
{
    $myString = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($myString),0,$string_length);
}

 