<?PHP
require('iResponse.php');

class GeneralResponse implements iResponse{
    private $msg = null;
    
    function __construct( $msg=null ){
        if( $msg ){
            $this->setMsg($msg);
        }
    }

    public function getMsg(){
        return $this->msg;
    }

    public function setMsg( $str ){
        if( gettype( $str ) == "string" ){
            $this->msg = $str;
            return true;
        }
        return false;
    }

    public function toString(){
        return $this->msg;
    }
}
?>
