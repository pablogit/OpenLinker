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
// Table sujets : formulaire de création d'une nouvelle fiche
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin"))
{
$pagetitle = "Revues de " . $configinstitution . " : nouveau thème ";
require ("header.php");
echo "<h1>Gestion des thèmes</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
echo "<form action=\"updatesubject.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='subjects.php'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom (FR) *</b></td><td class=\"odd\"><input name=\"sujetsfr\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Nom (EN)</b></td><td><input name=\"sujetsen\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>CODE ISI *</b></td><td class=\"odd\"><input name=\"sujetscode\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Thème SHS *</b></td><td><input type=\"radio\" name=\"sujetsshs\" value=\"1\"/> Oui  |  <input type=\"radio\" name=\"sujetsshs\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Thème STM *</b></td><td class=\"odd\"><input type=\"radio\" name=\"sujetsstm\" value=\"1\"/> Oui  |  <input type=\"radio\" name=\"sujetsstm\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td><b>Synonymes</b></td><td><input name=\"sujetsfm\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='subjects.php'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
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
