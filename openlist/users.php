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
// Table users : Liste complète des utlisateurs
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
// Liste des utilisateurs
// 
echo "<h1>Gestion des utilisateurs</h1>\n";
$req = "SELECT * FROM users ORDER BY user_id ASC LIMIT 0, 200";
$result = mysql_query($req,$link);
$total_results = mysql_num_rows($result);
$nb = $total_results;

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " utilisateur trouv&eacute;</b></font>\n";
else
echo " utilisateurs trouv&eacute;s</b></font>\n";
echo "<br/>";
echo "<br/>";

echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "</colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Nom</th>\n";
echo "<th scope=\"col\">E-Mail</th>\n";
echo "<th scope=\"col\">Login</th>\n";
echo "<th scope=\"col\">Droits</th>\n";
echo "<th scope=\"col\">Status</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$user_id = $enreg['user_id'];
$name = $enreg['name'];
$email = $enreg['email'];
$login = $enreg['login'];
$status = $enreg['status'];
$admin = $enreg['admin'];
echo "<tr>\n";
echo "<td class=\"titrestableau\"><b>";
echo $name;
echo "</b></td>\n";
echo "\n";
echo "<td>".$email."</b>\n";
echo "</td>\n";
echo "<td>";
echo $login."\n";
echo "</td>\n";
echo "<td>";
if ($admin == 1)
echo "Super administrateur";
if ($admin == 2)
echo "Administrateur";
if ($admin == 3)
echo "Collaborateur";
if ($admin > 3)
echo "Invité";
echo "</td>\n";
echo "<td>";
if ($status == 1)
echo "Actif";
else
echo "Inactif";
echo "</td>\n";
if ((($monaut == "admin")&&($admin > 1))||($monaut == "sadmin"))
{
echo "<td><a href=\"edituser.php?&id=".$user_id."\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
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
