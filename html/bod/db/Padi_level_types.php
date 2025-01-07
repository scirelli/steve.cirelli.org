<?php
/**
 * Table Definition for padi_level_types
 */
require_once 'DB/DataObject.php';

class DataObjects_Padi_level_types extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'padi_level_types';    // table name
    public $lvlType_id;                      // int(4)  primary_key not_null unsigned
    public $lvlTypes;                        // varchar(200)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Padi_level_types',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
