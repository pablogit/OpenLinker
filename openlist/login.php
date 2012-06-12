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
// Table users : formulaire de login et authentification. Création d'un cookie d'une durée de 10 heures
require ("config.php");
$logok=0;
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
// $monpwd=$_COOKIE['journalsid']['pwd'];
$monhost = "http://" . $_SERVER['SERVER_NAME'];
$monuri = $monhost . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
$rediradmin = "Location: " . $monuri . "administration.php";
$rediruser = "Location: " . $monuri . "administration.php";
$redirguest = "Location: " . $monuri . "index.php";
if ((!empty($_COOKIE[journalsid])) && (!isset($_GET['action'])) && ($monaut=="admin"))
header("$rediradmin");
if ((!empty($_COOKIE[journalsid])) && (!isset($_GET['action'])) && ($monaut=="user"))
header("$rediruser");
if ((!empty($_COOKIE[journalsid])) && (!isset($_GET['action'])) && ($monaut=="guest"))
header("$redirguest");
if(isset($_GET['action']))
{
if ($_GET['action'] == 'logout')
{
setcookie('journalsid[nom]', '', (time() - 31536000));
setcookie('journalsid[aut]', '', (time() - 31536000));
setcookie('journalsid[log]', '', (time() - 31536000));
// setcookie('journalsid[pwd]', '', (time() - 31536000));
}
}
if ((isset($_POST['log']))&&(isset($_POST['pwd'])))
{
$log=$_POST['log'];
$password=md5($_POST['pwd']);
require ("connexion.php");
// check if the user id and password combination exist in database
$req = "SELECT * FROM users WHERE login = '$log' AND password = '$password'";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
// the user id and password match,
$logok=$logok+1;
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$nom = $enreg['name'];
$login = $enreg['login'];
$status = $enreg['status'];
$admin = $enreg['admin'];
if ($admin == 1)
$admin = "sadmin";
if ($admin == 2)
$admin = "admin";
if ($admin == 3)
$admin = "user";
if ($admin > 3)
$admin = "guest";
if ($status != 1)
$admin = "guest";
setcookie('journalsid[nom]', $nom, (time() + 36000));
setcookie('journalsid[aut]', $admin, (time() + 36000));
setcookie('journalsid[log]', $login, (time() + 36000));
// setcookie('journalsid[pwd]', $password, (time() + 36000));
header("$rediradmin");
}
}
else
{
$mes='Le login ou le password ne sont pas corrects';
}
}
if ((isset($_POST['log']))||(isset($_POST['pwd'])))
{
if ($logok==0)
{
$mes='Le login ou le password ne sont pas corrects';
}
}
require ("header.php");
echo "<ul>\n";
if ($mes)
echo "<br /><b><font color=\"red\">".$mes."</font></b><br />\n";
echo "<form name=\"loginform\" id=\"loginform\" action=\"login.php\" method=\"post\">\n";
echo "<p><label>Username:<br /><input type=\"text\" name=\"log\" id=\"log\" value=\"" . $log . "\" size=\"20\" tabindex=\"1\" /></label></p>\n";
echo "<p><label>Password:<br /> <input type=\"password\" name=\"pwd\" id=\"pwd\" value=\"\" size=\"20\" tabindex=\"2\" /></label></p>\n";
// echo "<p>\n";
// echo "  <label><input name=\"rememberme\" type=\"checkbox\" id=\"rememberme\" value=\"forever\" tabindex=\"3\" /> \n";
// echo "  Garder en mémoire</label></p>\n";
echo "<p>\n";
echo "<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"login\" tabindex=\"4\" />\n";
echo "<input type=\"hidden\" name=\"redirect_to\" value=\"/\" />\n";
echo "</p>\n";
echo "<br />\n";
echo "</form>\n";
echo "</ul>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
if ($_GET['action'] == 'logout')
{
$monnom="";
$monaut="";
$monlog="";
}
require ("footer.php");
?>
