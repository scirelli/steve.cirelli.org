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

        $fname = '';
        $lname = '';
        $nname = '';
        $level = '';
        $pic = '';
        $insert = 1;
        if(isset( $_POST['ffStory'] )) $fname = $_POST['ffFirstN']; 
        if(isset( $_POST['ffLastN'] )) $lname = $_POST['ffLastN']; 
        if(isset( $_POST['ffNickN'] )) $nname = $_POST['ffNickN']; 
        if(isset( $_POST['ffLevel'] )) $level = $_POST['ffLevel']; 
        if(isset( $_POST['ffPic'] ))   $pic   = $_POST['ffPic']; 
        if(isset( $_GET['insert'] ))   $insert = $_GET['insert']; 
        ?>
        <form name="fBodSQLSanitiz" method="POST" action="">
            <input type="hidden" name="insert" value="<?PHP echo $insert; ?>"/>
            <div>
                <label for="ffFirstN">First Name: </label><input name="ffFirstN" id="ffFirstN" value="<?PHP echo $fname; ?>"/><br/>
                <label for="ffLastN">Last Name: </label><input name="ffLastN"  id="ffLastN"  value="<?PHP echo $lname; ?>"/><br/>
                <label for="ffNickN">Nick Name: </label><input name="ffNickN"  id="ffLastN"  value="<?PHP echo $nname; ?>"/><br/>
                <label for="ffLevel">Level: </label><input name="ffLevel"  id="ffLevel"  value="<?PHP echo $level; ?>"/><br/>
                <label for="ffPic">Pic: </label><input name="ffPic"  id="ffPic"  value="<?PHP echo $pic; ?>"/><br/>
            </div>
            <div><textarea name="ffStory" id="ffStory" rows="20" cols="100"><?PHP if(isset( $_POST['ffStory'] )) echo $_POST['ffStory']; ?></textarea></div>
            <input type="submit" value="Clean!"/>

            <div>
                <?PHP //’ ’
                if( isset( $_POST['ffStory'] ) ){
                    $sqlStr = "INSERT INTO Stories(story) VALUES ('%s');";
                    $output = str_replace("’","'", $_POST['ffStory'] );
                    $sqlStr = sprintf( $sqlStr, $output);

                    $sqlStr2 = "INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, userStory_id)
                                VALUES
                                ('%s','%s', '%s', 
                                  (SELECT padiLvl_id FROM padi_levels WHERE padiLevel LIKE '%s' LIMIT 1), 
                                  (SELECT image_id FROM images WHERE fileName LIKE '%s' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );";
                    $level = '%' . str_replace(' ', '%', $level) . '%';
                    $pic   = '%' . str_replace(' ', '%', $pic) . '%';
                    $sqlStr2 = sprintf( $sqlStr2, $_POST['ffFirstN'], $_POST['ffLastN'], $_POST['ffNickN'], $level, $pic);
                    echo '<textarea name="ffCleaned" id="ffCleaned" rows="20" cols="100">' . $sqlStr . $sqlStr2 . '</textarea>';
                }
                ?>
            </div>
            <div style="background-color:white;">
                <?PHP
                if( isset( $_POST['ffStory'] ) ){
                    //Insert into database
                    $dbhost = 'localhost';
                    $dbuser = 'root';
                    $dbpass = '';
                    $dbname = 'blueoceandivers';

                    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('error connecting to mysql');
                    echo mysql_error();
                    mysql_select_db($dbname);

                    if( isset($_POST['insert']) && $_POST['insert'] != 0  ){
                    $result = mysql_query($sqlStr);
                    if( !$result ) die('Invalid query:' . mysql_error());
                    $result = mysql_query($sqlStr2);
                    if( !$result ) die('Invalid query:' . mysql_error());
                    }
                    $result = mysql_query('select * from users u join stories s on s.story_id = u.userstory_id where lastname =\'' . $lname . '\'');
                    while ($row = mysql_fetch_assoc($result)) {
                        echo '<p>' . $row['firstname'] . '</p>';
                        echo '<p>' . $row['lastname'] . '</p>';
                        echo '<p>' . $row['story'] . '</p>';
                    }
                }
                ?>&nbsp;
            </div>
        </form>
    </body>
</html>
