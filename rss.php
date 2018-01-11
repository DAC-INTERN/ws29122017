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
use PHPHtmlParser\Dom;

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    die;
}

$response = JCRequest::get($url);
$xmlString = $response->body();
$xmlObject = simplexml_load_string($xmlString);
$data = [];

foreach ($xmlObject->channel->item as $object) {

    // remove anchor from description
    $desObject = new Dom();
    $desObject->load((string)$object->description);
    $desAnchorObject = $desObject->find('a');
    $desAnchorObject->setAttribute('href', 'javascript:void(0)');

    $data[] = [
        'title' => (string)$object->title,
        'link' => (string)$object->link,
        'description' => $desObject->innerHtml
    ];
}

echo json_encode($data);