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
// 
// Home page : order form
//
require ("includes/config.php");
require ("includes/authip.php");
require ("includes/authcookie.php");
require ("includes/connect.php");
$myhtmltitle = $configname[$lang] . " : nouvelle commande";
$mybodyonload = "document.commande.nom.focus(); remplirauto();";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("includes/headeradmin.php");
echo "<h1><center>" . $firstmessage[$lang] . "<a href=\"" . $configlibraryurl[$lang] . "\" target=\"_blank\">" . $configlibrary[$lang] . "</a></center></h1>\n";
echo "<script type=\"text/javascript\">\n";
echo "function textchanged(changes) {\n";
echo "document.fiche.modifs.value = document.fiche.modifs.value + changes + ' - ';\n";
echo "}\n";
echo "function ajoutevaleur(champ) {\n";
echo "var champ2 = champ + 'new';\n";
echo "var res = document.getElementById(champ).value;\n";
echo "if (res == 'new')\n";
echo "{\n";
echo "document.getElementById(champ2).style.display='inline';\n";
echo "}\n";
echo "}\n";
echo "</script>\n";
echo "<form action=\"new.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"commande\" onsubmit=\"javascript:okcooc()\">\n";
// START Management Fields
echo "<input name=\"table\" type=\"hidden\"  value=\"orders\">\n";
echo "<input name=\"userid\" type=\"hidden\"  value=\"".$monnom."\">\n";
echo "<input name=\"bibliotheque\" type=\"hidden\"  value=\"".$monbib."\">\n";
echo "<input name=\"sid\" type=\"hidden\"  value=\"\">\n";
echo "<input name=\"pid\" type=\"hidden\"  value=\"\">\n";
echo "<input name=\"referer\" type=\"hidden\"  value=\"" . rawurlencode($referer) . "\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"saisie\">\n";
echo "<input name=\"source\" type=\"hidden\" value=\"adminform\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<tr><td colspan=\"4\">\n";
echo $statusmessage[$lang] . " * : \n";
echo "<select name=\"stade\">\n";
$reqstatus="SELECT code, title1, title2, title3, title4, title5 FROM status ORDER BY code ASC";
$optionsstatus="";
$resultstatus = mysql_query($reqstatus,$link);
while ($rowstatus = mysql_fetch_array($resultstatus))
{
$codestatus = $rowstatus["code"];
$namestatus["fr"] = $rowstatus["title1"];
$namestatus["en"] = $rowstatus["title2"];
$namestatus["de"] = $rowstatus["title3"];
$namestatus["it"] = $rowstatus["title4"];
$namestatus["es"] = $rowstatus["title5"];
$optionsstatus.="<option value=\"" . $codestatus . "\"";
$optionsstatus.=">" . $namestatus[$lang] . "</option>\n";
}
echo $optionsstatus;
echo "</select>\n";


echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
echo $localisationmessage[$lang] . " : &nbsp;\n";
echo "<select name=\"localisation\">\n";
echo "<optgroup label=\"" . $localisationintmessage[$lang] . "\">\n";
$reqlocalisation="SELECT code, library, name1, name2, name3, name4, name5 FROM localizations WHERE library = \"" . $monbib . "\" ORDER BY name1 ASC";
$optionslocalisation="";
$resultlocalisation = mysql_query($reqlocalisation,$link);
while ($rowlocalisation = mysql_fetch_array($resultlocalisation))
{
$codelocalisation = $rowlocalisation["code"];
$namelocalisation["fr"] = $rowlocalisation["name1"];
$namelocalisation["en"] = $rowlocalisation["name2"];
$namelocalisation["de"] = $rowlocalisation["name3"];
$namelocalisation["it"] = $rowlocalisation["name4"];
$namelocalisation["es"] = $rowlocalisation["name5"];
$optionslocalisation.="<option value=\"" . $codelocalisation . "\"";
$optionslocalisation.=">" . $namelocalisation[$lang] . "</option>\n";
}
echo $optionslocalisation;
// select other libraries
$reqlocalisationext="SELECT code, name1, name2, name3, name4, name5 FROM libraries WHERE code != \"" . $monbib . "\" ORDER BY name1 ASC";
$optionslocalisationext="";
$resultlocalisationext = mysql_query($reqlocalisationext,$link);
$nbext = mysql_num_rows($resultlocalisationext);
if ($nbext > 0)
{
while ($rowlocalisationext = mysql_fetch_array($resultlocalisationext))
{
$codelocalisationext = $rowlocalisationext["code"];
$namelocalisationext["fr"] = $rowlocalisationext["name1"];
$namelocalisationext["en"] = $rowlocalisationext["name2"];
$namelocalisationext["de"] = $rowlocalisationext["name3"];
$namelocalisationext["it"] = $rowlocalisationext["name4"];
$namelocalisationext["es"] = $rowlocalisationext["name5"];
$optionslocalisationext.="<option value=\"" . $codelocalisationext . "\"";
$optionslocalisationext.=">" . $namelocalisationext[$lang] . "</option>\n";
}
echo "<optgroup label=\"" . $localisationextmessage[$lang] . "\">\n";
echo $optionslocalisationext;
}
echo "</select>\n";
echo "</td></tr>";

echo "<tr><td colspan=\"4\">\n";
echo $prioritymessage[$lang] . " : <select name=\"urgent\">\n";
echo "<option value=\"2\" selected>" . $prioritynormmessage[$lang] . "</option>\n";
echo "<option value=\"1\">" . $priorityurgmessage[$lang] . "</option>\n";
echo "<option value=\"3\">" . $prioritynonemessage[$lang] . "</option>\n";
echo "</select>\n";
echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $sourcemessage[$lang] . " : \n";
echo "<select name=\"source\" id=\"source\" onchange=\"ajoutevaleur('source');\">\n";
echo "<option value=\"\"> </option>\n";
$reqsource = "SELECT arrivee FROM orders WHERE arrivee != '' GROUP BY arrivee ORDER BY arrivee ASC";
$optionssource = "";
$resultsource = mysql_query($reqsource,$link);
while ($rowsource = mysql_fetch_array($resultsource))
{
$codesource = $rowsource["arrivee"];
$optionssource.="<option value=\"" . $codesource . "\"";
$optionssource.=">" . $codesource . "</option>\n";
}
echo $optionssource;
echo "<option value=\"new\">" . $addvaluemessage[$lang] . "</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"sourcenew\" id=\"sourcenew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr><tr><td>\n";
echo "<a href=\"#\" title=\"" . $orderdatehelpmessage[$lang] . "\">" . $orderdatemessage[$lang] . "</a> : </td><td> \n";
echo "<input name=\"datesaisie\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "</td><td>\n";
echo $ordersentdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"envoye\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "</td></tr><tr><td>\n";
echo $orderfactdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"facture\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "</td><td>\n";
echo $orderrenewdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"renouveler\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "</td></tr><tr><td colspan=\"4\">\n";
echo $pricemessage[$lang] . " : &nbsp;\n";
echo "<input name=\"prix\" type=\"text\" size=\"5\" value=\"\">\n";
echo "&nbsp;&nbsp;(<input type=\"checkbox\" name=\"avance\" value=\"on\" />" . $paidadvmessage[$lang] . ") &nbsp;&nbsp;&nbsp;&nbsp;\n";
echo "</td></tr><tr><td colspan=\"4\">\n";
echo $refextmessage[$lang] . " : &nbsp;\n";
echo "<input name=\"ref\" type=\"text\" size=\"20\" value=\"\">&nbsp;&nbsp;&nbsp;\n";
echo $refintmessage[$lang] . " : &nbsp;\n";
echo "<input name=\"refinterbib\" type=\"text\" size=\"20\" value=\"\"></td></tr>\n";
echo "<tr><td valign=\"top\">\n";
echo $commentsmessage[$lang] . " : \n";
echo "</td><td valign=\"bottom\" colspan=\"3\"><textarea name=\"remarques\" rows=\"2\" cols=\"60\" valign=\"bottom\"></textarea>\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
}
else
{
// display to guest or users not logged in
if ($monaut == "guest")
require ("includes/headeradmin.php");
if ($monaut == "")
require ("includes/header.php");
echo "<h1><center>" . $firstmessage[$lang] . "<a href=\"" . $configlibraryurl[$lang] . "\" target=\"_blank\">" . $configlibrary[$lang] . "</a></center></h1>\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<b><font color=\"red\">" . $alertmessage[$lang] . "</font></b><br />" . $informationmessage[$lang] . " : <a href=\"mailto:" . $configlibraryemail[$lang] . "\">" . $configlibraryemail[$lang] . "</a>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "<form action=\"new.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"commande\" onsubmit=\"javascript:okcooc()\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"orders\">\n";
echo "<input name=\"userid\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"bibliotheque\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"sid\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"pid\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"referer\" type=\"hidden\" value=\"" . rawurlencode($referer) . "\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"saisie\">\n";
echo "<input name=\"source\" type=\"hidden\" value=\"publicform\">\n";
}
// END Management Fields



// START User Fields
// Display to all users
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<TR><TD>\n";
echo $namemessage[$lang] . " * : </td><td><input name=\"nom\" type=\"text\" size=\"30\" value=\"\"></td><td>\n";
echo $firstnamemessage[$lang] . " * : </td><td><input name=\"prenom\" type=\"text\" size=\"30\" value=\"\">\n";
if ($directoryurl1 != "")
echo "&nbsp;<a href=\"javascript:directory('" . $directoryurl1 . "')\" title=\"" . $directory1message[$lang] . "\"><img src=\"img/directory1.png\"></a>\n";
if ($directoryurl2 != "")
echo "<a href=\"javascript:directory('" . $directoryurl2 . "')\" title=\"" . $directory2message[$lang] . "\"><img src=\"img/directory2.png\"></a>\n";
echo "</td></tr><tr><td>\n";
echo $unitmessage[$lang] . " * : </td><td>\n";
$unitsortlang = "name1";
if ($lang == "en")
$unitsortlang = "name2";
if ($lang == "de")
$unitsortlang = "name3";
if ($lang == "it")
$unitsortlang = "name4";
if ($lang == "es")
$unitsortlang = "name5";
echo "<select name=\"service\">\n";
echo "<option value=\"\"></option>\n";
if ($ip1 == 1)
$requnits="SELECT code, $unitsortlang FROM units WHERE internalip1display = 1 ORDER BY $unitsortlang ASC";
else if ($ip2 == 1)
$requnits="SELECT code, $unitsortlang FROM units WHERE internalip2display = 1 ORDER BY $unitsortlang ASC";
else
$requnits="SELECT code, $unitsortlang FROM units WHERE externalipdisplay = 1 ORDER BY $unitsortlang ASC";
$optionsunits="";
$resultunits = mysql_query($requnits,$link);
while ($rowunits = mysql_fetch_array($resultunits))
{
$codeunits = $rowunits["code"];
$nameunits = $rowunits[$unitsortlang];
$optionsunits.="<option value=\"" . $codeunits . "\"";
$optionsunits.=">" . $nameunits . "</option>\n";
}
echo $optionsunits;
echo "</select>\n";
echo "</td><td>\n";
echo $unitothermessage[$lang] . " : </td><td>\n";
echo "<input name=\"servautre\" type=\"text\" size=\"30\" value=\"\">\n";
echo "</td></tr>\n";
if ($ip1 == 1)
{
echo "<tr><td>\n";
echo $cgramessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"cgra\" type=\"text\" size=\"30\" value=\"\"></td><td>\n";
echo $cgrbmessage[$lang] . " : </td><td>\n";
echo "<input name=\"cgrb\" type=\"text\" size=\"30\" value=\"\">\n";
echo "</td></tr>\n";
}
else
{
echo "<input name=\"cgra\" type=\"hidden\"  value=\"\">\n";
echo "<input name=\"cgrb\" type=\"hidden\"  value=\"\">\n";
}
echo "<tr><td>\n";
echo $emailmessage[$lang] . " * : </td><td>\n";
echo "<input name=\"mail\" type=\"text\" size=\"30\" value=\"\"></td><td>\n";
echo $telmessage[$lang] . " : </td><td>\n";
echo "<input name=\"tel\" type=\"text\" size=\"30\" value=\"\">\n";
echo "</td></tr>\n";
echo "<tr><td valign=\"top\">\n";
echo $addressmessage[$lang] . " :\n";
echo "</td><td>\n";
echo "<input name=\"adresse\" type=\"text\" size=\"30\" value=\"\">\n";
echo "</td><td>\n";
echo $cpmessage[$lang] . " : </td><td>\n";
echo "<input name=\"postal\" type=\"text\" size=\"5\" value=\"\">\n";
echo "&nbsp;\n";
echo $citymessage[$lang] . " :\n";
echo "<input name=\"localite\" type=\"text\" size=\"7\" value=\"\">\n";
echo "</td></tr><tr><td valign=\"top\" colspan=\"4\">\n";
echo $dispomessage[$lang] . " : \n";
echo "<input type=\"radio\" name=\"envoi\" value=\"mail\" checked/>\n";
echo $dispofactmessage[$lang] . "&nbsp;\n";
echo "<input type=\"radio\" name=\"envoi\" value=\"surplace\" />\n";
echo $disponotfactmessage[$lang] . "\n";
echo "</td></tr>\n";
echo "<tr>\n";
echo "<td valign=\"top\" colspan=\"4\">\n";
echo "<input type=\"checkbox\" name=\"cooc\" value=\"on\" />\n";
echo $savecookiemessage[$lang] . "&nbsp;&nbsp;|&nbsp;&nbsp;(<A HREF=\"javascript:coocout()\">" . $deletecookiemessage[$lang] . "</a>)\n";
echo "</td></tr>\n";
echo "</Table>\n";
echo "\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "\n";
// END User Fields



// START Document Fields
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<center><b>" . $lookupmessage[$lang] . " </b>\n";
echo "<select name=\"tid\">\n";
$i = 0;
while ($lookupuid[$i]["name"])
{
echo "<option value=\"" . $lookupuid[$i]["code"] . "\">" . $lookupuid[$i]["name"] . "</option>\n";
$i = $i + 1;
}
echo "</select>\n";
echo "<input name=\"uids\" type=\"text\" size=\"20\" value=\"\">\n";
echo "<input type=\"button\" value=\"OK\" onclick=\"lookupid()\"></center>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "\n";
echo "<table border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<TR><TD>" . $doctypesmessage[$lang] . "Type de document : </td><td>\n";
echo "<select name=\"genre\">\n";
$i = 0;
while ($doctypes[$i]["code"])
{
echo "<option value=\"" . $doctypes[$i]["code"] . "\">" . $doctypes[$i][$lang] . "</option>\n";
$i = $i + 1;
}
echo "</select>\n";
echo "<div class=\"formdoc\">\n";
echo "</td></tr><tr><td>\n";
echo $stitlemessage[$lang] . " * : </td><td>\n";
echo "<input name=\"title\" type=\"text\" size=\"80\" value=\"\">\n";
echo "&nbsp;\n";
echo "<A HREF=\"javascript:openlist()\"><img src=\"img/find.png\" title=\"" . $atozlinkmessage[$lang] . "\"></a>\n";
echo "</td></tr><tr><td>\n";
echo $yearmessage[$lang] . " : </td><td>\n";
echo "<input name=\"date\" type=\"text\" size=\"3\" value=\"\">\n";
echo "&nbsp;\n";
echo $volumemessage[$lang] . " : \n";
echo "<input name=\"volume\" type=\"text\" size=\"3\" value=\"\">\n";
echo "&nbsp;\n";
echo $issuemessage[$lang] . " : \n";
echo "<input name=\"issue\" type=\"text\" size=\"3\" value=\"\">\n";
echo "&nbsp;\n";
echo $supplementmessage[$lang] . " : \n";
echo "<input name=\"suppl\" type=\"text\" size=\"3\" value=\"\">\n";
echo "&nbsp;\n";
echo $pagesmessage[$lang] . " : \n";
echo "<input name=\"pages\" type=\"text\" size=\"4\" value=\"\">\n";
echo "</td></tr><tr><td>\n";
echo $atitlemessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"atitle\" type=\"text\" size=\"80\" value=\"\">\n";
echo "</td></tr><tr><td>\n";
echo $authorsmessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"auteurs\" type=\"text\" size=\"80\" value=\"\">\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo $editionmessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"edition\" type=\"text\" size=\"14\" value=\"\">\n";
echo "&nbsp;\n";
echo "ISSN / ISBN : \n";
echo "<input name=\"issn\" type=\"text\" size=\"15\" value=\"\">\n";
echo "&nbsp;\n";
echo "UID : \n";
echo "<input name=\"uid\" type=\"text\" size=\"15\" value=\"\">\n";
echo "</td></tr></div>\n";
echo "<tr><td valign=\"top\">\n";
echo $publiccommentsmessage[$lang] . " : \n";
echo "</td><td valign=\"bottom\"><textarea name=\"remarquespub\" rows=\"2\" cols=\"60\" valign=\"bottom\"></textarea>\n";
echo "</td></tr><tr><td></td><td>\n";
echo "<input type=\"submit\" value=\"" . $submitmessage[$lang] . "\" onsubmit=\"javascript:okcooc();document.body.style.cursor = 'wait';\">&nbsp;&nbsp;\n";
echo "<input type=\"reset\" value=\"" . $resetmessage[$lang] . "\">\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "</form>\n";
require ("includes/footer.php");
?>
