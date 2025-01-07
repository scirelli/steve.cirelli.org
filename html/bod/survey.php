<?PHP require('setup.php'); ?>
<?PHP //Page is used to generate Surveys
if( !isset( $_REQUEST['surveyid'] )) $_REQUEST['surveyid'] = 1;
$_REQUEST['surveyid'] = intval($_REQUEST['surveyid']);
$survey = mysql_query("SELECT * FROM surveys WHERE survey_id = " . $_REQUEST['surveyid']);
$sql = "SELECT q.question_id, q.question, at.answerType FROM surveys s JOIN questions q on q.survey_id = s.survey_id JOIN answer_types at on q.answerType_id = at.answerType_id where s.survey_id = " . $_REQUEST['surveyid'];
$result = mysql_query($sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
?>
<page name="surveys">
    <surveys>
    <?PHP
    $row = mysql_fetch_assoc($survey);
    echo '<survey id="' . $row['survey_id'] . '" surveyName="'. $row['surveyName'] .'" action="forms.php?pg='. $row['action'] .'" formName="'. $row['formName'] .'">';
    echo '<message><![CDATA[' . $row['message'] . ']]></message>';
    while ($row = mysql_fetch_assoc($result)) {
        echo '<question id="' . $row['question_id'] .'" answerType="' . $row['answerType'] . '">';
        echo '<questionText><![CDATA[' . $row['question'] . ']]></questionText>';
        switch( $row['answerType'] ) 
        {
        case 'radio':
        case 'checkbox':
        case 'select multiple':
        case 'select':
            $sql = "SELECT * from answers where question_id = %d";
            $sql = sprintf($sql,$row['question_id']);
            $result2 = mysql_query($sql);
            if (!$result2) { die('Invalid query: ' . mysql_error()); }
            while( $subRow = mysql_fetch_assoc($result2)){
                echo '<answer type="'.  $row['answerType']  . '" id="' . $subRow['answer_id'] . '" groupby="' . $row['question_id'] .'" value="' . $subRow['answerValue'] . '"><![CDATA[' . $subRow['answerText'] . ']]></answer>';
            }
            mysql_free_result($result2);
            break;
        case 'text':
        case 'password':
        case 'submit':
        case 'textarea':
        default:
            echo '<answer type="'.  $row['answerType']  . '"/>';
        }
        echo '</question>';
    }
    echo '</survey>';
    ?>
    </surveys>
</page>

<?PHP
    // Free the resources associated with the result set
    // This is done automatically at the end of the script
    mysql_free_result($result);
    mysql_free_result($survey);
?>
