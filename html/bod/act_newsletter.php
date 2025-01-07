<?PHP
    require('setup.php'); 
    require( $paths["dbObjects"] . "anonymous_users.php"); 
    require( $paths["dbObjects"] . "anonymoususers_newsletterscategories.php"); 
?>
<?php
/** 
 * Desc: Subscribes a user to a news letter identified by ffCategoryId.
 * TODO: This page needs to be redone to make it OO
 * TODO: Need to make it so verification email can be resent if user requests it. 
 **/
    define("REPLY_ALREADY_EXISTS", 0);
    define("REPLY_VALIDATE_EMAIL", 1);
    define("REPLY_SUBSCRIBED",     2);
    $replyMsgs       = array(
                            'The user identified by email address \'%s\' already exists but the email has not been verified.<br/><br/>You will not begin to receive newsletters until your address has been verified. We have re-sent the verificatin email.',
                            'You should receive and email shortly to validate your email address. Please click the link in the email. <br/><br/>You will not begin to receive newsletters until your address has been verified.',
                            'You are now subscribed!'
                           );//Reply messages to user
    define("ERROR_NO_EMAIL",             0);
    define("ERROR_NO_CATEGORY",          1);
    define("ERROR_NO_INSERT",            2);
    define("ERROR_NO_CREATE",            3);
    define("ERROR_ALREADY_SUBSCRIBED",   4);
    define("ERROR_GENERAL",              5);
    $errorMsgs      = array(
                            'No email value received. An administrator will be notified.',
                            'No newsletter category value received. <br/> This is an internal error and an Admin has been notified.',
                            'Could not insert new user. An administrator has been notified',
                            'Could not create new subscription. An administrator has been notified',
                            'Unable to subscribe user with email address \'%s\'. You are possibly already subscribed.',
                            'Unable to subscribe user with email address \'%s\'. An administrator has been notified.'
                           );//User notifiable errors

    $adminErrorMsgs = array();//For fatal errors
    $userReplyMsgs  = array();
    $userErrorMsgs  = array();
    $anonUser = null;
    $sub      = null;

    if( !isset($_REQUEST['ffEmail']) || $_REQUEST['ffEmail'] == null ){
        //Can't do anything so error out.
        array_push( $userErrorMsgs, ERROR_NO_EMAIL );
    }else if( !isset($_REQUEST['ffCategoryId']) || $_REQUEST['ffCategoryId'] == null ){
        //Can't do anything so error out.
        array_push( $userErrorMsgs, ERROR_NO_CATEGORY);
    }else{ //We have the info we need so lets process it.
        try{
            //If possible create a user and get an id
            $anonUser = new DataObjects_Anonymous_Users();
            if( $anonUser->createAnonUser($_REQUEST['ffEmail']) === false ){//The user exsits already
                if( !$anonUser->validated ){//The user exists but has not validated their email yet. Notify them that they need to validate their email and give them the option to resend validation email.
                    array_push( $userReplyMsgs, REPLY_ALREADY_EXISTS);
                }
            }else{//The user did not exist so insert them.
                if( $anonUser->insertAnonUser() === false ){
                    array_push( $userErrorMsgs, ERROR_NO_INSERT);
                }else{//New user created, Notify them that an email has been set to the email address provided, and that they need to validate that email. Once validated they will recieve the news letters 
                    array_push( $userReplyMsgs, REPLY_VALIDATE_EMAIL);
                }
            }

            //$anonUser now holds the id of a user. Attempt to subscribe them to a news letter. Note to the user that They will only receive news letters if their email was validated.
            try{
                //echo 'About to create  DataObjects_Anonymoususers_NewslettersCategories. anonUser= '; var_dump($anonUser);
                $sub = new DataObjects_Anonymoususers_NewslettersCategories($anonUser->anonuser_id, $_REQUEST['ffCategoryId']);
                //echo '<br/>DataObjects_Anonymoususers_NewslettersCategories created sub = '; var_dump($sub);
                if( $sub->insertSubscription() === false ){
                    array_push( $userErrorMsgs, ERROR_NO_CREATE);
                }else{
                    //echo '<br/>DataObjects_Anonymoususers_NewslettersCategories inserted sub = '; var_dump($sub);
                    array_push( $userReplyMsgs, REPLY_SUBSCRIBED); 
                }
            }catch( Exception $e ){
                array_push( $userErrorMsgs, ERROR_ALREADY_SUBSCRIBED);
                array_push( $adminErrorMsgs, 'Email: ' . $_REQUEST['ffEmail']. ' Exception: ' . $e->getMessage() );
            }
        }catch( Exception $e ){
            array_push( $userErrorMsgs, ERROR_GENERAL);
            array_push( $adminErrorMsgs, 'Email: ' . $_REQUEST['ffEmail']. ' Exception: ' . $e->getMessage() );
        }
    }
    
    //Email Admin on error
    $str = null;
    foreach( $userErrorMsgs as $value ){
        switch($value){
        case ERROR_NO_EMAIL:
        case ERROR_NO_CATEGORY:
        case ERROR_NO_INSERT:
        case ERROR_NO_CREATE:
        case ERROR_ALREADY_SUBSCRIBED:
        case ERROR_GENERAL:
            $str .= sprintf($errorMsgs[$value],$_REQUEST['ffEmail']) . '<br/> catid= ' . $_REQUEST['ffCategoryId']; 
            break;
        }
    }

    if( $adminErrorMsgs ){
        $adminErrorMsgs = 'User errors ' . $str . '<br/>Admin Errors ' . $adminErrorMsgs . '<br/>' . var_export($anonUser,true) . '<br/>' . var_export($sub, true) . '<br/>' . var_export($_REQUEST,true); 
        $mail = new phpmailer;
        $mail->Host = "127.0.0.1";  // specify main and backup server
        $mail->From = $adminEmail;
        $mail->FromName = "Admin";
        $mail->AddAddress($adminEmail, "BoD Admin");
        $mail->AddReplyTo("no-reply@blueoceandivers.com", "No-reply");
        $mail->WordWrap = 50;    // set word wrap
        $mail->IsHTML(true);    // set email format to HTML
        $mail->Subject = "Error: Newsletter subscription";
        $mail->Body = $adminErrorMsgs;
        $mail->Send(); // send message
    }

    foreach( $userReplyMsgs as $value ){
        switch($value){
        case REPLY_ALREADY_EXISTS:
        case REPLY_VALIDATE_EMAIL:
            //Have the user verify their email address
            $link = $paths['httpRoot'] . '?goto=verifyEmail';
            $href = $link . '&h=' . $anonUser->hash;
            $href .= '&email=' . urlencode($anonUser->email);
            $href2 = $paths['httpRoot'] . '?goto=unsubscribe';//TODO implement unsubscribe
            $href2 .= '&u=' . $anonUser->anonuser_id;
            $href2 .= '&cat=' . $sub->newslettercat_id;
            $href2 .= '&h=' . $anonUser->hash;
            $body = "Hello,<br/> Please verify your email address by clicking the below link. <br/><a href=\"". $href ."\">" . $href . "</a><br/><". $href .">. 
                <br/><br/>If you did not subscribe to this email or wish to be removed please click the below link. <br/><a href=\"" . $href2 . "\"></a> <" . $href2 . ">";
            //ob_start - output buffer start
            $mail = new phpmailer;
            $mail->Host = "127.0.0.1";  // specify main and backup server
            $mail->From = $adminEmail;
            $mail->FromName = "Admin";
            $mail->AddAddress($anonUser->email);
            $mail->AddReplyTo("no-reply@blueoceandivers.com", "No-reply");
            $mail->WordWrap = 50;    // set word wrap
            $mail->IsHTML(true);    // set email format to HTML
            $mail->Subject = "Blue Ocean Divers - Please verify your email address.";
            $mail->Body = $body;
            $mail->Send(); // send message
            break;
        case REPLY_SUBSCRIBED:
            //Let the user know they are subscribed.
            $href = $paths['httpRoot'] . '?goto=unsubscribe';//TODO implement unsubscribe
            $href .= '&u=' . $anonUser->anonuser_id;
            $href .= '&cat=' . $sub->newslettercat_id;
            $href .= '&h=' . $anonUser->hash;
            $body = "Hello,<br/> You have been subscribed to Blue Ocean Divers newsletter.<br/><br/>
                    If you did not subscribe to BoD's newsletter please click the link below and you will be unsubscribed.<br/><br/>
                    <a href=\"". $href ."\">" . $href . "</a><br/><". $href . ">.";
            $mail = new phpmailer;
            $mail->Host = "127.0.0.1";  // specify main and backup server
            $mail->From = $adminEmail;
            $mail->FromName = "Admin";
            $mail->AddAddress($anonUser->email);
            $mail->AddReplyTo("no-reply@blueoceandivers.com", "No-reply");
            $mail->WordWrap = 50;    // set word wrap
            $mail->IsHTML(true);    // set email format to HTML
            $mail->Subject = "Blue Ocean Divers - You have been subscribed to our newsletter";
            $mail->Body = $body;
            $mail->Send(); // send message
            break;
        }
    }


    //echo 'ReplyMsg= '; var_dump($replyMsg); 
    //echo 'ErrorMsgs= '; var_dump($errorMsgs);
    //echo 'AdminErrorMsgs= '; var_dump($adminErrorMsgs);
 ?>
<page name="act_newsletter">
    <?PHP 
    echo '<email><![CDATA[' . $_REQUEST['ffEmail'] . ']]></email>';
    ?>
    <replymsgs>
        <?PHP
        foreach( $userReplyMsgs as $value ){
            echo '<replymsg><![CDATA[' . sprintf($replyMsgs[$value], $_REQUEST['ffEmail']) . ']]></replymsg>';
        }
        ?>
    </replymsgs>
    <errormsgs>
        <?PHP
        foreach( $userErrorMsgs as $value ){
            echo '<errormsg><![CDATA[' . sprintf($errorMsgs[$value], $_REQUEST['ffEmail']) . ']]></errormsg>';
        }
        ?>
    </errormsgs>
</page>
