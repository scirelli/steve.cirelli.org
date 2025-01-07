<?php
    require('/lib/common/isValidEmail.php'); 
/**
 * Table Definition for AnonymousUsers
 */
class DataObjects_Anonymous_Users
{
    public $__table = 'Anonymous_Users'; // table name
    //These column names must exactly match variable names below. Case and all.
    public $anonuser_id; // int(4) unsigned primary_key not_null
    public $joinDate;    // date default 1980-04-20
    public $email;       // char(200) unique
    public $validated;   // bit(1)
    public $hash;        // char(255)

    private $n;           // number of rows
    private $result;   //Result from find.

    /**
     * Constructor: If an email is passed in a new user is created but not inserted into the database. 
     *              call DataObjects_Anonymous_Users::insertAnonUser() to insert the user.
     * @param string $email an email address of a new user
     * @throw User already exists
     */
    function __construct($email=null){
        if( $email == null ){
            $this->anonuser_id = 0;
            $this->joinDate = null;   
            $this->email = null;      
            $this->validated = 0;  
            $this->hash = null;       
            $this->n = 0;
            $this->result = null;
            return;
        }else{
            if( $this->createAnonUser( $email ) === false ) throw new Exception('User already exists.');//TODO: Possibly change this so it doesn't throw and exception
        }
    }

    //function __clone(){
    //}

    /**
     * Creates a new anonymous user and fills the current obj with the info
     * Desc: Tries to create an anonymous user. 
     *       If the user already exists it will fill this obj with the users info.
     *       If the email is not a valid email it will throw an Invalid Email error
     * @param: string $email the users email.
     * @return: a pointer this object or false if the user already existed.
     * @throw: Excption if invalid email.
     * @acces: public
     **/ 
    function createAnonUser( $email ){
        if( !isValidEmail($email ) ) throw new Exception('Invalid email.');
        $this->email = $email;

        if( !$this->find(true) ){//The email doesn't exists.
            $this->joinDate = date("Y-m-d");
            $this->hash = md5($this->email. time());
            $this->validated = 0;
        }else{
            return false;
        }

        return $this;
    }

    /**
     * Inserts this object or the one passed in.
     * @param DataObjects_Anonymous_Users $do_anonymousUser an object to insert 
     * @return: insert result
     * @access public
     */
    function insertAnonUser( $do_anonymousUser=null ){
        $sql = "INSERT INTO " . $this->__table . "(email, joinDate, hash) VALUES ('%s', '%s', '%s')";
        $rtn = false;

        if( $do_anonymousUser != null && ($do_anonymousUser instanceof  DataObjects_Anonymous_Users) ){
            $sql = sprintf($sql, $do_anonymousUser->email, $do_anonymousUser->joinDate, $do_anonymousUser->hash); 
        }else{
            $sql = sprintf($sql, $this->email, $this->joinDate, $this->hash); 
        }
        $rtn = mysql_query( $sql );
        $this->anonuser_id =  $this->getLastInsertId(); 
        return $rtn;
    }

    function getLastInsertId(){
        $result = mysql_query( 'SELECT last_insert_id() as id' );
        $result = mysql_fetch_assoc( $result );
        return $result['id'];
    }

    /**
     * find results, either normal or crosstable
     *
     * for example
     *
     * $object = new mytable();
     * $object->ID = 1;
     * $object->find();
     *
     *
     * will set $object->N to number of rows, and expects next command to fetch rows
     * will return $object->N
     *
     * @param   boolean $n Fetch first result
     * @access  public
     * @return  mixed (number of rows returned, or true if numRows fetching is not supported)
     * @throws Exception if email or anonuser_id is not set
     */
    function find( $n=false ){
        //$vars = get_object_vars($this); //Use this function to build a query based on fields that are filled in.
        if( $this->anonuser_id != 0 )
            $rtn = $this->get( $this->anonuser_id );
        else if($this->email != null){
            $rtn = $this->get( 'email', $this->email );
        }else{
            throw new Exception('anonuser_id or email is not set.');
        }
        if( $n === true ){
            $this->fetch();
        }

        return $rtn; 
    }
    
    /**
     * fetches next row into this objects var's
     *
     * returns 1 on success 0 on failure
     **/
    function fetch(){
        $row = mysql_fetch_assoc( $this->result );
        
        if( $row === false ) return false;

        foreach($row as $var => $value){
            if( property_exists($this, $var) ){
                $this->$var = $row[$var];
            }
        }
        return true;
    }
    
    /**
     * Gets a key $k with a value $v. 
     * If $v is null then search is done by anonuser_id = $k
     * return: number of rows if successful
     * TODO: This function will have to be updated to accomodate differnt data types
     **/
    function get($k,$v=NULL) { 
        if(  $this->result )
            mysql_free_result( $this->result );
        $sql = "SELECT * FROM " . $this->__table . " WHERE %s = '%s'";

        if($v == NULL){
            $v = $k;
            $k = 'anonuser_id';
        }else{
            $k = strtolower( $k );
        }

        $sql = sprintf($sql, $k, $v);
        $this->result = mysql_query($sql);
        if( $this->result !== false )
            return $this->n = mysql_num_rows( $this->result );
        return false;
    }
}
/*
 * Counting rows
$stmtMain = $mysqli->prepare("SELECT SQL_CALC_FOUND_ROWS jobid,title FROM tbljobs 
    LIMIT ?, ? UNION SELECT FOUND_ROWS(),'!!IgnoreCount!!';")

Then iterate through the results with something like:
 */
