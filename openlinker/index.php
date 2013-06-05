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
// 
// Home page : links generation
//
require ("includes/config.php");
require ("includes/authip.php");
require ("includes/authcookie.php");
require ("includes/connect.php");
$myhtmltitle = $configname[$lang];
// $mybodyonload = "OpenURL2form();";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
// display to admin
require ("includes/headeradmin.php");
}
else
{
// display to guest or users not logged in
if ($monaut == "guest")
require ("includes/headeradmin.php");
if ($monaut == "")
require ("includes/header.php");
}
require ("includes/openurlparser.php");
echo "<h1>Générateur des liens OpenLinker</h1>\n";
echo "<form action=\"index.php\" method=\"get\" enctype=\"x-www-form-encoded\" name=\"openurlform\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<b>Obtenir les métadonnées à partir du </b>\n";
echo "<select name=\"tid\">\n";
echo "<option value=\"pmid\">PMID</option>\n";
echo "<option value=\"doi\">DOI</option>\n";
echo "<option value=\"isbn\">ISBN</option>\n";
echo "<option value=\"reroid\">RERO ID</option>\n";
echo "</select>\n";
echo "<input name=\"uids\" type=\"text\" size=\"20\" value=\"\">\n";
echo "<input type=\"submit\" value=\"OK\">\n";
echo "</div></div>\n";
echo "<div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "<table cellpadding=\"0\">\n";
echo "<tr><td>Type : </td><td><select name=\"genre\">\n";
echo "<option value=\"article\"";
if ($genre == 'article')
echo " selected";
echo ">Article</option>\n";
echo "<option value=\"book\"
";
if ($genre == 'book')
echo " selected";
echo ">Livre</option>\n";
echo "<option value=\"journal\"";
if ($genre == 'journal')
echo " selected";
echo ">Numéro de revue</option>\n";
echo "<option value=\"proceeding\"";
if ($genre == 'proceeding')
echo " selected";
echo ">Actes de conférence</option>\n";
echo "<option value=\"conference\"";
if ($genre == 'conference')
echo " selected";
echo ">Conference paper</option>\n";
echo "<option value=\"preprint\"";
if ($genre == 'preprint')
echo " selected";
echo ">Preprint</option>\n";
echo "<option value=\"unknown\"";
if ($genre == 'unknown')
echo " selected";
echo ">Inconnu</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td>Auteurs : </td><td><input name=\"aulast\" size=\"70%\" value=\"" . $authors . "\" type=\"text\"></td></tr>\n";
echo "<tr><td>Titre de l'article : </td><td><input name=\"atitle\" size=\"70%\" value=\"" . $atitle . "\" type=\"text\"></td></tr>\n";
echo "<tr><td>Titre du livre ou de la revue : </td><td><input name=\"title\" size=\"70%\" value=\"" . $title . "\" type=\"text\"></td></tr>\n";
echo "<tr><td>Date : </td><td><input name=\"date\" size=\"8%\" value=\"" . $date . "\" type=\"text\">&nbsp;&nbsp;\n";
echo "Volume : <input name=\"volume\" size=\"6%\" value=\"" . $volume . "\" type=\"text\">&nbsp;&nbsp;\n";
echo "Issue : <input name=\"issue\" size=\"6%\" value=\"" . $issue . "\" type=\"text\">&nbsp;&nbsp;\n";
echo "Pages : <input name=\"pages\" size=\"8%\" value=\"" . $pages . "\" type=\"text\"></td></tr>\n";
echo "<tr><td>ISSN : </td><td><input name=\"issn\" size=\"8%\" value=\"" . $issn . "\" type=\"text\">&nbsp;&nbsp;\n";
echo "ISBN : <input name=\"isbn\" size=\"12%\" value=\"" . $isbn . "\" type=\"text\">&nbsp;&nbsp;\n";
echo "UID : <input name=\"uid\" size=\"25%\" value=\"" . $uid . "\" type=\"text\"></td></tr>\n";
echo "<tr><td></td><td><input value=\"Actualiser les liens\" type=\"submit\"><input value=\"Effacer\" type=\"reset\"></td></tr>\n";
echo "</table>\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "</form>\n";
require ("includes/linksgenerator.php");
require ("includes/footer.php");
?>
