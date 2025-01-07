<?PHP
require('setup.php');
require('lib/common/GeneralResponse.php');
require('lib/common/GeneralResponseQ.php');
require('lib/common/XMLResponseQPrinter.php');


$output = new GeneralResponseQ();
//$output->pushMsg( new GeneralResponse('Something went wrong'), iResponseQ::MSG_TYPE_ERROR );
//$output->pushMsg(new GeneralResponse('Survey Submitted'), iResponseQ::MSG_TYPE_NORMAL);
$sql = null;
$answers = array();
$idList = null;

foreach($_REQUEST as $key => $value ){
    if( strpos($key, 'ffQ_') !== false){
        $id = explode('_', $key);
        $id = $id[1];

        if( is_numeric($id) ){
            $answers[$id] = $value;
            if($idList) $idList .= ',' . $id; else $idList = $id;
        }
    }
}

//$idList = implode(',',array_keys($answers));
$sql = 'SELECT question_id, answerType
        FROM questions q
          JOIN answer_types at ON q.answerType_id = at.answerType_id
        WHERE question_id in (' . $idList . ')';

$result = mysql_query( $sql );
if( $result !== false &&   ($count = mysql_num_rows($result)) > 0){
    //$count = mysql_fetch_row(mysql_query('SELECT FOUND_ROWS()'));//Maybe change this so it's not a separate query, or use the php result counting func
    //$count = $count[0];
    $sql = null;
    while( $row = mysql_fetch_assoc($result) ){
        $tmp = null;
        switch( $row['answerType'] ){
        case 'radio':
        case 'text':
            $tmp .= "(%s,'%s',NULL,NULL)";
            $tmp = sprintf($tmp, $row['question_id'],$answers[$row['question_id']]);
            break;
        default:
            $tmp = "('','','','','')";
        }
        if($sql) 
            $sql .= ", " . $tmp;
        else 
            $sql = $tmp;
    }
    if( $sql ){
        $sql =  'INSERT INTO users_answers (question_id,answerText,answerDate,answerNumeric) VALUES  ' . $sql;
        $result = mysql_query( $sql );
        if( $result === false ){
            $output->pushMsg( new GeneralResponse('Internal error occured. An administrator has been notified. 1'), iResponseQ::MSG_TYPE_ERROR );
        }else{
            $output->pushMsg(new GeneralResponse('Survey Submitted'), iResponseQ::MSG_TYPE_NORMAL);
        }
    }else{
        $output->pushMsg( new GeneralResponse('Internal error occured. An administrator has been notified. 2'), iResponseQ::MSG_TYPE_ERROR );
    }
}else{
    $output->pushMsg( new GeneralResponse('Internal error occured. An administrator has been notified. 3'), iResponseQ::MSG_TYPE_ERROR );
}
?>

<page name="act_survey">
    <?PHP
        echo '<surveyid><![CDATA[' . '' . ']]></surveyid>';
        $printer = new XMLResponseQPrinter($output);
        echo $printer->sprintXML();
    ?>
</page>
