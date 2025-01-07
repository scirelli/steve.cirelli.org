<?php
    //-------------------------------------------------------------
    // File: Setup.php - Main setup file for site.
    // Author: Steve Cirelli
    // Desc: Open a database connection and init global variables.
    //-------------------------------------------------------------

    //require_once 'System.php';
    //require_once 'DB/DataObject.php';
    if( !isset($_GET['db'])) $_GET['db'] = 0;//debug info on
    if( !isset($_REQUEST["pg"])) $_REQUEST["pg"] = 'home';

    if( $_GET['db'] == 1) 
    {
        echo $_SERVER['SERVER_NAME'];
        echo getcwd(); 
        var_dump( $_SERVER );
    }

    switch( $_SERVER['SERVER_NAME'] )
    {
    case "jerinaw.org":
        $dbhost = 'bodadmin.db.3245200.hostedresource.com';//173.201.217.77 cirellijerinaw
        $dbuser = 'bodadmin';//cirellijerinaw
        $dbadminUser = 'bodadmin';
        $dbpass = 'Thelipes1';
        $dbAdminPass = 'Thelipes1';
        $dbname = 'blueoceandivers';
        $dbbodreadOnlyUser = "bodUser";//password bodUser1234
        $dbbodreadOnlyUserPass = 'bodUser1234';
        $serverRoot = "/home/content/s/t/e/stevejc75/html/";
        $rootFolder = "bod";
        break;
    case "localhost":
        $dbhost = 'localhost';
        $dbuser = 'phpuser';
        $dbadminUser = 'root';
        $dbpass = 'steve';
        $dbAdminPass = '';
        $dbname = 'blueoceandivers';

        $serverRoot = "E:\\MyDocuments\\My Programs\\Web design\\htdocs\\";
        $rootFolder = "bod";
        break;
    case "192.168.1.19":
    case "98.28.164.78":
    case "scirelli.net":
        $dbhost = 'localhost';
        $dbuser = 'phpuser';
        $dbadminUser = 'phpAdmin';
        $dbpass = 'steve';
        $dbAdminPass = '';
        $dbname = 'blueoceandivers';

        $serverRoot = "C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\";
        $rootFolder = "bod";
        break;
    case "scirelli.com":
        $dbhost = 'localhost';
        $dbuser = 'phpuser';
        $dbadminUser = 'phpAdmin';
        $dbpass = 'steve';
        $dbAdminPass = '';
        $dbname = 'BlueOceanDivers';

        $serverRoot = "/var/www/";
        $rootFolder = "bod";
        break;
    default:
        echo 'Error';
        die(0);
    }

    $adminEmail = "information@blueoceandivers.com";
    $httpRoot = "http://" . $_SERVER["HTTP_HOST"] . "/bod/"; 
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('error connecting to mysql');
    echo mysql_error();
    mysql_select_db($dbname);

    //Use DB_DataObject
    //$options = &PEAR::getStaticProperty('DB_DataObject','options');
    //echo $php_errormsg;
    //$config = parse_ini_file('E:/MyDocuments/My Programs/Web design/htdocs/bod/db/DB_DataObject_BoD.ini',TRUE);
    //$options = $config['DB_DataObject'];

    $paths = array( 
                    'serverRoot' => $serverRoot,
                    'httpRoot'   => $httpRoot,
                    'rootFolder' => $rootFolder,
                    'libRoot'  => $serverRoot . $rootFolder . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR,
                    'libCommon'=> $serverRoot . $rootFolder . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR,
                    'images'   => $httpRoot . "images/",
                    'adminEmail' => $adminEmail,
                    'newsletters'   => $httpRoot . "newsletters/",
                    'dbObjects'   => $serverRoot . $rootFolder . DIRECTORY_SEPARATOR . "db" . DIRECTORY_SEPARATOR
                  );

    $slash = DIRECTORY_SEPARATOR;
 
    //set_error_handler("myscript"); //TODO: Create a function to handle errors see http://www.w3schools.com/php/php_error.asp
    //Look into autoloading classes http://www.php.net/manual/en/language.oop5.autoload.php
    require('lib/common/phpmailer/phpmailer.inc.php');
    /*
     *
        $mail = new phpmailer;

        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->From = "from@email.com";
        $mail->FromName = "Mailer";
        $mail->Host = "smtp1.site.com;smtp2.site.com";  // specify main and backup server
        $mail->AddAddress("josh@site.com", "Josh Adams");
        $mail->AddAddress("ellen@site.com");   // name is optional
        $mail->AddReplyTo("info@site.com", "Information");
        $mail->WordWrap = 50;    // set word wrap
        $mail->AddAttachment("c:\\temp\\js-bak.sql");  // add attachments
        $mail->AddAttachment("c:/temp/11-10-00.zip");

        $mail->IsHTML(true);    // set email format to HTML
        $mail->Subject = "Here is the subject";
        $mail->Body = "This is the message body";
        $mail->Send(); // send message
     *
     * */
?>
