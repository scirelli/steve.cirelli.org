!function(){
    'use strict';
    var oHours = document.querySelector('.clock .hours'),
        oMins  = document.querySelector('.clock .mins'),
        oSecs  = document.querySelector('.clock .secs'),
        oMHours = document.querySelector('.clock.mirror .hours'),
        oMMins  = document.querySelector('.clock.mirror .mins'),
        oMSecs  = document.querySelector('.clock.mirror .secs');
    
    function displayTime( oHours, oMins, oSecs ){
        setTimeout( function(){
            var oDate  = new Date(),
                nHours = oDate.getHours()%12,
                nMins  = oDate.getMinutes(),
                nSecs  = oDate.getSeconds();
                
            oHours.innerHTML = nHours == 0 ? 12 : nHours;
            oMins.innerHTML  = nMins < 10 ? '0' + nMins : nMins;
            oSecs.innerHTML  = nSecs < 10 ? '0' + nSecs : nSecs;
            displayTime( oHours, oMins, oSecs );
        },500);
    }
    displayTime( oHours, oMins, oSecs );
    displayTime( oMHours, oMMins, oMSecs );
}();
