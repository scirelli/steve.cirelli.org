<?php
/**
 * Table Definition for surveys
 */
require_once 'DB/DataObject.php';

class DataObjects_Surveys extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'surveys';             // table name
    public $survey_id;                       // int(4)  primary_key not_null unsigned
    public $surveyName;                      // char(200)   not_null

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Surveys',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
