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
// Table sujets : création ou modification d'un enregistrement
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$id=addslashes($_POST['id']);
$ip = $_SERVER['REMOTE_ADDR'];
$action=addslashes($_POST['action']);
if (($monaut == "admin")||($monaut == "sadmin"))
{
$mes="";
$date=date("Y-m-d H:i:s");
$sujetsfr = addslashes(trim($_POST['sujetsfr']));
$sujetsen = addslashes(trim($_POST['sujetsen']));
$sujetscode = addslashes(trim($_POST['sujetscode']));
$sujetsshs = addslashes($_POST['sujetsshs']);
$sujetsstm = addslashes($_POST['sujetsstm']);
$sujetsfm = addslashes($_POST['sujetsfm']);
// Tester si le code est unique
require ("connexion.php");
$reqtest = "SELECT * FROM sujets WHERE sujets.sujetscode = '$sujetscode'";
$resulttest = mysql_query($reqtest,$link);
$nbtest = mysql_num_rows($resulttest);
$enregtest = mysql_fetch_array($resulttest);
$idtest = $enregtest['sujetsid'];
if (($nbtest == 1)&&($action == "new"))
$mes = $mes . "<br/>le code ISI '" . $sujetscode . "' existe déjà dans la base, veuillez choisir un autre";
if (($nbtest == 1)&&($action != "new")&&($idtest != $id))
$mes = $mes . "<br/>le code ISI '" . $sujetscode . "' est déjà attribué à un autre thème, veuillez choisir un autre";
if ($sujetsfr == "")
$mes = $mes . "<br/>le nom français est obligatoire";
if ($sujetsshs == "")
$mes = $mes . "<br/>la catégorie 'sujetsshs' est obligatoire";
if ($sujetsstm == "")
$mes = $mes . "<br/>la catégorie 'sujetsstm' est obligatoire";
if ($sujetscode == "")
$mes = $mes . "<br/>le code ISI est obligatoire";
if ($mes != "")
{
require ("header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire</a></b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
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
require ("connexion.php");
require ("header.php");
$reqid = "SELECT * FROM sujets WHERE sujets.sujetsid = '$id'";
$pagetitle = "Revues de " . $configinstitution . " : édition du thème " . $id;
$resultid = mysql_query($reqid,$link);
$nb = mysql_num_rows($resultid);
if ($nb == 1)
{
$enregid = mysql_fetch_array($resultid);
$query = "UPDATE sujets SET sujetsfr='$sujetsfr', sujetsen='$sujetsen', sujetscode='$sujetscode', ";
$query = $query . "sujetsshs='$sujetsshs', sujetsstm='$sujetsstm', sujetsfm='$sujetsfm' WHERE sujetsid=$id";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La modification du thème " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"subjects.php\">Retour à la liste de sujets</a></center>\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car l'identifiant de la fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
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
echo "La modification n'a pas été enregistrée car il manque l'identifiant de la fiche</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche</b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
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
require ("connexion.php");
require ("header.php");
$pagetitle = "Revues de " . $configinstitution . " : nouveau thème";
$query ="INSERT INTO `sujets` (`sujetsid`, `sujetsfr`, `sujetsen`, `sujetscode`, `sujetsshs`, `sujetsstm`, `sujetsfm`) VALUES ('', '$sujetsfr', '$sujetsen', '$sujetscode', '$sujetsshs', '$sujetsstm', '$sujetsfm')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$id = mysql_insert_id();
echo "<center><br/><b><font color=\"green\">\n";
echo "Le nouveau thème " . $id . " a été enregistré avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"subjects.php\">Retour à la liste de thèmes</a></center>\n";
echo "</center>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
require ("footer.php");
}
// 
// Fin de la saisie
//
}
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
