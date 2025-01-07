<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Datatables Example</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <style type="text/css" title="currentStyle">
            @import "js/DataTables-1.9.4/media/css/demo_page.css";
            @import "js/DataTables-1.9.4/media/css/demo_table.css";
        </style>
        <style>
            #tableContainer{
                width:750px;
                margin-left:auto;
                margin-right:auto;
            }
        </style>
    </head>
    <body>
        <div id="tableContainer">
            <table id="example">
                <thead>
                    <tr>
                        <th>Mother</th>
                        <th>DOB</th>
                        <th>Father</th>
                        <th>DOB</th>
                        <th>Son</th>
                        <th>DOB</th>
                        <th>Daughter</th>
                        <th>DOB</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() { 
                //$('#myForm').submit(function() { 
                    //var file = 'relationships.csv.php',
                        //$ffRecordCount = $('#ffRecordCount'),
                        //data = {recordcount:$ffRecordCount.val()};
                    //$('#myTableContainer').CSVToTable(file,{ data:data, tableClass:'tableClass CSVTable', tdClass:'tdClass', thClass:'thClass', trClass:'trClass' });
                    //return false;
                //}); 
            $('#example').dataTable( {
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "getPage.php",
                    "fnServerParams": function ( aoData ) {
                          aoData.push( { "file": "test.csv" } );
                    },
                    bFilter:false,
                    bSort:false
                } );
            }); 
        </script>
    </body>
</html>

