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
// Page d'accueil pour les administrateurs ou collaborateurs après l'authentification
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$pagetitle = "Revues de " . $configinstitution . " : administration";
require ("header.php");
echo "\n";
echo "<br/><br/>\n";
// 
// Liens pour les administrateurs
// 
echo "<h1>Administration de la base Revues de " . $configinstitution . "</h1>\n";
echo "<br/>\n";
echo "<ul>\n";
echo "<li><h2><a href=\"advanced.php\">Recherche avancée</a></h2></li>\n";
echo "<li><h2><a href=\"adminsearch.php\">Recherche administrateur</a></h2></li>\n";
echo "<li><h2><a href=\"new.php\">Créer une nouvelle fiche</a></h2></li>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
echo "<li><h2><a href=\"users.php\">Gestion des utilisateurs</a></h2></li>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
echo "<li><h2><a href=\"newuser.php\">Créer un nouvel utilisateur</a></h2></li>\n";
echo "<li><h2><a href=\"edituserprofile.php\">Modifier mes codes d'accès</a></h2></li>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
{
echo "<li><h2><a href=\"subjects.php\">Gestion des thèmes</a></h2></li>\n";
echo "<li><h2><a href=\"newsubject.php\">Créer un nouveau thème</a></h2></li>\n";
}
echo "</ul>\n";
echo "<br/><br/>\n";
echo "\n";
echo "</div>\n";
echo "</div>\n";
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
