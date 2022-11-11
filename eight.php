<?php 
include_once "simple_html_dom.php";
 $curl = curl_init('http://quotes.toscrape.com/login');
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_COOKIEJAR,'cookie.txt');
$response=curl_exec($curl);
$html = str_get_html($response);
$csrf_token=$html->find('input[name="csrf_token"]')[0]->value;
// echo $csrf_token;
$data=array(
    'csrf_token' => $csrf_token,
    'username' => 'apple',
    'password' => 'ball',
);
curl_setopt($curl, CURLOPT_URL,"http://quotes.toscrape.com/login");
curl_setopt($curl, CURLOPT_POST,true);
curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
curl_setopt($curl, CURLOPT_COOKIEJAR,'cookie.txt');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);

$response=curl_exec($curl);

//echo $response;



$html = str_get_html($response);
$tags=array();
foreach($html->find('.tag') as $tag){
$tags[]=$tag->plaintext;
}
print_r($tags);

?>