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
// Home page for administrators
require ("includes/config.php");
require ("includes/authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("includes/headeradmin.php");
echo "\n";
echo "<br/><br/>\n";
// 
// Liens pour les administrateurs
// 
echo "<h1>Administration</h1>\n";
echo "<br/>\n";
echo "<ul>\n";
// echo "<li><h2><a href=\"adminsearch.php\">Recherche administrateur</a></h2></li>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
{
echo "<li><h2><a href=\"list.php?table=users\">Gestion des utilisateurs</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=users\">Créer un nouvel utilisateur</a></h3></li>\n";
echo "<li><h3><a href=\"edit.php?table=users&action=updateprofile\">Modifier mes codes d'accès</a></h2></li></ul>\n";
echo "<li><h2><a href=\"list.php?table=libraries\">Gestion des bibliothèques</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=libraries\">Créer une nouvelle bibliothèque</a></h2></li></ul>\n";
echo "<li><h2><a href=\"list.php?table=localizations\">Gestion des localisations</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=localizations\">Créer une nouvelle localisation</a></h2></li></ul>\n";
echo "<li><h2><a href=\"list.php?table=status\">Gestion des étapes de la commande</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=status\">Créer une nouvelle étape de la commande</a></h2></li></ul>\n";
echo "<li><h2><a href=\"list.php?table=units\">Gestion des unités/services</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=units\">Créer une nouvelle unité/service</a></h2></li></ul>\n";
echo "<li><h2><a href=\"list.php?table=links\">Gestion des liens sortants</a></h2></li>\n";
echo "<ul><li><h3><a href=\"new.php?table=links\">Créer un nouveau lien sortant</a></h2></li></ul>\n";
echo "<br/><br/>\n";
echo "<li><h2><a href=\"emptytrash.php\">Vider la corbeille</a></h2></li>\n";
}
else
echo "<li><h2><a href=\"edit.php?table=users&action=updateprofile\">Modifier mes codes d'accès</a></h2></li>\n";
echo "</ul>\n";
echo "<br/><br/>\n";
echo "\n";
require ("includes/footer.php");
}
else
{
require ("includes/header.php");
require ("includes/loginfail.php");
require ("includes/footer.php");
}
}
else
{
require ("includes/header.php");
require ("includes/loginfail.php");
require ("includes/footer.php");
}
?>
