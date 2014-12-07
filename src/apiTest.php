<?php
namespace CarRived;
require 'Autoloader.php';

use CarRived\Edmunds\ApiClient;
use CarRived\Edmunds\VehicleApi;

$client = new ApiClient('ryxpfa645s3vc4vywcwkdju9');
$vehicles = new VehicleApi($client);
$photos = [];
$error = null;

if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])) {
    try {
        $style = $vehicles->getMake($_GET['make'])->getModel($_GET['model'])->getYear($_GET['year'])->getStyles()[0];
        $photos = $style->getPhotos();
    } catch (Edmunds\ApiException $e) {
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html>
    <body>
        <form method="get">
            <label>Make</label>
            <input type="text" name="make" value="<?=$_GET['make']?>"/>
            <label>Model</label>
            <input type="text" name="model" value="<?=$_GET['model']?>"/>
            <label>Year</label>
            <input type="text" name="year" value="<?=$_GET['year']?>"/>
            <input type="submit"/>
        </form>
        <hr/>

        <?php if ($error != null):?>
            <b>Error:</b> <?=$error?>
        <?php endif;?>

        <h2>Photos</h2>
        <?php foreach ($photos as $photo):?>
            <div><img style="max-width:100%" src="<?=$photo->getBestQualityUrl()?>"></div>
        <?php endforeach;?>

        <div>Got data in <?=$client->getRequestCount()?> API request(s).</div>
    </body>
</html>
