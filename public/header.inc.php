<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Car-Rived</title>

        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/css/jquery.jsonview.css">

        <style>
            body {
              padding-top: 70px;
              padding-bottom: 30px;
            }
            .carousel-inner > .item > img {
                width: 100%;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>

    <body role="document">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Car-Rived</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?=$_GET['page']!=''?:'active'?>"><a href="/">Home</a></li>
                        <li class="<?=$_GET['page']!='rulesCreator'?:'active'?>"><a href="/rulesCreator">Search</a></li>
                        <li class="<?=$_GET['page']!='apiTest'?:'active'?>"><a href="/apiTest">Database Test</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" role="main">
