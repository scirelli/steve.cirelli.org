<?php
/**
 * Table Definition for html
 */
require_once 'DB/DataObject.php';

class DataObjects_Html extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'html';                // table name
    public $html_id;                         // int(4)  primary_key not_null unsigned
    public $htmlText;                        // text  
    public $name;                            // varchar(200)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Html',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
