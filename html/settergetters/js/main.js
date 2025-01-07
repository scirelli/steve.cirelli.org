"use strict";

;(function(){
    $(document).ready(function(){
        var $btn = $('#convert'),
            $clearbtn = $('#clear');
        $clearbtn.click(function(){
            var $input  = $('#input'),
                $output = $('#output');
            $input.val('');
            $output.val('');
        });
        $btn.click(function(){
            var $input  = $('#input'),
                $output = $('#output'),
                text    = $input.val(),
		json    = parseInt(window.location.searchObj.json) || false; 
        json = json == 1 ? true : false;
            var getters = function( aItems ){
                    if( aItems instanceof Array === false ) return '';
                    var aRtn = new Array();
                    for( var i=0,l=aItems.length,itm='',sFnc='',sFncLine=''; i<l; i++ ){
                        itm = aItems[i];
                        sFnc = 'get' + itm.toUpperCase().charAt(0) + itm.substr(1);
			sFncLine = json ? sFnc + ':function(){\n' :'function ' + sFnc + '(){\n' ;
                        aRtn.push(
			    sFncLine + 	
                            '    return this.' + itm + ';\n' +
                            '}'
                        );
                    }
                    return json ? aRtn.join(',\n') : aRtn.join('\n');
                },
                setters = function( aItems ){
                    if( aItems instanceof Array === false ) return '';
                    var aRtn = new Array();
                    for( var i=0,l=aItems.length,itm='',sFnc='',sFncLine=''; i<l; i++ ){
                        itm = aItems[i];
                        sFnc = 'set' + itm.toUpperCase().charAt(0) + itm.substr(1);
			sFncLine = json ? sFnc + ':function' + '( ' + itm + ' ){\n' : 'function ' + sFnc + '( ' + itm + ' ){\n';
                        aRtn.push(
			    sFncLine + 	
                            '    this.' + itm + ' = ' + itm +';\n' +
                            '}'
                        );
                    }
                    return json ? aRtn.join(',\n') : aRtn.join('\n');
                };
            text = text.replace(/[,\s]{2,}/g,' ');
            text = text.split(/[,\s]/);
            $output.val( getters(text) + '\n\n' + setters(text) );
        });
   }); 
})();
