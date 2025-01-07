cirelli.MenuCommandFactory = function( id ){
    if( typeof(id) != 'string' ){ throw 'MenuCommandFactory "id" must be of type "string".\n\nid= ' + id; return;}
    var jqObj = $j('#'+id);
    switch( id ){
    case 'menuItem_News':
        return new cirelli.NewsEventOnClickCommand(jqObj); 
        break;
    case 'menuItem_Excursions':
        return new cirelli.Command();
        break;
    case 'menuItem_MeetTheStaff':
        return new cirelli.StaffOnClickCommand(jqObj); 
        break;
    case 'menuItem_OnlineStore':
        return new cirelli.Command();
        break;
    case 'menuItem_PhotoGallery':
        return new cirelli.Command();
        break;
    case 'menuItem_Products':
        return new cirelli.Command();
        break;
    case 'menuItem_Survey':
        return new cirelli.SurveyOnClickCommand(jqObj);
        break;
    case 'menuItem_Trivia':
        return new cirelli.TriviaOnClickCommand(jqObj);
        break;
    case 'menuItem_NewsLetter':
        return new cirelli.NewslettersOnClickCommand(jqObj);
        break;
    case 'menuItem_About':
        return new cirelli.AboutOnClickCommand(jqObj);
        break;
    case 'menuItem_ContactUs':
        return new cirelli.ContactOnClickCommand(jqObj);
        break;
    case 'menuItem_calendar':
        return new cirelli.CalendarOnClickCommand(jqObj); 
        break;
    case 'menuItem_classes':
        return new cirelli.ClassesOnClickCommand(jqObj);
        break;
    case 'menuItem_specialtyOfTheMonth':
        return new cirelli.Command();
        break;
    default:
        return new cirelli.Command();
    }
}
