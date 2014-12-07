<?php
namespace CarRived;
require '../src/Autoloader.php';

$api = new Edmunds\VehicleApiClient('ryxpfa645s3vc4vywcwkdju9');

$style = $api->getModelStyles('volkswagen', 'golf', 2000)[0];

$rules = new RuleSet();
$rules->addRule(new AgeRule(2009));

echo $rules->heuristic($style);
