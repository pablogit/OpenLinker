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
// Login form
//
require ("includes/config.php");
require ("includes/authcookie.php");
$logok=0;
$monhost = "http://" . $_SERVER['SERVER_NAME'];
$monuri = $monhost . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
$rediradmin = "Location: " . $monuri . "list.php?folder=in";
$rediruser = "Location: " . $monuri . "list.php?folder=in";
$redirguest = "Location: " . $monuri . "list.php?folder=guest";
if ((!empty($_COOKIE[illinkid])) && (!isset($_GET['action'])) && ($monaut=="sadmin"))
header("$rediradmin");
if ((!empty($_COOKIE[illinkid])) && (!isset($_GET['action'])) && ($monaut=="admin"))
header("$rediradmin");
if ((!empty($_COOKIE[illinkid])) && (!isset($_GET['action'])) && ($monaut=="user"))
header("$rediruser");
if ((!empty($_COOKIE[illinkid])) && (!isset($_GET['action'])) && ($monaut=="guest"))
header("$redirguest");
if(isset($_GET['action']))
{
if ($_GET['action'] == 'logout')
{
setcookie('illinkid[nom]', '', (time() - 31536000));
setcookie('illinkid[bib]', '', (time() - 31536000));
setcookie('illinkid[aut]', '', (time() - 31536000));
setcookie('illinkid[log]', '', (time() - 31536000));
}
}
if ((isset($_POST['log']))&&(isset($_POST['pwd'])))
{
$logok=0;
$log=$_POST['log'];
$password=md5($_POST['pwd']);
require ("includes/connect.php");
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
$library = $enreg['library'];
$admin = $enreg['admin'];
$admin = md5 ($admin . $secure_string_cookie);
setcookie('illinkid[nom]', $nom, (time() + 36000));
setcookie('illinkid[bib]', $library, (time() + 36000));
setcookie('illinkid[aut]', $admin, (time() + 36000));
setcookie('illinkid[log]', $login, (time() + 36000));
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
//
// Connexion par login crypté
//
$mailg = strtolower($_POST['log']) . $secure_string_guest_login;
$passwordg = substr(md5($mailg), 0, 8);
if ($_POST['pwd'] == $passwordg)
{
$cookie_guest = md5 ("9" . $secure_string_cookie);
$logok=$logok+1;
setcookie('illinkid[nom]', strtolower($_POST['log']), (time() + 36000));
setcookie('illinkid[bib]', 'guest', (time() + 36000));
setcookie('illinkid[aut]', $cookie_guest, (time() + 36000));
setcookie('illinkid[log]', strtolower($_POST['log']), (time() + 36000));
header("$redirguest");
}
else
$mes='Le login ou le password ne sont pas corrects';
}
}
require ("includes/header.php");
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
echo "\n";
if ($_GET['action'] == 'logout')
{
$monnom="";
$monaut="";
$monlog="";
}
require ("includes/footer.php");
?>
