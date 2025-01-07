"use strict";

$j(document).ready(function(){
    snakes.url = window.location.origin + window.location.pathname;
    if( snakes.url.lastIndexOf('/') != (snakes.url.length-1) ) snakes.url += '/';
    
    snakes.nIntervalID = 0;
    snakes.bRunning = false;
    snakes.nScore = 0;
    snakes.nMaxScore = 0;
    snakes.elScore = document.getElementById('score');
    snakes.elMaxScore = document.getElementById('maxscore');

    snakes.oBlock = {
        width:50,
        height:25,
        types:{
            NONE:0,
            SNAKE:1,
            MOUSE:2,
            SNAKE_HEAD:3,
            '0':'',
            '1':'snake',
            '2':'mouse',
            '3':'snake_head',
            'none':'',
            'snake':'snake',
            'mouse':'mouse',
            'snake_head':'snake head'
        }
    };
    snakes.oBoard = {
        width     :800,
        height    :400,
        units     :'px',
        bkColor   :'#000',
        aDspBlocks: new Array(),
        aBlocks   : new Array(),
        aChanges  : new Array(),
        aMice     : new Array()
    };
    snakes.oBlock.nBlockW = snakes.oBoard.width/snakes.oBlock.width;
    snakes.oBlock.nBlockH = snakes.oBoard.height/snakes.oBlock.height;
    
    snakes.oDirection = {
        UP:[0,-1],
        DOWN:[0,1],
        LEFT:[-1,0],
        RIGHT:[1,0]
    };
        
    snakes.oSnake = {
        aDir       :snakes.oDirection.RIGHT,
        aSnake     : new Array(),
        initLength : 3,
        nSpeed     : 1000,//ms
        nSpeedInc  : 100, //ms
        nCurSpeed  : 1000,
        MAX_SPEED  : 50,
        nCurStep   : 1,
        SPEED_STEPS: 1
    };

    function changeBlock( x, y, type ){
        var pos = x + y*snakes.oBlock.width,
            types = snakes.oBlock.types,
            block = {};
        snakes.oBoard.aBlocks[ pos ] = type;
        block = { pos:pos, type:snakes.oBlock.types[type], x:x, y:y };
        snakes.oBoard.aChanges.push(block);
        return block;
    }
    
    function addMouse(){
        snakes.oBoard.aMice.push( changeBlock(Math.floor(Math.rndRange(0,snakes.oBlock.width)),Math.floor(Math.rndRange(0,snakes.oBlock.height)), snakes.oBlock.types.MOUSE) );
    };

    function collisionCheck( o1, o2 ){
        return o1.x == o2.x && o1.y == o2.y;
    };

    function snakeColids( ){
        var aSnake   = snakes.oSnake.aSnake,
            head     = aSnake[aSnake.length-1],
            colids   = false;
        for( var i=0,l=aSnake.length-1,itm=null; i<l; i++ ){
            itm = aSnake[i];
            colids = colids || collisionCheck(itm,head);
        }
        return colids;
    };

    function isInBounds( o1 ){
        return o1.x >= 0 && o1.x <= (snakes.oBlock.width-1) && o1.y >= 0 && o1.y <= (snakes.oBlock.height-1);
    };

    function mouseEaten(){
        var aMice  = snakes.oBoard.aMice,
            aSnake = snakes.oSnake.aSnake,
            head   = aSnake[aSnake.length-1],
            colids = false;
        for( var i=0,l=aMice.length,itm=null; i<l; i++ ){
            itm = aMice[i];
            if( collisionCheck(itm,head) ){
                aMice.splice(i,1);
                return itm
            }
        }
        return false;
    };

    function stop(){
        snakes.bRunning = false;
        clearTimeout(snakes.nIntervalID);
    };

    function end(){
        stop();
        snakes.nMaxScore = snakes.nScore > snakes.nMaxScore ? snakes.nScore : snakes.nMaxScore;
        localStorage.nMaxScore = snakes.nMaxScore;
    };

    function increaseSpeed(){
        //snakes.oSnake.nCurSpeed = (snakes.oSnake.nCurSpeed - (snakes.oSnake.nCurStep*snakes.oSnake.nCurStep)) + snakes.oSnake.MAX_SPEED;
        //snakes.oSnake.nCurSpeed = snakes.oSnake.nSpeed - ((snakes.oSnake.nCurStep+1)/snakes.oSnake.nCurStep) + snakes.oSnake.MAX_SPEED;// x+1/x
        snakes.oSnake.nCurSpeed *= 0.7;
        if( snakes.oSnake.nCurSpeed <= snakes.oSnake.MAX_SPEED ){
            snakes.oSnake.nCurSpeed = snakes.oSnake.MAX_SPEED; 
        }
        snakes.oSnake.nCurStep+=snakes.oSnake.SPEED_STEPS;
    };

    function incrementScore( ){
        return ++snakes.nScore;
    };

    function moveSnake(){
        var aSnake   = snakes.oSnake.aSnake,
            head     = aSnake[aSnake.length-1],
            prevHead = aSnake[aSnake.length-1],
            aDir     = snakes.oSnake.aDir,
            oldPeice = aSnake[0],
            newPos   = { x:head.x+aDir[0], y:head.y+aDir[1] },
            newPeice = null;
        
        if( isInBounds(newPos) ){
            newPeice = changeBlock( newPos.x, newPos.y, snakes.oBlock.types.SNAKE_HEAD );
            aSnake.push(newPeice);
            changeBlock( prevHead.x, prevHead.y, snakes.oBlock.types.SNAKE );
            //colids with self
            if( snakeColids() ){
                end();
            }
            //Check if mouse was eaten
            if( mouseEaten() ){
                addMouse();
                increaseSpeed();
                snakes.elScore.value = incrementScore();
                snakes.oSnake.aSnake.splice(0,1,oldPeice);
                changeBlock( oldPeice.x, oldPeice.y, snakes.oBlock.types.SNAKE);
            }else{
                oldPeice = aSnake.shift();
                changeBlock( oldPeice.x, oldPeice.y, snakes.oBlock.types.NONE );
            }
        }else{
            end();
        }

        return oldPeice;
    };

    function draw(){
        var aChanges = snakes.oBoard.aChanges,
            aDspBlocks = snakes.oBoard.aDspBlocks;
        for( var i=0,l=aChanges.length,itm=null,block=null; i<l; i++ ){
            itm   = aChanges[i];
            block = aDspBlocks[ itm.pos ];
            block.className = 'block ' + snakes.oBlock.types[itm.type];
        }
        //clear changes;
        snakes.oBlock.aChanges = new Array();
    };

    function init(){
        var $container = document.querySelector('.snakes');
        snakes.nMaxScore = localStorage.nMaxScore || 0;
        snakes.elMaxScore.value = snakes.nMaxScore;

        $container.style.width           = snakes.oBoard.width+snakes.oBoard.units;
        $container.style.height          = snakes.oBoard.height+snakes.oBoard.units;
        $container.style.backgroundColor = snakes.oBoard.bkColor;
        $container.style.border = '5px outset #C6C6C6';

        for( var h=0,l=snakes.oBlock.height; h<l; h++ ){
            for( var w=0,wl=snakes.oBlock.width,itm=null; w<wl; w++ ){
                itm              = document.createElement('div');
                itm.className    = 'block';
                itm.style.width  = snakes.oBlock.nBlockW + snakes.oBoard.units;
                itm.style.height = snakes.oBlock.nBlockH + snakes.oBoard.units;
                itm.style.top    = (snakes.oBlock.nBlockH * h + $container.cumulativeOffset().top + parseInt($container.style.borderTopWidth)) + snakes.oBoard.units;
                itm.style.left   = (snakes.oBlock.nBlockW * w + $container.cumulativeOffset().left + parseInt($container.style.borderLeftWidth)) + snakes.oBoard.units;
                //itm.style.backgroundColor = 'rgb('+ Math.round(Math.rndRange(100,256)) +','+ Math.round(Math.rndRange(100,256)) +',' + Math.round(Math.rndRange(100,256)) +')';
                snakes.oBoard.aDspBlocks.push(itm);
                snakes.oBoard.aBlocks.push(0);
                $container.appendChild(itm);
            }
        }

        for( var i=0,l=snakes.oSnake.initLength; i<l; i++ ){
            snakes.oSnake.aSnake.push( changeBlock(i,0,'SNAKE') );
        }
        addMouse();
        addMouse();
    };

    //Add event listenters
    document.addEventListener('keydown',function(evt){
        switch( evt.keyCode ){
            case Event.KEY_UP:
                if(snakes.oSnake.aDir != snakes.oDirection.DOWN )
                    snakes.oSnake.aDir = snakes.oDirection.UP;
                break;
            case Event.KEY_DOWN:
                if( snakes.oSnake.aDir != snakes.oDirection.UP )
                    snakes.oSnake.aDir = snakes.oDirection.DOWN;
                break;
            case Event.KEY_LEFT:
                if( snakes.oSnake.aDir != snakes.oDirection.RIGHT )
                    snakes.oSnake.aDir = snakes.oDirection.LEFT;
                break;
            case Event.KEY_RIGHT:
                if( snakes.oSnake.aDir != snakes.oDirection.LEFT )
                    snakes.oSnake.aDir = snakes.oDirection.RIGHT;
                break;
        }
    });

    init();
    draw();

    function play(){
        if( snakes.bRunning ){
            snakes.nIntervalID = setTimeout(function(){
                moveSnake();
                draw();
                play();
            },snakes.oSnake.nCurSpeed);
        }
    }
    snakes.bRunning = true;
    play();
});
