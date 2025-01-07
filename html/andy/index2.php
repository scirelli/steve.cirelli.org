<?PHP
    require('CSVPager.php');
    $sFile      = checkSet('file','test.csv',false);
    $csvPager   = new CSVPager($sFile);
    $nLineCount = $csvPager->numberOfLines();
    $nPageSize  = 10;
    $nPageCount = $nLineCount/$nPageSize;
    $aLines     = array();
    $output     = '';

    for( $i=0;$i<$nPageCount; $i++ ){
        $output .= printPage( $i, nextPage($csvPager, $i, $nPageSize ) );
    }
    
    //$output .= printPage( 7, nextPage($csvPager, 7, $nPageSize ) );
    function printPage( $nPageNumber, $aLines ){
        return '<div>Page: '.$nPageNumber.'</div><div><pre>' . var_export($aLines,true) . '</pre></div>';
    }

    function nextPage( $csvPager, $nCurPage, $nPageSize ){
        $aLines = $csvPager->getLines($nCurPage*$nPageSize,$nPageSize,false);
        return $aLines;
    }
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
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CSV Example</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <style>
            div{
                margin-bottom:10px;
                padding:5px;
                border:3px solid black;
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        
        <?PHP echo $output; ?>

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.csvToTable.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
            $(document).ready(function() { 
                //$('#myForm').submit(function() { 
                    //var file = 'relationships.csv.php',
                        //$ffRecordCount = $('#ffRecordCount'),
                        //data = {recordcount:$ffRecordCount.val()};
                    //$('#myTableContainer').CSVToTable(file,{ data:data, tableClass:'tableClass CSVTable', tdClass:'tdClass', thClass:'thClass', trClass:'trClass' });
                    //return false;
                //}); 
            }); 
        </script>
    </body>
</html>
