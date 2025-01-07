<?PHP
    require('CSVPager.php');
    header('Content-type: application/json');

    $sFile      = checkSet('file','test.csv',false);
    $csvPager   = new CSVPager($sFile);
    //Datatables Variables 
    $iDisplayStart  = intval(checkSet('iDisplayStart', 0,false));
    $iDisplayLength = intval(checkSet('iDisplayLength',10,false));
    $iTotal         = $csvPager->numberOfLines();

    $bHeader    = checkSet('returnheader',false);
    $aOutput    = array(
		"sEcho"                => intval(checkSet('sEcho','',false)),
		"iTotalRecords"        => $iTotal,
		"iTotalDisplayRecords" => $iTotal,
		"aaData"               => array()
    );
    $bHeader = $bHeader == 'false' || $bHeader == '0' || $bHeader == '' || $bHeader == null ? false : true;

    $aOutput['aaData'] = $csvPager->getLines($iDisplayStart,$iDisplayLength,$bHeader);
    //$aOutput['iTotalDisplayRecords'] = count($aOutput['aaData']);
    echo json_encode($aOutput);

    function checkSet( $var, $default = '', $toLower=true){
        if( isset($_REQUEST[$var]) && $_REQUEST[$var] != '' ){
            if( $toLower === true ){
                return strtolower($_REQUEST[$var]);
            }else{
                return $_REQUEST[$var];
            }
        }
        return $default;
    }
?>
