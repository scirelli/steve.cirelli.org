"use strict";//Just don't cross the streams!!

//------------------------------------------------
// Searches the object to see if it contains a value
// that contains the passed in string.
// @param: needle {String}; the string to search for
// @param: hayStack {Object}; the thing to search
//------------------------------------------------
/* Ext doesn't like this. When it does it's search of objects it think's it's a property and appends it to everything.
Object.prototype.objectContainsString = function( needle, hayStack ){
    if( needle === '') return true;
    
    if( hayStack === undefined ) hayStack = this;

    if( hayStack instanceof String || typeof(hayStack) == 'string' ){
        if( hayStack.search(new RegExp(needle, 'i')) != -1 ) return true;
    }else if( hayStack instanceof Number || typeof(hayStack) == 'number' ){
        if( hayStack.toString().search(new RegExp(needle, 'i')) != -1 ) return true;
    }else if( hayStack instanceof Object ){
        for( var field in hayStack ){
            if( hayStack.hasOwnProperty(field) ){
                var value = hayStack[field];
                if( objectContainsString( needle, value ) ) return true;//change this to this.objectContainsString()
            }
        }
    }

    return false;
}
*/

//------------------------------------------------
// Searches the object to see if it contains a value
// that contains the passed in string.
// @param: needle {String}; the string to search for
// @param: hayStack {Object}; the thing to search
//------------------------------------------------
function objectContainsString( needle, hayStack ){
    if( needle === '') return true;

    if( hayStack instanceof String || typeof(hayStack) == 'string' ){
        if( hayStack.search(new RegExp(needle, 'i')) != -1 ) return true;
    }else if( hayStack instanceof Number || typeof(hayStack) == 'number' ){
        if( hayStack.toString().search(new RegExp(needle, 'i')) != -1 ) return true;
    }else if( hayStack instanceof Object ){
        for( var field in hayStack ){
            if( hayStack.hasOwnProperty(field) ){
                var value = hayStack[field];
                if( objectContainsString( needle, value ) ) return true;
            }
        }
    }

    return false;
}
