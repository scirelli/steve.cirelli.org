<?php
/**
 * Table Definition for images
 */
require_once 'DB/DataObject.php';

class DataObjects_Images extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'images';              // table name
    public $image_id;                        // int(4)  primary_key not_null unsigned
    public $fileName;                        // char(255)   not_null
    public $filePath;                        // varchar(500)   default_%2Fimages%2F
    public $caption;                         // char(255)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Images',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
