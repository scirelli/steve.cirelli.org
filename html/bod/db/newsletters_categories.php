<?php
/**
 * Table Definition for Newsletters_Categories
 * Desc: Class for managing the bridge table Anonymoususers_NewslettersCategories 
 */
class DataObjects_Newsletters_Categories
{
    public $__table = 'Newsletters_Categories'; // table name
    public $newslettercat_id;                   // int(4)  primary_key not_null unsigned
    public $category;                           // int(4)  not_null unsigned
    public $htmlNote_id;                        // int(4)  not_null unsigned

    private $n;           // number of rows
    private $result;      //Result from find.

    /**
     * Constructor:
     * @param string $category 
     * @throw Exception 'Category already exists'
     */
    function __construct( $category=null){
        if( $category != null){
            if( $this->createCategory($category) === false )
                throw new Exception('Category already exists');
        }else{
            $this->newslettercat_id = 0;
            $this->category          = null;
            $this->htmlNote_id       = 0;
        }
    }

    //function __clone(){
    //}

    /**
     * Creates a category
     * Desc: 
     * @param: string $category
     * @param: int $html_id an id into the html table
     * @return: $this or false if the category already exists
     * @throw: 
     * @acces: public
     **/ 
    function createCategory( $category, $html_id=0){
        $this->category = $category;

        if( $this->find(true) ){//The category already exists
            return false;//can't create it
        }
        if( $html_id=intval($html_id) ){//handle the html_id check to see if it exists.
            $this->htmlNote_id = $html_id;
        }

        //There is no category
        if(  $this->result )
            mysql_free_result($this->result);
        $this->result = null;
        $this->category = $category;

        return $this;
    }

    /**
     * Inserts this object or the one passed in.
     * @param:  DataObjects_Newsletters_Categories $do_anonUserNewsLetterCat an object to insert 
     * @return: insert result
     * @throws: Exception 'Category already exists' if it finds the subscription
     * @access public
     */
    function insertCategory( $do_newsletterCat=null ){
        $sql = "INSERT INTO " . $this->__table . "(category, htmlNote_id) VALUES ('%s', '%s')";

        if( $do_newsletterCat != null && ($do_newsletterCat instanceof DataObjects_Newsletters_Categories ) ){
            $sql = sprintf($sql, $do_newsletterCat->category, intval($do_newsletterCat->htmlNote_id)); //TODO: need to make sure this htmlNote exists.
            $rtn = $do_newsletterCat->find(true);
            if( $rtn !== false && $rtn != 0 )
                throw new Exception('Category already Exists');
        }else{
            $sql = sprintf($sql, $this->category, $this->htmlNote_id); //TODO: need to make sure this category exists.
            $rtn = $this->find(true);
            if( $rtn !== false && $rtn != 0 )
                throw new Exception('Category already exists');
        }

        $rtn = mysql_query( $sql );
        $this->newslettercat_id =  $this->getLastInsertId(); 
        $this->get();//fill the current obj with the just inserted category 
        $this->fetch();
        return $rtn;
    }

    function getLastInsertId(){
        $result = mysql_query( 'SELECT last_insert_id() as id' );//would there be some kind of race condition with this?
        $result = mysql_fetch_assoc( $result );
        return $result['id'];
    }

    /**
     * Delete one or more categories
     */
    function deleteCategory( $newslettercat_id ){
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
        if( is_numeric($this->newslettercat_id) && $this->newslettercat_id != 0 )//Going from most specific to least
            $rtn = $this->get( $this->newslettercat_id );
        else if( $this->category != null )
            $rtn = $this->get( 'category', $this->category );
        else
            throw new Exception('Either newslettercat_id or category are not set.' . var_export($this, true));

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
     * Gets a key $k with a value $v. 
     * @param string or int $k column name if $v is set or an id
     * @param mixed value of the column to search for. default null
     * If $v is null then search is done by anonuser_id = $k
     * return: number of rows if successful false otherwise
     * TODO: This function will have to be updated to accomodate differnt data types
     **/
    function get($k,$v=NULL) { 
        if(  $this->result )
            mysql_free_result( $this->result );
        $sql = "SELECT * FROM " . $this->__table . " WHERE %s = '%s'";

        if($v == NULL){
            $v = $k;
            $k = 'newslettercat_id';
        }else{
            $k = strtolower( $k );
        }

        $sql = sprintf($sql, $k, $v);
        $this->result = mysql_query($sql);

        $this->result = mysql_query($sql);
        if( $this->result !== false )
            return $this->n = mysql_num_rows( $this->result );
        return false;
    }
}


