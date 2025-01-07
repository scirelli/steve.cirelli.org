<?PHP
interface iResponse{
    public function getMsg();
    //Should return true if successful false otherwise
    public function setMsg( $str );
    public function toString();
}
?>
