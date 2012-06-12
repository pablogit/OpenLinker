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
// Libraries table : List of all the libraries defined on the internal ILL network
// 
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : gestion des utilisateurs";
require ("headeradmin.php");
require ("connect.php");
echo "\n";
// 
// Libraries List
// 
echo "<h1>Gestion des bibliothèques du réseau</h1>\n";
$req = "SELECT * FROM libraries ORDER BY id ASC LIMIT 0, 200";
$result = mysql_query($req,$link);
$total_results = mysql_num_rows($result);
$nb = $total_results;

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " bibliothèque trouvée</b></font>\n";
else
echo " bibliothèques trouvées</b></font>\n";
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
echo "<th scope=\"col\">name1</th>\n";
// echo "<th scope=\"col\">name2</th>\n";
// echo "<th scope=\"col\">name3</th>\n";
// echo "<th scope=\"col\">name4</th>\n";
// echo "<th scope=\"col\">name5</th>\n";
echo "<th scope=\"col\">default</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$libid = $enreg['id'];
$libcode = $enreg['code'];
$libname1 = $enreg['name1'];
$libname2 = $enreg['name2'];
$libname3 = $enreg['name3'];
$libname4 = $enreg['name4'];
$libname5 = $enreg['name5'];
$libdef = $enreg['default'];
echo "<tr>\n";
echo "<td><b>" . $libcode . "</b></td>\n";
echo "<td>".$libname1."</td>\n";
// echo "<td>".$libname2."</td>\n";
// echo "<td>".$libname3."</td>\n";
// echo "<td>".$libname4."</td>\n";
// echo "<td>".$libname5."</td>\n";
echo "<td>".$libdef."</td>\n";
if ((($monaut == "admin")&&($admin > 1))||($monaut == "sadmin"))
{
echo "<td><a href=\"edit.php?table=libraries&id=".$libid."\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
}
echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
echo "\n";
echo "<br/><br/><ul>\n";
echo "<b><a href=\"new.php?table=libraries\">Ajouter une nouvelle bibliothèque</a></b>\n";
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
