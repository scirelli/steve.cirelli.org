$j(document).ready(function() { 
     var mainContent       = $j('#mainContent'),
         padi5starPopupDiv = $j('#padi5starPopupDiv'),
         generalPopup      = $j('#generalPopupContent');//TODO: make an object for handling this messagebox. Create a msgbox class and a comfirmationbox class. Allow them to be dragged around.
     var menuIdList = ['menuItem_News',
                      'menuItem_Excursions',
                      'menuItem_MeetTheStaff',
                      'menuItem_OnlineStore',
                      'menuItem_PhotoGallery',
                      'menuItem_Products',
                      'menuItem_Survey',
                      'menuItem_Trivia',
                      'menuItem_NewsLetter',
                      'menuItem_About',
                      'menuItem_ContactUs',
                      'menuItem_calendar',
                      'menuItem_classes',
                      'menuItem_specialtyOfTheMonth']; 
    window.location.searchObj =  searchtoObj();

    //Setup event handlers for the left side menu
    for( var i=0; i<menuIdList.length; i++ )
    {
        $j('#'+menuIdList[i]).click(function( evt ){
            try{
                var command = cirelli.MenuCommandFactory(this.id);//new cirelli.NewsEventOnClickCommand( $j(this) ); 
                command.execute();
            }catch( e ){
                alert('Could not attach handler to ' + this.id + '.\n\n' + e);
            }finally{
                evt.preventDefault();
            }
        }); 
    }

    //Load a page if requested. If not default to news
    if( window.location.searchObj.goto ){
        switch( window.location.searchObj.goto ){
        case 'newsevents':
            $j('#menuItem_News').click();
            break;
        case 'staff':
            $j('#menuItem_MeetTheStaff').click();
            break;
        case 'survey':
            $j('#menuItem_Survey').click();
            break;
        case 'trivia':
            $j('#menuItem_Trivia').click();
            break;
        case 'about':
            $j('#menuItem_About').click();
            break;
        case 'contact':
            $j('#menuItem_ContactUs').click();
            break;
        case 'calendar':
            $j('#menuItem_calendar').click();
            break;
        case 'classes':
            $j('#menuItem_classes').click();
            break;
        case 'newsletters':
            $j('#menuItem_NewsLetter').click();
            break;
        case 'verifyEmail':
            var verifyEmail = new cirelli.VerifyEmailSubmit(generalPopup);
            verifyEmail.makeRequest();
            break;
        case 'unsubscribe':
            var unsub = new cirelli.UnsubscribeSubmit(generalPopup);
            unsub.makeRequest();
            break;
        default:
            alert('Page \'' + window.location.searchObj.goto + '\' not found.\n\nDefaulting to News & Events');
            $j('#menuItem_News').click();
        }
    }else{
        $j('#menuItem_News').click();
    }

 });
