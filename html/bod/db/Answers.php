<?php
/**
 * Table Definition for answers
 */
require_once 'DB/DataObject.php';

class DataObjects_Answers extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'answers';             // table name
    public $answer_id;                       // int(4)  primary_key not_null unsigned
    public $answerText;                      // varchar(500)  
    public $answerDate;                      // date  
    public $answerNumeric;                   // int(4)  
    public $question_id;                     // int(4)   not_null unsigned

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Answers',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
