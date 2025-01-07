<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WC3//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Admin Tools - Blue Ocean Divers</title>
        <meta name="description" content="Blue Ocean Divers Administration tools. For authorized users only." />
        <meta name="keywords" content="administration, admin" />
        <link REL="SHORTCUT ICON" HREF="../favicon.ico">

        <!-- ------------ Javascript ------------ -->
        <!-- 3rd party -->
        <script type="text/javascript" src="../js/prototype_1.7.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <!--<script type="text/javascript" src="http://www.jongma.org/webtools/jquery/jquery.xslt.js"></script>-->
        <!-- Cirelli's -->
        <script type="text/javascript" src="../js/reflect.js"></script>
        <script type="text/javascript" src="../js/extras-array.js"></script>
        <script type="text/javascript" src="../js/ajaxLib.js"></script>
        <script type="text/javascript" src="../js/extras-location.js"></script>
        <script type="text/javascript"> 
            var $j = jQuery.noConflict();
            //---- GLOBAL: Namespacing object ----
            var cirelli = new Object();
            cirelli.url = '<?PHP echo $paths['httpRoot']; ?>';
        </script>
        <!--<script type="text/javascript" src="../js/CommandQ.js"></script>-->
        <script type="text/javascript" src="../js/CommandObj_Interface.js"></script>
        <script type="text/javascript" src="js/MenuLinkObjs.js"></script>
        <script type="text/javascript" src="js/MenuCommandObjs.js"></script>
        <script type="text/javascript" src="js/Factories.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <!-- ------------------------------------ -->

        <!-- ------------ CSS Styles ------------ -->
        <!-- <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />-->
        <style type="text/css">
            body{ 
                background:#AAA;
                background-image:url(http://localhost:8080/images/body_bg.jpg); 
                color:#000;
            }

        </style>
        <!--[if IE ]>
        <link rel="stylesheet" href="" type="text/css" media="screen"/>
        <style type="text/css">
        </style>
        <![endif]-->
        <!-- ------------------------------------ -->
    </head>

    <body>
        <?PHP include('newsletters.php'); ?>
    </body>
</html>
