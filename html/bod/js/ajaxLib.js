// JavaScript Document
function alert_no_ajax()
{
	alert("Your browser does not support AJAX.");
	return false;
}

//------------------------------------------------
// Func: getXMLDocument()
// Desc: Gets an XML Document 
// Return: An Xml document 
//------------------------------------------------
function getXMLDocument(){
    var xDoc=null;

    if( document.implementation && document.implementation.createDocument ){
        xDoc=document.implementation.createDocument("","",null);//Mozilla/Safari 
    }else if (typeof ActiveXObject != "undefined"){
        var msXmlAx=null;
        try{
            msXmlAx=new ActiveXObject("Msxml2.DOMDocument");//New IE
        }catch (e){
            msXmlAx=new ActiveXObject("Msxml.DOMDocument"); //Older Internet Explorer 
        }
        xDoc=msXmlAx;
    }
    if (xDoc==null || typeof xDoc.load=="undefined"){
        xDoc=null;
    }
    return xDoc;
}

//------------------------------------------------
// Func: getHTTPReqObj()
// Desc: 
// Params:
// Return: A HTTP Request Obj 
//------------------------------------------------
function getHTTPReqObj()
{
	var xHRObject = null;
	
	//IE 6+
	try{
		xHRObject = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e){
	  	//IE 5.5
		try{
			xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
	  	catch(e){
		    //Firefox, Opera 8.0+, Safari
		    try{xHRObject = new XMLHttpRequest();}
		    catch (e){
				alert_no_ajax();
			}
	    }
  	}
  	return xHRObject;
}

//------------------------------------------------
// Func: getData()
// Desc: Gets data from the httprequest call and
//	uses the given style sheet on it
// Params:
//	xHRObject: the xmlhttprequest obj or the xml an document
//	xsllnk: path to the xslt or value 'xml' for xml
//		obj
// Return: requested data
//------------------------------------------------
function getData( xHRObject, xsllnk )
{
    var READY_STATE_UNINITIALIZED = 0;
    var READY_STATE_LOADING       = 1;
    var READY_STATE_LOADED        = 2;
    var READY_STATE_INTERACTIVE   = 3;
    var READY_STATE_COMPLETE      = 4;
	//var xmlDocs = xHRObject.responseText;
	//var xmlDocs = xHRObject.responseXML;
	//alert('getData called ' + xHRObject.readyState + ' ' + xHRObject.status + '\n' + xmlDocs);
	
	if ((xHRObject.readyState == READY_STATE_COMPLETE) && (xHRObject.status == 200))//check to see if the obj is rdy
	{
		//If there's not stylesheet to manupulate the data send the txt back
		if( xsllnk == null || xsllnk == '') return xHRObject.responseText;
		if( xsllnk.toLowerCase() == 'xml' ) return xHRObject.responseXML;
		//Load XML
		var xmlDoc = xHRObject.responseXML;
        return applyXSL( xmlDoc, xsllnk );
	}
	return null;
}

function applyXSL( xmlDoc, xsllnk ){
    if (window.ActiveXObject) //check to see if this is IE
    { 
        //Load XSL
        var xsl = new ActiveXObject("Microsoft.XMLDOM");
        xsl.async = false;
        xsl.load(xsllnk); //load the .xsl file
        if( xsl.parseError.errorCode != 0)
        {alert(xsl.parseError.reason);}
        //Transform
        return xmlDoc.transformNode(xsl);			
    }
    else //all other browsers
    {
        var xsltProcessor = new XSLTProcessor();
        
        //Load XSL
        xslStylesheet = document.implementation.createDocument("", "doc", null);
        xslStylesheet.async = false;
        if(xslStylesheet.load)
            xslStylesheet.load(xsllnk);
        else{//Chrome and Safari
            xhttp = getHTTPReqObj();
            xhttp.open("POST",xsllnk,false);
            xhttp.send("");
            xslStylesheet = xhttp.responseXML;
        }
        xsltProcessor.importStylesheet(xslStylesheet);

        //Transform
        var fragment = xsltProcessor.transformToFragment(xmlDoc, document);
        return new XMLSerializer().serializeToString(fragment);
    }
}

//------------------------------------------------
// Func: sendRequest()
// Desc: Sends a http request
//   Throws: a string error
// Params:
//   strURL: String - the server page to call
//   queryStr: String - the data to send to the page
//       You must http escape this string
//   httpMethod: String - accepted values 'GET' and 'POST'
//   [func]: Func pointer - A function who's first param
//     is a string which will be the data returned
//     from the HTTP request.
//   [xsltLink]: String - location of the xslt to be
//     used on the returned XML, if this value is 
//     null or "" then the text is returned from 
//     the http request.
//------------------------------------------------
function sendRequest( strURL, queryStr, httpMethod, func, xsltLink )
{
	var xHRObject = getHTTPReqObj();
    if( !httpMethod ) httpMethod = 'POST';

	if( xHRObject )
	{
		xHRObject.open(httpMethod.toUpperCase(), strURL, true);
		xHRObject.onreadystatechange = function(){ 
													var str = getData( xHRObject, xsltLink);
													if( str != null && str != "" )
														func( str ); 
												 };
		if( httpMethod.toUpperCase() == 'GET' )
		{
			xHRObject.setRequestHeader('Content-Type', 'text/html');
			xHRObject.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT" );//Prevent IE from caching
		}
		else
			xHRObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		//xHRObject.overrideMimeType("text/xml");//for firefox only
		xHRObject.send(queryStr);
	}
	else
		throw( "sendRequest: getHTTPReqObj object returned null." );
}

//------------------------------------------------
// Constructor: HTTPReqQ()
// Desc: Defines the HTTPReqQ obj
//------------------------------------------------
/*function HTTPReqQ ()
{
	
	//--------------------
	// Methods
	//--------------------
	this.procureHTTP = getHTTPReqObj;
	
	function PostHTTP( stringURL, queryString, func )
	{
		var c = this.reqHTTPQ.length;
		this.reqHTTPQ[c] = this.procureHTTP();
		this.reqHTTPQ[c].open('POST', stringURL, true);
		//this.reqHTTPQ[c].setRequestHeader('Content-Type', 'text/html');
		this.reqHTTPQ[c].setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		this.reqHTTPQ[c].onreadystatechange = function () { this.processHTTP(func) };
		this.reqHTTPQ[c].send(queryString);
	}
	
	function GetHTTP(stringURL, queryString, func)
	{
		var c = this.reqHTTPQ.length;
		this.reqHTTPQ[c] = this.procureHTTP();
		this.reqHTTPQ[c].open('GET', stringURL, true);
		this.reqHTTPQ[c].setRequestHeader('Content-Type', 'text/html');
		this.reqHTTPQ[c].setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT" );//Prevent IE from caching
		this.reqHTTPQ[c].onreadystatechange = function () { this.processHTTP(func) };
		this.reqHTTPQ[c].send(queryString);
	}
	
	function processHTTP( func )
	{
		var i=this.findHTTP();
		if(i!=-1)
		{
			func( this.reqHTTPQ[i] );
			this.reqHTTPQ.splice(i,1);
		}
	}
	
	function findHTTP()
	{
		for( var i=0; i<this.reqHTTPQ.length; i++ )
			if( parseInt(this.reqHTTPQ[i].readyState) == 4 && parseInt(this.reqHTTPQ[i].status) == 200 ) 
				return i;
		return -1;
	}
	
	//------------------------------------------------
	// Func: getData()
	// Desc: Gets data from the httprequest call and
	//	uses the given style sheet on it
	// Params:
	//	lnk: Link to the bases to put in the div
	// Return: the html data
	//------------------------------------------------
	function getData( xHRObject, xsllnk )
	{
		//var xmlDocs = xHRObject.responseText;
		//var xmlDocs = xHRObject.responseXML;
		//alert('getData called ' + xHRObject.readyState + ' ' + xHRObject.status + '\n' + xmlDocs);
		
		if ((xHRObject.readyState == 4) && (xHRObject.status == 200))//check to see if the obj is rdy
		{
			//If there's not stylesheet to manupulate the data send the txt back
			if( xsllnk == null || xsllnk == '') return xHRObject.responseText;
			//Load XML
			var xmlDoc = xHRObject.responseXML;
			if (window.ActiveXObject) //check to see if this is IE
			{ 
				//Load XSL
				var xsl = new ActiveXObject("Microsoft.XMLDOM");
				xsl.async = false;
				xsl.load(xsllnk); //load the .xsl file
				if( xsl.parseError.errorCode != 0)
				{alert(xsl.parseError.reason);}
				//Transform
				return xmlDoc.transformNode(xsl);			
			}
			else //all other browsers
			{
				var xsltProcessor = new XSLTProcessor();
				
				//Load XSL
				xslStylesheet = document.implementation.createDocument("", "doc", null);
				xslStylesheet.async = false;
				xslStylesheet.load(xsllnk);
				xsltProcessor.importStylesheet(xslStylesheet);
	
				//Transform
				var fragment = xsltProcessor.transformToFragment(xmlDoc, document);
				return new XMLSerializer().serializeToString(fragment);
			}
		}
		return null;
	}
	
	//--------------------
	// Variables
	//--------------------
	this.reqHTTPQ = new Array();
}*/
