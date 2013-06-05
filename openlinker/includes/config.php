<?php
// ***************************************************************************
// ***************************************************************************
// ***************************************************************************
// OpenLinker is a web based library system designed to manage 
// journals, ILL, document delivery and OpenURL links
// 
// Copyright (C) 2012, Pablo Iriarte
// 
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
// 
// ***************************************************************************
// ***************************************************************************
// ***************************************************************************
// essential parameters

// MySQL access codes
$configmysqldb = "openlinker";
$configmysqlhost = "localhost";
$configmysqllogin = "root";
$configmysqlpwd = "panamara";

// Google Analytics code (leave blank if not applicable)
$configanalytics = "UA-123456789";

// Informations about the main library managing the ILL network
$configlibname = "XYZ University Library";
$configlibstreet = "River Street";
$configlibbuilding = "Building XY";
$configlibpostalcode = "1234";
$configlibcity = "Ville QW";
$configlibcowntry = "Pays";
$configlibtel = "+12 34 567 89 01";
$configlibemail = "library@univxyz.com";
$configliburl = "http://www.univxyz.com/library";

// Name of ILL or document delivery manager
$configillmanagername = "John Smith";
$configillmanageremail = "john.smith@univxyz.com";
$configillmanagertel = "+12 34 567 89 01";

// e-mail address used to receive external orders
$configemaildelivery = "docdelivery@univxyz.com";

// Public e-mail address displayed on the description pages and error messages
$configemail = "admin@univxyz.com";

// Administrator e-mail address used to send feedback messages
$configemailto = "admin@univxyz.com";

// IP range of main institution like 123.456.*.*
$configipainst1 = "123";
$configipbinst1 = "456";
$configipcinst1 = "*";
$configipdinst1 = "*";
// IP range of secondary institution like 789.10.*.* (leave blank if not applicable
$configipainst2 = "789";
$configipbinst2 = "10";
$configipcinst2 = "*";
$configipdinst2 = "*";

// Secret string added to secure public password generated from e-mail
$secure_string_guest_login = "HYGWGMII?gsSC9mX0X#&ydfgrZç%&467";

// Secret string added to secure admin level on cookies
$secure_string_cookie = "HYdfhrtznvcw354AETte5üPO!äP236%ç";

// Define the number of results per page 
$max_results = 25;

// CorssRef identifiers
$configcrossrefpid1 = "abc";
$configcrossrefpid2 = "abc123";

// Define the name and search URL of directories used to make the home page links
// to determine your URLs make a search with firstname "XFIRSTNAMEX" (without quotes) and name "XNAMEX", then copy the URL of the results page
// if your directory allows only POST request, you can create a form imitating the search form and place on the forms folder
$directoryname1 = "Univ. directory";
$directoryurl1 = "http://www.univxyz.com/directory?ln=XNAMEX&fn=XFIRSTNAMEX";
$directoryname2 = "Hosp. directory";
$directoryurl2 = "http://www.univabc.com/ldap?nom=XNAMEX&prenom=XFIRSTNAMEX";

// Define the unique identifiers used on the lookup tool
$lookupuid[0]["name"] = "PMID";
$lookupuid[0]["code"] = "pmid";
$lookupuid[1]["name"] = "DOI";
$lookupuid[1]["code"] = "doi";
$lookupuid[2]["name"] = "ISBN";
$lookupuid[2]["code"] = "isbn";
$lookupuid[3]["name"] = "RERO ID";
$lookupuid[3]["code"] = "reroid";
$lookupuid[4]["name"] = "WoS ID";
$lookupuid[4]["code"] = "wosid";


// OpenURL parameters
$openurlsid = "OpenLinker:DemoDB";

// Autodetect language from browser settings (0 inactive, 1 active)
$langautodetect = 0;

// See the others values on tranlations.php
require ("translations.php");


// shibboleth authentication (0 inactive, 1 active)
$shibboleth = 1;

// shibboleth url including entityID, return URL and target (redirection to the login.php)
$shibbolethurl = "https://wayf.www.univxyz.com/shibboleth/WAYF?entityID=https%3A%2F%2Fwww.univxyz.com%2Fshibboleth&return=http%3A%2F%2Fwww.univxyz.com%2FShibboleth.sso%2FDS%3FSAMLDS%3D1%26target%3Dhttp%3A%2F%2Fwww.univxyz.com%2Flogin.php%26action%3Dshibboleth";


?>
