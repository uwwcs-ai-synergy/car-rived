
<!doctype html>
<html>
    <!-- bootstrap -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

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
                    <h1>Submit your rule!</h1>
                </div>
            </div>

            <div class = 'row'>

                <div class = 'col-md-12'>
                        
                    <form method = 'get' action = 'result.php'>
                        <div class="input-group">
                            <span class="input-group-addon">Make</span>
                            <input type="text" class="form-control" placeholder="ex.volkswagen" name="make" value=""/>
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">Year</span>
                            <input type="text" class="form-control" placeholder="ex.2000" name="year" value=""/>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">Price</span>
                            <input type="text" class="form-control" placeholder="ex.5000" name="price" value=""/>
                        </div>
                        <div>
                            <button class = 'btn btn-primary' type = 'submit'>Submit
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                        </div>
                       
                    </form>
                    <hr/>
                    
                </div>    
            </div>

             <div class='row footer'>
                <div class='col-md-12'></div>
            </div>

        </div>
        
    </body>
</html>
