<?PHP
    $id = $_GET['id'];
    
    if( isset($id) ){
        $response = file_get_contents( 'http://localhost:8383/stop/' . urlencode($id) );
        //var_dump($response);
        if( $response ){
            $id = json_decode($response);
            $id = $id->botId;
            require('stopped.php');
        }
    }else{
        require('failedstop.php');
    }
?>
