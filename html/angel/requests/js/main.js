/*
 * Worker
 * 
 * usage: 
 * var worker = new Worker()
 * worker.newJob(['word1', 'word2'], function(results) {
 *   console.log('done', results) 
 * })
 */


var Worker = function(){
  var context = this,
      _returnList = [],
      _count,
      _callback;

    function handleRequest(word, i){
        //should have access to context but just in case
        var me = context;

        return function(data, status, xhr) {
            //check for error

            _returnList.push({
                word: word,
                xhr: xhr,
                data: data
            });

            //not sure about this way of doing it but it might work
            if(i === _count - 1) {
                _callback(_returnList);
            }
        }
    }

    return $.extend({
        newJob: function(list, callback) {
            _count = list.length;
            _callback = callback;

            var word;
            var url = window.location.href;
            if( url.lastIndexOf('/') != (url.length-1) ) url += '/';
            url += 'echo.php?word='
            for(var i = 0; i < list.length; i++){
                word = list[i];  

                $.ajax({
                    url: url + word,
                    success: handleRequest(word, i),
                    error: handleRequest(word, i)
                });
            }
        } 
    });
}

var w = new Worker();
w.newJob( ['is','this','working'], function( list ){
    var s = $('#output').html();
    s += JSON.stringify(list);
    $('#output').html(s);
});
