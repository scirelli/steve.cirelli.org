$(document).ready(function(){
    function filterNL( text ){
        return text.replace(/[\n\r]/g,'<br/>');
    };
    function filter( text ){
        var NBSP  = '&nbsp;',
            sStr  = '',
            SPACE = ' ',
            TAB   = '\t',
            VTAB  = '\v',
            RTN   = '\n',
            LF    = '\f',
            tSz   = text.length;

        for( var i=0, l=tSz,c=null,sc=0,ss=''; i<l; i++ ){
            c = text.charAt(i);
            switch( c ){
                case SPACE:
                    sc++;
                    for(; ++i<l; ){
                        c = text.charAt(i);
                        if( c == SPACE ){
                            sc++;
                            ss+=NBSP;
                        }else{
                            break;
                        }
                    }
                    if( sc > 1 ){
                        c = ss+=NBSP;
                        i--;
                        sc=0;
                        ss='';
                        sStr += c;
                        break;
                    }else{
                        sStr += SPACE;
                        i--;
                        break;
                    }
                break;
                case TAB:
                case VTAB:
                    sStr += NBSP+NBSP+NBSP+NBSP; 
                    break;
                case RTN:
                case LF:
                    sStr += '<br/>'; 
                break;
                default:
                    sStr += c;
            }
        }
        return sStr;
    }
    function unFilter( text ){
        text = text.replace(/<br\/>|<br>/g,'\n');
        text = text.replace(/&nbsp;/g,' ');
        return text;
    }

    $('#do').click(function(e){
        var $text = $('#content'),
            text = $text.html();
        text = filter(text);
        $text.html(text);
    });
    $('#undo').click(function(e){
        var $text = $('#content'),
            text = $text.html();
        text = unFilter(text);
        $text.html(text);
    });
});
/*
    function filter( text ){
        var nbsp  = String.fromCharCode(160),//hex 0xA0
            NBSP  = '&nbsp;',
            sStr  = [],
            SPACE = ' ',
            TAB   = '\t',
            VTAB  = '\v',
            RTN   = '\n',
            LF    = '\f';
        
        for( var i=0, l=text.length,c=null,sc=0; i<l; i++ ){
            c = text.charAt(i);
            switch( c ){
                case SPACE:
                    sc++;
                    sStr.push(SPACE);
                break;
                case TAB:
                case VTAB:
                    sStr.push(NBSP+NBSP+NBSP+NBSP); 
                    sc = 0;
                    break;
                case RTN:
                case LF:
                    sStr.push('<br/>');
                    sc = 0;
                break;
                default:
                    sStr.push(c);
                    sc = 0;
            }

            if( sc == 2 ){
                sStr.pop();
                sStr.push(NBSP+NBSP);   
            }else if( sc > 2 ){
                sStr.pop();
                sStr.push(NBSP);   
            }
        }
        return sStr.join('');
    };
*/
