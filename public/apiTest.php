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

<?php include("./header.php"); ?>

                <div class = 'col-md-12'>

                    <?php if ($error != null):?>
                        <b>Error:</b> <?=$error?>
                    <?php endif;?>

                    <?php foreach ($photos as $photo):?>
                        <div class = 'col-md-3'><img style="max-width:100%" src="<?=$photo->getBestQualityUrl()?>"></div>
                    <?php endforeach;?>

                </div>

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
                       
                    </form>
                    <hr/>

            </div>
                
        

             <?php include("./footer.php") ?>
