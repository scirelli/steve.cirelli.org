<?PHP
require('setup.php');
require('lib/common/isValidEmail.php');
require('lib/common/GeneralResponse.php');
require('lib/common/GeneralResponseQ.php');
require('lib/common/XMLResponseQPrinter.php');


 //ob_start();
 //  echo "Test";
 //  header("Location: http://www.php.net");
 //  ob_flush();
$output = new GeneralResponseQ();
if( isset($_REQUEST['h']) && !preg_match('/[^0-9a-zA-Z]+/', $_REQUEST['h'] ) &&
    isset($_REQUEST['email']) && isValidEmail($_REQUEST['email']) ){
    $sql = null;

    if( isset($_REQUEST['iv']) && $_REQUEST['iv'])
        $sql = 'UPDATE anonymous_users SET validated = 0 WHERE email = \'%s\' AND hash = \'%s\'';
    else
        $sql = 'UPDATE anonymous_users SET validated = 1 WHERE email = \'%s\' AND hash = \'%s\'';

    $sql = sprintf($sql, $_REQUEST['email'], $_REQUEST['h']);
    $result = mysql_query($sql);
    
    if( $result === false ){
        $output->pushMsg( new GeneralResponse('We\'re sorry there was an error when trying to verify your email address. An administrator has been contacted. Please try again later.'), iResponseQ::MSG_TYPE_ERROR );

        $body = 'failed to execute sql \'' . $sql . '\'';
        $body .= ' Db error \'' . mysql_error() . '\'';
        $body .= ' _REQUEST[] = ' . var_export( $_REQUEST, true );
        $mail = new phpmailer;
        $mail->From = "admin@blueoceandivers.com";
        $mail->FromName = "No-reply";
        $mail->Host = "127.0.0.1";  // specify main and backup server
        $mail->AddAddress($adminEmail, "BoD Admin");
        $mail->AddReplyTo("no-reply@blueoceandivers.com", "No-reply");
        $mail->WordWrap = 50;    // set word wrap
        $mail->IsHTML(true);    // set email format to HTML
        $mail->Subject = "Error: Verifying user email";
        $mail->Body = $body;
        $mail->Send(); // send message
    }else if( mysql_affected_rows() == 0 ){
        $sql = 'SELECT validated FROM anonymous_users WHERE email = \'%s\' AND hash = \'%s\'';
        $sql = sprintf($sql, $_REQUEST['email'], $_REQUEST['h']);
        $result = mysql_query($sql);
        if( $result === false ){
            $output->pushMsg( new GeneralResponse('Email address not found - DB error'), iResponseQ::MSG_TYPE_ERROR );
        }else{
            $row = mysql_fetch_assoc( $result );
            if( $row === false )
                $output->pushMsg( new GeneralResponse('Email address not found'), iResponseQ::MSG_TYPE_ERROR );
            else
                $output->pushMsg(new GeneralResponse('Your email was already verified'), iResponseQ::MSG_TYPE_NORMAL);
        }
    }else{
        $output->pushMsg(new GeneralResponse('Your email is now verified'), iResponseQ::MSG_TYPE_NORMAL);
    }
}else{
    $output->pushMsg( new GeneralResponse('Internal error - Did not receive the information needed to process request. h= ' . $_REQUEST['h'] . ' email= ' . $_REQUEST['email']), iResponseQ::MSG_TYPE_ERROR );
}
?>
<page name="act_verifyEmail">
    <?PHP
        echo '<email><![CDATA[' . $_REQUEST['email'] . ']]></email>';
        echo '<hash>' . $_REQUEST['h'] . '</hash>'; 
        $printer = new XMLResponseQPrinter($output);
        echo $printer->sprintXML();
    ?>
</page>
<?PHP
        //Unable to use httpresponse class because I don't have a threadsafe verions of php installed. I'll have to look into upgrading.
        //$hr = HttpResponse(); 
        //$hr->http_redirect('http://localhost:8080/bod');// [, array $params [, bool $session = false [, int $status ]]]] );
?>
