<?php
namespace CarRived;
require '../src/Autoloader.php';

$cache = new Edmunds\ApiCache('../cache');
$api = new Edmunds\VehicleApiClient('ryxpfa645s3vc4vywcwkdju9', $cache);

$rules = new RuleSet();
$rules->addRule(new AgeRule(2000));
$rules->addRule(new PriceRangeRule(10000, 30000));

gc_disable();
$searcher = new VehicleSearcher($api, $rules);
var_dump($searcher->search('dodge', 9));
var_dump($api->getRequestCount());
