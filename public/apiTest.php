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

        <style>
            .banner { background-color: #2F4F4F; color: #fff; height: 100px;}
        </style>
    </head><!-- -->

    <body>
        <div class= 'container'>

            <div class='row banner'>
                <div class='col-md-12'>
                    <h1>Submit your car!</h1>
                </div>
            </div>

            <div class = 'row'>

                <div class = 'col-md-12'>

                    <?php if ($error != null):?>
                        <b>Error:</b> <?=$error?>
                    <?php endif;?>

                    <span class="label label-primary">Photos</span>
                    <?php foreach ($photos as $photo):?>
                        <div class = 'col-md-3'><img style="max-width:100%" src="<?=$photo->getBestQualityUrl()?>"></div>
                    <?php endforeach;?>

                </div>

                <!-- <div>Got data in <?=$client->getRequestCount()?> API request(s).</div> -->

            </div>

            <div class = 'col-md-12'>

                    <form method="get">

                        <div class="input-group">
                            <span class="input-group-addon">Make</span>
                            <input type="text" class="form-control" placeholder="volkswagen" name="make" value="<?=$_GET['make']?>"/>
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">Model</span>
                            <input type="text" class="form-control" placeholder="golf" name="model" value="<?=$_GET['model']?>"/>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">Year</span>
                            <input type="text" class="form-control" placeholder="2000" name="year" value="<?=$_GET['year']?>"/>
                        </div>
                        <div>
                            <button class = 'btn btn-primary' type = 'submit'>
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                        </div>
                        <!-- original inputs 
                        <span class="label label-info">Make</span>
                       <input type="text" name="make" value="<?=$_GET['make']?>"/>
                        <span class="label label-info">Model</span>
                        <input type="text" name="model" value="<?=$_GET['model']?>"/>
                        <span class="label label-info">Year</span>
                        <input type="text" name="year" value="<?=$_GET['year']?>"/>
                        <input type="submit"/>
                        -->
                    </form>
                    <hr/>

                </div>
                
            </div>

        </div>
    </body>
</html>
