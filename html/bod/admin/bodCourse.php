<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WC3//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title></title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link REL="SHORTCUT ICON" HREF="http://jerinaw.org/favicon.ico">

        <!-- ------------ Javascript ------------ -->
        <script type="text/javascript"></script>
        <!-- ------------------------------------ -->

        <!-- ------------ CSS Styles ------------ -->
        <!-- <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />-->
        <style type="text/css">
            body{ 
                background:#AAA;
                background-image:url(http://localhost:8080/images/body_bg.jpg); 
                color:#000;
            }
            div#warning{color:red; background-color:white; font-weight:bold; text-align:center;}

        </style>
        <!--[if IE ]>
        <link rel="stylesheet" href="" type="text/css" media="screen"/>
        <style type="text/css">
        </style>
        <![endif]-->
        <!-- ------------------------------------ -->
    </head>

    <body>
        <?PHP 
        $insert = 1;
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'blueoceandivers';

        $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('error connecting to mysql');
        echo mysql_error();
        mysql_select_db($dbname);
        ?>
        <div>
        <?PHP
        if( isset($_POST['submit'])){
            $sqlStr = "SELECT * 
                FROM courses c 
                JOIN padi_levels pl ON pl.padilvl_id = c.padiLvl_id 
                JOIN padi_level_types lt ON pl.lvlType_id = lt.lvlType_id";

            $result = mysql_query($sqlStr);
            if( !$result ) die('Invalid query:' . mysql_error());
            while ($row = mysql_fetch_assoc($result)) {
                $sqlStr = "UPDATE courses 
                           set cost = '%s', 
                           duration = '%s',
                           startDate = '%s'
                           where course_id = %s";
                $courseid = $row['course_id'];
                try{
                    $cost = $_POST['ffCost_'.$courseid];
                    $dura = $_POST['ffDuration_' . $courseid];
                    $sdate = $_POST['ffSdate_' . $courseid];
                    $sqlStr =  sprintf($sqlStr, $cost, $dura, $sdate, $courseid);
                    $rtn = mysql_query($sqlStr);
                    echo '<p>' . $sqlStr . '</p>';
                }catch(Exception $e){
                    echo 'Catch error';
                }
            }
        }

        //mysql_free_result($result);
        ?>
        </div>
        <div id="warning"> UNSAFE FORM! NO INPUT VALIDATION IS DONE ON CLIENT OR SERVER!  </div>

        <form name="fCourses" method="POST" action="">
            <input type="hidden" name="insert" value="<?PHP echo $insert; ?>"/>
            <table>
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Cost</th>
                        <th>Duration</th>
                        <th>Start Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP
                    $sqlStr = "SELECT * 
                        FROM courses c 
                        JOIN padi_levels pl ON pl.padilvl_id = c.padiLvl_id 
                        JOIN padi_level_types lt ON pl.lvlType_id = lt.lvlType_id";

                    $result = mysql_query($sqlStr);
                    if( !$result ) die('Invalid query:' . mysql_error());

                    while ($row = mysql_fetch_assoc($result)) {
                        $cost = 'ffCost_' . $row['course_id'];
                        $dura = 'ffDuration_' . $row['course_id'];
                        $sdate = 'ffSdate_' . $row['course_id'];
                        echo '<tr>';
                        echo '<td>' . $row['padiLevel'] . '</td>';
                        $output = '<td><input type="text" name="%s" id="%s" value="%s"/></td>';
                        printf($output, $cost, $cost, $row['cost']);
                        printf($output, $dura, $dura, $row['duration']);
                        printf($output, $sdate, $sdate, $row['startDate']);
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <input type="submit" name="submit" id="submit" value="Submit"/>
        </form>
    </body>
</html>
