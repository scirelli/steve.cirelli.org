<?PHP 
    header('Content-type: application/xml'); 
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    /*echo '<?xml-stylesheet type="text/xsl" href="xslt/newsletters.xsl"?>';*/
    /*echo '<?xml-stylesheet type="text/xsl" href="xslt/survey.xsl"?>';*/
    echo '<pages>';
    if( !isset($_REQUEST['pg']) ) $_REQUEST['pg'] = 'newsevents';
    foreach( explode(",", $_REQUEST['pg']) as $page ){
        switch(strToLower($page)){
            case 'staff':
                include('staff.php');
                break;
            case 'contactinfo':
                include('contactInfo.php');
                break;
            case 'calendar':
                include('calendar.php');
                break;
            case 'about':
                include('about.php');
                break;
            case 'courses':
                include('courses.php');
                break;
            case 'survey':
                include('survey.php');
                break;
            case 'newsletters':
                include('newsletters.php');
                break;
            case 'all':
                include('staff.php');
                include('contactInfo.php');
                include('calendar.php');
                include('about.php');
                include('coarses.php');
                include('survey.php');
                include('newsletters.php');
                break;
            case 'newsevents':
                include('newsevents.php');
       }
    }
    echo '</pages>';
?>
