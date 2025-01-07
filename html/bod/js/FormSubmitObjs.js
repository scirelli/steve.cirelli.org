//--- Actions for when you click a Submit button on a form. ---
//--- Desc: When you submit a form a message is usually expected to come back and popup
//---       this is the default action for this abstract class
// TODO: Need to create a class that represents the msgbox. 
// TODO: Maybe redo this class to use the jquery.form.js plugin http://malsup.com/jquery/form/#ajaxSubmit
cirelli.FormSubmit = Class.create({
    initialize: function( elem ){
        this.setElem(elem);
        this.page = 'forms.php';
        this.xslPage = '';
        this.subPage = '';
        this.requestData = null;
        this.lastUpdateTime = 0;
        this.url = cirelli.url;
        this.xsl = '';
        this.contentContainer = $j('#generalPopupContent');
    },
    makeRequest:function(){
        var tmp = this;//for the closure below
        //$j('#loadingMsgContainer').css('display','block');
        $j.post( this.url + this.page, this.requestData, function(){tmp.processDoc.apply(tmp, arguments);}, 'xml');
    },
    processDoc:function( xmlDoc, textStatus, XMLHttpRequest ){//call back to update the page. Adds xml chunk to element
        //$j('#loadingMsgContainer').css('display','none');
        if( this.xsl ){
            this.elem[0].doc = applyXSL( xmlDoc, this.xsl );
        }else{
            this.elem[0].doc = xmlDoc;
        }
        this.updatePage();
    },
    updatePage:function(){
        $j('#generalPopupContainer').css('display', 'block');
        this.contentContainer[0].innerHTML = this.elem[0].doc;//There's something wrong with jQuery and using $.html with an element tha thas events attached to it see comment on $.html page by 'David Jack Wange Olrik'. I'll have to work on this some other time.
        this.applyEventHandlers();   
    },
    applyEventHandlers:function(){//Abstract method --- Implemented by Subclasses ---
        //add event handlers
        throw('applyEventHandlers not implemented');
    },
    parseQueryURLQuery:function( urlQuery ){//Should be called after Subpage is set
        if( !urlQuery ){
            if( searchtoObj ){
                urlQuery = searchtoObj();
            }else{
                throw('VerifyEmail - searchtoObj not found');
            }
        }else if( typeof(urlQuery) == 'string' ){
            if( queryStrToObj ){
                urlQuery = queryStrToObj( urlQuery );
            }else{
                throw('VerifyEMail - queryStrToObj not found');
            }
        }else{
            throw('Can not parse URL query string');
        } 
        urlQuery['pg'] = this.subPage;
        return this.requestData = urlQuery;
    },
    getRequestDataObj:function(){
        return this.requestData;
    },
    getRequestPage:function(){
        return this.page;
    },
    getXSL:function(){
        return this.xsl;
    },
    getElem:function(){
        return this.elem;
    },
    setXSLPage: function( page ){
        if( typeof(page) == 'string' ){
        this.xslPage = page;
        this.xsl = this.url + 'xslt/' + this.xslPage;
        }else{
            throw('Page must be of type string');
        }
    },
    setElem:function(elem){
        if(elem == null)
            return;
        if(typeof(elem) == "string")
            elem = $j('#' + elem);
        this.elem = elem;
    },
    setSubPage:function( sp ){
        if( typeof(sp) == 'string' ){
            this.subPage = sp;
        }else{
            throw('Subpage must be of type string');
        }
    },
    setURL:function( url ){
        if( typeof(url) == 'string' ){
            this.url = url;
            this.xsl = this.url + 'xslt/' + this.xslPage;
        }else{
            throw('URL must be of type string');
        }
    },
    setRequestData:function( obj ){
        this.requestData = obj;
    },
    setContentContainer:function( elem ){
        if( typeof(elem) == 'string' )
            elem = $j('#' + elem);
        this.contentContainer = elem;
    }
});

//******* Helper classes for filling in the FormSubmit class ********
//--- Actions for when you click the Subscribe Button on the newsletters page. ---
cirelli.NewsLetterSubmit = Class.create(cirelli.FormSubmit, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage('act_newsletter.xsl');
    },
    applyEventHandlers:function(){
        $j('#btnVerifyEmail_Ok').click(function(){
            $j('#generalPopupContainer').css('display', 'none');
        });
        $j('#generalPopupContainer').draggable();
    }
});

//--- Actions for when a user clicks the verify link in a verify email email ---
cirelli.VerifyEmailSubmit = Class.create(cirelli.FormSubmit, {
    initialize: function( $super, elem ) {
        $super( elem );
        this.setSubPage('verifyEmail');
        this.parseQueryURLQuery();
        this.setXSLPage('verifyemail.xsl');
    },
    applyEventHandlers:function(){
        //add event handlers
        $j('#btnVerifyEmail_Ok').click(function(){
             $j('#generalPopupContainer').css('display', 'none');
        });
        $j('#generalPopupContainer').draggable();
    }
});

//--- Actions for when a user Unsubscribes to a newsletter ---
cirelli.UnsubscribeSubmit = Class.create(cirelli.FormSubmit, {
    initialize: function( $super, elem ) {
        $super( elem );
        this.setSubPage('unsubscribe');
        this.parseQueryURLQuery();
        this.setXSLPage('act_newsletter_unsubscribe.xsl');
    },
    applyEventHandlers:function(){
        //add event handlers
        $j('#btnVerifyEmail_Ok').click(function(){
             $j('#generalPopupContainer').css('display', 'none');
        });
        $j('#generalPopupContainer').draggable();
    }
});

//--- Actions for when a user Submits a survey ---
cirelli.SurveySubmit = Class.create(cirelli.FormSubmit, {
    initialize: function( $super, elem ) {
        $super( elem );
        this.setSubPage('act_survey');//default
        this.setXSLPage('act_survey.xsl');
    },
    applyEventHandlers:function(){
        //add event handlers
        $j('#btnVerifyEmail_Ok').click({'form':this.elem}, function(e){
            $j('#generalPopupContainer').css('display', 'none');
            e.data.form.resetForm();
            $j('input,select,textarea', e.data.form).enable(true);
        });
        $j('#generalPopupContainer').draggable();
    }
});
