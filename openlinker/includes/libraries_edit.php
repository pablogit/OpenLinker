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
// Libraries table : edit form
// 
require ("config.php");
require ("authcookie.php");
$id="";
$montitle = "Gestion des bibliothèques";
$id=$_GET['id'];
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
require ("connect.php");
if ($id!="")
{
$req = "SELECT * FROM libraries WHERE id = '$id'";
$myhtmltitle = "Commandes de l'" . $configinstitution . " : édition de la bibliothèque " . $id;
$montitle = "Gestion des bibliothèques : édition de la fiche " . $id;
require ("headeradmin.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<h1>" . $montitle . "</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
$enreg = mysql_fetch_array($result);
$libid = $enreg['id'];
$libcode = $enreg['code'];
$name["fr"] = $enreg['name1'];
$name["en"] = $enreg['name2'];
$name["de"] = $enreg['name3'];
$name["it"] = $enreg['name4'];
$name["es"] = $enreg['name5'];
$libdef = $enreg['default'];
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"libraries\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$libid."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=libraries'\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Supprimer\" onClick=\"self.location='update.php?action=delete&table=libraries&id=" . $libid . "'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td><b>Code *</b></td><td>\n";
echo "<input name=\"code\" type=\"text\" size=\"30\" value=\"" . $libcode . "\"></td></tr>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 1 *</b></td><td class=\"odd\"><input name=\"name1\" type=\"text\" size=\"30\" value=\"" . $name["fr"] . "\"></td></tr>\n";
echo "<tr><td><b>Nom 2</b></td><td><input name=\"name2\" type=\"text\" size=\"30\" value=\"" . $name["en"] . "\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 3</b></td><td class=\"odd\"><input name=\"name3\" type=\"text\" size=\"30\" value=\"" . $name["de"] . "\"></td></tr>\n";
echo "<tr><td><b>Nom 4</b></td><td><input name=\"name4\" type=\"text\" size=\"30\" value=\"" . $name["it"] . "\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom 5</b></td><td class=\"odd\"><input name=\"name5\" type=\"text\" size=\"30\" value=\"" . $name["es"] . "\"></td></tr>\n";
echo "<tr><td><b>Default</b></td><td><input name=\"default\" value=\"1\" type=\"checkbox\"";
if ($libdef==1)
echo " checked";
echo "></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='list.php?table=libraries'\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Supprimer\" onClick=\"self.location='update.php?action=delete&table=libraries&id=" . $libid . "'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
require ("footer.php");
}
}
else
{
require ("header.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
echo "<br /><br />\n";
echo "</ul>\n";
echo "\n";
require ("footer.php");
}
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour éditer cette fiche</b></font></center><br /><br /><br /><br />\n";
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
