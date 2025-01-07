<?php
/**
 * Table Definition for courses
 */
require_once 'DB/DataObject.php';

class DataObjects_Courses extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'courses';             // table name
    public $course_id;                       // int(4)  primary_key not_null unsigned
    public $padiLvl_id;                      // int(4)   not_null
    public $cost;                            // float   not_null
    public $duration;                        // float   not_null
    public $startDate;                       // date  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Courses',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
