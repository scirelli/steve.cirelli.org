<?PHP 
    $id = $_GET['id'];
    if( isset($id) ){
        $response = file_get_contents('bots/' . $id . '_like.log' );
        if( $response !== false ){
            $response = '[' . str_replace("}\n{",'},{',str_replace('}{','},{',rtrim($response,','))) . ']';
        }else{
            $response = '[]';
        }
    }else{
        $response = '[]';
    }
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tinder Bot Logs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <style>
            .image{
                display:inline;
            }
            .image img{
                display:inline;
            }
        </style>

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container" style="margin-top:30px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <a name="top" href="#"></a>
                        <h4>Liked</h4>
                        <div id="loglist">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script type="text/javascript">
            var aLogs = <?PHP echo $response; ?>;
            var id    = '<?PHP echo $id; ?>';
            var eList = document.getElementById('loglist');
            var sTmpl = '<a href="%s"><img src="%s" height="100px" width="100px" title="%t"/></a>'
            console.log( aLogs );

            if( aLogs && aLogs.length ){
                for(var i=0,l=aLogs.length,itm,li=null,name='',img=''; i<l; i++ ){
                    itm = aLogs[i];
                    li = createElement(itm);
                    if(li) eList.appendChild(li);
                }
            }
            function createElement( itm ){
                if( itm.name ){
                    name = itm.name;
                }else{
                    name = '';
                }
                if( itm.imgs && itm.imgs.length ){
                    img = itm.imgs[0];
                }else{
                    img = '';
                }
                if( name && img ){
                    li = document.createElement('div');
                    li.className = 'image';
                    li.innerHTML = sTmpl.replace('%s', img).replace('%s', img).replace('%t',name);
                    return li;
                }
                return false;
            }
            function cleanLog(str){
                return str.replace(/}\s*{/g,'},{').replace(/,$/,'');
            }
            function makeRequest(id){
                var xhttp = new XMLHttpRequest();
                xhttp.open('GET','https://scirelli.com/tinderbot/bots/'+id+'_like.log');
                xhttp.onreadystatechange = function(){
                    if( xhttp.readyState==4 && xhttp.status==200){
                        var str = '['+ cleanLog(xhttp.responseText) +']';
                        try{
                            var a = JSON.parse(str);
                            for( var i=aLogs.length-1,l=a.length,itm,li; i<l; i++ ){
                                itm = a[i];
                                aLogs.push(itm);
                                li = createElement(itm);
                                if(li) eList.appendChild(li);
                            }
                        }catch(e){}
                    }
                };
                xhttp.send();
            }
            setInterval( function(){ makeRequest(id); }, 15*60*1000 );
        </script>
    </body>
</html>
