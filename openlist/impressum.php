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
// Page d'information concernant le site
require ("config.php");
$pagetitle = "Revues de " . $configinstitution . " : Impressum";
require ("header.php");
echo "<h1>Impressum</h1>\n";
echo "<h2>Equipe de gestion de la base de revues et ebooks de " . $configinstitution . "</h2>\n";
echo "\n";
echo "<ul>\n";
echo $configteam . "\n";
echo "</ul>\n";
echo "\n";
echo "\n";
echo "<h2>Technique et graphisme</h2>\n";
echo "\n";
echo "<p>\n";
echo "Site publié avec PHP/MySQL et basé sur le système libre <a href=\"http://www.openlinker.org\">OpenLinker</a>\n";
echo "\n";
echo "</p><p>\n";
echo "Interface de recherche et de gestion conçu par Pablo Iriarte, Bibliothèque Universiatire de Médecine, CHUV - Lausanne\n";
echo "\n";
echo "</p>\n";
echo "<br />\n";
echo "</ul>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
require ("footer.php");
?>
