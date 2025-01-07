<?php
/**
 * Table Definition for question_types
 */
require_once 'DB/DataObject.php';

class DataObjects_Question_types extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'question_types';      // table name
    public $type_id;                         // int(4)  primary_key not_null unsigned
    public $name;                            // char(50)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Question_types',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
