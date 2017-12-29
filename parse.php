<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 29/12/2017
 * Time: 11:25
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
$dom = new Dom;
$dom->load($response->body());

$content = $dom->find('#divNewsContent');
echo json_encode(['content' => $content->innerHtml]);
