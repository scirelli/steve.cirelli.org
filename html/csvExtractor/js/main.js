"use strict";

;(function(){
    var dropZone = document.querySelector('.dropzone'),
        oOutput  = document.getElementById('output'),
        oRows    = document.getElementById('row'),
        oCols    = document.getElementById('col');
    
    dropZone.oOutput = oOutput;
    dropZone.oRows   = oRows;
    dropZone.oCols   = oCols;
    dropZone.addEventListener('dragover', function(evt){
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    });
    dropZone.addEventListener('drop', function(evt){
        evt.stopPropagation();
        evt.preventDefault();

        var files = evt.dataTransfer.files || [];// FileList object.

        if( !FileReader ) return;

        for( var i=0, l=files.length,itm=null,rdr=null; i<l; i++ ){
            itm = files[i];
            if( itm.type == 'application/vnd.ms-excel' || itm.type == 'text/plain' ){
                rdr = new FileReader();
                rdr.oOutput = this.oOutput;
                rdr.oRows   = this.oRows;
                rdr.oCols   = this.oCols;
                rdr.onload = function( oFREvent ){
                    var result = oFREvent.target.result,aOut=[],
                        nRows = parseInt(this.oRows.value),
                        nCols = parseInt(this.oCols.value);
                    if( result ){
                        result = result.trim();
                        result = result.split(/[\n\r]/);

                        for( var i=0, l=result.length; i<l; i++ ){
                            result[i] = result[i].split(',');
                        }
                        if( nRows >= 0 && nCols >= 0 ){ 
                            this.oOutput.value = result[nRows][nCols];
                        }else if( nRows >= 0 ){
                            this.oOutput.value = result[nRows];
                        }else if( nCols >= 0 ){
                            for( var i=0, l=result.length,itm=null; i<l; i++ ){
                                itm = result[i][nCols];
                                aOut.push(itm);
                            }
                            this.oOutput.value = aOut.join(',');
                        }else{
                            this.oOutput.value = oFREvent.target.result;
                        }
                    }
                }
                rdr.readAsText(itm);
            }
        }
    });
})();
