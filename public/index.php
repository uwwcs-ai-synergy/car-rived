<?php
namespace CarRived;
require '../src/Autoloader.php';

const API_KEY = 'ryxpfa645s3vc4vywcwkdju9';

$action = 'home';
if (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) {
    $action = $_REQUEST['page'];
}


session_start();

include 'header.inc.php';
$actionFile = $action . '.php';

if (is_file($actionFile)) {
    include $actionFile;
} else {
    echo '<h1>Page not found.</h1>';
}

include 'footer.inc.php';
