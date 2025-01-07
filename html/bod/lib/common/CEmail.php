<?php
    class CEmail
    {
        private $s_headers  = "From: $from\r\n" . "Content-type: text/html\r\n"; 
        private $s_from;
        private $s_to;
        private $s_cc;
        private $s_bcc;
        private $s_subject;
        private $s_body;
        //options to send to cc+bcc 
        //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]"; 
        //$headers .= "Bcc: [email]email@maaking.cXom[/email]"; 

        function __construct( $s_from=null, $s_to=null, $s_subject=null, $s_body=null ){

        }
     
        public static function sendEmail( $s_from, $s_to, $s_subject, $s_body ){
            if( mail($s_to, $s_subject, $s_body) )
                return 1;
            else 
                return 0;
        }

        public function send(){
        }
    }
?>
