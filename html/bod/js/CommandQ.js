//--------------------------------------------------------------------------------------
//--- Queue system for efficient transfer of many small commands in a single request ---
//---                                                                                ---
//--- Desc: Queues up requests to a page on the server. The server will respond with ---
//---       one large xml document.                                                  ---
//--------------------------------------------------------------------------------------
//---- QUEUE ARRAY ---
if( cirelli ) //Check to see if the cirelli namespace exists
    cirelli.cmdQueues=new Array();
else{
    var cirelli = new Object();
    cirelli.cmdQueues=new Array();
}

//Constructor
cirelli.CommandQueue=function(id,url,onUpdate,freq){
  this.id=id;
  cirelli.cmdQueues[id]=this;
  this.url=url;
  this.queued=new Array();
  this.sent=new Array();
  this.onUpdate=onUpdate;
  if (freq){
    this.repeat(freq);
  }
  this.lastUpdateTime=0;
}
//Constants
cirelli.CommandQueue.STATUS_QUEUED       = -1;
cirelli.CommandQueue.STATE_UNINITIALIZED = cirelli.READY_STATE_UNINITIALIZED;
cirelli.CommandQueue.STATE_LOADING       = cirelli.READY_STATE_LOADING;
cirelli.CommandQueue.STATE_LOADED        = cirelli.READY_STATE_LOADED;
cirelli.CommandQueue.STATE_INTERACTIVE   = cirelli.READY_STATE_INTERACTIVE;
cirelli.CommandQueue.STATE_COMPLETE      = cirelli.READY_STATE_COMPLETE;
cirelli.CommandQueue.STATE_PROCESSED     = 5;

cirelli.CommandQueue.PRIORITY_NORMAL    = 0;
cirelli.CommandQueue.PRIORITY_IMMEDIATE = 1;

//Methods
cirelli.CommandQueue.prototype={
    addCommand:function(command){
        if (this.isCommand(command)){
            this.queue.append(command,true);
            if (command.priority==cirelli.CommandQueue.PRIORITY_IMMEDIATE){
                this.fireRequest();
            }
        }
    },

    fireRequest:function(){
        if (!this.onUpdate && this.queued.length==0){
            return;
        }
        var data={lastUpdate:this.lastUpdateTime};
        for(var i=0;i<this.queued.length;i++){
            var cmd=this.queued[i];
            if (this.isCommand(cmd)){
                for( attrName in cmd.data ){
                    if( data.implementsProp(attr) )//if the obj already has this property just append more data to it
                        data[attr] += cmd.data[attr];
                    else
                        data[attr] = cmd.data[attr];//If it doesn't, add it
                }
                this.sent[cmd.id]=cmd;
            }
        }
        this.queued=new Array();
        $j.post( this.url, data, cirelli.CommandQueue.onload, 'xml');
        //this.loader=new cirelli.ContentLoader( this.url, cirelli.CommandQueue.onload, cirelli.CommandQueue.onerror, "POST",data);
    },

    isCommand:function(obj){
        return ( obj.implementsProp("id") && obj.implementsProp("priority") && 
                 obj.implementsProp("data") && obj.implementsFunc("parseResponse") );
    },

    repeat:function(freq){
        this.unrepeat();
        if (freq>0){
            this.freq=freq;
            var cmd="cirelli.cmdQueues["+this.id+"].fireRequest()";
            this.repeater=setInterval(cmd,freq*1000);
        }
    },

    unrepeat:function(){
        if (this.repeater){
            clearInterval(this.repeater);
        }
            this.repeater=null;
    }
}

cirelli.CommandQueue.onload=function(){
    var xmlDoc=this.req.responseXML;
    var elDocRoot=xmlDoc.getElementsByTagName("responses")[0];
    var lastUpdate=elDocRoot.attributes.getNamedItem("updateTime");
    if (parseInt(lastUpdate)>this.lastUpdateTime){
        this.lastUpdateTime=lastUpdate;
    }
    if (elDocRoot){
        for(i=0;i<elDocRoot.childNodes.length;i++){
            elChild=elDocRoot.childNodes[i];
            if (elChild.nodeName=="command"){
                var attrs=elChild.attributes;
                var id=attrs.getNamedItem("id").value;
                var command=cirelli.commandQueue.sent[id];
                if (command){
                    command.parseResponse(elChild);
                }
            }else if (elChild.nodeName=="update"){
                if (this.implementsFunc("onUpdate")){
                    this.onUpdate.call(this,elChild);
                }
            }
        }
    }
}

cirelli.CommandQueue.onerror=function(){
  alert("problem sending the data to the server");
}

