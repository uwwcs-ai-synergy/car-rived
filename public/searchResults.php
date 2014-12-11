<?php
    namespace CarRived;

    $cache = new Edmunds\ApiCache('../cache');
    $api = new Edmunds\VehicleApiClient(API_KEY, $cache);
    $rules = new RuleSet();
    $searcher = new VehicleSearcher($api, $rules);

    if (isset($_GET['age'])) {
        $rules->addRule(new AgeRule((int)$_GET['age']));
    }

    if (isset($_GET['minPrice']) && isset($_GET['maxPrice'])) {
        $rules->addRule(new PriceRangeRule((int)$_GET['minPrice'], (int)$_GET['maxPrice']));
    }

    $vehicles = $searcher->search($_GET['make'], 9);
?>
<div class="page-header">
    <h3>Search Results</h3>
</div>

<div class="col-md-9">
    <div class="row">
        <?php foreach ($vehicles as $vehicle):if ($vehicle instanceof Edmunds\VehicleStyle):?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="<?=count($vehicle->getPhotos())>0?$vehicle->getPhotos()[0]->getUrl(400):''?>">
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
