"use strict";

;(function(){
    $(document).ready(function(){
        var $btn = $('#convert'),
            $clearbtn = $('#clear'),
            $namespace = $('#ffNameSpace'),
            $className = $('#ffClassName');

        $clearbtn.click(function(){
            var $input  = $('#input'),
                $output = $('#output'),
                $namespace = $('#ffNameSpace'),
                $className = $('#ffClassName'),
                $parentName = $('#ffParentName');
            $input.val('');
            $output.val('');
            $namespace.val('');
            $className.val('');
            $parentName.val('');
        });

        $btn.click(function(){
            var $input     = $('#input'),
                $output    = $('#output'),
                $namespace = $('#ffNameSpace'),
                $className = $('#ffClassName'),
                $parentName = $('#ffParentName'),
                sNameSpace = $namespace.val(),
                sClassName = $className.val(),
                sParentName = $parentName.val(),
                text       = $input.val(),
                tmp        = '',
                sClassDef  = '',
                sGettersSetters = '',
                json = true,
                indent = '    ';

            json = parseInt(window.location.searchObj.json) || false; 
            json = true;

            var getters = function( aItems ){
                    if( aItems instanceof Array === false ) return '';
                    var aRtn = new Array();
                    for( var i=0,l=aItems.length,itm='',sFnc='',sFncLine=''; i<l; i++ ){
                        itm = aItems[i];
                        sFnc = indent + 'get' + itm.toUpperCase().charAt(0) + itm.substr(1);
                        sFncLine = json ? sFnc + ':function(){\n' :'function ' + sFnc + '(){\n' ;
                        aRtn.push(
                            sFncLine + 	
                            indent + indent + 'return this.' + itm + ';\n' +
                            indent +'}'
                        );
                    }
                    return indent+'//Getters\n' + aRtn.join(',\n');
                },

                setters = function( aItems ){
                    if( aItems instanceof Array === false ) return '';
                    var aRtn = new Array();
                    for( var i=0,l=aItems.length,itm='',sFnc='',sFncLine=''; i<l; i++ ){
                        itm = aItems[i];
                        sFnc = indent + 'set' + itm.toUpperCase().charAt(0) + itm.substr(1);
                        sFncLine = json ? sFnc + ':function' + '( ' + itm + ' ){\n' : 'function ' + sFnc + '( ' + itm + ' ){\n';
                        aRtn.push(
                            sFncLine + 	
                            indent + indent + 'this.' + itm + ' = ' + itm +';\n' +
                            indent + '}'
                        );
                    }
                    return indent+'//Setters\n' + aRtn.join(',\n');
                },
                thises = function( aItems ){
                    if( aItems instanceof Array === false ) return '';
                    var aRtn = new Array();
                    for( var i=0,l=aItems.length,itm='',sFnc='',sFncLine=''; i<l; i++ ){
                        itm = aItems[i];
                        sFnc = indent + indent + 'this.set' + itm.toUpperCase().charAt(0) + itm.substr(1);
                        aRtn.push( sFnc + '( ' + itm +' );' );
                    }
                    return aRtn.join('\n');
                };

            text = text.replace(/[,\s]{2,}/g,' ');
            text = text.split(/[,\s]/);
            sGettersSetters = getters(text) + ',\n\n' + setters(text);
            sNameSpace = sNameSpace ? sNameSpace + '.' : '';
            sParentName = sParentName ? sParentName +',' : '';
            if( sClassName ){
                sClassDef = sNameSpace + sClassName + ' = Class.create(' + sParentName + '{\n' 
                            + indent + 'initialize:function( '+text.join(', ')+' ){\n'+
                                thises(text)
                            +'\n'+indent+'},\n\n'
                            + sGettersSetters
                            + '\n});';
            }else{
                sClassDef = sGettersSetters;
            }

            $output.val( sClassDef );
        });
   }); 
})();
