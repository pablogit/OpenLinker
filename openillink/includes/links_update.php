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
// links table : creation and update of records
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
$linktitle = addslashes(trim($_POST['title']));
$linkurl = addslashes(trim($_POST['url']));
$linksearch_issn = addslashes(trim($_POST['search_issn']));
$linksearch_isbn = addslashes(trim($_POST['search_isbn']));
$linksearch_ptitle = addslashes(trim($_POST['search_ptitle']));
$linksearch_btitle = addslashes(trim($_POST['search_btitle']));
$linksearch_atitle = addslashes(trim($_POST['search_atitle']));
$linkorder_ext = addslashes(trim($_POST['order_ext']));
$linkorder_form = addslashes(trim($_POST['order_form']));
$linkopenurl = addslashes(trim($_POST['openurl']));
$linklibrary = addslashes(trim($_POST['library']));
$linkactive = addslashes(trim($_POST['active']));
if ($linksearch_issn != "1")
$linksearch_issn = 0;
if ($linksearch_isbn != "1")
$linksearch_isbn = 0;
if ($linksearch_ptitle != "1")
$linksearch_ptitle = 0;
if ($linksearch_btitle != "1")
$linksearch_btitle = 0;
if ($linksearch_atitle != "1")
$linksearch_atitle = 0;
if ($linkorder_ext != "1")
$linkorder_ext = 0;
if ($linkorder_form != "1")
$linkorder_form = 0;
if ($linkopenurl != "1")
$linkopenurl = 0;
if ($linkactive != "1")
$linkactive = 0;
if (($action == "update")||($action == "new"))
{
// Tester les champs obligatoires
require ("connect.php");
if ($linktitle == "")
$mes = $mes . "<br/>le Nom du lien est obligatoire";
if ($linkurl == "")
$mes = $mes . "<br/>l'URL est obligatoire";

if ($mes != "")
{
require ("headeradmin.php");
echo "<center><br/><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire</a></b></center><br /><br /><br /><br />\n";
require ("footer.php");
break;
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
$reqid = "SELECT * FROM links WHERE id = '$id'";
$myhtmltitle = $configname[$lang] . " : édition de la fiche du lien " . $id;
$resultid = mysql_query($reqid,$link);
$nb = mysql_num_rows($resultid);
if ($nb == 1)
{
$enregid = mysql_fetch_array($resultid);
$query = "UPDATE links SET links.title='$linktitle', links.url='$linkurl', links.search_issn='$linksearch_issn', links.search_isbn='$linksearch_isbn', links.search_ptitle='$linksearch_ptitle', links.search_btitle='$linksearch_btitle', links.search_atitle='$linksearch_atitle', links.order_ext='$linkorder_ext', links.order_form='$linkorder_form', links.openurl='$linkopenurl', links.library='$linklibrary', links.active='$linkactive' WHERE links.id=$id";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La modification de la fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=links\">Retour à la liste de liens</a></center>\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car l'identifiant de la fiche " . $id . " n'a pas été trouvé dans la base.</b></font>\n";
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
$myhtmltitle = $configname[$lang] . " : nouveau lien ";
$query = "INSERT INTO `links` (`id`, `title`, `url`, `search_issn`, `search_isbn`, `search_ptitle`, `search_btitle`, `search_atitle`, `order_ext`, `order_form`, `openurl`, `library`, `active`) ";
$query .= "VALUES ('', '$linktitle', '$linkurl', $linksearch_issn, $linksearch_isbn, $linksearch_ptitle, $linksearch_btitle, $linksearch_atitle, $linkorder_ext, $linkorder_form, $linkopenurl, '$linklibrary', '$linkactive')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$id = mysql_insert_id();
echo "<center><br/><b><font color=\"green\">\n";
echo "La nouvelle fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=links\">Retour à la liste de liens</a></center>\n";
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
$myhtmltitle = $configname[$lang] . " : confirmation pour la suppresion d'une lien ";
require ("headeradmin.php");
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement supprimer la fiche " . $id . "?</b></font>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"links\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"deleteok\">\n";
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression de la fiche " . $id . " en cliquant ici\">\n";
echo "</form>\n";
echo "<br/><br/><br/><a href=\"list.php?table=links\">Retour à la liste des liens</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
if ($action == "deleteok")
{
$myhtmltitle = $configname[$lang] . " : supprimer une lien ";
require ("connect.php");
require ("headeradmin.php");
$query = "DELETE FROM links WHERE links.id = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La fiche " . $id . " a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=links\">Retour à la liste des liens</a></center>\n";
echo "</center>\n";
echo "\n";
require ("footer.php");
}
// 
// Fin de la suppresion
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
require ("loginfail.php");
require ("footer.php");
}
?>
