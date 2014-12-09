<?php
namespace CarRived;
require '../src/Autoloader.php';

$cache = new Edmunds\ApiCache('../cache');
$api = new Edmunds\VehicleApiClient('ryxpfa645s3vc4vywcwkdju9', $cache);

$style = $api->getModelStyles('volkswagen', 'golf', 2014)[0];
//var_dump($style);
$rules = new RuleSet();
$rules->addRule(new AgeRule(2000));
$rules->addRule(new PriceRangeRule(10000, 30000));

var_dump($rules->heuristic($style));


$searcher = new VehicleSearcher($api, $rules);
var_dump($searcher->search('mini', 9));
var_dump($api->getRequestCount());
