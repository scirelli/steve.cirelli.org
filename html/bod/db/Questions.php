<?php
/**
 * Table Definition for questions
 */
require_once 'DB/DataObject.php';

class DataObjects_Questions extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'questions';           // table name
    public $question_id;                     // int(4)  primary_key not_null unsigned
    public $question;                        // varchar(500)   not_null
    public $type_id;                         // int(4)   not_null unsigned
    public $survey_id;                       // int(4)   not_null unsigned

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Questions',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
