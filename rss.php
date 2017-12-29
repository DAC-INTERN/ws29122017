<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 29/12/2017
 * Time: 10:16
 */

require __DIR__ . '/vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
use JC\HttpClient\JCRequest;

if (isset($_GET['url'])) {
    $url = $_GET['url'];
}else{
    die;
}

$response = JCRequest::get($url);

$xmlString = $response->body();
$xmlObject = simplexml_load_string($xmlString);
$data = [];

//var_dump($xmlObject);

foreach ($xmlObject->channel->item as $object) {
    $data[] = [
        'title' => (string)$object->title,
        'link' => (string)$object->link,
        'description' => (string)$object->description
    ];
}

echo json_encode($data);