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
// Table sujets : formulaire de modification
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin"))
{
require ("connexion.php");
$id=$_GET['id'];
$action=$_GET['action'];
if ($id)
{
$req = "SELECT * FROM sujets WHERE sujets.sujetsid = '$id'";
$pagetitle = "Revues de " . $configinstitution . " : édition du thème " . $id;
require ("header.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<h1>Gestion des thèmes</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
$enreg = mysql_fetch_array($result);
$sujetsid = $enreg['sujetsid'];
$sujetsfr = $enreg['sujetsfr'];
$sujetsen = $enreg['sujetsen'];
$sujetscode = $enreg['sujetscode'];
$sujetsshs = $enreg['sujetsshs'];
$sujetsstm = $enreg['sujetsstm'];
$sujetsfm = $enreg['sujetsfm'];
if (($monaut == "admin")&&($admin == 1))
{
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour éditer cette fiche</b></font></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
if ((($monaut == "admin")&&($admin > 1))||($monaut == "sadmin"))
{
echo "<form action=\"updatesubject.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='subjects.php'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom (FR) *</b></td><td class=\"odd\"><input name=\"sujetsfr\" type=\"text\" size=\"60\" value=\"".$sujetsfr."\"></td></tr>\n";
echo "<tr><td><b>Nom (EN)</b></td><td><input name=\"sujetsen\" type=\"text\" size=\"60\" value=\"".$sujetsen."\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>CODE ISI *</b></td><td class=\"odd\"><input name=\"sujetscode\" type=\"text\" size=\"60\" value=\"".$sujetscode."\"></td></tr>\n";
echo "<tr><td><b>Thème SHS *</b></td><td><input type=\"radio\" name=\"sujetsshs\" value=\"1\"/";
if ($sujetsshs == 1)
echo " checked";
echo "> Oui  |  <input type=\"radio\" name=\"sujetsshs\" value=\"0\"/";
if ($sujetsshs == 0)
echo " checked";
echo "> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Thème STM *</b></td><td class=\"odd\"><input type=\"radio\" name=\"sujetsstm\" value=\"1\"/";
if ($sujetsstm == 1)
echo " checked";
echo "> Oui  |  <input type=\"radio\" name=\"sujetsstm\" value=\"0\"/";
if ($sujetsstm == 0)
echo " checked";
echo "> Non</td></tr>\n";
echo "<tr><td><b>Synonymes</b></td><td><input name=\"sujetsfm\" type=\"text\" size=\"60\" value=\"".$sujetsfm."\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='subjects.php'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
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
echo "</div>\n";
echo "</div>\n";
echo "\n";
require ("footer.php");
}
}
else
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour éditer cette fiche</b></font></center><br /><br /><br /><br />\n";
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
