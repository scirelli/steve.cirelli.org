<?PHP
    $fbCookie = $_POST['ffFBCookie'];
    $ffLike   = $_POST['ffLike'];
    $ffFilter = $_POST['ffFilter'];
    $id       = ''; 
    if( isset($fbCookie) ){
        $response = file_get_contents( 'http://localhost:8383/start?cookie=' . urlencode($fbCookie) . '&like=' . urlencode($ffLike) . '&filter=' . urlencode($ffFilter) );
        //var_dump($response);
        if( $response ){
            $id = json_decode($response);
            $id = $id->botId;
            require('complete.php');
        }else{
            require('failedstart.php');
        }
    }else{
        require('badcookie.php');
    }
?>
