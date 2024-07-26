<?php
namespace Threecolts\Phptest;
require_once('src/UrlCounter.php');


$counter  = new UrlCounter();
$data = ["https://example.com","https://example.com/"];

$counter = $counter->normalizeURL($data);
var_dump($counter);
