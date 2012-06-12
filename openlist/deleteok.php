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
// Table journals : confirmation de la suppression de la fiche et création de la fiche dans la table journals_trash
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$id=$_POST['journalsid'];
if ($id)
{
$action=$_POST['action'];
$date=date("Y-m-d H:i:s");
$journalsid = addslashes($_POST['journalsid']);
$titre = addslashes(trim($_POST['titre']));
$titreabrege = addslashes(trim($_POST['titreabrege']));
$variantetitre = addslashes(trim($_POST['variantetitre']));
$issn = addslashes($_POST['issn']);
$issnl = addslashes($_POST['issnl']);
$nlmid = addslashes($_POST['nlmid']);
$catalogid = addslashes($_POST['catalogid']);
$doi = addslashes($_POST['doi']);
$coden = addslashes($_POST['coden']);
$urn = addslashes($_POST['urn']);
$openaccess = addslashes($_POST['openaccess']);
$publiinst = addslashes($_POST['publiinst']);
$faitsuitea = addslashes(trim($_POST['faitsuitea']));
$devient = addslashes(trim($_POST['devient']));
$editeur = addslashes(trim($_POST['editeur']));
$etatcoll = addslashes(trim($_POST['etatcoll']));
$etatcolldeba = addslashes($_POST['etatcolldeba']);
$etatcolldebv = addslashes($_POST['etatcolldebv']);
$etatcolldebf = addslashes($_POST['etatcolldebf']);
$etatcollfina = addslashes($_POST['etatcollfina']);
$etatcollfinv = addslashes($_POST['etatcollfinv']);
$etatcollfinf = addslashes($_POST['etatcollfinf']);
$embargo = addslashes($_POST['embargo']);
$url = addslashes($_POST['url']);
$rss = addslashes($_POST['rss']);
$acceselecinst1 = addslashes($_POST['acceselecinst1']);
$acceselecinst2 = addslashes($_POST['acceselecinst2']);
$acceseleclibre = addslashes($_POST['acceseleclibre']);
$titreexclu = addslashes($_POST['titreexclu']);
$support = addslashes($_POST['support']);
$licence = addslashes($_POST['licence']);
$plateforme = addslashes($_POST['plateforme']);
$gestion = addslashes($_POST['gestion']);
$historiqueabo = addslashes($_POST['historiqueabo']);
$statutabo = addslashes($_POST['statutabo']);
$cote = addslashes(trim($_POST['cote']));
$localisation = addslashes($_POST['localisation']);
$user = addslashes($_POST['user']);
$pwd = addslashes($_POST['pwd']);
$keywords = addslashes(trim($_POST['keywords']));
$commentairepro = addslashes(trim($_POST['commentairepro']));
$commentairepub = addslashes(trim($_POST['commentairepub']));
$signaturecreation = addslashes($_POST['signaturecreation']);
$signaturemodif = addslashes($_POST['signaturemodif']);
$datecreation = addslashes($_POST['datecreation']);
$datemodif = addslashes($_POST['datemodif']);
$sujetsfm = addslashes($_POST['sujetsfm']);
$fmid = addslashes($_POST['fmid']);
$soustitre = addslashes(trim($_POST['soustitre']));
$format = addslashes($_POST['format']);
$time = $_POST['time'];
$historique = "Fiche supprimée par " . $monlog . " le " . $date;
$historique = addslashes($_POST['historique']) . $historique;
$pagetitle = "Revues de " . $configinstitution . " : suppression de la fiche " . $id;
require ("connexion.php");
require ("header.php");
require ("menurech.php");
$query = "DELETE FROM journals WHERE journals.journalsid = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
$query ="DELETE FROM journals_sujets WHERE journals_sujets.journalsid = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
$query ="INSERT INTO `journals_trash` (`id`, `journalsid`, `titre`, `titreabrege`, `variantetitre`, `issn`, `issnl`, `nlmid`, `catalogid`, `doi`, `coden`, `urn`, `openaccess`, `publiinst`, `faitsuitea`, `devient`, `editeur`, `etatcoll`, `etatcolldeba`, `etatcolldebv`, `etatcolldebf`, `etatcollfina`, `etatcollfinv`, `etatcollfinf`, `embargo`, `url`, `rss`, `acceselecinst1`, `acceselecinst2`, `acceseleclibre`, `titreexclu`, `support`, `licence`, `plateforme`, `gestion`, `historiqueabo`, `statutabo`, `cote`, `localisation`, `user`, `pwd`, `keywords`, `commentairepro`, `commentairepub`, `signaturecreation`, `signaturemodif`, `datecreation`, `datemodif`, `soustitre`, `format`, `time`, `historique`) VALUES ('', '$id', '$titre', '$titreabrege', '$variantetitre', '$issn', '$issnl', '$nlmid', '$catalogid', '$doi', '$coden', '$urn', '$openaccess', '$publiinst', '$faitsuitea', '$devient', '$editeur', '$etatcoll', '$etatcolldeba', '$etatcolldebv', '$etatcolldebf', '$etatcollfina', '$etatcollfinv', '$etatcollfinf', '$embargo', '$url', '$rss', '$acceselecinst1', '$acceselecinst2', '$acceseleclibre', '$titreexclu', '$support', '$licence', '$plateforme', '$gestion', '$historiqueabo', '$statutabo', '$cote', '$localisation', '$user', '$pwd', '$keywords', '$commentairepro', '$commentairepub', '$signaturecreation', '$signaturemodif', '$datecreation', '$datemodif', '$soustitre', '$format', '$time', '$historique')";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><br/><br/><b><font color=\"green\">\n";
echo "La fiche " . $id . " a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/></center>\n";
}
else
{
require ("header.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "La fiche n'a pas été trouvée dans la base.</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche ou contactez l'administrateur de la base : " . $configemail . "</b></center><br /><br /><br /><br />\n";
}
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
require ("header.php");
require ("loginfail.php");
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
