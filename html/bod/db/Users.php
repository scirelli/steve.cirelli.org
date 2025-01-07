<?php
/**
 * Table Definition for users
 */
require_once 'DB/DataObject.php';

class DataObjects_Users extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'users';               // table name
    public $user_Id;                         // int(4)  primary_key not_null unsigned
    public $firstname;                       // char(200)   not_null
    public $lastname;                        // char(200)   not_null
    public $nickName;                        // char(200)  
    public $padiLevel_id;                    // int(4)   not_null unsigned
    public $joinDate;                        // date   default_1980-04-20
    public $address;                         // varchar(500)  
    public $primPhoneNumber;                 // char(11)  
    public $altPhone;                        // char(11)  
    public $city;                            // char(50)  
    public $state_id;                        // int(4)   not_null unsigned
    public $zip;                             // char(10)  
    public $image_id;                        // int(4)   not_null
    public $story_id;                        // int(4)   not_null unsigned

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Users',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
