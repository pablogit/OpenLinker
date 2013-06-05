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
// Status table : creation and update of records
// 
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
if (($monaut == "admin")||($monaut == "sadmin"))
{
$mes="";
$date=date("Y-m-d H:i:s");
$code = addslashes(trim($_POST['code']));
$title1 = addslashes(trim($_POST['title1']));
$title2 = addslashes(trim($_POST['title2']));
$title3 = addslashes(trim($_POST['title3']));
$title4 = addslashes(trim($_POST['title4']));
$title5 = addslashes(trim($_POST['title5']));
$help1 = addslashes(trim($_POST['help1']));
$help2 = addslashes(trim($_POST['help2']));
$help3 = addslashes(trim($_POST['help3']));
$help4 = addslashes(trim($_POST['help4']));
$help5 = addslashes(trim($_POST['help5']));
$in = addslashes(trim($_POST['in']));
$out = addslashes(trim($_POST['out']));
$trash = addslashes(trim($_POST['trash']));
$special = addslashes(trim($_POST['special']));
$color = addslashes(trim($_POST['color']));
if ($in != "1")
$in = 0;
if ($out != "1")
$out = 0;
if ($trash != "1")
$trash = 0;
if (($action == "update")||($action == "new"))
{
// Tester si le code est unique
require ("connect.php");
$reqcode = "SELECT * FROM status WHERE code = '$code'";
$resultcode = mysql_query($reqcode,$link);
$nbcode = mysql_num_rows($resultcode);
$enregcode = mysql_fetch_array($resultcode);
$idcode = $enregcode['id'];
if (($nbcode == 1)&&($action == "new"))
$mes = $mes . "<br/>le code '" . $code . "' existe déjà dans la base, veuillez choisir un autre";
if (($nbcode == 1)&&($action != "new")&&($idcode != $id))
$mes = $mes . "<br/>le code '" . $code . "' est déjà attribué à une autre étape, veuillez choisir un autre";
if ($title1 == "")
$mes = $mes . "<br/>le nom1 est obligatoire";
if ($code == "")
$mes = $mes . "<br/>le code est obligatoire";

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
if ($action == "update")
{
if ($id != "")
{
require ("connect.php");
require ("headeradmin.php");
$reqid = "SELECT * FROM status WHERE id = '$id'";
$myhtmltitle = $configname[$lang] . " : édition de l'étape " . $id;
$resultid = mysql_query($reqid,$link);
$nb = mysql_num_rows($resultid);
if ($nb == 1)
{
$enregid = mysql_fetch_array($resultid);
$query = "UPDATE status SET status.title1='$title1', status.title2='$title2', status.title3='$title3', status.title4='$title4', status.title5='$title5', status.help1='$help1', status.help2='$help2', status.help3='$help3', status.help4='$help4', status.help5='$help5', status.in='$in', status.out='$out', status.trash='$trash', status.special='$special', status.color='$color', status.code='$code' WHERE status.id=$id";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La modification de la fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=status\">Retour à la liste des étapes</a></center>\n";
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
$myhtmltitle = $configname[$lang] . " : nouvelle status";
$query ="INSERT INTO `status` (`id`, `title1`, `title2`, `title3`, `title4`, `title5`, `help1`, `help2`, `help3`, `help4`, `help5`, `code`, `in`, `out`, `trash`, `special`, `color`) VALUES ('', '$title1', '$title2', '$title3', '$title4', '$title5', '$help1', '$help2', '$help3', '$help4', '$help5', '$code', '$in', '$out', '$trash', '$special', '$color')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$id = mysql_insert_id();
echo "<center><br/><b><font color=\"green\">\n";
echo "La nouvelle fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=status\">Retour à la liste des étapes</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
}
// 
// Fin de la création
//
// Début de la suppresion
//
if ($action == "delete")
{
$id=addslashes($_GET['id']);
$myhtmltitle = $configname[$lang] . " : confirmation pour la suppresion d'une étape de la commande";
require ("headeradmin.php");
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement supprimer la fiche " . $id . "?</b></font>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"status\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"deleteok\">\n";
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression de la fiche " . $id . " en cliquant ici\">\n";
echo "</form>\n";
echo "<br/><br/><br/><a href=\"list.php?table=status\">Retour à la liste des étapes</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
if ($action == "deleteok")
{
$myhtmltitle = $configname[$lang] . " : supprimer une étape de la commande";
require ("connect.php");
require ("headeradmin.php");
$query = "DELETE FROM status WHERE status.id = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La fiche " . $id . " a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=status\">Retour à la liste des étapes</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
// 
// Fin de la saisie
//
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
require ("codefail.php");
require ("footer.php");
}
?>
