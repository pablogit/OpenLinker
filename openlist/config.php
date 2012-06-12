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
// Configuration des paramètres essentiels au fonctionnement de la base

// Codes d'accès à la base MySQL
$configmysqldb = "openlist";
$configmysqlhost = "localhost";
$configmysqllogin = "root";
$configmysqlpwd = "";

// Nom de l'application affiché dans la barre intermédiaire et dans le titre du code HTML
$configname = "OpenList : recherche des revues accessibles à l'université XYZ";

// Nom de l'institution principale
$configinstitution = "Université XYZ";

// Nom de l'institution secondaire
$configinstitution2 = "Hôpital universitaire de XYZ";

// Code pour les statistiques de Google Analytics
// Laisser vide si ce n'est pas applicable
$configanalytics = "UA-31278787";

// email générique affiché dans les pages de description ou les messages d'erreur
$configemail = "admin@xyz.com";

// email de l'administrateur de la base sur lequel seront dirigés les messages de feedback
$configemailto = "admin@xyz.com";

// Rang d'adresse IP permettant l'affichage du login et password des revues gérés par mot de passe
// début de l'adresse de l'institution principale 
$configipainst1 = "155";
$configipbinst1 = "105";
// début de l'adresse de l'institution secondaire 
$configipainst2 = "133";
$configipbinst2 = "33";

// Adresse du site de la bibliothèque
$configlibraryurl = "http://www.xyz.com/library";

// Nom de la bibliothèque
$configlibrary = "Bibliothèque de l'Université XYZ";

// Adresse de la bibliothèque responsable de la base qui est affiché dans les messages de feedback et les pages de description
$configadresse = "Bibliothèque de l'Université XYZ\n";
$configadresse .= "Bâtiment XY - Code postal 1234\n";
$configadresse .= "Ville QW - Pays\n";
$configadresse .= "Tel. +12 34 567 89 01\n";
$configadresse .= "library@xyz.com\n";
$configadresse .= "http://www.xyz.com/library\n";

// Adresse de la page d'aide du helpdesk
$confighelpdeskurl = "http://www.xyz.com/help";

// Nom des gestionaires de la base
$configteam = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";

?>
