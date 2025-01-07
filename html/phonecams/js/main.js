if( cam === undefined ) var cam = new Object();

;(function(cam, $){
    $('#fForm').submit( function( evt ){
        var sURL = $('#ffURL').val();
        if( sURL )
            addFrame( sURL );
        evt.preventDefault();
        return false;
    });

    function addFrame( sURL ){
        var $span6 = $('.span6'),
            bFilled = false;
        
        for( var i=0,l=$span6.length,itm=null; i<l; i++ ){
            itm = $span6[i];
            if(itm.innerHTML == false){
                itm.innerHTML = '<iframe src="' + sURL + '"></iframe>';
                bFilled = true;
                break;
            }
        }
        if( bFilled == false ){
            var $cont = $('.container');
            $cont.append(' <div class="row"><div class="span6"></div><div class="span6"></div></div>');
            addFrame(sURL);
        }
    }
})(cam, jQuery);
