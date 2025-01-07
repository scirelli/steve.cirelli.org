/** *****************************************************************************************************
* Author: Steve Cirelli
* File Desc: 
* Requires:
******************************************************************************************************* */
if( scUtils === undefined ) { var scUtils = {}; }

(function(ns){
'use strict';
    var RADIUS    = 200;
    
    function init( div ){
        div._ix                   = div._x+((window.innerWidth/2)-div._halfImageWidth);
        div._iy                   = div._y+((window.innerHeight/2)-div._halfImageWidth);
        div._x                    = Math.rndRange( 0, window.innerWidth );
        div._y                    = Math.rndRange( 0, window.innerHeight );
        div._radius               = RADIUS;
        div._xRadius              = div._x - div._ix;
        div._yRadius              = div._y - div._iy;
        div.style.top             = div._y + 'px';
        div.style.left            = div._x + 'px';

        div.animate               = true;
        document.body.appendChild(div);
    }

    function anim(deferred){
        var p = this.oParticleImg.getParticles(),
            me = this;
        
        var angle = this.angleStep*Math.PI,
            cos   = Math.cos(angle),
            sin   = Math.sin(angle);
        for( var i=0,l=p.length,div=null; i<l; i++ ){
            div = p[i];

            div._x = div._ix + cos*(div._xRadius*this.cnt);
            div._y = div._iy + sin*(div._yRadius*this.cnt);
            div.style.top = div._y + 'px';
            div.style.left = div._x + 'px';
        }
        this.cnt   -= 0.005;
        this.angleStep += 0.01;
        if( this.cnt >= 0 ){
            this.timeID = setTimeout(function(){ anim.call(me, deferred); },10);
        }else{
            deferred.resolve('done');
        }
    }

    ns.RotateImage = function( sURL ){
        if( !sURL ) throw "RotateImage requires an image url.";
        this.oParticleImg = new scUtils.ParticlizeImage(sURL);

        this.cnt       = 2;
        this.angleStep = 0;
        this.timeID    = 0;

        scUtils.ParticlizeImage.attachCommonStyles();
        this.oParticleImg.register( this );
    }
    ns.RotateImage.prototype = {
        onInitParticle:function( oDiv ){
            init(oDiv);
        },
        init:function(){
            return this.oParticleImg.retrieveImageData();
        },
        remove:function(){
            this.oParticleImg.deleteImageDivs();
            return this;
        },
        start:function(){
            var me = this,
                deferred = Q.defer();
            this.cnt       = 2;
            this.angleStep = 0;
            this.init().then( function(){ anim.call(me, deferred); } ).done();
            return deferred.promise;
        }
    }
})(scUtils);
