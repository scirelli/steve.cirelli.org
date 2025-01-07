//---- News & Events ----
cirelli.NewsEventOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.newsEventLink = new cirelli.NewsEvent(elem);
    },
    execute: function() {//@Override
        //alert('You clicked me!');
        this.newsEventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.newsEventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.newsEventLink.getRequestPage();
    }
});

//---- Staff ----
cirelli.StaffOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Staff(elem);
    },
    execute: function() {//@Override
        //alert('You clicked me!');
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Calendar ---
cirelli.CalendarOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Calendar(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Contact Us ---
cirelli.ContactOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Contact(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- About ---
cirelli.AboutOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.About(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Classes ---
cirelli.ClassesOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Classes(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Survey ---
cirelli.SurveyOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Survey(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Newsletters ---
cirelli.NewslettersOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Newsletters(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});

//---- Trivia ---
cirelli.TriviaOnClickCommand = Class.create(cirelli.Command, {
    initialize: function( elem ){
        //Member variables
        this.eventLink = new cirelli.Trivia(elem);
    },
    execute: function() {//@Override
        this.eventLink.makeRequest();
    },
    getRequestDataObj: function(){//@Override
        return this.eventLink.getRequestString();
    },
    getRequestPage: function(){//@Override
        return this.eventLink.getRequestPage();
    }
});
