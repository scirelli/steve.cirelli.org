/** *****************************************************************************************************
* Author: Steve Cirelli
* File Desc: 
* Requires: 
******************************************************************************************************* */
if( scUtils === undefined ) { var scUtils = {}; }

(function(ns){
'use strict';

    var IMAGE_PARTICLES_WIDE = 20;//Should be an even number.
    var IMAGE_PARTICLES_HIGH = 20;//Should be an even number.

    ns.ParticlizeImage = function( sImgURL, nRows, nCols ){
        this.setURL(sImgURL);
        this.setWidth(0);
        this.setHeight(0);
        this.setCenterX(0);
        this.setCenterY(0);

        this.aImgDivs = [];
        this.nImageRows = 0;//Based on particles
        this.nImageCols = 0;
        this.setImageRows(nRows || IMAGE_PARTICLES_WIDE);
        this.setImageCols(nCols || IMAGE_PARTICLES_HIGH);
        this.aListeners = [];
    };

    ns.ParticlizeImage.prototype = {
        setURL:function( sURL ){
            this.sURL = sURL;
            return this;
        },
        setCenterX:function(x){
            this.cx = x;
            return this;
        },
        setCenterY:function(y){
            this.cy = y;
            return this;
        },
        setWidth:function(nW){
            this.nWidth = parseInt(nW);
            return this;
        },
        setHeight:function( nH ){
            this.nHeight = parseInt(nH);
            return this;
        },

        getURL:function(){
            return this.sURL;
        },
        getWidth:function(){
            return this.nWidth;
        },
        getHeight:function(){
            return this.nHeight;
        },
        getParticles:function(){
            return this.aImgDivs;
        },

        retrieveImageData:function(){
            var oImg = document.createElement('img'),
                me   = this,
                deferred = Q.defer();
            oImg.addEventListener('load',function(e){
                me.setWidth(this.width);
                me.setHeight(this.height);
                deferred.resolve(me);
            });
            oImg.src = this.sURL;
            return deferred.promise.then(
                function(){
                    me.createImageDivs();
                    return true;
                },
                function(){
                    debugger;
                    return false;
                }
            );
        },

        //@private
        createImageDivs:function(){
            var aImgDivs = [],
                iw       = this.getWidth(),       //Image width
                ih       = this.getHeight(),      //Image height
                iw2      = iw/2,                  //half the image width
                ih2      = ih/2,                  //half the image height
                rows     = this.getImageRowsCnt(),//Number of rows in this image's grid
                cols     = this.getImageColsCnt(),//Number of columns in this image's grid
                pw       = iw/cols,               //particle width
                ph       = ih/rows,               //particle height
                pw2      = (pw*cols)/2,           //half the particle width
                ph2      = (ph*rows)/2;           //half the particle height
            
            this.cx = this.cx || iw2;
            this.cy = this.cy || 0;

            //"Break" the image up
            for( var col=0;  col<cols; col++ ){
                for( var row=0,oDiv=null,x=0,y=0; row<rows; row++ ){
                    oDiv = document.createElement('div');
                    x    = col*pw;
                    y    = row*ph;

                    oDiv._imageWidth               = iw;
                    oDiv._imageHeight              = ih;
                    oDiv._halfImageWidth           = iw2;
                    oDiv._halfImageHeight          = ih2;
                    oDiv._pw                       = pw;
                    oDiv._ph                       = ph;
                    oDiv._x                        = (x-pw2)+this.cx;
                    oDiv._y                        = (y)+this.cy;
                    oDiv._opacity                  = 1;
                    oDiv.style.backgroundImage     = 'url(' + this.getURL() + ')';
                    oDiv.style.left                = oDiv._x + 'px';
                    oDiv.style.top                 = oDiv._y + 'px';
                    oDiv.style.width               = Math.ceil(pw) + 'px';
                    oDiv.style.height              = Math.ceil(ph) + 'px';
                    oDiv.style.opacity             = 1;
                    oDiv.style.backgroundPosition  = -x + 'px ' + -y + 'px';
                    oDiv.classList.add('image-frag');
                    
                    this.notifyInit(oDiv);

                    aImgDivs.push(oDiv);
                }
            }

            this.aImgDivs = aImgDivs;
        },
         
        notifyInit:function(oDiv){
            for( var i=0, l=this.aListeners.length; i<l; i++ ){
                this.aListeners[i].onInitParticle(oDiv);
            }
        },
        register:function( oListener ){
            if( oListener && oListener.onInitParticle ){
                this.aListeners.push(oListener);
            }
        },
        unregister:function( oListener ){
            var id = this.aListeners.indexOf(oListener);
            if( id >= 0 ){
                this.aListeners.splice(i,1);
            }
        },

        getParticleCount:function(){
            return this.aImgDivs;
        },
        getImageRowsCnt:function(){
            return this.nImageRows;
        },
        getImageColsCnt:function(){
             return this.nImageCols;
        },
        setImageRows:function( nRows ){
            this.nImageRows = parseInt(nRows);
            return this;
        },
        setImageCols:function( nCols ){
            this.nImageCols = parseInt(nCols);
            return this;
        },
        //@private
        indexIntoArray:function( row, col, totalCols ){
            return row*totalCols + col;
        },
        //@public
        deleteImageDivs:function(){
            for( var i=0,l=this.aImgDivs.length; i<l; i++ ){
                this.aImgDivs[i].remove();
            }
        }
    };

    ns.ParticlizeImage.IListener = function(){}
    ns.ParticlizeImage.IListener.prototype = {
        onInitParticle:function( oParticleDiv ){}
    }

    //@public static
    ns.ParticlizeImage.attachCommonStyles = function(){
        if( document.getElementById('image-frag') ) return;
        var style = document.createElement('style');
        style.type = 'text/css';
        style.id   = 'image-frag';
        style.innerHTML = '.image-frag{ background-color:white; background-repeat:no-repeat; background-size:auto; background-position:0 0; display:block; position:fixed; margin:0; padding:0; opacity:1;}';
        document.head.appendChild(style);
    };
})(scUtils);
