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
// List of orders used in different pages : list, search results, guest, etc.

if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user")||($monaut == "guest"))
{
// Build Page Number Hyperlinks
require ("pages.php");

if ($total_results == 1)
echo "<b>" . $total_results." commande trouv&eacute;e</b>\n";
else
echo "<b>" . $total_results." commandes trouv&eacute;es</b>\n";
echo "<br />";
echo "<br />";

if ($nb > 0)
{
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
echo "<tr><td valign=\"top\" width=\"95%\">\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$id = $enreg['illinkid'];
$type_doc = $enreg['type_doc'];
$date = $enreg['date'];
$stade = $enreg['stade'];
$localisation = $enreg['localisation'];
$nom = $enreg['nom'].', '.$enreg['prenom'];
$mail = $enreg['mail'];
$adresse = $enreg['adresse'].', '.$enreg['code_postal'].' '.$enreg['localite'];
$statusname = $enreg['title1'];
$statushelp = $enreg['help1'];
$statusrenew = $enreg['renew'];
$statuscolor = $enreg['color'];
echo "<table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"0\">\n";
echo "<tr><td valign=\"top\" width=\"20\">&nbsp;</td>\n";
echo "<td valign=\"top\" align=\"left\">\n";
if ($monaut != "guest")
echo "<a href=\"detail.php?table=orders&id=".$id."\" title=\"voir la notice compl&egrave;te\">\n";
require ("ordertop.php");
echo "<br>\n";
echo "</td></tr>\n";
echo "<tr><td>&nbsp;</td></tr>\n";
echo "<tr><td>&nbsp;</td></tr>\n";
echo "</table>\n";
}
echo "</td></tr>\n";
echo "</table>\n";
// Build Page Number Hyperlinks
require ("pages.php");
}
}
?>
