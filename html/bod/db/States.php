<?php
/**
 * Table Definition for states
 */
require_once 'DB/DataObject.php';

class DataObjects_States extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'states';              // table name
    public $state_id;                        // int(4)  primary_key not_null unsigned
    public $stateName;                       // varchar(50)   not_null
    public $abriv;                           // char(2)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_States',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
