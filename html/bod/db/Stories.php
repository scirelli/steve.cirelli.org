<?php
/**
 * Table Definition for stories
 */
require_once 'DB/DataObject.php';

class DataObjects_Stories extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'stories';             // table name
    public $story_id;                        // int(4)  primary_key not_null unsigned
    public $story;                           // varchar(4000)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Stories',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
