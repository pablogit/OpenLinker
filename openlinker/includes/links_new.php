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
// links table : record creation form
// 
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : nouveau lien externe ";
require ("headeradmin.php");
require ("connect.php");
echo "<h1>Gestion des liens : Création d'une nouvelle fiche </h1>\n";
echo "<br /></b>";
echo "<ul>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"links\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer le nouveau lien \">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=links'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td><b>Nom *</b></td><td>\n";
echo "<input name=\"title\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>URL *</b></td><td class=\"odd\"><input name=\"url\" type=\"text\" size=\"50\" value=\"\">&nbsp;&nbsp;";
echo "<input name=\"openurl\" value=\"1\" type=\"checkbox\"> OpenURL</td></tr>\n";
echo "<tr><td><b>Lien de recherche par identifiant</b></td><td>";
echo "<input name=\"search_issn\" value=\"1\" type=\"checkbox\">ISSN &nbsp;&nbsp;|&nbsp;&nbsp; ";
echo "<input name=\"search_isbn\" value=\"1\" type=\"checkbox\">ISBN";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Lien de recherche par titre</b></td><td class=\"odd\">";
echo "<input name=\"search_ptitle\" value=\"1\" type=\"checkbox\">de périodique &nbsp;&nbsp;|&nbsp;&nbsp; ";
echo "<input name=\"search_btitle\" value=\"1\" type=\"checkbox\">du livre&nbsp;&nbsp;|&nbsp;&nbsp; ";
echo "<input name=\"search_atitle\" value=\"1\" type=\"checkbox\">de l'article ou du chapitre\n";
echo "</td></tr>\n";
echo "<tr><td><b>Lien de commande</b></td><td>";
echo "<input name=\"order_ext\" value=\"1\" type=\"checkbox\">Formulaire externe &nbsp;&nbsp;|&nbsp;&nbsp; ";
echo "<input name=\"order_form\" value=\"1\" type=\"checkbox\">Formulaire interne\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Bibliothèque d'attribution</b></td><td class=\"odd\">\n";
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
$optionslibraries.=">" . $namelibraries[$lang] . "</option>\n";
}
echo $optionslibraries;
}
echo "</select></td></tr>\n";
echo "<tr><td><b>Lien actif</b></td><td><input name=\"active\" value=\"1\" type=\"checkbox\" checked></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer le nouveau lien \">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=links'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
require ("footer.php");
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour consulter cette page</b></font></center><br /><br /><br /><br />\n";
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
