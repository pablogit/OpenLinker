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
// Table journals : bloc de recherche rapide utilisé dans les pages des résultats

$query = str_replace("%"," ",$q);
$query = str_replace("\'","'",$query);
if ($init)
$query=$init;
echo "<center>\n";
echo "<form action=\"search.php\" method=\"get\" enctype=\"x-www-form-encoded\" name=\"recherche\" id=\"recherche\" onsubmit=\"return check_search()\">\n";
// if (($format!='all')||($field!='title'))
// {
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>\n";
echo "<b>Recherche rapide : &nbsp;</b>\n";
echo "</td><td>\n";
echo "<input name=\"q\" id=\"q\" type=\"text\" size=\"60\" value=\"".$query."\">\n";
echo "<input name=\"init\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"search\" type=\"hidden\" value=\"simple\">\n";
// echo "<input name=\"format\" type=\"hidden\" value=\"" . $format . "\">\n";
// echo "<input name=\"field\" type=\"hidden\" value=\"" . $field . "\">\n";
echo "&nbsp;<input type=\"submit\" value=\"OK\">\n";
echo "&nbsp;&nbsp; <a href=\"advanced.php\">Recherche avancée</a>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo " | <a href=\"adminsearch.php\">Recherche administrateur</a>\n";
}
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "</td><td>\n";
echo "<input type=\"radio\" name=\"field\" value=\"title\"";
if (($field!='tbegin')&&($field!='texact')&&($field!='all'))
echo " checked";
echo "/>mots du titre | <input type=\"radio\" name=\"field\" value=\"tbegin\"";
if ($field=='tbegin')
echo " checked";
echo "/>début du titre  |  <input type=\"radio\" name=\"field\" value=\"texact\"";
if ($field=='texact')
echo " checked";
echo "/>titre exact  |  <input type=\"radio\" name=\"field\" value=\"all\"";
if ($field=='all')
echo " checked";
echo "/>tous les champs\n";
echo "<br/>\n";
echo "<input type=\"radio\" name=\"format\" value=\"all\"";
if ((($format!='e')&&($format!='p'))||($collapsetemp=='0'))
echo " checked";
echo "/>tous | <input type=\"radio\" name=\"format\" value=\"e\"";
if (($format=='e')&&($collapsetemp!='0'))
echo " checked";
echo "/>électroniques | <input type=\"radio\" name=\"format\" value=\"p\"";
if (($format=='p')&&($collapsetemp!='0'))
echo " checked";
echo "/>imprimés \n";
echo "</td></tr></table>\n";
// }
// else
// {
// echo "<b>Recherche rapide : &nbsp;</b>\n";
// echo "<input name=\"q\" id=\"q\" type=\"text\" size=\"60\" value=\"".$query."\">\n";
// echo "<input name=\"init\" type=\"hidden\" value=\"\">\n";
// echo "<input name=\"format\" type=\"hidden\" value=\"" . $format . "\">\n";
// echo "<input name=\"field\" type=\"hidden\" value=\"" . $field . "\">\n";
// echo "&nbsp;<input type=\"submit\" value=\"OK\">\n";
// }
// echo "&nbsp;<input type=\"reset\" value=\"Annuler\">\n";
echo "</form></center>";
?>
