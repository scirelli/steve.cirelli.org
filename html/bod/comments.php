<?PHP
    require('setup.php'); 
    require( $paths["dbObjects"] . "anonymous_users.php"); 
?>

<?php
/** 
 * Desc: Subscribes a user to a news letter
 * Notes: This page needs to be redone to make it OO 
 * TODO: Make this subscribe a user to a newsletter. Currently just tries to add a user to anonymous_users table
 **/
    $replyMsg  = array();
    $errorMsgs = array();
    $adminErrorMsgs = array();

    if( !isset($_REQUEST['ffEmail']) ){
        //Can't do anything so error out.
        array_push( $errorMsgs, 'No email value received.');
        array_push( $adminErrorMsgs, 'No email value received.');
    }else if(!isset($_REQUEST['ffCategoryId'])) {
        //Can't do anything so error out.
        array_push( $errorMsgs, 'No letter category value received. <br/> This is an internal error and an Admin has been notified.');
        array_push( $adminErrorMsgs, 'No letter category value received. _REQUEST[] = ' . var_export($_REQUEST,true));
    }else{ //We have the info we need so lets process it.
        try{
            //If possible create a user and get an id
            $tmp = new DataObjects_Anonymous_Users($_REQUEST['ffEmail']);
            if( $tmp->insertAnonUser() === false ){
                array_push( $errorMsgs, 'Could not insert new user. An administrator has been notified');
                array_push( $adminErrorMsgs, 'Could not insert user. <br/> Insert returned false. $tmp = ' . var_export($tmp,true) );
            }
        }catch( Exception $e ){
            array_push( $errorMsgs, 'Unable to create a user with email address \'' . $_REQUEST['ffEmail'] . '\'. User possibly already exists. An administrator has been notified.');
            array_push( $adminErrorMsgs, 'Email: ' . $_REQUEST['ffEmail']. ' Exception: ' . $e->getMessage() );
        }
    }
    var_dump($errorMsgs);
    var_dump($adminErrorMsgs);
    
    $to = "testuser@127.0.0.1";
    $subject = "This is a TEST this is only a TEST";
    $body = "Hi,\n\nHow are you?";
    if (mail($to, $subject, $body)) {
    echo("<p>Message successfully sent!</p>");
    } else {
    echo("<p>Message delivery failed...</p>");
    }

    $user = new DataObjects_Anonymous_Users();
    $user->anonuser_id = 1;
    $user->get('email', 'scirelli@gmail.com');
    while($user->fetch()){
        echo $user->email . '<br/>';
        echo $user->hash. '<br/>';
        echo $user->joinDate. '<br/>';
    }

 ?>

