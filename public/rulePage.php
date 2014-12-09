
<!doctype html>
<html>
    <!-- bootstrap -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="http://netdna.bootstrap/3.2.0/css/bootstrap.min.css">

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <style>
            .banner { background-color: #2F4F4F; color: #fff; height: 100px;}
            .footer { background-color: #2F4F4F; color: #fff; height: 50px; }

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

            <div class = 'col-md-4'>

                    <!--<form method="get">-->

                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">Makes
                            <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li role="presentation"><a role="menuitem" tabindex="0" href="">Dodge</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="1" href="#">Volkswagen</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="2" href="#">Toyota</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="3" href="#">Nissan</a></li>
                                </ul>
                        </div>
            </div> 
            <div class = 'col-md-4'>           
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">Year
                            <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="">2000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2001</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2002</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2003</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2004</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2005</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2006</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2007</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2008</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2009</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2010</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2011</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2012</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2013</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">2014</a></li>
                                </ul>
                        </div>
            </div>
            <div class = 'col-md-4'>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-expanded="true">Price
                            <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="">Less than 5,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">5,000 - 15,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">15,000 - 20,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">20,000 - 25,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">25,000 - 30,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">30,000 - 35,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">35,000 - 40,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">40,000 - 45,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">45,000 - 50,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">50,000 - 55,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">55,000 - 60,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">60,000 - 65,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">65,000 - 70,000</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">above 70,000</a></li>
                                    
                                </ul>
                        </div>
            </div>            
                        <!--
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
                    -->
            </div>

             <div class='row footer'>
                <div class='col-md-12'></div>
            </div>

        </div>
        
    </body>
</html>
