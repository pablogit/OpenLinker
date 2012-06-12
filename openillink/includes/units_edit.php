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
// Units table : edit form
// 
require ("config.php");
require ("authcookie.php");
$id="";
$montitle = "Gestion des unités";
$id=$_GET['id'];
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
require ("connect.php");
if ($id!="")
{
$req = "SELECT * FROM units WHERE id = '$id'";
$myhtmltitle = $configname[$lang] . " : édition de la unité " . $id;
$montitle = "Gestion des unités : édition de la fiche " . $id;
require ("headeradmin.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<h1>" . $montitle . "</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
$enreg = mysql_fetch_array($result);
$unitid = $enreg['id'];
$unitcode = $enreg['code'];
$name["fr"] = $enreg['name1'];
$name["en"] = $enreg['name2'];
$name["de"] = $enreg['name3'];
$name["it"] = $enreg['name4'];
$name["es"] = $enreg['name5'];
$unitlibrary = $enreg['library'];
$unitdepartment = $enreg['department'];
$unitfaculty = $enreg['faculty'];
$unitip1 = $enreg['internalip1display'];
$unitip2 = $enreg['internalip2display'];
$unitipext = $enreg['externalipdisplay'];
$validation = $enreg['validation'];
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
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"units\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$unitid."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=units'\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Supprimer\" onClick=\"self.location='update.php?action=delete&table=units&id=" . $unitid . "'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td><b>Code *</b></td><td>\n";
echo "<input name=\"code\" type=\"text\" size=\"60\" value=\"" . $unitcode . "\"></td></tr>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 1 *</b></td><td class=\"odd\"><input name=\"name1\" type=\"text\" size=\"60\" value=\"" . $name["fr"] . "\"></td></tr>\n";
echo "<tr><td><b>Nom 2</b></td><td><input name=\"name2\" type=\"text\" size=\"60\" value=\"" . $name["en"] . "\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 3</b></td><td class=\"odd\"><input name=\"name3\" type=\"text\" size=\"60\" value=\"" . $name["de"] . "\"></td></tr>\n";
echo "<tr><td><b>Nom 4</b></td><td><input name=\"name4\" type=\"text\" size=\"60\" value=\"" . $name["it"] . "\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 5</b></td><td class=\"odd\"><input name=\"name5\" type=\"text\" size=\"60\" value=\"" . $name["es"] . "\"></td></tr>\n";
echo "<tr><td><b>Bibliothèque d'attribution</b></td><td>\n";
echo "<select name=\"library\">\n";
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
if ($unitlibrary == $codelibraries)
$optionslibraries.=" selected";
$optionslibraries.=">" . $namelibraries[$lang] . "</option>\n";
}
echo $optionslibraries;
}
echo "</select></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Département</b></td><td class=\"odd\">\n";
echo "<select name=\"department\" id=\"department\" onchange=\"ajoutevaleur('department');\">\n";
echo "<option value=\"\"> </option>\n";
$reqdepartment = "SELECT department FROM units WHERE department != '' GROUP BY department ORDER BY department ASC";
$optionsdepartment = "";
$resultdepartment = mysql_query($reqdepartment,$link);
while ($rowdepartment = mysql_fetch_array($resultdepartment))
{
$codedepartment = $rowdepartment["department"];
$optionsdepartment.="<option value=\"" . $codedepartment . "\"";
if ($unitdepartment == $codedepartment)
$optionsdepartment.=" selected";
$optionsdepartment.=">" . $codedepartment . "</option>\n";
}
echo $optionsdepartment;
echo "<option value=\"new\">" . $addvaluemessage[$lang] . "</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"departmentnew\" id=\"departmentnew\" type=\"text\" size=\"30\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Faculté</b></td><td>\n";
echo "<select name=\"faculty\" id=\"faculty\" onchange=\"ajoutevaleur('faculty');\">\n";
echo "<option value=\"\"> </option>\n";
$reqfaculty = "SELECT faculty FROM units WHERE faculty != '' GROUP BY faculty ORDER BY faculty ASC";
$optionsfaculty = "";
$resultfaculty = mysql_query($reqfaculty,$link);
while ($rowfaculty = mysql_fetch_array($resultfaculty))
{
$codefaculty = $rowfaculty["faculty"];
$optionsfaculty.="<option value=\"" . $codefaculty . "\"";
if ($unitfaculty == $codefaculty)
$optionsfaculty.=" selected";
$optionsfaculty.=">" . $codefaculty . "</option>\n";
}
echo $optionsfaculty;
echo "<option value=\"new\">" . $addvaluemessage[$lang] . "</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"facultynew\" id=\"facultynew\" type=\"text\" size=\"30\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Affichage selon IP</b></td><td class=\"odd\">\n";
echo "<input name=\"ip1\" value=\"1\" type=\"checkbox\"";
if ($unitip1 == 1)
echo " checked";
echo ">IP interne 1 &nbsp;&nbsp;|&nbsp;&nbsp; \n";
echo "<input name=\"ip2\" value=\"1\" type=\"checkbox\"";
if ($unitip2 == 1)
echo " checked";
echo ">IP interne 2 &nbsp;&nbsp;|&nbsp;&nbsp; \n";
echo "<input name=\"ipext\" value=\"1\" type=\"checkbox\"";
if ($unitipext == 1)
echo " checked";
echo ">IP externe</td></tr>\n";
echo "<tr><td><b>A valider par la bibliothèque</b></td><td>\n";
echo "<input name=\"validation\" value=\"1\" type=\"checkbox\"";
if ($validation == 1)
echo " checked";
echo "></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=units'\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Supprimer\" onClick=\"self.location='update.php?action=delete&table=units&id=" . $unitid . "'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
require ("footer.php");
}
}
else
{
require ("header.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
echo "<br /><br />\n";
echo "</ul>\n";
echo "\n";
require ("footer.php");
}
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour éditer cette fiche</b></font></center><br /><br /><br /><br />\n";
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
