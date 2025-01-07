<?PHP require('setup.php'); ?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//WC3//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>Blue Ocean Divers</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <meta name="description" content="Blue Ocean Divers is committed to providing you the best educational experience using the 
                                          proven PADI system of diver education. We are your PADI 5 Star (IDC) Instructor Development Center for the Southern Tier. 
                                          This means that we can help you with your snorkeling/diving goals. If your goal is to be a better snorkeler or to start your diving 
                                          career or take your diving to the next level, Blue Ocean Divers is here to assist you with each step. We can even work with you to 
                                          become a PADI Scuba Diving Instructor if that is your goal. Blue Ocean Divers is your one stop shop for all of your dive related needs. 
                                          Whether it is a need for new equipment, equipment service, help with local diving or dive travel and of course training, 
                                          Blue Ocean Divers is here to serve you. We have the industry leading product lines, at best value pricing for all your equipment needs. 
                                          We are continually going to manufacturer's seminars and classes to advance our education in equipment service. We work hard to stay 
                                          current on all equipment service bulletins and changes in equipment service techniques." />
        <meta name="keywords" content="images,photogallery,photos,scuba, diving, scuba diving, padi" />
        <link REL="SHORTCUT ICON" HREF="favicon.ico">

        <!-- ----- Social/Open Graph Meta data ----- -->
        <meta property="og:title" content="Blue Ocean Divers"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://www.blueoceandivers.com/"/>
        <meta property="og:image" content="http://www.blueoceandivers.com/Images/logo_large.jpg"/>
        <meta property="og:site_name" content="Blue Ocean Divers"/>
        <meta property="fb:admins" content="144238028468,Mach10Mike,cirelli"/>
        <meta property="og:description" content="Blue Ocean Divers is committed to providing you the best educational experience using the 
                                                 proven PADI system of diver education. We are your PADI 5 Star (IDC) Instructor Development Center for the Southern Tier. 
                                                 This means that we can help you with your snorkeling/diving goals. If your goal is to be a better snorkeler or to start your diving 
                                                 career or take your diving to the next level, Blue Ocean Divers is here to assist you with each step. We can even work with you to 
                                                 become a PADI Scuba Diving Instructor if that is your goal. Blue Ocean Divers is your one stop shop for all of your dive related needs. 
                                                 Whether it is a need for new equipment, equipment service, help with local diving or dive travel and of course training, 
                                                 Blue Ocean Divers is here to serve you. We have the industry leading product lines, at best value pricing for all your equipment needs. 
                                                 We are continually going to manufacturer's seminars and classes to advance our education in equipment service. We work hard to stay 
                                                 current on all equipment service bulletins and changes in equipment service techniques."/>
        <meta property="og:email" content="information@blueoceandivers.com"/>
        <meta property="og:phone_number" content="607-757-2930"/>
        <meta property="og:fax_number" content="+1-607-757-2989"/>
        <meta property="og:street-address" content="1500 Vestal Parkway East Suite 103A"/>
        <meta property="og:locality" content="Vestal"/>
        <meta property="og:region" content="NY"/>
        <meta property="og:postal-code" content="13850"/>
        <meta property="og:country-name" content="USA"/>
        <!-- ------------------------------------ -->

        <!-- ------------ Javascript ------------ -->
        <!-- 3rd party -->
        <script type="text/javascript" src="js/prototype_1.7.js"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>-->
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <!--<script type="text/javascript" src="http://www.jongma.org/webtools/jquery/jquery.xslt.js"></script>-->
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <!-- Cirelli's -->
        <script type="text/javascript" src="js/reflect.js"></script>
        <script type="text/javascript" src="js/extras-array.js"></script>
        <script type="text/javascript" src="js/ajaxLib.js"></script>
        <script type="text/javascript" src="js/extras-location.js"></script>
        <script type="text/javascript"> 
            var $j = jQuery.noConflict();
            //---- GLOBAL: Namespacing object ----
            var cirelli = new Object();
            cirelli.url = '<?PHP echo $paths['httpRoot']; ?>';
        </script>
        <!--<script type="text/javascript" src="js/CommandQ.js"></script>-->
        <script type="text/javascript" src="js/CommandObj_Interface.js"></script>
        <script type="text/javascript" src="js/MenuLinkObjs.js"></script>
        <script type="text/javascript" src="js/MenuCommandObjs.js"></script>
        <script type="text/javascript" src="js/FormSubmitObjs.js"></script>
        <script type="text/javascript" src="js/Factories.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <!-- ------------------------------------ -->

        <!-- ------------ CSS Styles ------------ -->
        <!-- <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />-->
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/generalStyles.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/aboutStyles.css"   media="screen" />
        <link rel="stylesheet" type="text/css" href="css/contactStyles.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/coursesStyles.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/surveyStyles.css"  media="screen" />
        <link rel="stylesheet" type="text/css" href="css/staffStyles.css"   media="screen" />
        <link rel="stylesheet" type="text/css" href="css/newsletters.css"   media="screen" />
        <link rel="stylesheet" type="text/css" href="css/verifyemail.css"   media="screen" />

        <style type="text/css"> 
            /*div{ border:1px solid #000;}*/ 
        </style>

        <!--[if IE ]>
        <link rel="stylesheet" href="" type="text/css" media="screen"/>
        <style type="text/css">
        </style>
        <![endif]-->
        <!-- ------------------------------------ -->
    </head>

    <body>
        <div id="container">
            <div id="header">
                <h1>Blue Ocean Divers</h1>
                <h1>Blue Ocean Divers</h1>
                <div id="siteFBLike">
                    <fb:like href="http://www.blueoceandivers.com" layout="button_count" show_faces="false" width="55" height="65" font="arial" colorscheme="light"></fb:like>
                </div>
                <div id="BoDLLC"><span>LLC.</span></div>
                <div class="shadow"></div>
            </div>
                
            <div id="menuListDiv">
                <div id="logo"><img src="images/logo_large2.gif" alt="BOD Logo" /></div>
                <ul id="mainMenuList">
                    <li><span class="menuTitle">Main Menu</span>
                        <ul>
                            <li><a id="menuItem_News"         href="">News</a></li>
                            <li><a id="menuItem_Excursions"   href="">Excursions</a></li>
                            <li><a id="menuItem_MeetTheStaff" href="">Meet The Staff</a></li>
                            <li><a id="menuItem_OnlineStore"  href="">Online Store</a></li>
                            <li><a id="menuItem_PhotoGallery" href="">Photo Gallery</a></li>
                            <li><a id="menuItem_Products"     href="">Products</a></li>
                            <li><a id="menuItem_Survey"       href="">Survey</a></li>
                            <li><a id="menuItem_Trivia"       href="">Trivia</a></li>
                            <li><a id="menuItem_NewsLetter"   href="">Newsletter</a></li>
                            <li><a id="menuItem_About"        href="">About</a></li>
                            <li><a id="menuItem_ContactUs"    href="">Contact Us</a></li>
                        </ul>
                    </li>
                    <li><span class="menuTitle">Training</span>
                        <ul>
                            <li><a id="menuItem_calendar"    href="">Calendar</a></li>
                            <li><a id="menuItem_classes"     href="">Classes</a></li>
                            <li><a id="menuItem_specialtyOfTheMonth"    href="">Specialty of the Month</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="mainContent">
               <!-- DONE
                <div id="contactDivContainer">
                    <div>
                        1500 Vestal Parkway East
                        Suite 103A
                        Vestal, NY 13850
                    </div>
                    <div>
                        HOURS:
                        Monday - Friday: Noon to 7 p.m. 
                        Saturday: 9 a.m. to 5 p.m.
                    </div>
                    <div>
                        (607) 757-2930 / (607) 757-2989 (fax) 
                    </div>
                    <div>
                        Information email address:<br/>
                        information@blueoceandivers.com
                    </div>
                    <div id="map">
                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=1500+Vestal+Parkway+East+Suite+103A+Vestal,+NY+13850++&amp;sll=37.0625,-95.677068&amp;sspn=35.410182,61.875&amp;ie=UTF8&amp;hq=&amp;hnear=1500+Vestal+Pkwy+E+%23103a,+Vestal,+Broome,+New+York+13850&amp;t=h&amp;z=14&amp;ll=42.092005,-76.02803&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=1500+Vestal+Parkway+East+Suite+103A+Vestal,+NY+13850++&amp;sll=37.0625,-95.677068&amp;sspn=35.410182,61.875&amp;ie=UTF8&amp;hq=&amp;hnear=1500+Vestal+Pkwy+E+%23103a,+Vestal,+Broome,+New+York+13850&amp;t=h&amp;z=14&amp;ll=42.092005,-76.02803" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                    </div>
                    <div>
                        From all Locations:
                        Take 17 to exit 67 South onto Route 26 South. Take the Vestal Exit and make a right hand turn onto the Vestal Parkway. Go 0.9 miles East after going under the highway to 1500 Vestal Parkway. We are the 3rd building after the Red Lobster and in the building just before the building Nextel is in. Come around back and you are there.
                    </div>
                    <div id="contactFormContainerDiv">
                        <div class="formRequiredNote"><span class="formRequired">*</span> Denotes required fields</div>
                        <form name="fContactForm" id="fContactForm" method="POST" action="">
                            <div>
                                <label for="ffRegarding">Regarding<span class="formRequired">*</span>: </label> 
                                <select name="ffRegarding" id="ffRegarding">
                                    <option value=""></option>  
                                    <option value="store">Store</option>  
                                    <option value="excursions">Excursions</option>  
                                    <option value="edcuation">Education</option>  
                                    <option value="website">Website</option>  
                                </select>
                            </div>
                            <div>
                                <div><label for="ffName">Name: </label><input type="text" name="ffName" id="ffName" value="" maxlength="30"/></div>
                                <div><label for="ffEmail">Email<span class="formRequired">*</span>: </label><input type="text" name="ffEmail" id="ffEmail" value="" maxlength="50"/></div>
                                <div><label for="ffPhone">Phone Number <br/>(###-###-####): </label><input type="text" name="ffPhone" id="ffPhone" value="" maxlength="12"/></div>
                                <div><label for="ffAddress">Address: </label><input type="text" name="ffAddress" id="ffAddress" value="" maxlength="200"/></div>
                                <div><label for="ffCity">City: </label><input type="text" name="ffCity" id="ffCity" value=""  maxlength="11"/></div>
                                <div>
                                    <label for="ffState">State: </label>
                                    <select name="ffState" id="ffState">
                                        <option value="">  </option>
                                    </select>
                                </div>
                                <label for="ffZip">Zip: </label><input type="text" name="ffZip" id="ffZip" value="" maxlength="11" size="10"/>
                            </div>
                            <div>
                                <label for="ffComment">Comment: </label><textarea name="ffComment" wrap="virtual" col="50" row="8"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                -->
                <!-- DONE
                <div id="courseContainer">
                    <div id="coursesHeaderDiv">
                        <div><span><h3>Diving Education Programs</h3></span></div> 
                        <div>
                            We are the only <span class="fiveStarDC"><em><a href="http://www.padi.com/scuba/call-to-actions/locate-a-scuba-dive-shop/dive-shop-and-resort-levels/default.aspx">PADI 5 Star Dive Center</a></em></span> in the Southern Tier. 
                            Our on-site instructor's credentials range from Open Water Scuba Instructor to Master Instructor. All of our instructors 
                            are avid divers and have a wide range of experiences and expertise in different diving environments. Their knowledge 
                            together with the PADI program of diver education allows us to offer you the world's most distinguished SCUBA instruction. 
                            After completion of your Open Water or continuing education class you will have the confidence and ability to further 
                            explore the underwater world.
                        </div>
                    </div>
                    <div id="coursesContentDiv" class="table">
                        <div class="section">
                            <div class="tr">
                                <div class="th">Open Water Divers</div>
                                <div class="th">Cost</div>
                                <div class="th">Duration</div>
                                <div class="th">Start Date</div>
                            </div>
                            <div class="tr">
                                <div class="td">SCUBA Diver</div> 
                                <div class="td">$175.00</div> 
                                <div class="td">13 hrs</div> 
                                <div class="td">Today</div> 
                            </div>
                            <div class="tr">
                                <div class="td">Open Water Diver</div> 
                                <div class="td">$275.00</div> 
                                <div class="td">26 hrs</div> 
                                <div class="td">January 2011</div> 
                            </div>
                        </div>
                    </div>
                </div>
                -->
                <!-- DONE
                <div id="calendarDiv">
                    <iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=9r1cet0oqitp2t2bss5ek3lpjg%40group.calendar.google.com&amp;color=%23060D5E&amp;ctz=America%2FNew_York" style=" border-width:0 " width="572" height="372" frameborder="0" scrolling="no"></iframe>
                    <div class="shadow3"></div>
                </div>
                -->
                <!-- DONE
                <div id="surveyDiv">
                    <div><h3>BoD Survey</h3></div>
                    <div class="msg">Please take a moment and fill out our survey and help us better understand you and your needs.</div>
                    <form name="fBodSurvey" id="fBodSurvey" method="POST" action="">
                        <ol>
                            <li>
                                <label class="surveyQuestion" for="ffQ_1">What year where you 1st certified?</label>
                                <input class="surveyAnswer" type="text" name="ffQ_1" id="ffQ_1" value=""/>
                            </li>
                            <li>
                                <label class="surveyQuestion" for="ffQ_1">What year where you 1st certified?</label>
                                <input class="surveyAnswer" type="text" name="ffQ_1" id="ffQ_1" value=""/>
                            </li>
                            <li>
                                <label class="surveyQuestion" for="ffQ_1">What year where you 1st certified?</label>
                                <input class="surveyAnswer" type="text" name="ffQ_1" id="ffQ_1" value=""/>
                            </li>
                            <li>
                                <label class="surveyQuestion" for="ffQ_1">What year where you 1st certified?</label>
                                <input class="surveyAnswer" type="text" name="ffQ_1" id="ffQ_1" value=""/>
                            </li>
                        </ol>
                        <div><input type="submit" value="Submit"/></div>
                    </form>
                </div>
                -->

                <!-- DONE
                <div id="aboutDiv">
                    <div><h2>About Blue Ocean Divers</h2></div>
                    <div>
                        <p>
                            Blue Ocean Divers is committed to providing you the best educational experience using the proven PADI system of diver education.
                        </p>
                        <p>
                            We are your <span class="fiveStarDC"><em><a href="http://www.padi.com/scuba/call-to-actions/locate-a-scuba-dive-shop/dive-shop-and-resort-levels/default.aspx">PADI 5 Star (IDC) Instructor Development Center</a> </em></span>for the Southern Tier. This means that we can help you with your snorkeling/diving goals. If your goal is to be a better snorkeler or to start your diving career or take your diving to the next level, Blue Ocean Divers is here to assist you with each step. We can even work with you to become a PADI Scuba Diving Instructor if that is your goal. 
                        </p>
                        <p>
                            Blue Ocean Divers is your one stop shop for all of your dive related needs. Whether it is a need for new equipment, equipment service, help with local diving or dive travel and of course training, Blue Ocean Divers is here to serve you. We have the industry leading product lines, at best value pricing for all your equipment needs. We are continually going to manufacturer's seminars and classes to advance our education in equipment service. We work hard to stay current on all equipment service bulletins and changes in equipment service techniques
                        </p>
                    </div>
                </div>
                -->
                <!--
                -->
                <!-- DONE
                <div class="staffContentDiv">
                    <div><h3><span>Patty</span>&nbsp;<span>Elsner</span></h3></div>
                    <img src="./images/staff_pat_e_sm.jpg"/>
                    <div>
                        I've been diving for 13 years and have dove and/or snorkeled in Lake Michigan, the St. Lawrence River, 
                        Hawaii, west coast of Florida, the Florida Keys, Bahamas, Grand Cayman, Cayman Brac, Curacao, Bonaire, and 
                        Roatan. What I enjoy most about diving is weightlessness and the quiet. Yes, I use an open circuit system but I still 
                        think about it as quiet. There are so many critters in the ocean and fresh water if you take the time to see them. Come see 
                        what I see!
                        Dive Safely and Have Fun
                        I've been diving for 13 years and have ... 
                    </div>
                </div> 
                -->
            </div>
        </div>
        <div id="loadingMsgContainer">
            <div class="bkFade"></div>
            <div id="loadingMsg">
                <span>Loading...</span>
                <div id="loadingImg"></div>
            </div>
        </div>

        <div id="generalPopupContainer" class="popupContainer">
            <div class="popupRoundShadowContainer" >
                <div class="round4_blue"></div>
                <!--<div class="round3_blue"></div>-->
                <div class="round2_blue"></div>
                <div class="round1_blue"></div>

                <div class="popUpShadowContent">
                </div>

                <div class="round1_blue"></div>
                <div class="round2_blue"></div>
                <!--<div class="round3_blue"></div>-->
                <div class="round4_blue"></div>
            </div>

            <div class="popupContentContainer" >
                <div class="round4_darkblue"></div>
                <!--<div class="round3_darkblue"></div>-->
                <div class="round2_darkblue"></div>
                <div class="round1_darkblue"></div>

                <div id="generalPopupContent" class="popUpContent">
                </div>

                <div class="round1_darkblue"></div>
                <div class="round2_darkblue"></div>
                <!--<div class="round3_darkblue"></div>-->
                <div class="round4_darkblue"></div>
            </div>
        </div>

        <div id="padi5starPopupDiv" class="popUpInfo">
            <div><img src="images/5star_IDCWeb.jpg"/></div>
            <div>
                <p><h3>PADI Five Star Dive Center</h3></p>
                <p>
                    PADI Five Star Dive Center Membership is awarded to progressive PADI Dive Shops that excel in providing scuba divers with a full range of scuba certification programs, scuba gear selection, and scuba experience opportunities. To qualify as PADI Five Star Dive Center, a dive shop must meet elevated service and business standards and both promote and offer only PADI scuba diving lessons as their recreational scuba diver training. These dive shops also actively promote underwater environmental awareness and embrace the PADI System of diver education, with a commitment to providing quality training, products, services and experiences.
                </p>
            </div>
            <div>
                <p><h3>PADI Five Star Instructor Development Dive Center</h3></p>
                <p>PADI Five Star Instructor Development Centers meet all PADI Five Star Dive Center standards and provides the same level of service. They also meet additional training requirements and offer PADI Instructor-level training.</p>
            </div>
        </div>
        <div id="sun"></div>
        <div id="clouds"></div>
        <div id="water"></div>
        <div id="seafloor"></div>
        <div id="sceneImg1"></div>
        <div id="sceneImg2"></div>
        <div id="sceneImg3"></div>
        <div id="sceneImg4"></div>
        <div id="sceneImg5"></div>
        <div id="sceneImg6"></div>
    </body>
</html>
