<?PHP 
    if( !isset($id) ){
        $id = ""; 
    }
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Complete</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container" style="margin-top:30px;">
            <div class="row">
                <div class="col-md-2"></div>
                <div  class="col-md-8">
                    <div name="info" class="bg-info" style="margin-top:20px; padding:15px;">
                        <h4>Complete!</h4>
                        <p>
                            Logs can be found <a href="<?PHP echo 'viewlogs.php?id=' . $id;?>">here</a>.
                        </p>
                        <p>
                            Your id is '<?PHP echo $id;?>'. This is the ID of your bot. It is tied to your FB cookie. If you revoke the cookie your bot will no longer work. If this server goes down you will need to <a href="index.html">submit</a> your FB cookie again.
                        </p>
                        <p>
                            You can <a href="stopbot.php?id=<?PHP echo $id;?>">stop</a> your bot by going to this page.
                        </p>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
