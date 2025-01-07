<?php
require('db/newsletters_categories.php');
/**
 * Table Definition for Anonymoususers_NewslettersCategories
 * Desc: Class for managing the bridge table Anonymoususers_NewslettersCategories 
 * TODO: make it so this class fetches the category class for each obj. As well as a user class
 */
class DataObjects_Anonymoususers_NewslettersCategories
{
    public $__table = 'anonymoususers_newsletterscategories';                // table name
    public $anonusernewsletterscat_Id;       // int(4)  primary_key not_null unsigned
    public $anonuser_id;                     // int(4)  not_null unsigned
    public $newslettercat_id;                // int(4)  not_null unsigned

    private $n;           // number of rows
    private $result;      //Result from find.

    /**
     * Constructor:
     * @param 
     * @throw 
     */
    function __construct( $anonUserId=null, $newsLetterCatId=null){
        if( $anonUserId != null && $newsLetterCatId !=null ){
            if( $this->createSubscriptoin( $anonUserId, $newsLetterCatId) === false )
                throw new Exception('Already subscribed');
        }else{
            $this->anonusernewsletterscat_Id = 0;
            $this->anonuser_id = 0;
            $this->newslettercat_id = 0;
        }
    }

    //function __clone(){
    //}

    /**
     * Creates  subscription
     * Desc: 
     * @param: int $anonUserId the users id
     * @param: int $newsLetterCatId the the category id to subscribe the user too
     * @return: $this or false if the subscription already exists
     * @throw: Exception 'Already subscribed'
     * @acces: public
     **/ 
    function createSubscriptoin( $anonUserId, $newsLetterCatId){
        $this->anonuser_id = $anonUserId;
        //$this->newslettercat_id = $newsLetterCatId;
        if( $this->find(true) ){//The user has subscriptions 
            while( $this->fetch() ){//search through all their subscriptions
                if($this->newslettercat_id == $newsLetterCatId ){//See if they are subscribed to $newsLetterCatId already
                    return false;//They are already subscribed do not re-subscribe them.
                }
            }
        }
        //They are not subscribed to $newsLetterCatId 
        if(  $this->result )
            mysql_free_result($this->result);
        $this->result = null;
        //Make sure the category exists then set it
        $tmp = new DataObjects_Newsletters_Categories();
        $tmp->newslettercat_id = $newsLetterCatId;
        if( !is_numeric($tmp->find())) throw new Exception('Category does not exist');
        $this->newslettercat_id = $newsLetterCatId;

        return $this;
    }

    /**
     * Inserts this object or the one passed in.
     * @param: DataObjects_Anonymoususers_NewslettersCategories $do_anonUserNewsLetterCat an object to insert 
     * @return: insert result
     * @throws: Exception 'Subscription already setup' if it finds the subscription
     * @access public
     */
    function insertSubscription( $do_anonUserNewsLetterCat=null ){
        $sql = "INSERT INTO " . $this->__table . "(anonuser_id, newslettercat_id) VALUES ('%s', '%s')";

        if( $do_anonUserNewsLetterCat != null && ($do_anonUserNewsLetterCat instanceof DataObjects_Anonymoususers_NewslettersCategories) ){
            //Make sure the category exists
            $tmp = new DataObjects_Newsletters_Categories();
            $tmp->newslettercat_id = $do_anonUserNewsLetterCat->newslettercat_id;
            if( !is_numeric($tmp->find())) throw new Exception('Category does not exist');
            $sql = sprintf($sql, $do_anonUserNewsLetterCat->anonuser_id, $do_anonUserNewsLetterCat->newslettercat_id);
            $rtn = $do_anonUserNewsLetterCat->find(true);
            if( $rtn !== false && $rtn != 0 )
                throw new Exception('Subscription already setup');
        }else{
            //Make sure the category exists
            $tmp = new DataObjects_Newsletters_Categories();
            $tmp->newslettercat_id = $this->newslettercat_id;
            if( !is_numeric($tmp->find())) throw new Exception('Category does not exist');
            $sql = sprintf($sql, $this->anonuser_id, $this->newslettercat_id);
            $rtn = $this->find(true);
            if( $rtn !== false && $rtn != 0 )
                throw new Exception('Subscription already setup');
        }
        //echo 'insertSubscription sql= ' . $sql;
        $rtn = mysql_query( $sql );
        $this->anonusernewsletterscat_Id =  $this->getLastInsertId(); 
        $this->get();//fill the current obj with the just inserted subscription
        $this->fetch();
        return $rtn;
    }

    function getLastInsertId(){
        $result = mysql_query( 'SELECT last_insert_id() as id' );
        $result = mysql_fetch_assoc( $result );
        return $result['id'];
    }

    /**
     * Delete one or more subscriptions
     */
    function deleteSubscription( $anonUserId, $newsLetterCatId ){
        //TODO: implement
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
     * @return  mixed (number of rows returned, or true if numRows fetching is not supported). 
     * @throws Exception if email or anonuser_id is not set
     */
    function find( $n=false ){
        //$vars = get_object_vars($this); //Use this function to build a query based on fields that are filled in.
        if( $this->anonusernewsletterscat_Id != 0 )//Going from most specific to least
            $rtn = $this->get( $this->anonusernewsletterscat_Id );
        else if($this->anonuser_id != null && $this->newslettercat_id != null)
            $rtn = $this->get();
        else if($this->anonuser_id != null)
            $rtn = $this->get( 'anonuser_id', $this->anonuser_id );
        else if($this->newslettercat_id != null)
            $rtn = $this->get( 'newslettercat_id', $this->newslettercat_id);
        else
            throw new Exception('anonusernewsletterscat_Id or anonuser_id or newslettercat_id are not set.<br/>' . var_export($this, true));

        if( $n === true ){
            $this->fetch();
        }

        return $rtn; 
    }
    
    /**
     * fetches next row into this objects var's
     *
     * returns true on success false on failure
     **/
    function fetch(){
        $row = false;
        if( $this->result !== false &&  $this->result != null)
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
     * Gets a key $k with a value $v. Or uses the current objects members if no params are passed 
     * @param optional mixed string or id $k
     * @param optional $v is null and $k is an id then search is done by anonusernewsletterscat_Id = $k
     * return: number of rows if successful false otherwise
     * TODO: This function will have to be updated to accomodate differnt data types
     **/
    function get($k=null,$v=NULL) { 
        if(  $this->result )
            mysql_free_result( $this->result );
        $whereAry =  array();
        $sql = "SELECT * FROM " . $this->__table . " WHERE 1=1 ";

        if( $k == null){//no params sent
            if( $this->anonusernewsletterscat_Id != 0 )
                array_push( $whereAry, 'anonusernewsletterscat_Id = ' . $this->anonusernewsletterscat_Id );
            if( $this->anonuser_id != 0 )
                array_push( $whereAry, 'anonuser_id = ' . $this->anonuser_id );
            if ( $this->newslettercat_id != 0 )
                array_push( $whereAry, 'newslettercat_id = ' . $this->newslettercat_id );

        }else if($v == NULL){
            $v = $k;
            $k = 'anonusernewsletterscat_Id';
            array_push( $whereAry, $k . ' = ' . $v );
        }else{
            $k = strtolower( $k );
            array_push( $whereAry, $k . ' = ' . $v );
        }

        foreach( $whereAry as $var => $value ){
            $sql .= 'AND ' . $value;
        }
        $this->result = mysql_query($sql);
        if( $this->result !== false )
            return $this->n = mysql_num_rows( $this->result );
        return false;
    }

}

