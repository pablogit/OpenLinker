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
// Order edition form
//
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$id=$_GET['id'];
$myhtmltitle = "Commandes de " . $configinstitution[$lang] . " : edition de la commande " . $id;
require ("connect.php");
if ($id)
{
$req = "select * from orders where illinkid like '$id' order by illinkid desc";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
require ("headeradmin.php");
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$id = $enreg['illinkid'];
echo "<script type=\"text/javascript\">\n";
echo "function textchanged(changes) {\n";
echo "document.commande.modifs.value = document.commande.modifs.value + changes + ' - ';\n";
echo "}\n";
echo "function ajoutevaleur(champ) {\n";
echo "var champ2 = champ + 'new';\n";
echo "var res = document.getElementById(champ).value;\n";
echo "if (res == 'new')\n";
echo "{\n";
echo "document.getElementById(champ2).style.display='inline';\n";
echo "}\n";
echo "document.commande.modifs.value = document.commande.modifs.value + champ + ' - ';\n";
echo "}\n";
echo "</script>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"commande\">\n";
echo "<input name=\"id\" type=\"hidden\"  value=\"".$id."\">\n";
echo "<input name=\"userid\" type=\"hidden\"  value=\"".$enreg['saisie_par']."\">\n";
echo "<input name=\"ip\" type=\"hidden\"  value=\"".$enreg['ip']."\">\n";
// echo "<input name=\"referer\" type=\"hidden\"  value=\"".$enreg['referer']."\">\n";
echo "<input name=\"doi\" type=\"hidden\"  value=\"".$enreg['doi']."\">\n";
echo "<input name=\"historique\" type=\"hidden\"  value=\"".$enreg['historique']."\">\n";
echo "<b><font color=\"red\">Modification da la commande ".$id."</font></b>\n";
echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
echo "<input name=\"modifs\" type=\"hidden\" value=\"\">\n";
echo "&nbsp;&nbsp;|&nbsp;&nbsp;<b>Attribuée à la bibliothèque</b> <select name=\"bibliotheque\" onchange=\"textchanged('bibliotheque')\">\n";
$reqlibraries="SELECT code, name1, name2, name3, name4, name5 FROM libraries ORDER BY name1 ASC";
$optionslibraries="";
$resultlibraries = mysql_query($reqlibraries,$link);
$nblibs = mysql_num_rows($resultlibraries);
if ($nblibs > 0)
{
while ($rowlibraries = mysql_fetch_array($resultlibraries))
{
$codelibraries = $rowlibraries["code"];
$namelibraries["fr"] = $rowlibraries["name1"];
$namelibraries["en"] = $rowlibraries["name2"];
$namelibraries["de"] = $rowlibraries["name3"];
$namelibraries["it"] = $rowlibraries["name4"];
$namelibraries["es"] = $rowlibraries["name5"];
$optionslibraries.="<option value=\"" . $codelibraries . "\"";
if ($enreg['bibliotheque'] == $codelibraries)
$optionslibraries.=" selected";
$optionslibraries.=">" . $namelibraries[$lang] . "</option>\n";
}
echo $optionslibraries;
}
echo "</select>\n";
echo "&nbsp;&nbsp;|&nbsp;&nbsp;<input type=\"submit\" value=\"" . $submitmessage[$lang] . "\" onsubmit=\"javascript:okcooc();document.body.style.cursor = 'wait';\"\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
echo "<tr><td valign=\"top\" width=\"90%\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";

// START Management Fields
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<tr><td colspan=\"4\">\n";
// Begin Status Field
echo $statusmessage[$lang] . " * : \n";
echo "<select name=\"stade\" onchange=\"textchanged('stade')\">\n";
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
if ($enreg['stade'] == $codestatus)
$optionsstatus.=" selected";
$optionsstatus.=">" . $namestatus[$lang] . "</option>\n";
}
echo $optionsstatus;
echo "</select>\n";
// END Status Field

// Begin Localization Field
$localisationok = 0;
echo "&nbsp;&nbsp;&nbsp;&nbsp;\n";
echo $localisationmessage[$lang] . " : &nbsp;\n";
echo "<select name=\"localisation\" onchange=\"textchanged('localisation')\">\n";
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
if ($enreg['localisation'] == $codelocalisation)
{
$optionslocalisation.=" selected";
$localisationok = 1;
}
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
if ($enreg['localisation'] == $codelocalisationext)
{
$optionslocalisationext.=" selected";
$localisationok = 1;
}
$optionslocalisationext.=">" . $namelocalisationext[$lang] . "</option>\n";
}
echo "<optgroup label=\"" . $localisationextmessage[$lang] . "\">\n";
echo $optionslocalisationext;
}
if ($localisationok = 0)
{
echo "<optgroup label=\"Others\">\n";
echo "<option value=\"" . $enreg['localisation'] . "\"> " . $enreg['localisation'] . "</option>\n";
}
echo "</select>\n";
// END Localization Field
echo "</td></tr>";

// Start Priority Field
echo "<tr><td colspan=\"4\">\n";
echo "Priorit&eacute; : \n";
echo "<select name=\"urgent\" onchange=\"textchanged('priorite')\">\n";
echo "<option value=\"2\"";
if ($enreg['urgent']=='2')
echo " selected";
echo "> Normale</option>\n";
echo "<option value=\"1\"";
if ($enreg['urgent']=='1')
echo " selected";
echo "> Urgente</option>\n";
echo "<option value=\"3\"";
if ($enreg['urgent']=='3')
echo " selected";
echo "> Pas prioritaire</option>\n";
echo "</select>\n";
// END Priority Field

// Start Origin Field
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
if ($enreg['arrivee'] == $codesource)
$optionssource.=" selected";
$optionssource.=">" . $codesource . "</option>\n";
}
echo $optionssource;
echo "<option value=\"new\">" . $addvaluemessage[$lang] . "</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"sourcenew\" id=\"sourcenew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
// END Origin Field

// Start Dates
echo "<tr><td>\n";
echo "<a href=\"#\" title=\"" . $orderdatehelpmessage[$lang] . "\">" . $orderdatemessage[$lang] . "</a> : </td><td> \n";
echo "<input name=\"datesaisie\" type=\"text\" size=\"10\" value=\"".$enreg['date']."\" class=\"tcal\" onchange=\"textchanged('datesaisie')\">\n";
echo "</td><td>\n";
echo $ordersentdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"envoye\" type=\"text\" size=\"10\" value=\"".$enreg['envoye']."\" class=\"tcal\" onchange=\"textchanged('envoye')\">\n";
echo "</td></tr><tr><td>\n";
echo $orderfactdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"facture\" type=\"text\" size=\"10\" value=\"".$enreg['facture']."\" class=\"tcal\" onchange=\"textchanged('facture')\">\n";
echo "</td><td>\n";
echo $orderrenewdatemessage[$lang] . " : </td><td>\n";
echo "<input name=\"renouveler\" type=\"text\" size=\"10\" value=\"".$enreg['renouveler']."\" class=\"tcal\" onchange=\"textchanged('renouveler')\">\n";
echo "</td></tr>\n";
// END Dates

// START Price Field and Internal references
echo "<tr><td colspan=\"4\">\n";
echo $pricemessage[$lang] . " : &nbsp;\n";
echo "<input name=\"prix\" type=\"text\" size=\"5\" value=\"".$enreg['prix']."\" onchange=\"textchanged('prix')\">\n";
echo "&nbsp;&nbsp;(<input type=\"checkbox\" name=\"avance\" value=\"on\"";
if ($enreg['prepaye']=='on')
echo " checked";
echo " onclick=\"textchanged('prepaye')\"/>" . $paidadvmessage[$lang] . ") &nbsp;&nbsp;&nbsp;&nbsp;\n";
echo "</td></tr>\n";
echo "<tr><td colspan=\"4\">\n";
echo $refextmessage[$lang] . " : &nbsp;\n";
echo "<input name=\"ref\" type=\"text\" size=\"20\" value=\"".$enreg['ref']."\" onchange=\"textchanged('ref fournisseur')\">&nbsp;&nbsp;&nbsp;\n";
echo $refintmessage[$lang] . " : &nbsp;\n";
echo "<input name=\"refinterbib\" type=\"text\" size=\"20\" value=\"".$enreg['refinterbib']."\" onchange=\"textchanged('ref interne')\">\n";
echo "</td></tr>\n";
// END Price Field and Internal references

// Start Private Notes
echo "<tr><td valign=\"top\">\n";
echo $commentsmessage[$lang] . " : \n";
echo "</td><td valign=\"bottom\" colspan=\"3\"><textarea name=\"remarques\" rows=\"2\" cols=\"68\" valign=\"bottom\" onchange=\"textchanged('remarques')\">".stripslashes($enreg['remarques'])."</textarea>\n";
echo "</td></tr>\n";
// END Private Notes
echo "</table>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
// END Management Fields



// START User Fields
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<TR><TD>\n";
echo $namemessage[$lang] . " * : </td><td><input name=\"nom\" type=\"text\" size=\"25\" value=\"".$enreg['nom']."\" onchange=\"textchanged('nom')\"></td><td>\n";
echo $firstnamemessage[$lang] . " * : </td><td><input name=\"prenom\" type=\"text\" size=\"25\" value=\"".$enreg['prenom']."\" onchange=\"textchanged('prenom')\">\n";
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
$unitsok = 0;
echo "<select name=\"service\" onchange=\"textchanged('service'); document.commande.servautre.value = '';\">\n";
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
if ($enreg['service'] == $codeunits)
{
$optionsunits.=" selected";
$unitsok = 1;
}
$optionsunits.=">" . $nameunits . "</option>\n";
}
echo $optionsunits;
echo "</select>\n";
echo "</td><td>\n";
echo $unitothermessage[$lang] . " : </td><td>\n";
echo "<input name=\"servautre\" type=\"text\" size=\"30\" value=\"";
if ($unitsok == 0)
echo $enreg['service'];
echo "\" onchange=\"textchanged('service autre')\">\n";
echo "</td></tr>\n";
if ($ip1 == 1)
{
echo "<tr><td>\n";
echo $cgramessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"cgra\" type=\"text\" size=\"30\" value=\"".$enreg['cgra']."\" onchange=\"textchanged('cgra')\"></td><td>\n";
echo $cgrbmessage[$lang] . " : </td><td>\n";
echo "<input name=\"cgrb\" type=\"text\" size=\"30\" value=\"".$enreg['cgrb']."\" onchange=\"textchanged('cgrb')\">\n";
echo "</td></tr>\n";
}
else
{
echo "<input name=\"cgra\" type=\"hidden\"  value=\"".$enreg['cgra']."\">\n";
echo "<input name=\"cgrb\" type=\"hidden\"  value=\"".$enreg['cgrb']."\">\n";
}
echo "<tr><td>\n";
echo $emailmessage[$lang] . " * : </td><td>\n";
echo "<input name=\"mail\" type=\"text\" size=\"30\" value=\"".$enreg['mail']."\" onchange=\"textchanged('email')\"></td><td>\n";
echo $telmessage[$lang] . " : </td><td>\n";
echo "<input name=\"tel\" type=\"text\" size=\"30\" value=\"".$enreg['tel']."\" onchange=\"textchanged('tel')\">\n";
echo "</td></tr>\n";
echo "<tr><td valign=\"top\">\n";
echo $addressmessage[$lang] . " :\n";
echo "</td><td>\n";
echo "<input name=\"adresse\" type=\"text\" size=\"30\" value=\"".$enreg['adresse']."\" onchange=\"textchanged('adresse')\">\n";
echo "</td><td>\n";
echo $cpmessage[$lang] . " : </td><td>\n";
echo "<input name=\"postal\" type=\"text\" size=\"5\" value=\"".$enreg['code_postal']."\" onchange=\"textchanged('code postal')\">\n";
echo "&nbsp;\n";
echo $citymessage[$lang] . " :\n";
echo "<input name=\"localite\" type=\"text\" size=\"7\" value=\"".$enreg['localite']."\" onchange=\"textchanged('localite')\">\n";
echo "</td></tr><tr><td valign=\"top\" colspan=\"4\">\n";
echo $dispomessage[$lang] . " : \n";
echo "<input type=\"radio\" name=\"envoi\" value=\"mail\"";
if ($enreg['envoi_par']=='mail')
echo " checked";
echo " onclick=\"textchanged('envoi')\"/>\n";
echo $dispofactmessage[$lang] . "&nbsp;\n";
echo "<input type=\"radio\" name=\"envoi\" value=\"surplace\"";
if ($enreg['envoi_par']=='surplace')
echo " checked";
echo " onclick=\"textchanged('envoi')\"/>\n";
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
echo "<input type=\"button\" value=\"OK\" onclick=\"lookupid(); textchanged('ref ecrassee par PMID');\"></center>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "\n";
echo "<table border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<TR><TD>" . $doctypesmessage[$lang] . "Type de document : </td><td>\n";
echo "<select name=\"genre\" onchange=\"textchanged('type_doc')\">\n";
$i = 0;
while ($doctypes[$i]["code"])
{
echo "<option value=\"" . $doctypes[$i]["code"] . "\"";
if ($enreg['type_doc']==$doctypes[$i]["code"])
echo " selected";
echo ">" . $doctypes[$i][$lang] . "</option>\n";
$i = $i + 1;
}
echo "</select>\n";
echo "<div class=\"formdoc\">\n";
echo "</td></tr><tr><td>\n";
echo $stitlemessage[$lang] . " * : </td><td>\n";
echo "<input name=\"title\" type=\"text\" size=\"80\" value=\"".stripslashes($enreg['titre_periodique'])."\" onchange=\"textchanged('titre_periodique')\">\n";
echo "&nbsp;\n";
echo "<A HREF=\"javascript:openlist()\"><img src=\"img/find.png\" title=\"" . $atozlinkmessage[$lang] . "\"></a>\n";
echo "</td></tr><tr><td>\n";
echo $yearmessage[$lang] . " * : </td><td>\n";
echo "<input name=\"date\" type=\"text\" size=\"3\" value=\"".$enreg['annee']."\" onchange=\"textchanged('date')\">\n";
echo "&nbsp;\n";
echo $volumemessage[$lang] . " * : \n";
echo "<input name=\"volume\" type=\"text\" size=\"3\" value=\"".$enreg['volume']."\" onchange=\"textchanged('volume')\">\n";
echo "&nbsp;\n";
echo $issuemessage[$lang] . " : \n";
echo "<input name=\"issue\" type=\"text\" size=\"3\" value=\"".$enreg['numero']."\" onchange=\"textchanged('numero')\">\n";
echo "&nbsp;\n";
echo $supplementmessage[$lang] . " : \n";
echo "<input name=\"suppl\" type=\"text\" size=\"3\" value=\"".$enreg['supplement']."\" onchange=\"textchanged('suppl')\">\n";
echo "&nbsp;\n";
echo $pagesmessage[$lang] . " * : \n";
echo "<input name=\"pages\" type=\"text\" size=\"4\" value=\"".$enreg['pages']."\" onchange=\"textchanged('pages')\">\n";
echo "</td></tr><tr><td>\n";
echo $atitlemessage[$lang] . " : \n";
echo "</td><td>\n";
$titreart = stripslashes($enreg['titre_article']);
$titreart = htmlspecialchars($titreart, ENT_COMPAT);
echo "<input name=\"atitle\" type=\"text\" size=\"80\" value=\"".$titreart."\" onchange=\"textchanged('titre_article')\">\n";
echo "</td></tr><tr><td>\n";
echo $authorsmessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"auteurs\" type=\"text\" size=\"80\" value=\"".$enreg['auteurs']."\" onchange=\"textchanged('auteurs')\">\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo $editionmessage[$lang] . " : \n";
echo "</td><td>\n";
echo "<input name=\"edition\" type=\"text\" size=\"14\" value=\"".$enreg['edition']."\" onchange=\"textchanged('edition')\">\n";
echo "&nbsp;\n";
echo "ISSN / ISBN : \n";
echo "<input name=\"issn\" type=\"text\" size=\"15\" value=\"";
if ($enreg['isbn']!="")
echo $enreg['isbn'];
else {
echo $enreg['issn'];
if ($enreg['eissn']!="")
echo ",".$enreg['eissn'];
}
echo "\" onchange=\"textchanged('issn')\">\n";
echo "&nbsp;\n";
echo "UID : \n";
echo "<input name=\"uid\" type=\"text\" size=\"15\" value=\"".$enreg['uid']."\" onchange=\"textchanged('uid')\">\n";
echo "</td></tr></div>\n";
echo "<tr><td valign=\"top\">\n";
echo $publiccommentsmessage[$lang] . " : \n";
echo "</td><td valign=\"bottom\"><textarea name=\"remarquespub\" rows=\"2\" cols=\"60\" valign=\"bottom\" onchange=\"textchanged('remarquespub')\">".stripslashes($enreg['remarquespub'])."</textarea>\n";
echo "</td></tr><tr><td></td><td>\n";
echo "<input type=\"submit\" value=\"" . $submitmessage[$lang] . "\" onsubmit=\"javascript:okcooc();document.body.style.cursor = 'wait';\">&nbsp;&nbsp;\n";
echo "<input type=\"reset\" value=\"" . $resetmessage[$lang] . "\">&nbsp;&nbsp;\n";
if ($monaut == "sadmin")
echo "<input type=\"button\" value=\"Supprimer definitivement cette commande\" onClick=\"self.location='update.php?action=delete&table=orders&id=" . $id . "'\">\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
// END Document Fields


echo "</form>\n";
echo "</td></tr></table>\n";
}
require ("footer.php");
}
else
{
require ("header.php");
require ("loginfail.php");
require ("footer.php");
}
}
else
{
require ("header.php");
require ("loginfail.php");
require ("footer.php");
}
?>
