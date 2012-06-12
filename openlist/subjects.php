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
// Table sujets : affichage de la liste complète des thèmes
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin"))
{
$pagetitle = "Revues de " . $configinstitution . " : gestion des utilisateurs";
require ("header.php");
require ("connexion.php");
echo "\n";
// 
// Liste des sujets
// 
echo "<h1>Gestion des thèmes</h1>\n";
$req = "SELECT * FROM sujets ORDER BY sujetsfr ASC LIMIT 0, 300";
$result = mysql_query($req,$link);
$total_results = mysql_num_rows($result);
$nb = $total_results;

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " thème trouv&eacute;</b></font>\n";
else
echo " thèmes trouv&eacute;s</b></font>\n";
echo "<br/>";
echo "<br/>";

echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "</colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Nom (FR)</th>\n";
echo "<th scope=\"col\">Nom (EN)</th>\n";
echo "<th scope=\"col\">ID</th>\n";
echo "<th scope=\"col\">Code ISI</th>\n";
echo "<th scope=\"col\">SHS</th>\n";
echo "<th scope=\"col\">STM</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$sujetsid = $enreg['sujetsid'];
$sujetsfr = $enreg['sujetsfr'];
$sujetsen = $enreg['sujetsen'];
$sujetscode = $enreg['sujetscode'];
$sujetsshs = $enreg['sujetsshs'];
$sujetsstm = $enreg['sujetsstm'];
echo "<tr>\n";
echo "<td class=\"titrestableau\"><b>";
echo $sujetsfr;
echo "</b></td>\n";
echo "\n";
echo "<td>".$sujetsen."</b>\n";
echo "</td>\n";
echo "<td>";
echo $sujetsid."\n";
echo "</td>\n";
echo "<td>";
echo $sujetscode."\n";
echo "</td>\n";
echo "<td>";
if ($sujetsshs == 1)
echo "oui";
echo "</td>\n";
echo "<td>";
if ($sujetsstm == 1)
echo "oui";
echo "</td>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
{
echo "<td><a href=\"editsubject.php?&id=".$sujetsid."\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
}
echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";

echo "\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
require ("header.php");
echo "Vos droits sont insuffisants pour consulter cette page</b></font></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
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
