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
// Table users : formulaire de création d'une nouvelle fiche
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin"))
{
$pagetitle = "Revues de " . $configinstitution . " : nouvel fiche utilisateur ";
require ("header.php");
echo "<h1>Gestion des utilisateurs</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
echo "<form action=\"updateuser.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='users.php'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom *</b></td><td class=\"odd\"><input name=\"name\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>E-mail</b></td><td><input name=\"email\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Login *</b></td><td class=\"odd\"><input name=\"login\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Status *</b></td><td><input type=\"radio\" name=\"status\" value=\"1\"/> Actif  |  <input type=\"radio\" name=\"status\" value=\"0\"/> Inactif</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Droits *</b></td><td class=\"odd\">\n";
echo "<select name=\"admin\" id=\"admin\">\n";
if ($monaut == "sadmin")
echo "<option value=\"1\">Super administrateur</option>\n";
echo "<option value=\"2\">Administrateur</option>\n";
echo "<option value=\"3\">Collaborateur</option>\n";
echo "<option value=\"9\">Invité</option>\n";
echo "</select>\n";
echo "<tr><td><b>Password *</b></td><td><input name=\"newpassword1\" type=\"password\" size=\"30\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Confirmation du password *</b></td><td class=\"odd\"><input name=\"newpassword2\" type=\"password\" size=\"30\" value=\"\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='users.php'\"></td></tr>\n";
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
