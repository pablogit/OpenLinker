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
// Status table : record creation form
// 
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : nouvelle étape de la commande ";
require ("headeradmin.php");
require ("connect.php");
echo "<h1>Gestion des étapes de la commande : Création d'une nouvelle fiche </h1>\n";
echo "<br /></b>";
echo "<ul>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"status\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer la nouvelle étape\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=status'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td><b>Code (numérique) *</b></td><td>\n";
echo "<input name=\"code\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Title 1 *</b></td><td class=\"odd\"><input name=\"title1\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Help 1</b></td><td><input name=\"help1\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Title 2</b></td><td class=\"odd\"><input name=\"title2\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Help 2</b></td><td><input name=\"help2\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Title 3</b></td><td class=\"odd\"><input name=\"title3\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Help 3</b></td><td><input name=\"help3\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Title 4</b></td><td class=\"odd\"><input name=\"title4\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Help 4</b></td><td><input name=\"help4\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Title 5</b></td><td class=\"odd\"><input name=\"title5\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Help 5</b></td><td><input name=\"help5\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Folder IN</b></td><td class=\"odd\"><input name=\"in\" value=\"1\" type=\"checkbox\"></td></tr>\n";
echo "<tr><td><b>Folder OUT</b></td><td><input name=\"out\" value=\"1\" type=\"checkbox\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Folder TRASH</b></td><td class=\"odd\"><input name=\"trash\" value=\"1\" type=\"checkbox\"></td></tr>\n";
echo "<tr><td><b>Special status</b></td><td>";
echo "<select name=\"special\">\n";
echo "<option value=\"\"></option>\n";
echo "<option value=\"new\">Nouvelle commande (new)</option>\n";
echo "<option value=\"sent\">Commande envoyée (sent)</option>\n";
echo "<option value=\"paid\">Commande soldée (paid)</option>\n";
echo "<option value=\"renew\">Commande à renouveler (renew)</option>\n";
echo "<option value=\"reject\">Commande rejetée (reject)</option>\n";
echo "<option value=\"tobevalidated\">Commande à valider (tobevalidated)</option>\n";
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Color (HTML code)</b></td><td class=\"odd\"><input name=\"color\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer la nouvelle étape\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=status'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
require ("footer.php");
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
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
