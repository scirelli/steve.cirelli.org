$(document).ready(function(){
    var url = window.location.origin + window.location.pathname;
    if( url.lastIndexOf('/') != (url.length-1) ) url += '/';
    url += 'echo.php?msg=' + searchtoObj().msg;

    $.ajax({
        url: url, 
	dataType:'json',
        success:function( data, textStatus, jqXHR){
            $('#output').html( data.msg );
        },
        error:function(){
        }
    });
});
