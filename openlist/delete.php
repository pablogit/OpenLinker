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
// Table journals : Page intermédiaire pour demander la confirmation de suppression de la fiche
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$id = $_GET['id'];
$pagetitle = "Revues de " . $configinstitution . " : suppression de la fiche " . $id;
if ($id)
{
// $req = "input * FROM journals LEFT JOIN journals_sujets ON journals_sujets.journalsid = journals.journalsid LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals.journalsid = '$id'";
$req = "SELECT * FROM journals WHERE journals.journalsid = '$id'";
require ("header.php");
require ("menurech.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement supprimer la fiche " . $id . "?</b></font>\n";
$enreg = mysql_fetch_array($result);
$journalsid = $enreg['journalsid'];
$titre = $enreg['titre'];
$titreabrege = $enreg['titreabrege'];
$variantetitre = $enreg['variantetitre'];
$issn = $enreg['issn'];
$issnl = $enreg['issnl'];
$nlmid = $enreg['nlmid'];
$catalogid = $enreg['catalogid'];
$doi = $enreg['doi'];
$coden = $enreg['coden'];
$urn = $enreg['urn'];
$openaccess = $enreg['openaccess'];
$publiinst = $enreg['publiinst'];
$faitsuitea = $enreg['faitsuitea'];
$devient = $enreg['devient'];
$editeur = $enreg['editeur'];
$etatcoll = $enreg['etatcoll'];
$etatcolldeba = $enreg['etatcolldeba'];
$etatcolldebv = $enreg['etatcolldebv'];
$etatcolldebf = $enreg['etatcolldebf'];
$etatcollfina = $enreg['etatcollfina'];
$etatcollfinv = $enreg['etatcollfinv'];
$etatcollfinf = $enreg['etatcollfinf'];
$embargo = $enreg['embargo'];
$url = $enreg['url'];
$rss = $enreg['rss'];
$acceselecinst1 = $enreg['acceselecinst1'];
$acceselecinst2 = $enreg['acceselecinst2'];
$acceseleclibre = $enreg['acceseleclibre'];
$titreexclu = $enreg['titreexclu'];
$support = $enreg['support'];
$licence = $enreg['licence'];
$plateforme = $enreg['plateforme'];
$gestion = $enreg['gestion'];
$historiqueabo = $enreg['historiqueabo'];
$statutabo = $enreg['statutabo'];
$cote = $enreg['cote'];
$localisation = $enreg['localisation'];
$user = $enreg['user'];
$pwd = $enreg['pwd'];
$keywords = $enreg['keywords'];
$commentairepro = $enreg['commentairepro'];
$commentairepub = $enreg['commentairepub'];
$signaturecreation = $enreg['signaturecreation'];
$signaturemodif = $enreg['signaturemodif'];
$datecreation = $enreg['datecreation'];
$datemodif = $enreg['datemodif'];
$sujetsfm = $enreg['sujetsfm'];
$fmid = $enreg['fmid'];
$soustitre = $enreg['soustitre'];
$format = $enreg['format'];
$historique = $enreg['historique'];
echo "<form action=\"deleteok.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"journalsid\" type=\"hidden\" value=\"".$journalsid."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"delete\">\n";
echo "<input name=\"time\" type=\"hidden\" value=\"" . time() ."\">\n";
echo "<input name=\"titre\" type=\"hidden\" value=\"".$titre."\">\n";
echo "<input name=\"soustitre\" type=\"hidden\" value=\"".$soustitre."\">\n";
echo "<input name=\"titreabrege\" type=\"hidden\" value=\"".$titreabrege."\">\n";
echo "<input name=\"variantetitre\" type=\"hidden\" value=\"".$variantetitre."\">\n";
echo "<input name=\"faitsuitea\" type=\"hidden\" value=\"".$faitsuitea."\">\n";
echo "<input name=\"devient\" type=\"hidden\" value=\"".$devient."\">\n";
echo "<input name=\"editeur\" type=\"hidden\" value=\"".$editeur."\">\n";
echo "<input name=\"publiinst\" type=\"hidden\" value=\"".$publiinst."\">\n";
echo "<input name=\"openaccess\" type=\"hidden\" value=\"".$openaccess."\">\n";
echo "<input name=\"issnl\" type=\"hidden\" value=\"".$issnl."\">\n";
echo "<input name=\"issn\" type=\"hidden\" value=\"".$issn."\">\n";
echo "<input name=\"catalogid\" type=\"hidden\" value=\"".$catalogid."\">\n";
echo "<input name=\"nlmid\" type=\"hidden\" value=\"".$nlmid."\">\n";
echo "<input name=\"coden\" type=\"hidden\" value=\"".$coden."\">\n";
echo "<input name=\"doi\" type=\"hidden\" value=\"".$doi."\">\n";
echo "<input name=\"urn\" type=\"hidden\" value=\"".$urn."\">\n";
echo "<input name=\"url\" type=\"hidden\" value=\"".$url."\">\n";
echo "<input name=\"rss\" type=\"hidden\" value=\"".$rss."\">\n";
echo "<input name=\"user\" type=\"hidden\" value=\"".$user."\">\n";
echo "<input name=\"pwd\" type=\"hidden\" value=\"".$pwd."\">\n";
echo "<input name=\"licence\" type=\"hidden\" value=\"".$licence."\">\n";
echo "<input name=\"titreexclu\" type=\"hidden\" value=\"".$titreexclu."\">\n";
echo "<input name=\"statutabo\" type=\"hidden\" value=\"".$statutabo."\">\n";
echo "<input name=\"plateforme\" type=\"hidden\" value=\"".$plateforme."\">\n";
echo "<input name=\"gestion\" type=\"hidden\" value=\"".$gestion."\">\n";
echo "<input name=\"historiqueabo\" type=\"hidden\" value=\"".$historiqueabo."\">\n";
echo "<input name=\"support\" type=\"hidden\" value=\"".$support."\">\n";
echo "<input name=\"format\" type=\"hidden\" value=\"".$format."\">\n";
echo "<input name=\"acceselecinst1\" type=\"hidden\" value=\"".$acceselecinst1."\">\n";
echo "<input name=\"acceselecinst2\" type=\"hidden\" value=\"".$acceselecinst2."\">\n";
echo "<input name=\"acceseleclibre\" type=\"hidden\" value=\"".$acceseleclibre."\">\n";
echo "<input name=\"etatcoll\" type=\"hidden\" value=\"".$etatcoll."\">\n";
echo "<input name=\"embargo\" type=\"hidden\" value=\"".$embargo."\">\n";
echo "<input name=\"etatcolldeba\" type=\"hidden\" value=\"".$etatcolldeba."\">\n";
echo "<input name=\"etatcolldebv\" type=\"hidden\" value=\"".$etatcolldebv."\">\n";
echo "<input name=\"etatcolldebf\" type=\"hidden\" value=\"".$etatcolldebf."\">\n";
echo "<input name=\"etatcollfina\" type=\"hidden\" value=\"".$etatcollfina."\">\n";
echo "<input name=\"etatcollfinv\" type=\"hidden\" value=\"".$etatcollfinv."\">\n";
echo "<input name=\"etatcollfinf\" type=\"hidden\" value=\"".$etatcollfinf."\">\n";
echo "<input name=\"localisation\" type=\"hidden\" value=\"".$titreexclu."\">\n";
echo "<input name=\"cote\" type=\"hidden\" value=\"".$cote."\">\n";
echo "<input name=\"commentairepro\" type=\"hidden\" value=\"".$commentairepro."\">\n";
echo "<input name=\"commentairepub\" type=\"hidden\" value=\"".$commentairepub."\">\n";
echo "<input name=\"signaturecreation\" type=\"hidden\" value=\"".$signaturecreation."\">\n";
echo "<input name=\"signaturemodif\" type=\"hidden\" value=\"".$signaturemodif."\">\n";
echo "<input name=\"datecreation\" type=\"hidden\" value=\"".$datecreation."\">\n";
echo "<input name=\"datemodif\" type=\"hidden\" value=\"".$datemodif."\">\n";
echo "<input name=\"sujetsfm\" type=\"hidden\" value=\"".$sujetsfm."\">\n";
echo "<input name=\"fmid\" type=\"hidden\" value=\"".$fmid."\">\n";
echo "<input name=\"keywords\" type=\"hidden\" value=\"".$keywords."\">\n";
echo "<input name=\"historique\" type=\"hidden\" value=\"".$historique."\">\n";

$reqthemes = "SELECT * FROM journals_sujets LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals_sujets.journalsid = '$journalsid'";
$resultthemes = mysql_query($reqthemes,$link);
for ($i=1 ; $i<11 ; $i++)
{
$enregthemes = mysql_fetch_array($resultthemes);
$sujetsid = $enregthemes['sujetsid'];
echo "<input name=\"theme" . $i . "\" type=\"hidden\" value=\"".$sujetsid."\">\n";
}
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression de la fiche " . $journalsid . " en cliquant ici\">\n";
echo "</form>\n";
echo "<br /><br />\n";

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
