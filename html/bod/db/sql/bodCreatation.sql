/* login to mysql: mysql -u <user> -h <host> -p
 run this script \. bodCreatation.sql */
-- ----------------------------------------------------------------------------------------------------------
-- ------------------------------------------- CREATE TABLES ------------------------------------------------
-- ----------------------------------------------------------------------------------------------------------
-- 
-- The Databse
-- 
CREATE DATABASE BlueOceanDivers;
USE BlueOceanDivers;

-- 
-- Table Structure for PADI Level Types Table
-- 
CREATE TABLE PADI_Level_Types (
  lvlType_id int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  lvlTypes VARCHAR(200) NOT NULL,
  PRIMARY KEY  (lvlType_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Table Structure for PADI_Levels Table
-- 
CREATE TABLE PADI_Levels (
  padiLvl_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  padiLevel VARCHAR(200) NOT NULL,
  lvlType_id INT(4) NOT NULL,
  INDEX(lvlType_id),
  FOREIGN KEY (lvlType_id) REFERENCES PADI_Level_Types(lvlType_id) ON DELETE NO ACTION,
  PRIMARY KEY  (padiLvl_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Table Structure for dive Course 
-- 
CREATE TABLE Courses(
  course_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  padiLvl_id INT(4) NOT NULL,
  INDEX(padiLvl_id),
  FOREIGN KEY (padiLvl_id) REFERENCES PADI_Levels(padiLvl_id) ON DELETE NO ACTION,
  cost FLOAT NOT NULL DEFAULT 0,
  duration FLOAT NOT NULL DEFAULT 0,
  startDate Date,
  PRIMARY KEY  (course_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Table Structure for Images Table
-- 
CREATE TABLE Images (
  image_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  fileName char(255) NOT NULL,
  filePath varchar(500) DEFAULT '/Images/', 
  caption  char(255),
  PRIMARY KEY  (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for Stories Table
-- 
CREATE TABLE Stories (
  story_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  story    VARCHAR(4000) NOT NULL,
  PRIMARY KEY  (story_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for State Table
-- 
CREATE TABLE States (
  state_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  stateName  varchar(50) NOT NULL,
  abriv      char(2) NOT NULL,
  PRIMARY KEY  (state_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Table structure for table "Users"
-- 
-- Staff members and users who do not want to be anonymous
CREATE TABLE Users (
 user_Id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,         /*user ID*/
 firstname CHAR(200)  NOT NULL,                           /*The first name of the user*/
 lastname  CHAR(200)  NOT NULL,                           /*The last name of the user*/
 nickName  CHAR(200),                                     /*The users nickName. Comma separated List if more than one*/
 padiLevel_id INT(4)     NOT NULL DEFAULT 0,               /*Forgien key to the PADI_Level table*/
 INDEX (padiLevel_id),
 FOREIGN KEY (padiLevel_id) REFERENCES PADI_Levels(padiLvl_id) ON DELETE NO ACTION,  /* */
 email     CHAR(200),
 joinDate  DATE DEFAULT '1980-04-20',
 isStaff BIT(1) DEFAULT 0,
 address      VARCHAR(500),
 primPhoneNumber CHAR(11),
 altPhone        CHAR(11),
 city            CHAR(50),
 state_id        INT(4) UNSIGNED NOT NULL DEFAULT 0,
 INDEX(state_id),
 FOREIGN KEY (state_id) REFERENCES states(state_id) ON DELETE NO ACTION,
 zip             CHAR(10),
 image_id        INT(4) NOT NULL DEFAULT 0,
 INDEX(image_id),
 FOREIGN KEY (image_id) REFERENCES Images(image_id) ON DELETE CASCADE,
 story_id INT(4) UNSIGNED NOT NULL DEFAULT '0',
 INDEX(story_id),
 FOREIGN KEY (story_id) REFERENCES stories(story_id) ON DELETE CASCADE,
 PRIMARY KEY  (user_id)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ALTER TABLE Users ADD COLUMN email char(200) AFTER padiLevel_id;
-- ALTER TABLE Users ADD COLUMN isStaff BIT(0) DEFAULT 0 AFTER joinDate;

-- 
-- Structure for Survey Table
-- 
-- Desc: Table which olds surveys
CREATE TABLE Surveys(
  survey_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  surveyName CHAR(200) NOT NULL,
  action     VARCHAR(1024),
  message    VARCHAR(1024),
  formName   VARCHAR(50),
  PRIMARY KEY  (`survey_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for Answer_Types table
-- 
-- Desc: Lookup table for answers types, this corruspond to HTML input types.
CREATE TABLE Answer_Types(
  answerType_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  answerType CHAR(50) NOT NULL,
  PRIMARY KEY  (answerType_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for Question Table
-- 
-- Desc: Holds questions of a survey.
CREATE TABLE Questions(
  question_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  question    VARCHAR(500) NOT NULL,
  answerType_id     INT(4) UNSIGNED NOT NULL DEFAULT 1,
  INDEX(answerType_id),
  FOREIGN KEY (answerType_id) REFERENCES Answer_Types(type_id) ON DELETE NO ACTION,
  survey_id   INT(4) UNSIGNED NOT NULL,
  INDEX(survey_id),
  FOREIGN KEY (survey_id) REFERENCES Surveys(survey_id) ON DELETE NO ACTION,
  PRIMARY KEY  (question_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ALTER TABLE Questions ADD COLUMN type_id INT(4) UNSIGNED NOT NULL DEFAULT 0 AFTER question;

-- 
-- Structure for Answer Table
-- 
-- Desc: Table that holds predefined answers to Questions.
CREATE TABLE Answers(
  answer_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  answerText VARCHAR(500),  /* This is for the text in a select box*/
  answerDate Date,
  answerNumeric INT(4),
  answerValue VARCHAR(500),  /* This is for values of select boxes*/
  question_id INT(4) UNSIGNED NOT NULL,
  INDEX(question_id),
  FOREIGN KEY (question_id) REFERENCES Questions(question_id) ON DELETE CASCADE,
  PRIMARY KEY  (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for Answer Table
-- 
-- Desc: Table that holds users answers to Questions.
CREATE TABLE Users_Answers(
  answer_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  answerText VARCHAR(500),  /* This is for the text in a select box*/
  answerDate Date,
  answerNumeric INT(4),
  question_id INT(4) UNSIGNED NOT NULL,
  INDEX(question_id),
  FOREIGN KEY (question_id) REFERENCES Questions(question_id) ON DELETE CASCADE,
  anonuser_id INT(4) UNSIGNED,
  INDEX(anonuser_id),
  FOREIGN KEY (anonuser_id) REFERENCES Anonymous_Users(anonuser_id) ON DELETE CASCADE,
  PRIMARY KEY  (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for HTML Table
-- 
-- Desc: General purpose table for holding chunks of HTML
CREATE TABLE HTML(
  html_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  htmlText TEXT,
  name VARCHAR(200),
  PRIMARY KEY  (html_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for Newsletters_Categories Table
-- 
CREATE TABLE Newsletters_Categories (
  newslettercat_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  category char(255) NOT NULL,
  htmlNote_id INT(4) UNSIGNED,
  INDEX(htmlNote_id),
  FOREIGN KEY (htmlNote_id) REFERENCES HTML(html_id) ON DELETE CASCADE,
  PRIMARY KEY (newslettercat_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 
-- Structure for NewsLetters Table
-- 
CREATE TABLE NewsLetters(
  newsletter_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  fileName char(255) NOT NULL,
  letterName char(255) NOT NULL,
  filePath varchar(500) DEFAULT '/newsletters/', 
  publishDate Date NOT NULL,
  html_id INT(4) UNSIGNED,
  INDEX(html_id),
  FOREIGN KEY (html_id) REFERENCES HTML(html_id) ON DELETE CASCADE,
  htmlNote_id INT(4) UNSIGNED,
  INDEX(htmlNote_id),
  FOREIGN KEY (htmlNote_id) REFERENCES HTML(html_id) ON DELETE CASCADE,
  newslettercat_id INT(4) UNSIGNED NOT NULL, 
  INDEX(newslettercat_id),
  FOREIGN KEY (newslettercat_id) REFERENCES Newsletters_Categories(newslettercat_id) ON DELETE NO ACTION,
  PRIMARY KEY  (newsletter_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ALTER TABLE NewsLetters ADD COLUMN newslettercat_id INT(4) UNSIGNED NOT NULL; 
-- ALTER TABLE NewsLetters ADD INDEX(newslettercat_id); 
-- ALTER TABLE NewsLetters ADD FOREIGN KEY (newslettercat_id) REFERENCES Newsletters_Categories(newslettercat_id) ON DELETE NO ACTION;

-- 
-- Table structure for table Anonymous_Users
-- 
-- Desc: For users who want to remain anonymous when making comments, also used for signing up for a news letter subscription
CREATE TABLE  Anonymous_Users(
 anonuser_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,         /*user ID*/
 joinDate  DATE DEFAULT '1980-04-20',
 email  CHAR(200) UNIQUE NOT NULL,
 validated BIT DEFAULT 0,
 hash char(255),
 PRIMARY KEY  (anonuser_id)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- ALTER TABLE Anonymous_Users ADD COLUMN validated BIT DEFAULT 0;
-- ALTER TABLE Anonymous_Users ADD COLUMN hash CHAR(255);
-- ALTER TABLE Anonymous_Users CHANGE COLUMN anonuser_Id anonuser_id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT;

-- 
-- Table structure for table AnonymousUsers_NewsLettersCategories
-- 
-- Desc: Bridge table for uses subscriped to a news letter
CREATE TABLE  AnonymousUsers_NewsLettersCategories(
 anonusernewsletterscat_Id INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,      
 anonuser_id INT(4) UNSIGNED NOT NULL,
 INDEX(anonuser_id),
 FOREIGN KEY (anonuser_id) REFERENCES Anonymous_Users(anonuser_id) ON DELETE NO ACTION,
 newslettercat_id INT(4) UNSIGNED NOT NULL,
 INDEX(newslettercat_id),
 FOREIGN KEY (newslettercat_id) REFERENCES Newsletters_Categories (newslettercat_id) ON DELETE NO ACTION,
 PRIMARY KEY  (anonusernewsletterscat_Id)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- -------------------------------------------------------------------------------------------------------------------
-- ------------------------------------------------ PERMISSIONS ------------------------------------------------------
-- -------------------------------------------------------------------------------------------------------------------
CREATE USER 'phpuser'@'%' IDENTIFIED BY 'steve';
GRANT SELECT ON *.* TO 'phpuser'@'%';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.Anonymous_Users TO 'phpuser'@'%';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.AnonymousUsers_NewsLettersCategories TO 'phpuser'@'%';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.Users_Answers TO 'phpuser'@'%';

CREATE USER 'phpuser'@'localhost' IDENTIFIED BY 'steve';
GRANT SELECT ON *.* TO 'phpuser'@'localhost';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.Anonymous_Users TO 'phpuser'@'localhost';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.AnonymousUsers_NewsLettersCategories TO 'phpuser'@'localhost';
GRANT INSERT, UPDATE, DELETE ON BlueOceanDivers.Users_Answers TO 'phpuser'@'localhost';
-- GRANT INSERT, UPDATE ON BlueOceanDivers.NewsLetters TO 'phpuser'@'%';


-- -------------------------------------------------------------------------------------------------------------------
-- ------------------------------------------------ INSERT DATA ------------------------------------------------------
-- -------------------------------------------------------------------------------------------------------------------
INSERT INTO PADI_Level_Types(lvlTypes)
VALUES
('None'),
('Youth'),
('Open Water'),
('Adventure'),
('Specialty'),
('Professional'),
('Technical - TDI'),
('Technical - IANTD'),
('Technical - PADI'),
('Divers Alert Network');

INSERT INTO PADI_Levels(padiLevel, lvlType_id)
VALUES
('None', 1),
/* Youth */
('PADI Seal Team', 2),
('Bubblemaker',2),
/* Open Water */
('Discover Scuba Diving',3),
('Skin Diver',3),
('Open Water Diver',3),
('PADI Scuba Diver',3),
/* Adventure */
('Adventure Diver',4),
('Advanced Open Water Diver',4),
('Rescue Diver',4),
('Master Scuba Diver',4),
/* Professional */
('Divemaster',6),
('Assistant Instructor',6),
('Open Water Scuba Instructor',6),
('Specialty Instructor',6),
('Master Scuba Diver Trainer',6),
('IDC Staff Instructor',6),
('Master Instructor',6),
('Course Director',6),
/* Specialty */
('Enriched Air Nitrox',5),
('Peak Performance Buoyancy',5),
('Project AWARE',5),
('AWARE Coral Reef Conservation',5),
('Equipment Specialist',5),
('Night Diver',5),
('Drysuit Diver',5),
('Boat Diver',5),
('Deep Diver',5),
('Wreck Diver',5),
('Underwater Navigator',5),
('Underwater Photographer',5),
('Underwater Naturalist',5),
('Emergency First Response',5),
('Search & Recovery',5),
/* IANTD */
('Advanced Nitrox',8),
('Inspiration Rebreather Recreation Diver',8),
/* Divers Alert Network */
('Diving Emergency Managment Provider Program',10),
('Oxygen First Aid for Aquatic Emergencies',10),
('Advanced Oxygen First Aid for Scuba Diving Injuries',10),
('First Aid for Hazardous Marine Life Injuries',10),
('Automated External Defibrillators for Scuba Diving',10),
('On-Site Neurological Assessment for Divers',10),
/* Technical */
('Intro to Technical Diving',7),
('Advanced Nitrox',7),
('Decompression Procedures',7),
('Evolution Rebreather Recreation Diver',7),
('Inspiration Rebreather Recreation Diver',7);

INSERT INTO Courses (padiLvl_id, cost, duration, startDate )
    SELECT padiLvl_id, 0 as cost, 0 as duration, Now() as startDate
    FROM PADI_Levels;

INSERT INTO Surveys(surveyName, message, formName, action)
VALUES
('Diving Survey', 'Please take a moment and fill out our survey and help us better understand you and your needs.', 'fBodSurvey', 'act_survey'),
('Trivia Challenge', '<center>Answer a few questions and you could win a prize!<br/>Play the Trivia Challenge!</center>', 'fBodTrivia', 'act_survey');

INSERT INTO States (stateName, abriv)
VALUES
('',''),
('ALABAMA','AL'),
('ALASKA','AK'),
('AMERICAN SAMOA','AS'),
('ARIZONA','AZ'),
('ARKANSAS','AR'),
('CALIFORNIA','CA'),
('COLORADO','CO'),
('CONNECTICUT','CT'),
('DELAWARE','DE'),
('DISTRICT OF COLUMBIA','DC'),
('FEDERATED STATES OF MICRONESIA','FM'),
('FLORIDA','FL'),
('GEORGIA','GA'),
('GUAM','GU'),
('HAWAII','HI'),
('IDAHO','ID'),
('ILLINOIS','IL'),
('INDIANA','IN'),
('IOWA','IA'),
('KANSAS','KS'),
('KENTUCKY','KY'),
('LOUISIANA','LA'),
('MAINE','ME'),
('MARSHALL ISLANDS','MH'),
('MARYLAND','MD'),
('MASSACHUSETTS','MA'),
('MICHIGAN','MI'),
('MINNESOTA','MN'),
('MISSISSIPPI','MS'),
('MISSOURI','MO'),
('MONTANA','MT'),
('NEBRASKA','NE'),
('NEVADA','NV'),
('NEW HAMPSHIRE','NH'),
('NEW JERSEY','NJ'),
('NEW MEXICO','NM'),
('NEW YORK','NY'),
('NORTH CAROLINA','NC'),
('NORTH DAKOTA','ND'),
('NORTHERN MARIANA ISLANDS','MP'),
('OHIO','OH'),
('OKLAHOMA','OK'),
('OREGON','OR'),
('PALAU','PW'),
('PENNSYLVANIA','PA'),
('PUERTO RICO','PR'),
('RHODE ISLAND','RI'),
('SOUTH CAROLINA','SC'),
('SOUTH DAKOTA','SD'),
('TENNESSEE','TN'),
('TEXAS','TX'),
('UTAH','UT'),
('VERMONT','VT'),
('VIRGIN ISLANDS','VI'),
('VIRGINIA','VA'),
('WASHINGTON','WA'),
('WEST VIRGINIA','WV'), 
('WISCONSIN','WI'), 
('WYOMING','WY');

/* Drop all tables
drop table PADI_Level_Types;
drop table PADI_Levels;
drop table PADI_Level_Types;
drop table Courses;
drop table Images;
drop table Stories;
drop table States;
drop table Users;
drop table Surveys;
drop table Questions;
drop table Answers;
*/

INSERT INTO Images (fileName)
VALUES
('staff_nopic_sm.jpg'),
('clouds.jpg'),
('gradient_bg.jpg'),
('IMG_7433.JPG'),
('IMG_7559.JPG'),
('logo_large.gif'),
('logo_large.jpg'),
('logo_large2.GIF'),
('PADI5Star.jpg'),
('seafloor.jpg'),
('shadow.jpg'),
('Staff_Al_R_big.jpg'),
('Staff_Al_R_sm.jpg'),
('Staff_Beth_R (1).jpg'),
('Staff_Beth_R.jpg'),
('staff_Bob_H_Big.jpg'),
('Staff_Bob_Sm.jpg'),
('staff_brent_m_big.jpg'),
('staff_brent_m_sm.jpg'),
('Staff_Debbie_M_Big.jpg'),
('Staff_Debbie_M_Sm.jpg'),
('Staff_Derek_Packer_sm.jpg'),
('Staff_Guy_Rogers_big.jpg'),
('Staff_Guy_Rogers_sm.jpg'),
('staff_jim_c_big.jpg'),
('staff_jim_c_sm.jpg'),
('Staff_Jim_E_big.jpg'),
('Staff_Jim_E_Sm.jpg'),
('staff_kurt_h_big.jpg'),
('staff_kurt_h_sm.jpg'),
('staff_louise_m_big.jpg'),
('staff_louise_m_sm.jpg'),
('staff_mike_e_big.jpg'),
('staff_mike_e_sm.jpg'),
('Staff_Mike_N_Big.jpg'),
('Staff_Mike_N_Small.jpg'),
('staff_mike_r_big.jpg'),
('staff_mike_r_sm.jpg'),
('staff_nopic_big.jpg'),
('staff_pat_e_big.jpg'),
('staff_pat_e_sm.jpg'),
('staff_Roger_H_Big.jpg'),
('Staff_Roger_H_Sm.jpg'),
('Staff_Ross_sm (1).jpg'),
('Staff_Ross_sm.jpg'),
('staff_Sarah_N_big.jpg'),
('staff_Sarah_N_sm.jpg'),
('staff_terry_s_big.jpg'),
('staff_terry_s_sm.jpg'),
('staff_tim_f_big.jpg'),
('staff_tim_f_sm.jpg'),
('Staff_Tom_R_Big.jpg'),
('Staff_Tom_R_big2.jpg'),
('Staff_Tom_R_Sm.jpg'),
('sunlight.jpg'),
('water_edge.jpg');

INSERT INTO Stories(story)
VALUES
('No story.'),
('<p>Blue Ocean Divers is committed to providing you the best educational experience using the proven PADI system of diver education.</p>
<p>We are your PADI 5 Star (IDC) Instructor Development Center for the Southern Tier. This means that we can help you with your snorkeling/diving 
goals. If your goal is to be a better snorkeler or to start your diving career or take your diving to the next level, Blue Ocean Divers is here to 
assist you with each step. We can even work with you to become a PADI Scuba Diving Instructor if that is your goal.</p> 
<p>Blue Ocean Divers is your one stop shop for all of your dive related needs. Whether it is a need for new equipment, equipment service, 
help with local diving or dive travel and of course training, Blue Ocean Divers is here to serve you. We have the industry leading product 
lines, at best value pricing for all your equipment needs. We are continually going to manufacturer\'s seminars and classes to advance our 
education in equipment service. We work hard to stay current on all equipment service bulletins and changes in equipment service techniques.</p>');

INSERT INTO Users(firstName, lastName, story_id)
VALUES
('Blue Ocean Divers','No Name',  LAST_INSERT_ID());

INSERT INTO Stories(story)
VALUES
('<p>I\'ve been diving for 13 years and have dove and//or snorkeled in Lake Michigan, the St. Lawrence River, Hawaii, west coast of 
    Florida, the Florida Keys, Bahamas, Grand Cayman, Cayman Brac, Curacao, Bonaire, and Roatan. What I enjoy most about diving is 
    weightlessness and the quiet. Yes, I use an open circuit system but I still think about it as quiet. There are so many critters in 
    the ocean and fresh water if you take the time to see them. Come see what I see!</p>
<p>Dive Safely and Have Fun</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Patti','Elsner', 'The Queen', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Rescue%'), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%pat%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Answer_Types(answerType)
VALUES
('text'),
('password'),
('radio'),
('checkbox'),
('submit'),
('textarea'),
('select'),
('select multiple');

INSERT INTO Questions(question,survey_id,answerType_id)
VALUES
('What year were you 1st certified?',1,1),
('When was your last dive? (yyyy or mm/yyyy)',1,1),
('Where was your last dive?',1,1),
('How many total dives have you done?',1,1),
('These photosynthesizers are thought to account for about 25% of all photosynthetic biomass on earth:',2,3),
('What are the two major criteria you need to consider when selecting gear?',2,3),
('Name:',2,1),
('Email:',2,1);

INSERT INTO Answers(answerText, answerValue, question_id)
VALUES
('bi-atoms','bi-atoms',5),
('diatoms','diatoms',5),
('chlorophyll atoms','chlorophyll atoms',5),
('bia-dia-chloro-tria-ringa-ding-dings','bia-dia-chloro-tria-ringa-ding-dings',5),
('Style & comfort','Stylecomfort',6),
('Fit & style','Fitstyle',6),
('Comfort & Safety','ComfortSafety',6),
('Color coordination','Color coordination',6);

INSERT INTO Stories(story)
VALUES
('<p>They tell me I\'m the boss. But I go by "Mach10" Mike. I have certified over 650 divers in at all levels of training up to and including 
Assistant Instructor. I am currently a PADI Master Instructor.</p>
<p>The list of PADI specialty certifications I can issue include Deep, Underwater Photographer, Underwater Naturalist, Peak Performance Buoyancy, 
Equipment Specialty, Dry Suit, Wreck, Underwater Navigator, Boat, Project Aware, Night Diver, Enriched Air Diver, AWARE Coral Reef Conservation 
Specialty, Drift Diver, Multilevel Diver, Dolphin Rebreather, Care for Children w/AED, Tec Rec Trimix Blender, Digital Underwater Photographer, 
Underwater Videographer and I am a PADI Emergency First Responder Instructor. I am a DAN (Divers Alert Network) Oxygen Provider Instructor.</p>
<p>My teaching repertoire has expanded into Technical Diving with teaching credentials from IANTD and TDI for Advanced Nitrox, Inspiration and 
Evolution closed circuit rebreathers.</p>
<p>My logbook has over 1,600 dives in it and I dive for two reasons:
<ol>
<li>To train divers.<br/> I truly enjoy my role as instructor and take great pride and satisfaction in helping people discover the wonders of the underwater world. Some of my best memories are from comments made by first time divers after what I thought was just an OK dive. Their excitement, wonder and amazement always gives me pride in being able to help them experience this wonderful sport.</li>
<li>To capture the underwater world digitally.<br/>My second passion is underwater videography and photography. If I am diving without students I invariably will have a video camera in my hands. I have yet to be published but I take videos & pictures for my own enjoyment. All of the trip videos and underwater shots that are on my website are my work.</li>
</ol></p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Mike','Elsner', 'Mach 10 Mike', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Master Instructor%'),
  (SELECT image_id FROM Images WHERE fileName LIKE '%mike_e%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story)
VALUES
('<p>My wife and I went on our first Caribbean cruise in March of 2006. She pointed out that the ship had a \"Discover SCUBA\" 
    excursion in Grand Cayman and she thought I might like to try it. What she didn\'t know was that submerging me for an extended 
    period of time would release the fish hidden inside me. I came back from the dive and made the statement, \"If we ever come back to the Caribbean 
    I will be a certified diver.\" Little did we know that we would be back the following Christmas. I was certified and had definitely 
    caught the diving bug. Two years later, I\'ve been on 100+ dives on ten Caribbean islands, the Thousand Islands, Dutch Springs, and 
    the ever-famous Quaker Lake, and I\'m now an Instructor. I guess it just ties in with my other adventurous activities as a volunteer 
    firefighter/EMT and an active member of the National Ski Patrol. For all these activities, I also hold Instructor ratings.</p>
<p> My Accomplishments: 
<ul> <li>PADI Open Water Oct 2006</li>
<li>PADI Advanced June 2007 </li>
<li>DAN Oxygen Provider Jan 2008 </li>
<li>PADI Oxygen Provider Jan 2008 </li>
<li>PADI Rescue Diver Apr 2008 </li>
<li>PADI Night Diver Apr 2008 </li>
<li>PADI Nitrox Diver Apr 2008 </li>
<li>PADI Wreck Diver Jun 2008 </li>
<li>PADI Search and Recovery Jul 2008 </li>
<li>PADI Master Diver Jul 2008 </li>
<li>PADI Divemaster Jul 2008 </li>
<li>PADI Assistant Instructor Nov 2008 </li>
<li>PADI Open Water Instructor Dec 2008 </li>
<li>DAN DEMP Instructor Feb 2009 </li>
<li>EFR Instructor Feb 2009 </li>
<li>Deep Diver Instructor</li>
<li>Boat Diver Instructor</li>
<li>Nitrox Instructor</li>
<li>Dry Suit Instructor</li>
<li>Wreck Diver Instructor</li>
<li>Master SCUBA Diver Trainer</li>
<li>PADI IDC Staff Instructor Aug 2010</li>
</ul>
</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Bob','Hamilton', 'Bob The Fish', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%IDC%Staff%Instruc%'), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%Bob_H%Big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story)
VALUES
('<p>I started Diving in 1969 to keep the city pool clean. Because I was a city employee, managing the pool, I was able to be 
on the underwater recovery team for the fire department until 1974. I quit diving when I got married and had family 
responsibilities, sold my tank and equipment. On a cruise in Sept 2005 Randy and I did some snorkeling in Haiti. We had a 
great time but Randy said she could not stay down long enough to look at all the fun stuff. Well I said I know a way to 
stay down longer. And the rest is history. I signed us up for our Open Water course and as you can see below 
never looked back. I love to help and look forward to assisting in the classes and open waters.
<p>My favorite dive sites include: Curacao, St Thomas, St Martin, Aruba, Florida Keys, 1000 Islands, Skaneateles Lake, 
and of course, Dutch Springs.</p>
<p>I am getting into underwater photography and love learning and experimenting. I have seen many wonderful things underwater.
On the last trip to Curacao we saw a dimpled puffer (Golf Ball). It was first spotted by Kim Elsner. It was strange to 
find one at the Santa Curiz dive site. Along with that I found a 50 Caliber shell casing.</p>
<p>Diving is fun and an adventure that one needs to experience once in a life time. To float along at 40-60 
feet looking at all the beauty is a great feeling. To imagine what it was like or how it happened is continual learning. 
Look forward to see you under water or in class.</p>
</p>
<p>
My diving accomplishments: 
<ul>
<li>PADI Open Water - 05/2006 </li>
<li>PADI Advanced Open Water- 06/2006</li>
<li>PADI Enriched Air Diver - 08/2006</li>
<li>PADI Specialty Diver - Deep Diver - 09/2006</li>
<li>PADI Specialty Diver - Wreck Diver - 09/2006</li>
<li>PADI Specialty Diver - Equipment Specialist - 11/2006</li>
<li>PADI Specialty Diver - Boat Diver - 12/2006</li>
<li>PADI Specialty Diver - Oxygen Provider - 02/2007</li>
<li>PADI Rescue Diver - 05/2007</li>
<li>PADI Master Scuba Diver - 05/2007</li>
<li>PADI Specialty Diver - Digital Underwater Photographer - 11/2007</li>
<li>PADI Divemaster - 04/2008</li>
<li>PADI Specialty Diver - Search and Recovery - 07/2008</li>
<li>PSI - Visual Cylinder Inspector - 09/2008</li>
<li>PSI - Eddy Current Technician - 09/2008</li>
<li>PSI - Cylinder Hazmat Trainer - 09/2008</li>
<li>PADI Assistant Instructor - 11/2008</li>
<li>PADI Open Water Instructor - 11/2008</li>
<li>Emergency First Responder Instructor - 02/2009</li>
<li>Emergency First Responder Care for Children - 02/2009</li>
<li>PADI Specialty Instructor - Boat Diver - 02/2009</li>
<li>PADI Specialty Instructor - Deep Diver - 02/2009</li>
<li>PADI Specialty Instructor - Digital UW Photography - 02/2009</li>
<li>PADI Specialty Instructor - Drift Diver - 02/2009</li>
<li>PADI Specialty Instructor - Enriched Air Diver - 02/2009</li>
<li>PADI Specialty Instructor - Equipment Specialty - 02/2009</li>
<li>PADI Specialty Instructor - Night Diver - 02/2009</li>
<li>PADI Specialty Instructor - Search and Recovery - 02/2009</li>
<li>PADI Specialty Instructor - UW Navigation - 02/2009</li>
<li>PADI Specialty Instructor - Wreck Diver - 02/2009</li>
<li>PADI Tec Rec Tri Mix Blender - 6/2009</li>
<li>PADI Master Scuba Diver Trainer - 10/2009</li>
<li>PADI IDC Staff Instructor - 10/2010</li>
</ul>
</p>
');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Al','Rimington', '', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%IDC%Staff%Instructor%'), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%Al_R%big%'),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story)
VALUES
('<p>I\'m Jim Crisanti, a PADI Master Scuba Diver Trainer, TDI Technical Instructor, and Emergency First Response Instructor 
    at Blue Ocean Divers. I have been diving since 1997, getting my start with Ron Witte of Sea Fan Scuba. I\'ve been with 
    Mike and Pat at Blue Ocean Divers since nearly the beginning of the Dive Center\'s existence.</p>
<p>I teach both the Blue Ocean Divers community classes as well as work with the Binghamton University SCUBA Program. You\'ll 
find me teaching everything from Open Water classes, to PADI Specialties, to Technical courses.</p>
<p>My diving history is quite varied from the fish and reefs in the warm blue waters of the Florida Keys and Caribbean
islands, the WWII wrecks off the Atlantic coastline, to the cold clear water of the Finger Lakes in January. My favorite dives 
involve wrecks (usually pretty deep) with a digital or video camera in my hands. Most of my diving involves double tanks and 
sling bottles. Of course one of my favorite places to dive is the St. Lawrence River due to its clarity, warm temperature, abundance of 
(real) wrecks and closeness to home.
</p>
<p>When not in the water, I\'m usually at my \"real job\", playing with my kids, working with the Broome County Water Rescue 
Dive Response Team, or off on a mountain someplace on my mountain bike, snowboard, or in my Jeep.</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Jim','Crisanti', 'Gentleman Jim', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Master%Scuba%Diver%Trainer%'), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%jim_c%big%'),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story)
VALUES
('<p>When I\'m not working with students, you will find me diving with a camera in my hand. Photography has been 
a passion of mine since I was ten years old, and my dad first put his SLR in my hands. </p>
<p>In 1994, I earned my open water dive certification, which enabled me to take that passion to the next level underwater photography. 
As far as I\'m concerned, gliding underwater is the most peaceful and beautiful place on the planet. Some of my 
favorite types of diving include night diving and wreck diving.</p>
<p>I\'ve glimpsed many incredible sights on my 
dives to the shipwrecks of the St. Lawrence River, the reefs of Key Largo and Grand Cayman, and in the caverns of 
Florida. There are so many amazing and interesting places to explore; no two dives are ever the same. Even dives to 
the same site are never quite identical. I always find new sea life to observe and photograph when I revisit my old 
favorites. In 2004, I earned my dive master certification, and now I am able to share my love of the water with students. 
I can\'t wait to see what new adventures and experiences this dive season will bring.</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Debbie','Miller', '?', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Master%Scuba%Diver%Trainer%'), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%Debbie_m%Big%'),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('<p>In 1988, with a gift certificate from my wife, I became an open water diver and then an advanced 
open water diver. It was love at first splash! I dove whenever and wherever I could: beautiful reefs, fascinating local wrecks, lakes 
and quarries. Finally in 2001 I became serious about rising through the professional ranks and became an instructor in 2003. It is a
true joy to be able to pass on my love of the sport to others.</p>
<p>
As a kid living near the beach in Florida I used to spend every possible minute snorkeling around the jetties and dreaming of seeing even 
more of the beautiful underwater world. Becoming an open water scuba diver allowed that dream to come true. The real underwater world is 
much more wonderful and enlightening than I had ever dreamed. Every dive brings something new and renews my sense of wonder of that world.</p>
<p>
In the coming year I hope to certify my 100th student. I also hope to complete my 400th dive; that may happen on our upcoming trip this summer 
to Truck Lagoon and Palau.</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Kurt','Henninger', 'Pool Diver', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE 'Open Water Scuba Instructor' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%kurt_h%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);


INSERT INTO Stories(story) VALUES ('<p>
Hi Folks, <br/>
As a kid I watched Sea Hunt on television and dreamed about the day I would dive too! Back then there were few female divers so it seemed it would stay a dream. After a snorkeling excursion in Montego Bay, I knew I had to go for it. My first certification level was a PADI Open Water Diver in 1996. I was hooked! Diving became a passion. All I wanted to do was learn more about diving and improve my skills. Since then I steadily progressed through the ranks becoming a PADI Open Water Instructor in November of 2008. I was proud to be The Lady, with The Tramps, through my instructor training. I dive about thirty-plus times a year in both salt and fresh water. My favorite diving is in the warm waters off Bonaire but Skaneateles Lake, the St. Lawrence River, and Key Largo are wonderful dives as well. I have been lucky enough to have done a shark dive, a dolphin dive and some wreck dives that were awesome. When not diving you might find me helping out at the dive center. If I can\'t be in the water, the shop is the next best thing. I definitely qualify as a diving \"finatic\". I love seeing all of you at the dive center and swapping stories with other divers. Wherever the next adventure is, I am packed and ready to go. If I can\'t be there I want to hear about yours. On the surface I have two daughters and five grandchildren, my other passion. When I can not be with them I will be on the boat with my husband and his dog on one of the Finger Lakes. I will close with this thought, \"I can\'t belive I came this far!\" If I can do it so can you.
</p>
<p>
Never stop learning!
</p>');


INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Louise','Mosher', 'Saint Louise', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Open%Water%Instructor%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%louise_m%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('<p>
Hello Divers,<br/>
I have always loved, boats, fishing and anything involving water. My diving experience started in June of 1996 when 
I earned my PADI Open Water C-card. I continued my training through the years and became a PADI Open Water Instructor in 2008. 
Without a doubt it was my most rewarding "Cert". I was fortunate enough to share the experience with five of the best dive buddies 
on the planet, and look forward to working and teaching with "The Lady and the Tramps". I average about 35 dives a year, not counting 
confined water training. I have been fortunate enough to experience about half of these in warm ocean waters including Bonaire, 
the Bahamas and the Florida Keys. In 2003 I bought the best dive boat in the world, or at least the best one I could afford, the 
In-Depth. From Memorial Day through Labor Day Weekend you might find my wife and I at Seneca or Skaneateles Lakes under the watchful 
eye of First Mate Emmett, The Aquatic Airedale. I dabble some in video and still photography. While far from being a threat to Cathy 
Church or our own local favorite underwater photographer, I really enjoy underwater photography. It provides the opportunity to share 
my experience with non diving family and friends. Diving is a great sport. For me it has opened doors to adventure, travel, and most 
importantly new friends. Under the Blue, we are all Brothers and Sisters in Neoprene. Dive more, Dive more often, but never Dive over your head!</p>
');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Brent','Mosher', 'Scuba Guard Brent', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Open%Water%Instructor%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%brent_m%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('<p>I had wanted to learn to dive since I was very young. I finally had my chance to 
    a take a discover scuba class with my wife on our honeymoon in 2006 in St. Lucia. My wife was slightly reluctant to 
    try diving but she decided to give it a shot. I was a little nervous and consumed a lot of air on our dive. My wife 
    looked like a champ and I was hoping already to be able to return home and take a certification course. Upon surfacing my 
    wife simply had one thing to say "Don\'t ask me to ever do that again." My SCUBA dreams faded and I did not think about it 
    again for another two years.
</p>
<p> I started finding out that some of our friends were divers and I wanted to get some more information. It was something 
that I felt that I had to do for myself even if my wife felt that she could not. I went to Blue Ocean Divers to find out 
pricing for the course and meet the staff. I took the information and my wife asked me about it and made me a deal. She would 
take the course with me and if she was not comfortable after getting certified, I could dive when I wanted but she would no longer 
dive. That was fair I thought.
</p>
<p>
That began my career in diving and I have loved every minute of recreational diving and the classes that I have taken to further my education.
</p>
<p>
I became an instructor in 2010 and enjoy working with community students and students at Binghamton University.
</p>
<p>
As for my wife, she now has her professional Divemaster rating and can pretty much out dive me any day of the week. 
Let this be a lesson to all of you that might say "I can\'t\" or \"diving is too difficult for me to do". You might surprise 
yourself and find that you were born to be a diver.
</p>
<p>
My Accomplishments:
<ul>
<li>PADI Open Water - 08/2008 </li>
<li>PADI Advanced Open Water - 09/2008 </li>
<li>PADI Enriched Air Diver - 09/2009 </li>
<li>PADI Rescue Diver - 05/2009</li>
<li>PADI Specialty Diver - Peak Performance Buoyancy - 08/2009 </li>
<li>PADI Specialty Diver - Deep Diver - 08/2009 </li>
<li>PADI Specialty Diver - Night Diver - 08/2009</li>
<li>PADI Specialty Diver - Digital Underwater Photographer - 08/2009</li>
<li>PADI Master Scuba Diver - 08/2009</li>
<li>PADI Divemaster - 09/2009 </li>
<li>PADI Drysuit Diver - 11/2009</li>
<li>PADI Equipment Specialist - 01/2010</li>
<li>DAN- Diving Emergency Management Provider - 02/2010</li>
<li>DAN- On-Site Neurological Assessment for Divers - 02/2010</li>
<li>Emergency First Response Instructor - 8/2010 </li>
<li>PADI Assistant Instructor - 08/2010</li>
<li>PADI Open Water Scuba Instructor - 08/2010</li>
<li>TDI Advanced Nitrox - 09/2010</li>
<li>TDI Decompression Procedures - 10/2010</li>
</ul>
</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Mike','Nutter', '', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Open%Water%Instructor%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%Mike%N%small%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('<p>I was certified for Open Water in October 1987 and immediately signed up for the Advanced Open Water 
training (Adventures in Diving). I was certified for AOW in November 1987. After getting some dives under my (weight) belt (sorry... a little 
dive humor) I continued my dive training and received my Rescue Diver Certification in July 1988. Spent some time as a safety diver for scuba 
classes before becoming a Certified PADI Dive Master in October 1988.</p>
<p>I worked as a Dive Master for Scuba Sports and Sea Fan Scuba until coming to Blue Ocean Divers. After 10 Years as a Dive Master, 
"Mach 10" Mike talked me into becoming an Assistant Instructor (Thanks Mike!).
</p>
<p>It\'s been 8 years since I earned my Assistant Instructor rating so it was time for some more continuing educaton. I am now a 
PADI Open Water Scuba Instructor! I can\'t wait to bring the exciting world of diving to new students.
</p>
<p>I really enjoy working with students and find it very rewarding to see the progress from week to week. It\'s always so cool to see 
someone who starts out a little nervous, become a confident diver by the end of training! The vast majority of my dives have been with students... 
But I do manage to do some diving for myself once in a while.
</p>
<p>My favorite type of Diving:<br/>
Deep Diving and Wreck Diving</p>
<p>
Best Dives: The USCG Duane, Key Largo, Florida (Lots to see, Great Wreck Dive)<br/>
Molokini, Hawaii (Drift dive on the outside of the crater; Shallow Lagoon on the inside)
</p>
<p>
Diving Turn Offs:<br/>
Cold water - I\'m a W.I.M.P. (Why Inflict More Pain) so I wear a Drysuit<br/>
Zebra Muscles (Yes, there\'s a story to that...) 
</p>
<p>
If you\'ve ever had even the slightest interest in diving, all I can say is "Try it...You\'ll Like It"!! 
After All, it\'s... No Sweat</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Terry','Stockdale', 'No Sweat Terry', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Open%Water%Instructor%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%terry_s%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('Mr. Stealth is as mysterious as his nickname. Tim has been certified since 1994 and really likes the piece and quite of the underwater world. He has almost 500 dives in his logbook and he is enjoying learning to take better still and video Images underwater.


He will admit his favorite dive is the USS Dwayne off of Key Largo, FL. Mr. Stealth is also mysterious.');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Tim','Ford', 'Mr. Stealth', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Assistant%Instructor%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%tim_f%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);


INSERT INTO Stories(story) VALUES ('I just completed my Divemaster training and very excited about helping folks discover Scuba Diving. I\'ll get Mike my Bio real soon.');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Jim','Estelle', '?', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%jim_e%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);

INSERT INTO Stories(story) VALUES ('Coming soon.');
INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('John','Garvey', '', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%no%pic%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);


INSERT INTO Stories(story) VALUES ('I started swimming when I was 6 years old. Growing up I was a lifeguard and swimming instructor’s aide at the Endicott Boy’s Club along with membership on the swim team at the Endicott Boys Club. 
Scuba diving was always an interest for me. I’m currently a PADI Divemaster with Medic First Aid and D.A.N. Oxygen Provider certifications. I also hold Equipment and Drysuit Specialty certifications. I enjoy diving the St. Lawrence River and try to get to the beautiful waters of the Caribbean at least once a year.');INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Roger','Holmes', 'Sonar', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%roger%h%big%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );



INSERT INTO Stories(story) VALUES ('Back in 2000 when my son, Steven, suggested we take diving lessons, I never imagined I would become a divemaster. In March of 2007 I realized my goal of earning my divemaster certification. I also became the third member of the three ugly divemasters! Join me on the Thursday night dives on Skaneateles Lake. My favorite dive location is the mighty St. Lawrence River holding over 200 wrecks. In addition to my divemaster certification, I hold a NY State Public Vessel Captains license and a USCG 50 Ton Masters (Captains) license. See you on the bottom!');INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Ross','Lazarek', 'Captain', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%ross%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );


INSERT INTO Stories(story) VALUES ('Hello, I wanted to tell you a little about myself. 5 years ago my Dad (Tom R.) signed me up for a discover scuba. At the time I had no interest in scuba diving even though as a child I loved the water and was always taking some sort of swimming lesson. From the moment I took my first breath underwater I was hooked! Since then I have always been trying to better myself. My wife and I, along with our daughter, have been on a few dive vacations to Key Largo, Curacao, The St. Lawrence, and just like everyone else Quaker Lake. I want you to know that I am here to help you with any questions you may have. See you on the bottom!');
INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Derek','Packer', '?', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%derek%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );



INSERT INTO Stories(story) VALUES ('<p>
I never would have predicted that my name would be on listed under “Staff” on this website! For anyone out there who is considering learning to scuba dive, or advancing in their scuba diving certifications, but has “reasons” why they can’t/shouldn’t, find me – we’ll talk. I started out with a really long, organized, rational, responsible, logical list of why diving wasn’t for me… :-)
</p>
<p>
My husband, Mike, and I started diving not long ago, and we absolutely love it. It has changed our lives for the better in many ways. I did have to be coerced, talked down, etc a few times at the start, but as soon as I realized that my body loves being underwater, and that the underwater world is AMAZING, it was game on! Scuba diving reminds you that you can conquer fears, and you come out prouder and fiercer when you take on a challenge (…after challenge, after challenge, after challenge…). 
</p>
<p>
Confidence is everything.
</p>
<p>
The staff at Blue Ocean Divers are all incredibly supportive, and I am proud to call them my mentors and my friends. The experience level of this group is amazing. When you decide to dive with us, you are in very good hands. 
</p>
<p>
My accomplishments:
<ul>
<li>PADI Open Water - 08/2008 (Dutch Springs)</li>
<li>PADI Advanced Open Water - 09/2008 (St. Lawrence River)</li>
<li>PADI Enriched Air Diver - 09/2008 (St. Lawrence River)</li>
<li>PADI Rescue Diver - 05/2009 (Dutch Springs)</li>
<li>PADI Specialty Diver - Peak Performance Buoyancy - 08/2009 (Roatan, Honduras) </li>
<li>PADI Specialty Diver - Deep Diver – 08/2009 (Roatan, Honduras) </li>
<li>PADI Specialty Diver - Night Diver – 08/2009 (Roatan, Honduras) </li>
<li>PADI Specialty Diver - Digital Underwater Photographer – 08/2009 (Roatan, Honduras) </li>
<li>PADI Master Scuba Diver - 08/2009 (Roatan, Honduras) </li>
<li>PADI Drysuit Diver - 06/2010 (Dutch Springs)</li>
<li>PADI Divemaster - 08/2010 (Dutch Springs)</li>
</ul>
</p>');INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Sarah','Nutter', 'Speedy', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%sarah%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );


INSERT INTO Stories(story) VALUES ('<p>My interest in diving goes back to when I saw my first episode of "Sea Hunt" and 
found a new hero, Mike Nelson ("There was only one way to do it - under water!"). But it was not until I reached 50 that 
I was finally able to realize my childhood dream of becoming a SCUBA diver. Beyond the adventure of it though, diving, 
for me, is fundamentally another avenue for my life-long passion of exploring and learning new things (maybe That\'s why 
Blue Ocean Divers hung the “Analyzer” moniker on me). Whether it\'s developing an integrated cockpit for a special operations 
helicopter at Lockheed Martin, towing and flying sailplanes over Harris Hill in Elmira, or singing master choral works with 
the Binghamton Downtown Singers, the pull for me has a constant theme - the opportunity to learn something new. Achieving 
Divemaster certification and becoming a Blue Ocean Divers staff diver is another step in that process that I hope to continue 
for the rest of my life. And my most recent certification as an Ice Diver demonstrated again to me that there\'s always something 
new to learn and do (as Mike Nelson used to say) "under water". Here\'s hoping you\'ll come take that plunge into a whole 
new world of experience, fun, adventure, and learning, with me and the rest of the Blue Ocean Divers staff.</p>');

INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
VALUES
('Mike','Randolph', 'Mr. Analyst', 
  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
  (SELECT image_id FROM Images WHERE fileName LIKE '%mike_r%big%' LIMIT 1),
  (SELECT LAST_INSERT_ID())
);
               




INSERT INTO Stories(story) VALUES ('<p>Hello, and welcome to the wondrous world of SCUBA diving. My experience began at about the age of twelve when my father took a SCUBA class as a P.E. requirement for college. One day while on excursion on Seneca Lake he allowed me to play in the shallow waters of a quiet cove with the remains of his scuba cylinder and I was hooked. My first open water dive class was also in college and like so many of my fellow college students this was my last opportunity diving. That is until I could afford the time and money necessary to enjoy the experience. In 1997 my family and I moved back home and I took a Job as a Paramedic with Greater Valley EMS in Sayre Pa. It’s here that I was able to return to diving and joined their underwater search and recovery team. After graduating from Physician Assistant School in 2004 I could now pursue scuba diving as never before. 
</p>
<p>
The first item of business, in 2006, was to repeat my open water training which is when I was first introduced to the beauty of the St Lawrence River. However, it did not take long to find out that my diving was quite limited and Advanced Open Water was just around the bend. With the diversity of the wrecks in this area and increased depths came decreased temperatures and bottom time which meant Advanced Nitrox and a dry suit were a must. All through out these classes the one person I admired the most was the Dive Master. It was the Dive Master who was the one I could look up to, approachable, calm, and reassuring the person whom I wanted to emulate my skills after and in 2009 I achieved this milestone. 
</p>
<p>
The next phase of my diving experience has now begun, Technical Diving. In addition to obtaining my certification as a Dive Master I purchased and completed training on the Inspiration Re-breather with Advanced Nitrox. In the years to come I look forward to exploring new depths and seeing new sights as a re-breather technical diver. In addition, as a Dive Master and I hope to embellish the same characteristics as the people who I looked up to as a student. I look forward to seeing you as a student and fellow explorer.
</p>');INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Guy','Rogers', '?', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%Divemaster%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%guy%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );




INSERT INTO Stories(story) VALUES ('<p>
As the volunteer Publicity Director for Blue Ocean Divers, I plan to help inform the public of the great training programs and dive trips available here at Blue Ocean Divers.
</p>
<p>
While not a scuba diver, I love to snorkel. My husband, Tom, a new instructor, and I especially enjoy traveling on scuba trips with Blue Ocean Divers to exotic places. Three of our kids scuba dive, as well as one of our granddaughters so far. When not at the dive shop, I\'m showing my driving ponies and spoiling my grandchildren.
</p>');INSERT INTO Users(firstName, lastName, nickName, padiLevel_id, image_id, story_id)
                                VALUES
                                ('Beth','Rieselman', '', 
                                  (SELECT padiLvl_id FROM PADI_Levels WHERE padiLevel LIKE '%none%' LIMIT 1), 
                                  (SELECT image_id FROM Images WHERE fileName LIKE '%beth%' LIMIT 1),
                                  (SELECT LAST_INSERT_ID())
                                );

UPDATE Users set isStaff = 1; -- This is a latter add on, all above members are staff anyway

UPDATE Courses set cost = '225', duration = '20', startDate = '2010-12-10' where course_id = 2;

UPDATE Courses set cost = '25', duration = '2', startDate = '2010-12-10' where course_id = 3;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 4;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 5;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 6;

UPDATE Courses set cost = '175', duration = '13', startDate = '2010-12-10' where course_id = 7;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 8;

UPDATE Courses set cost = '275', duration = '15', startDate = '2010-12-10' where course_id = 9;

UPDATE Courses set cost = '350', duration = '25', startDate = '2010-12-10' where course_id = 10;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 11;

UPDATE Courses set cost = '595', duration = '50', startDate = '2010-12-10' where course_id = 12;

UPDATE Courses set cost = '15000', duration = '60', startDate = '2010-12-10' where course_id = 13;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 14;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 15;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 16;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 17;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 18;

UPDATE Courses set cost = '-1', duration = '0', startDate = '2010-12-10' where course_id = 19;

UPDATE Courses set cost = '100', duration = '5', startDate = '2010-12-10' where course_id = 20;

UPDATE Courses set cost = '50', duration = '4', startDate = '2010-12-10' where course_id = 21;

UPDATE Courses set cost = '50', duration = '2', startDate = '2010-12-10' where course_id = 22;

UPDATE Courses set cost = '50', duration = '6', startDate = '2010-12-10' where course_id = 23;

UPDATE Courses set cost = '100', duration = '12', startDate = '2010-12-10' where course_id = 24;

UPDATE Courses set cost = '140', duration = '24', startDate = '2010-12-10' where course_id = 25;

UPDATE Courses set cost = '100', duration = '12', startDate = '2010-12-10' where course_id = 26;

UPDATE Courses set cost = '200', duration = '24', startDate = '2010-12-10' where course_id = 27;

UPDATE Courses set cost = '200', duration = '24', startDate = '2010-12-10' where course_id = 28;

UPDATE Courses set cost = '150', duration = '12', startDate = '2010-12-10' where course_id = 29;

UPDATE Courses set cost = '125', duration = '12', startDate = '2010-12-10' where course_id = 30;

UPDATE Courses set cost = '100', duration = '12', startDate = '2010-12-10' where course_id = 31;

UPDATE Courses set cost = '95', duration = '4', startDate = '2010-12-10' where course_id = 32;

UPDATE Courses set cost = '200', duration = '24', startDate = '2010-12-10' where course_id = 33;

UPDATE Courses set cost = '350', duration = '16', startDate = '2010-12-10' where course_id = 34;

UPDATE Courses set cost = '1500', duration = '40', startDate = '2010-12-10' where course_id = 35;

UPDATE Courses set cost = '350', duration = '8', startDate = '2010-12-10' where course_id = 36;

UPDATE Courses set cost = '85', duration = '4', startDate = '2010-12-10' where course_id = 37;

UPDATE Courses set cost = '85', duration = '4', startDate = '2010-12-10' where course_id = 38;

UPDATE Courses set cost = '85', duration = '4', startDate = '2010-12-10' where course_id = 39;

UPDATE Courses set cost = '85', duration = '4', startDate = '2010-12-10' where course_id = 40;

UPDATE Courses set cost = '85', duration = '4', startDate = '2010-12-10' where course_id = 41;

UPDATE Courses set cost = '200', duration = '16', startDate = '2010-12-10' where course_id = 42;

UPDATE Courses set cost = '350', duration = '16', startDate = '2010-12-10' where course_id = 43;

UPDATE Courses set cost = '400', duration = '16', startDate = '2010-12-10' where course_id = 44;

UPDATE Courses set cost = '1500', duration = '40', startDate = '2010-12-10' where course_id = 45;

UPDATE Courses set cost = '1500', duration = '40', startDate = '2010-12-10' where course_id = 46;

UPDATE Courses set cost = '750', duration = '72', startDate = '2010-12-10' where course_id = 47;

INSERT INTO NewsLetters (fileName,letterName,publishDate,newslettercat_id )
VALUES
('200712.pdf', 'December 2007', '2007-12-01', 1),
('200801.pdf', 'January 2008', '2008-01-01', 1),
('200802.pdf', 'Febuary 2008', '2008-02-01', 1),
('200803.pdf', 'March 2008', '2008-03-01', 1),
('200804.pdf', 'April 2008', '2008-04-01', 1),
('200805.pdf', 'May 2008', '2008-05-01', 1),
('200806.pdf', 'June 2008', '2008-06-01', 1),
('200807.pdf', 'July 2008', '2008-07-01', 1),
('200808.pdf', 'August 2008', '2008-08-01', 1),
('200809.pdf', 'September 2008', '2008-09-01', 1),
('200810.pdf', 'October 2008', '2008-10-01', 1),
('200811.pdf', 'November 2008', '2008-11-01', 1),
('200812.pdf', 'December 2008','2008-12-01', 1),
('200901.pdf', 'January 2009', '2009-01-01', 1),
('200902.pdf', 'Febuary 2009', '2009-02-01', 1),
('200903.pdf', 'March 2009', '2009-03-01', 1),
('200904.pdf', 'April 2009', '2009-04-01', 1),
('200905.pdf', 'May 2009', '2009-05-01', 1),
('200906.pdf', 'June 2009', '2009-06-01', 1),
('200907.pdf', 'July 2009', '2009-07-01', 1),
('200908.pdf', 'August 2009', '2009-08-01', 1),
('200909.pdf', 'September 2009', '2009-09-01', 1),
('200910.pdf', 'October 2009', '2009-10-01', 1),
('200911.pdf', 'November 2009', '2009-11-01', 1),
('200912.pdf', 'December 2009', '2009-12-01', 1),
('201001.pdf', 'January 2010', '2010-01-01', 1),
('201002.pdf', 'Febuary 2010', '2010-02-01', 1),
('201003.pdf', 'March 2010', '2010-03-01', 1),
('201004.pdf', 'April 2010', '2010-04-01', 1),
('201005.pdf', 'May 2010', '2010-05-01', 1),
('201006.pdf', 'June 2010', '2010-06-01', 1),
('201008.pdf', 'August 2010', '2010-08-01', 1),
('201009.pdf', 'September 2010', '2010-09-01', 1),
('201010.pdf', 'October 2010', '2010-10-01', 1),
('201011.pdf', 'November 2010', '2010-11-01', 1),
('201012.pdf', 'December 2010', '2010-12-01', 1),
('201101.pdf', 'January 2011', '2011-01-01', 1);

-- INSERT INTO NewsLetters (fileName,letterName,publishDate)
-- VALUES
-- ('201101.pdf', 'January 2011', '2011-01-01');

INSERT INTO Newsletters_Categories (category) VALUES ('General News Letter');
-- UPDATE NewsLetters SET newslettercat_id = LAST_INSERT_ID();
