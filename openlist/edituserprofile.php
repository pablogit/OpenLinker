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
// Table users : formulaire de modification de son propre profil utilisateur
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$req = "SELECT * FROM users WHERE users.login = '$monlog'";
$pagetitle = "Revues de " . $configinstitution . " : édition de mon profil";
require ("header.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<h1>Gestion de mon profil</h1>\n";
echo "<br /></b>";
echo "<ul>\n";
$enreg = mysql_fetch_array($result);
$id = $enreg['user_id'];
$name = $enreg['name'];
$email = $enreg['email'];
$login = $enreg['login'];
$status = $enreg['status'];
$admin = $enreg['admin'];
$password = $enreg['password'];
echo "<form action=\"updateuser.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"updateprofile\">\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='administration.php'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Nom</b></td><td class=\"odd\"><input name=\"name\" type=\"text\" size=\"60\" value=\"".$name."\"></td></tr>\n";
echo "<tr><td><b>E-mail</b></td><td><input name=\"email\" type=\"text\" size=\"60\" value=\"".$email."\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Login</b></td><td class=\"odd\"><input name=\"login\" type=\"text\" size=\"60\" value=\"".$login."\"></td></tr>\n";
echo "<tr><td><b>Nouveau password</b></td><td><input name=\"newpassword1\" type=\"password\" size=\"30\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Confirmation du nouveau password</b></td><td class=\"odd\"><input name=\"newpassword2\" type=\"password\" size=\"30\" value=\"\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='administration.php'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
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
