<?PHP
    header('Content-type: text/csv');
    ini_set("auto_detect_line_endings", true);
    $FN_FILE = './data/CSV_Database_of_First_Names.csv';
    $LN_FILE = './data/CSV_Database_of_Last_Names.csv';
    $NUM_RECORDS = checkSet('recordcount',100,false);

    $FN_Array    = csvToArray( $FN_FILE );
    $FN_Array_Sz = count( $FN_Array );
    $LN_Array    = csvToArray( $LN_FILE );
    $LN_Array_Sz = count( $LN_Array );
    $output   = array();

    //CSV Header
    $output[] = array('Mother', 'DOB', 'Father', 'DOB', 'Son', 'DOB', 'Daughter', 'DOB');

    for($i=0; $i<$NUM_RECORDS; $i++){
        $surName = rand(1,$LN_Array_Sz-1);
        $output[] = array(
            //Mother
            $FN_Array[ rand(1,$FN_Array_Sz-1) ][0] . ' ' .  $LN_Array[ rand(1,$LN_Array_Sz-1) ][0],
            date("m/d/Y"),
            //Father
            $FN_Array[ rand(1,$FN_Array_Sz-1) ][0] . ' ' .  $LN_Array[ $surName ][0],
            date("m/d/Y"),
            //Son
            $FN_Array[ rand(1,$FN_Array_Sz-1) ][0] . ' ' .  $LN_Array[ $surName ][0],
            date("m/d/Y"),
            //Daughter
            $FN_Array[ rand(1,$FN_Array_Sz-1) ][0] . ' ' .  $LN_Array[ $surName ][0],
            date("m/d/Y")
        );
    } 
    str_putcsv( $output );
    echo implode( PHP_EOL, $output );

    function str_putcsv( &$array ){
        $arraySz = count( $array );
        for( $i=0; $i<$arraySz; $i++ ){
            $array[$i] = implode( ',', $array[$i] );
        }
        return $array;
    }

    function csvToArray( $fileName ){
        $array = array();
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $array[] = $data;
            }
            fclose($handle);
        }
        return $array;
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
?>
