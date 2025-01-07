<?PHP
require('setup.php');
require('lib/common/GeneralResponse.php');
require('lib/common/GeneralResponseQ.php');
require('lib/common/XMLResponseQPrinter.php');

 //ob_start();
 //  echo "Test";
 //  header("Location: http://www.php.net");
 //  ob_flush();
$output = new GeneralResponseQ();
if( isset($_REQUEST['h']) && !preg_match('/[^0-9a-zA-Z]+/', $_REQUEST['h'] ) &&
    isset($_REQUEST['cat']) && 
    isset($_REQUEST['u'])){
    
    $hash   = $_REQUEST['h'];
    $catid  = $_REQUEST['cat'];
    $userid = $_REQUEST['u'];
    $sql = null;

    $sql = 'DELETE FROM anonymoususers_newsletterscategories 
            WHERE anonuser_id IN (SELECT anonuser_id FROM Anonymous_Users WHERE hash = \'%s\' AND anonuser_id = %s)
            AND newslettercat_id IN (SELECT newslettercat_id FROM newsletters_categories WHERE newslettercat_id = %s)';

    $sql = sprintf($sql, $hash, $userid, $catid);
    $result = mysql_query($sql);
    
    if( $result === false ){
        $output->pushMsg( new GeneralResponse('We\'re sorry there was an error when trying to remove your subscription. An administrator has been contacted. Please try again later.'), iResponseQ::MSG_TYPE_ERROR );

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
        $mail->Subject = "Error: Removing user subscription";
        $mail->Body = $body;
        $mail->Send(); // send message
    }else if( mysql_affected_rows() == 0 ){
        $output->pushMsg( new GeneralResponse('We were unable to find a subscription for the information given. If you are still receiving newsletters please contact an administrator.'), iResponseQ::MSG_TYPE_ERROR );
    }else{
        $output->pushMsg(new GeneralResponse('You are now unsubscribed.'), iResponseQ::MSG_TYPE_NORMAL);
    }
}else{
    $output->pushMsg( new GeneralResponse('Internal error - Did not receive the information needed to process request. h= ' . $_REQUEST['h'] . ' u= ' . $_REQUEST['u'] . ' cat= ' . $_REQUEST['cat']), iResponseQ::MSG_TYPE_ERROR );
}
?>
<page name="act_newsletter_unsubscribe">
    <?PHP
        echo '<user><![CDATA[' . $_REQUEST['u'] . ']]></user>';
        echo '<hash>' . $_REQUEST['h'] . '</hash>'; 
        echo '<category>' . $_REQUEST['cat'] . '</category>'; 
        $printer = new XMLResponseQPrinter($output);
        echo $printer->sprintXML();
    ?>
</page>
<?PHP
        //Unable to use httpresponse class because I don't have a threadsafe verions of php installed. I'll have to look into upgrading.
        //$hr = HttpResponse(); 
        //$hr->http_redirect('http://localhost:8080/bod');// [, array $params [, bool $session = false [, int $status ]]]] );
?>
