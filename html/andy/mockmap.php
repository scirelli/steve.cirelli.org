<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mockup Map</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
	<div>
		<form id="mapform" method="POST" action="">
			<input type="hidden" id="mapdata" name="mapdata" value=""/>
			<textarea id="ex" name="ex" value=""></textarea>
		</form>
	</div>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
            $(document).ready(function(){ 
		$('#mapdata').change(function(e){
			$('#ex').val( $('#mapdata').val() );
			alert('');
		});
		$('#ex').val( JSON.stringify(top.localStorage) );
            }); 
        </script>
    </body>
</html>

