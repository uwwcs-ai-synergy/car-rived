<?php
    namespace CarRived;

    // create a persistent API cache - tries to speed up process a little bit
    $cache = new Edmunds\ApiCache('../cache');

    // create API client with key
    $api = new Edmunds\VehicleApiClient(API_KEY, $cache);

    // crete empty rule set and searcher instance
    $rules = new RuleSet();
    $searcher = new VehicleSearcher($api, $rules);

    // create an age rule if given
    if (isset($_GET['age']) && !empty($_GET['age'])) {
        $rules->addRule(new AgeRule((int)$_GET['age']));
    }

    // create price range rule if given
    if (isset($_GET['minPrice']) && isset($_GET['maxPrice']) && !empty($_GET['minPrice']) && !empty($_GET['maxPrice'])) {
        $rules->addRule(new PriceRangeRule((int)$_GET['minPrice'], (int)$_GET['maxPrice']));
    }

    // add last selected vehicle to history
    if (isset($_GET['lastId'])) {
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }

        $_SESSION['history'][] = $api->getModelStyle($_GET['lastId']);
    }

    $vehicles = $searcher->search($_GET['make'], 9);
?>
<div class="page-header">
    <h1>Search Results</h1>
</div>

<div class="col-md-3">
    <h2>Vehicle History</h2>
        <?php if (isset($_SESSION['history'])): foreach ($_SESSION['history'] as $item):?>
    <ul class="list-group">
        <li class="list-group-item">
            <?=$item->getMake()->name?>
            <?=$item->getModel()->name?>
            <?=$item->getModelYear()->year?>
        </li>
        <?php endforeach;endif;?>
    </ul>

    <p><a href="vehicleDetails?id=<?=$vehicle->id?>" target="_blank" class="btn btn-default">Clear History</a></p>
</div>

<div class="col-md-9">
    <div class="row">
        <?php foreach ($vehicles as $vehicle):if ($vehicle instanceof Edmunds\VehicleStyle):?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <a href="?<?php
                    $params = [];
                    parse_str($_SERVER['QUERY_STRING'], $params);
                    $params['lastId'] = $vehicle->id;
                    unset($params['page']);
                    echo http_build_query($params);
                ?>">
                    <img src="<?=count($vehicle->getPhotos())>0?$vehicle->getPhotos()[0]->getUrl(400):''?>">
                </a>
                <div class="caption">
                    <h3>
                        <?=$vehicle->getMake()->name?>
                        <?=$vehicle->getModel()->name?>
                        <?=$vehicle->getModelYear()->year?>
                    </h3>
                    <p><a href="vehicleDetails?id=<?=$vehicle->id?>" target="_blank" class="btn btn-default">View Details</a></p>
                </div>
            </div>
        </div>
        <?php endif;endforeach;?>
    </div>
</div>
