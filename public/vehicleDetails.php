<?php
    namespace CarRived;

    $client = new Edmunds\VehicleApiClient(API_KEY);
    $photos = [];
    $error = null;
    $style = null;

    if (!isset($_GET['id'])) {
        $error = 'No vehicle ID was specified.';
    } else {
        try {
            $style = $client->getModelStyle($_GET['id']);
            $photos = $style->getPhotos();
        } catch (Edmunds\ApiException $e) {
            $error = $e->getMessage();
        }
    }
?>
<div class="page-header">
    <h1>Vehicle Details</h1>
</div>

<?php if ($error != null):?>
    <b>Error:</b> <?=$error?>
<?php else:?>
    <h2>
        <?=$style->getModelYear()->year?>
        <?=$style->getMake()->name?>
        <?=$style->getModel()->name?>
    </h2>

    <div class="col-md-3">
        Details...
    </div>

    <div class="col-md-9">
        <div id="photo-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($photos); $i++):?>
                    <li data-target="#photo-carousel" data-slide-to="<?=$i?>" <?php if($i==0):?>class="active"<?php endif;?>></li>
                <?php endfor;?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php for ($i = 0; $i < count($photos); $i++):?>
                    <div class="item<?php if($i==0):?> active<?php endif;?>">
                        <img src="<?=$photos[$i]->getBestQualityUrl()?>" alt="<?=$photos[$i]->captionTranscript?>">
                    </div>
                <?php endfor;?>
            </div>
            <a class="left carousel-control" href="#photo-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#photo-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="col-md-12">
        <h2>All vehicle data</h2>
        <div class="well" id="json"></div>

        <script type="text/javascript">
            var json = <?=json_encode($style->getData());?>;
            $(function() {
                $("#json").JSONView(json);
            });
        </script>
    </div>
<?php endif;?>
