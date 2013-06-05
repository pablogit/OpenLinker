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
// Table users : modification / création d'un enregistrement
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
$action2="";
$action="";
$id=addslashes($_POST['id']);
$ip = $_SERVER['REMOTE_ADDR'];
$action=addslashes($_POST['action']);
$action2=addslashes($_GET['action']);
if ($action2!="")
$action = $action2;
if (($monaut == "admin")||($monaut == "sadmin")||(($monaut == "user")&&($action == "updateprofile")))
{
if (($monaut == "user")&&($action == "updateprofile"))
$action == "update";
if (($action == "update")||($action == "new"))
{

$mes="";
$date=date("Y-m-d H:i:s");
$name = addslashes(trim($_POST['name']));
$email = addslashes(trim($_POST['email']));
$login = addslashes(trim($_POST['login']));
$status = addslashes($_POST['status']);
$admin = addslashes($_POST['admin']);
$library = addslashes($_POST['library']);
$newpassword1 = addslashes($_POST['newpassword1']);
$newpassword2 = addslashes($_POST['newpassword2']);
if ($newpassword1 != "")
$password = md5($newpassword1);
// Tester si le login est unique
require ("connect.php");
$reqlogin = "SELECT * FROM users WHERE users.login = '$login'";
$resultlogin = mysql_query($reqlogin,$link);
$nblogin = mysql_num_rows($resultlogin);
$enreglogin = mysql_fetch_array($resultlogin);
$idlogin = $enreglogin['user_id'];
if (($nblogin == 1)&&($action == "new"))
$mes = $mes . "<br/>le login '" . $login . "' existe déjà dans la base, veuillez choisir un autre";
if (($nblogin == 1)&&($action != "new")&&($idlogin != $id))
$mes = $mes . "<br/>le login '" . $login . "' est déjà attribué à un autre utilisateur, veuillez choisir un autre";
if ($name == "")
$mes = $mes . "<br/>le nom est obligatoire";
if ($login == "")
$mes = $mes . "<br/>le login est obligatoire";
if (($status == "")&&($action != "updateprofile"))
$mes = $mes . "<br/>la status est obligatoire";
if (($admin == "")&&($action != "updateprofile"))
$mes = $mes . "<br/>le type d'utilisateur est obligatoire";
if (($newpassword1 == "")&&($action == "new"))
$mes = $mes . "<br/>le password est obligatoire";
if (($newpassword2 != $newpassword1)||(($newpassword2 == "")&&($action == "new")))
$mes = $mes . "<br/>le password n'a pas été confirmé correctement";
if ($mes != "")
{
require ("headeradmin.php");
echo "<center><br/><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire</a></b></center><br /><br /><br /><br />\n";
require ("footer.php");
}
else
{
// 
// Début de l'édition
//
if (($action == "update")||($action == "updateprofile"))
{
if ($id != "")
{
require ("connect.php");
require ("headeradmin.php");
$reqid = "SELECT * FROM users WHERE users.user_id = '$id'";
$myhtmltitle = "Commandes de " . $configinstitution . " : édition de la fiche utilisateur " . $id;
$resultid = mysql_query($reqid,$link);
$nb = mysql_num_rows($resultid);
if ($nb == 1)
{
$enregid = mysql_fetch_array($resultid);
$query = "UPDATE users SET name='$name', email='$email', login='$login', ";
if ($action == "update")
$query = $query . "status=$status, admin=$admin, ";
if ($newpassword1 != "")
$query = $query . "password='$password', ";
$query = $query . "library='$library', ";
$query = $query . "created_ip='$ip', created_on='$date' WHERE user_id=$id";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La modification de la fiche " . $id . " a été enregistrée avec succès</b></font>\n";
if ($action == "updateprofile")
echo "<br/><br/><br/><a href=\"admin.php\">Retour à la page d'administration</a></center>\n";
else
echo "<br/><br/><br/><a href=\"list.php?table=users\">Retour à la liste d'utulisateurs</a></center>\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car l'identifiant de la fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
require ("footer.php");
}
}
else
{
require ("headeradmin.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car il manque l'identifiant de la fiche</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche</b></center><br /><br /><br /><br />\n";
require ("footer.php");
}
}
// 
// Fin de l'édition
//
// Début de la création
//
if ($action == "new")
{
require ("connect.php");
require ("headeradmin.php");
$myhtmltitle = "commandes de " . $configinstitution . " : nouvel utilisateur";
$query ="INSERT INTO `users` (`user_id`, `name`, `email`, `login`, `status`, `admin`, `password`, `created_ip`, `created_on`, `library`) VALUES ('', '$name', '$email', '$login', '$status', '$admin', '$password', '$ip', '$date', '$library')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$id = mysql_insert_id();
echo "<center><br/><b><font color=\"green\">\n";
echo "La nouvelle fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=users\">Retour à la liste d'utulisateurs</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
// 
// Fin de la saisie
//
}
}
// 
// Début de la suppresion
//
if ($action == "delete")
{
$id=addslashes($_GET['id']);
$myhtmltitle = $configname[$lang] . " : confirmation pour la suppresion d'un utilisateur";
require ("headeradmin.php");
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement supprimer la fiche " . $id . "?</b></font>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"users\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"deleteok\">\n";
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression de la fiche " . $id . " en cliquant ici\">\n";
echo "</form>\n";
echo "<br/><br/><br/><a href=\"list.php?table=users\">Retour à la liste des utilisateurs</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
if ($action == "deleteok")
{
$myhtmltitle = $configname[$lang] . " : supprimer un utilisateur";
require ("connect.php");
require ("headeradmin.php");
$query = "DELETE FROM users WHERE users.user_id = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La fiche " . $id . " a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=users\">Retour à la liste des utilisateurs</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
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
