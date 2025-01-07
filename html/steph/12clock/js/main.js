!function(){
    'use strict';
    var oHours = document.querySelector('.hours'),
        oMins  = document.querySelector('.mins'),
        oSecs  = document.querySelector('.secs'),
        oMs    = document.querySelector('.ms');
    
    function displayTime(){
        setTimeout( function(){
            var oDate  = new Date(),
                nHours = oDate.getHours()%12,
                nMins  = oDate.getMinutes(),
                nSecs  = oDate.getSeconds(),
                nMs    = oDate.getMilliseconds();
            oHours.innerHTML = nHours == 0 ? 12 : nHours;
            oMins.innerHTML  = nMins < 10 ? '0' + nMins : nMins;
            oSecs.innerHTML  = nSecs < 10 ? '0' + nSecs : nSecs;
            if( nMs <= 999 && nMs >= 100 ){
                oMs.innerHTML    = '0' + nMs;
            }else if( nMs < 100 && nMs >= 10 ){
                oMs.innerHTML    = '00' + nMs;
            }else if( nMs < 10 ){
                oMs.innerHTML    =  '000' + nMs;
            }else{
                oMs.innerHTML    =  nMs;
            }
            displayTime();
        },10);
    }
    displayTime();
}();
