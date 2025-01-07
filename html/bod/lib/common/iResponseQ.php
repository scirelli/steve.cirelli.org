<?PHP
interface iResponseQ{
    const MSG_TYPE_ERROR  = 0;
    const MSG_TYPE_NORMAL = 1;

    public function getNextMsg ( $type       );
    public function pushMsg    ( $msg, $type );
}
?>
