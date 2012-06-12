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
// Status table : List of all the status defined on the internal ILL network
// 
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : gestion des étapes de la commande";
require ("headeradmin.php");
require ("connect.php");
echo "\n";
// 
// Status List
// 
echo "<h1>Gestion des étapes de la commande</h1>\n";
$req = "SELECT * FROM status ORDER BY id ASC LIMIT 0, 200";
$result = mysql_query($req,$link);
$total_results = mysql_num_rows($result);
$nb = $total_results;

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " étape trouvée</b></font>\n";
else
echo " étapes trouvées</b></font>\n";
echo "<br/>";
echo "<br/>";

echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "</colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">code</th>\n";
echo "<th scope=\"col\">title1</th>\n";
echo "<th scope=\"col\">help1</th>\n";
// echo "<th scope=\"col\">title2</th>\n";
// echo "<th scope=\"col\">title3</th>\n";
// echo "<th scope=\"col\">title4</th>\n";
// echo "<th scope=\"col\">title5</th>\n";
echo "<th scope=\"col\">Folder</th>\n";
echo "<th scope=\"col\">Special status</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$statusid = $enreg['id'];
$statuscode = $enreg['code'];
$statustitle1 = $enreg['title1'];
$statushelp1 = $enreg['help1'];
$statustitle2 = $enreg['title2'];
$statustitle3 = $enreg['title3'];
$statustitle4 = $enreg['title4'];
$statustitle5 = $enreg['title5'];
$statusin = $enreg['in'];
$statusout = $enreg['out'];
$statustrash = $enreg['trash'];
$statusspecial = $enreg['special'];
$statuscolor = $enreg['color'];
$monseparateur = "";
echo "<tr>\n";
echo "<td><b>" . $statuscode . "</b></td>\n";
echo "<td><font color=\"".$statuscolor."\"><b>".$statustitle1."</b></font></td>\n";
echo "<td>".$statushelp1."</td>\n";
echo "<td>\n";
if ($statusin == 1)
{
echo $monseparateur . "IN";
$monseparateur = " - ";
}
if ($statusout == 1)
{
echo $monseparateur . "OUT";
$monseparateur = " - ";
}
if ($statustrash == 1)
{
echo $monseparateur . "TRASH";
$monseparateur = " - ";
}
echo "</td><td>\n";
echo $statusspecial;
echo "</td>\n";
// echo "<td>".$statustitle2."</td>\n";
// echo "<td>".$statustitle3."</td>\n";
// echo "<td>".$statustitle4."</td>\n";
// echo "<td>".$statustitle5."</td>\n";
// echo "<td>".$statusin."</td>\n";
// echo "<td>".$statusout."</td>\n";
// echo "<td>".$statustrash."</td>\n";
// echo "<td>".$statusrenew."</td>\n";
// echo "<td>".$statusreject."</td>\n";
if ((($monaut == "admin")&&($admin > 1))||($monaut == "sadmin"))
{
echo "<td><a href=\"edit.php?table=status&id=".$statusid."\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
}
echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
echo "\n";
echo "<br/><br/><ul>\n";
echo "<b><a href=\"new.php?table=status\">Ajouter une nouvelle étape</a></b>\n";
echo "<br/><br/>\n";
echo "</ul>\n";
require ("footer.php");
}
else
{
require ("header.php");
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
