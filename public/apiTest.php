<?php
namespace CarRived;
require '../src/Autoloader.php';

$client = new Edmunds\VehicleApiClient('ryxpfa645s3vc4vywcwkdju9');
$photos = [];
$error = null;

if (isset($_GET['make']) && isset($_GET['model']) && isset($_GET['year'])) {
    try {
        $style = $client->getModelStyles($_GET['make'], $_GET['model'], $_GET['year'])[0];
        $photos = $style->getPhotos();
    } catch (Edmunds\ApiException $e) {
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html>
    <!-- bootstrap -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head><!-- -->

    <body>
        <div class= 'container'>

            <div class = 'row'>

                <div class = 'col-md-12'>

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

                </div>
                
            </div>

            <?php if ($error != null):?>
                <b>Error:</b> <?=$error?>
            <?php endif;?>

            <h2>Photos</h2>
            <?php foreach ($photos as $photo):?>
                <div><img style="max-width:100%" src="<?=$photo->getBestQualityUrl()?>"></div>
            <?php endforeach;?>

            <div>Got data in <?=$client->getRequestCount()?> API request(s).</div>

        </div>
    </body>
</html>
