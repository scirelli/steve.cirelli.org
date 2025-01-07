<?PHP 
    header('Content-type: application/xml'); 
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    /*echo '<?xml-stylesheet type="text/xsl" href="xslt/verifyemail.xsl"?>';*/
    /*echo '<?xml-stylesheet type="text/xsl" href="xslt/newsletters.xsl"?>';*/
    /*echo '<?xml-stylesheet type="text/xsl" href="xslt/act_newsletter_unsubscribe.xsl"?>';*/
    echo '<pages>';
    if( !isset($_REQUEST['pg']) ) $_REQUEST['pg'] = 'newsevents';
    foreach( explode(",", $_REQUEST['pg']) as $page ){
        switch(strToLower($page)){
            case 'act_newsletter':
                include('act_newsletter.php');
                break;
            case 'verifyemail':
                include('act_verifyEmail.php');
                break;
            case 'unsubscribe':
                include('act_newsletter_unsubscribe.php');
                break;
            case 'act_survey':
                include('act_survey.php');
                break;
            default:
                include('form_nodata.php');
       }
    }
    echo '</pages>';
?>
