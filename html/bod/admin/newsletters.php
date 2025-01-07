<?PHP
    require('../setup.php'); 
    require( $paths["dbObjects"] . "anonymous_users.php"); 
?>
<?php


    
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

