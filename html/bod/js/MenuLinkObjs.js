//--- Actions for when you click the a Link. ---
cirelli.MenuLink = Class.create({//TODO:Rename this abstract class to Action. It's more of a general action then specific to a menulink
    initialize: function( elem ){
        if(elem == null)
            return;
        if(typeof(elem) == "string")
            elem = $j('#' + elem);
        this.elem = elem;
        this.contentContainer = $j('#mainContent');
        this.page = 'pages.php';
        this.xslPage = 'staff.xsl';
        this.requestData = null;
        this.lastUpdateTime = 0;
        this.url = cirelli.url;
        this.xsl = this.url + 'xslt/' + this.xslPage;
    },
    getRequestDataObj:function(){
        return this.requestData;
    },
    getRequestPage:function(){
        return this.page;
    },
    makeRequest:function(){
        var tmp = this;//for the closure below
        if(!this.elem[0].doc){
            $j('#loadingMsgContainer').css('display','block');
            $j.get( this.url + this.page, this.requestData, function(){tmp.processDoc.apply(tmp, arguments);}, 'xml');
        } else{
            this.updatePage();
        }
    },
    processDoc:function( xmlDoc, textStatus, XMLHttpRequest ){//call back to update the page. Adds xml chunk to element
        $j('#loadingMsgContainer').css('display','none');
        this.elem[0].doc = applyXSL( xmlDoc, this.xsl);
        this.updatePage();
    },
    updatePage:function(){
        this.contentContainer[0].innerHTML = this.elem[0].doc;//There's something wrong with jQuery and using $.html with an element tha thas events attached to it see comment on $.html page by 'David Jack Wange Olrik'. I'll have to work on this some other time.
        this.applyEventHandlers();   
    },
    applyEventHandlers:function(){
        //add event handlers
        throw('applyEventHandlers not implemented');
        //TODO: Look into jQuery.delegate(). This might be used to apply event handles once.
    },
    setXSLPage: function( page ){
        this.xslPage = page;
        this.xsl = this.url + 'xslt/' + this.xslPage;
    },
    setURL:function( url ){
        this.url = url;
        this.xsl = this.url + 'xslt/' + this.xslPage;
    },
    getXSL:function(){
        return this.xsl;
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

//--- Actions for when you click the News & Events Link. ---
cirelli.NewsEvent = Class.create(cirelli.MenuLink, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'newsevents.xsl' );
        this.requestData = {pg:'newsevents'};
    },
    applyEventHandlers:function(){
    }
});

//--- Actions for when you click the Staff Link. ---
cirelli.Staff = Class.create(cirelli.MenuLink,{
    initialize: function($super, elem){
        $super(elem);
        this.setXSLPage( 'staff.xsl' );
        this.requestData = {pg:'staff'};
    },
    applyEventHandlers:function(){
        //add event handlers
        $j('div.staffContentDiv').
            height(200).
            css('display', 'none').
            css('cursor','pointer').
            fadeIn(1000, 'linear').
            toggle( function(){ 
                        var children = $j(this).children('.story').children(), sumHeight=200;
                        for(var child=0; child<children.length; child++){ 
                           sumHeight += $j(children[child]).height();
                        }
                        $j(this).animate({height:sumHeight},'slow'); 
                    }, 
                   function(){ $j(this).animate({height:'200px'}, 'slow'); } 
                 );
    }
});

//--- Actions for when you click the Calendar Link. ---
cirelli.Calendar = Class.create(cirelli.MenuLink, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'calendar.xsl' );
        this.requestData = {pg:'calendar'};
    },
    applyEventHandlers:function(){
        $j('div.calendar').
            css('display', 'none').
            fadeIn(1000, 'linear');
    }
});

//--- Actions for when you click the Contact Us Link. ---
cirelli.Contact = Class.create(cirelli.MenuLink, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'contactinfo.xsl' );
        this.requestData = {pg:'contactinfo'};
    },
    applyEventHandlers:function(){
        $j('div.contactDivContainer').
            css('display', 'none').
            fadeIn(1000, 'linear');
    }
});

//--- Actions for when you click the About Link. ---
cirelli.About = Class.create(cirelli.MenuLink, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'about.xsl' );
        this.requestData = {pg:'about'};
    },
    applyEventHandlers:function(){
        $j('#aboutDiv').
            css('display', 'none').
            fadeIn(1000, 'linear');

        $j('.fiveStarDC').hover(
            function(){
                var tp = $j('.fiveStarDC').offset().top+15,
                    lft = $j('.fiveStarDC').offset().left-50;
                $j('#padi5starPopupDiv').height(0).width(400).
                                        css('display', 'block').css('visibility','visible').
                                        offset({top:tp, left:lft}).
                                        animate({height:300}, 'fast').
                                        fadeIn('fast');
            }, 
            function(){
                $j('#padi5starPopupDiv').animate({height:0}, 'fast').fadeOut('fast');
            }
         );
    }
});

//--- Actions for when you click the Classes Link. ---
cirelli.Classes = Class.create(cirelli.MenuLink, {
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'courses.xsl' );
        this.requestData = {pg:'courses'};
    },
    applyEventHandlers:function(){
        $j('#courseContainer').
            css('display', 'none').
            fadeIn(1000, 'linear');
        $j('.fiveStarDC').hover(
            function(){
                var tp = $j('.fiveStarDC').offset().top+15,
                    lft = $j('.fiveStarDC').offset().left-50;
                $j('#padi5starPopupDiv').height(0).width(400).
                                        css('display', 'block').css('visibility','visible').
                                        offset({top:tp, left:lft}).
                                        animate({height:300}, 'fast').
                                        fadeIn('fast');
            }, 
            function(){
                $j('#padi5starPopupDiv').animate({height:0}, 'fast').fadeOut('fast');
            }
         );
    }
});

//--- Actions for when you click the Survey Link. ---
cirelli.Survey = Class.create(cirelli.MenuLink, {//TODO: Maybe Redo the submit button to use jquery.form.js http://malsup.com/jquery/form/#ajaxSubmit
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'survey.xsl' );
        this.requestData = {pg:'survey', surveyid:1};
    },
    applyEventHandlers:function(){//TODO: have the server generate the validation scripts
        $j('#surveyDiv').
            css('display', 'none').
            fadeIn(1000, 'linear');
        var q1Validate = function(){
                var rexp = new RegExp("^[1-2][09][0-9][0-9]$"),
                el =  $j(this);
                if( !rexp.test(el.val()) ){
                    alert('Year must be in the format yyyy. Example: 2010');
                    el.focus();
                    return false;
                }
                return true;
            },
            q2Validate = function(){
                var my = new RegExp("^((1[0-2]|0[1-9])/[1-2][09][0-9][0-9]|[1-2][09][0-9][0-9])$"),
                    el = $j(this);
                if( !my.test(el.val()) ){
                    alert('Answer must be in the format yyyy or mm/yyyy. Example: 2010 or 01/2010');
                    el.focus();
                    return false;
                }
                return true;
            },
            q3Validate = function(){
                var el = $j(this);
                if( !el.val() ){
                    alert('Please enter a value for this field');
                    el.focus();
                    return false;
                }
                return true;
            },
            q4Validate = function(){
                var regex = /^\d+$/,
                    el = $j(this);

                if( !regex.test(el.val()) ){
                    alert('Must be a numeric value');
                    el.focus();
                    return false;
                }
                return true;
            };

        $j('#ffQ_1').blur(q1Validate);
        $j('#ffQ_2').blur(q2Validate);
        //$j('#ffQ_3').blur(q3Validate);
        $j('#ffQ_4').blur(q4Validate);

        $j('#fBodSurvey').submit(function(evt){
           var form   = $j(this),
               query  = form.serializeArray(),
               json   = {'pg':'act_survey'},
               submit = new cirelli.SurveySubmit(form);

           evt.preventDefault();

           for (i in query){//turn the form array into one obj
               json[query[i].name] = query[i].value
           }
           
           if( q1Validate.apply($j('#ffQ_1')[0]) && q2Validate.apply($j('#ffQ_2')[0]) && q3Validate.apply($j('#ffQ_3')[0]) && q4Validate.apply($j('#ffQ_4')[0])){
               submit.setRequestData(json);
               $j('input,select,textarea', form).enable(false);
               submit.makeRequest();
           }
           return false;
        });
    }
});

//--- Actions for when you click the Newsletters Link. ---
cirelli.Newsletters = Class.create(cirelli.MenuLink, {//TODO: Redo the submit button to use jquery.form.js
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'newsletters.xsl' );
        this.requestData = {pg:'newsletters'};
    },
    applyEventHandlers:function(){
        $j('#newsLetterArchiveContainer').
            css('display', 'none').
            fadeIn(1000, 'linear');

            $j('#fNewsletters').attr('action', 'forms.php?pg=act_newsletter')
                               .submit( function(){
                                   var msg    = $j('#fNewsletters').attr('action'),
                                       email  = $j('#ffEmail').val(),
                                       catid  = $j('#ffCategoryId').val(),
                                       form   = $j(this),
                                       submit = new cirelli.NewsLetterSubmit(form);
                                   var query = form.serializeArray(),
                                       json = {'pg':'act_newsletter'};

                                   for (i in query) {
                                        json[query[i].name] = query[i].value
                                   }//{pg:'act_newsletter','ffEmail':email, 'ffCategoryId':catid}
                                   if( !json.ffEmail ){
                                       alert('You must enter an email address.');
                                   }else{
                                       submit.setRequestData(json);
                                       submit.makeRequest();
                                   }
                                   return false;
                               });
        /*
        $j('#fNewsletters').hover(
            function(){
                $j(this).css('border','1px solid #000');
            },
            function(){
                $j(this).css('border','1px solid #FFF');
        });
        */
        /*$j('div.newsLetter').hover(
            function(){
                $j(this).toggleClass('newsLetterHoverIn');
            },
            function(){
                $j(this).toggleClass('newsLetterHoverIn');
            }
        );*/
    }
});

//--- Actions for when you click the Trivia Link. ---
cirelli.Trivia = Class.create(cirelli.MenuLink, {//TODO: Maybe Redo the submit button to use jquery.form.js http://malsup.com/jquery/form/#ajaxSubmit
    initialize:function($super, elem){
        $super(elem);
        this.setXSLPage( 'survey.xsl' );
        this.requestData = {pg:'survey', surveyid:2};
    },
    applyEventHandlers:function(){
        $j('#fBodTrivia').submit(function(evt){
           var form   = $j(this),
               query  = form.serializeArray(),
               json   = {'pg':'act_survey'},
               submit = new cirelli.SurveySubmit(form);

           evt.preventDefault();

           for (i in query){//turn the form array into one obj
               json[query[i].name] = query[i].value
           }
           
           submit.setRequestData(json);
           $j('input,select,textarea', form).enable(false);
           submit.makeRequest();
           return false;
        });
    }
});
