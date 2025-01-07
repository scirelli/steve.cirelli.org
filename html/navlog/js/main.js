$(document).ready(function(){
"use strict";

    //Insert new leg
    $('#addleg').click(function(e){
        $('.template').clone().removeClass('template').insertBefore('.footer-start');
    });
    $('#addleg').click();
    $('#addleg').click();
    $('#addleg').click();
    $('#addleg').click();

    $('.data').click(function(e){
        var $elm = $(this),
            $input = $('<input type="text" value=""/>');

        $input.width( $elm.width()-5 )
              .blur(function(e){
                   var $input = $(this);
                   $elm.html( $input.val() );
              });

        $elm.html('');
        $elm.append($input);
        $input.focus();
        console.log('clicked');
    });
});
