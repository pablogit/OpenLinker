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
// Table journals : formulaire de duplification d'une fiche
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monbib=$_COOKIE['journalsid']['bib'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$monpwd=$_COOKIE['journalsid']['pwd'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$id=$_GET['id'];
if ($id)
$req = "SELECT * FROM journals, journals_sujets, sujets WHERE (journals.journalsid = '$id' AND journals.journalsid = journals_sujets.journalsid AND journals_sujets.sujetsid = sujets.sujetsid)";
require ("header.php");
require ("menurech.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
// $total_results = mysql_result(mysql_query("SELECT COUNT (*) as Num FROM commandes"),0);

echo "<br /></b>";
echo "<ul>\n";
for ($i=0 ; $i<$nb ; $i++)
{
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
if (strlen($url)>80)
$urlcut = substr($url, 0, 80) . "[...]";
else
$urlcut = $url;
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
$classification = $enreg['classification'];
// echo "<li><b><a href=\"journal.php?id=".$id."\" title=\"voir la notice compl&egrave;te\">".$titre."</a></b>\n";
echo "<script type=\"text/javascript\">\n";
echo "function textchanged(changes) {\n";
// echo "var changements = document.fiche.remarques.value;\n";
echo "document.fiche.modifs.value = document.fiche.modifs.value + changes + ' - ';\n";
echo "}\n";
echo "</script>\n";
echo "<form action=\"new.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\">\n";
echo "<input name=\"journalsid\" type=\"hidden\"  value=\"".$journalsid."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"dupliquer\">\n";
echo "<input name=\"modifs\" type=\"hidden\" value=\"\">\n";
// echo "<input name=\"historique\" type=\"hidden\"  value=\"".$enreg['historique']."\">\n";
echo "<b><font color=\"red\">Duplication da la fiche ".$journalsid." [ATTENTION cet acction ne modifie pas la fiche mais crée une nouvelle à partir des données de la base]</font></b><br/><br/>\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
// echo "<tr><td><b>Titre : </b></td><td><input name=\"title\" type=\"text\" size=\"50\" value=\"".$titre."\" onchange=\"textchanged('titre')\"></td></tr>\n";
// echo "<tr><td><b>journalsid : </b></td><td><input name=\"journalsid\" type=\"text\" size=\"50\" value=\"".$journalsid."\" onchange=\"textchanged('journalsid')\"></td></tr>\n";
echo "<tr><td><b>titre : </b></td><td><input name=\"titre\" type=\"text\" size=\"50\" value=\"".$titre."\" onchange=\"textchanged('titre')\"></td></tr>\n";
echo "<tr><td><b>titreabrege : </b></td><td><input name=\"titreabrege\" type=\"text\" size=\"50\" value=\"".$titreabrege."\" onchange=\"textchanged('titreabrege')\"></td></tr>\n";
echo "<tr><td><b>variantetitre : </b></td><td><input name=\"variantetitre\" type=\"text\" size=\"50\" value=\"".$variantetitre."\" onchange=\"textchanged('variantetitre')\"></td></tr>\n";
echo "<tr><td><b>issn : </b></td><td><input name=\"issn\" type=\"text\" size=\"50\" value=\"".$issn."\" onchange=\"textchanged('issn')\"></td></tr>\n";
echo "<tr><td><b>issnl : </b></td><td><input name=\"issnl\" type=\"text\" size=\"50\" value=\"".$issnl."\" onchange=\"textchanged('issnl')\"></td></tr>\n";
echo "<tr><td><b>nlmid : </b></td><td><input name=\"nlmid\" type=\"text\" size=\"50\" value=\"".$nlmid."\" onchange=\"textchanged('nlmid')\"></td></tr>\n";
echo "<tr><td><b>catalogid : </b></td><td><input name=\"catalogid\" type=\"text\" size=\"50\" value=\"".$catalogid."\" onchange=\"textchanged('catalogid')\"></td></tr>\n";
echo "<tr><td><b>doi : </b></td><td><input name=\"doi\" type=\"text\" size=\"50\" value=\"".$doi."\" onchange=\"textchanged('doi')\"></td></tr>\n";
echo "<tr><td><b>coden : </b></td><td><input name=\"coden\" type=\"text\" size=\"50\" value=\"".$coden."\" onchange=\"textchanged('coden')\"></td></tr>\n";
echo "<tr><td><b>urn : </b></td><td><input name=\"urn\" type=\"text\" size=\"50\" value=\"".$urn."\" onchange=\"textchanged('urn')\"></td></tr>\n";
echo "<tr><td><b>openaccess : </b></td><td><input name=\"openaccess\" type=\"text\" size=\"50\" value=\"".$openaccess."\" onchange=\"textchanged('openaccess')\"></td></tr>\n";
echo "<tr><td><b>publiinst : </b></td><td><input name=\"publiinst\" type=\"text\" size=\"50\" value=\"".$publiinst."\" onchange=\"textchanged('publiinst')\"></td></tr>\n";
echo "<tr><td><b>faitsuitea : </b></td><td><input name=\"faitsuitea\" type=\"text\" size=\"50\" value=\"".$faitsuitea."\" onchange=\"textchanged('faitsuitea')\"></td></tr>\n";
echo "<tr><td><b>devient : </b></td><td><input name=\"devient\" type=\"text\" size=\"50\" value=\"".$devient."\" onchange=\"textchanged('devient')\"></td></tr>\n";
echo "<tr><td><b>editeur : </b></td><td><input name=\"editeur\" type=\"text\" size=\"50\" value=\"".$editeur."\" onchange=\"textchanged('editeur')\"></td></tr>\n";
echo "<tr><td><b>etatcoll : </b></td><td><input name=\"etatcoll\" type=\"text\" size=\"50\" value=\"".$etatcoll."\" onchange=\"textchanged('etatcoll')\"></td></tr>\n";
echo "<tr><td><b>etatcolldeba : </b></td><td><input name=\"etatcolldeba\" type=\"text\" size=\"50\" value=\"".$etatcolldeba."\" onchange=\"textchanged('etatcolldeba')\"></td></tr>\n";
echo "<tr><td><b>etatcolldebv : </b></td><td><input name=\"etatcolldebv\" type=\"text\" size=\"50\" value=\"".$etatcolldebv."\" onchange=\"textchanged('etatcolldebv')\"></td></tr>\n";
echo "<tr><td><b>etatcolldebf : </b></td><td><input name=\"etatcolldebf\" type=\"text\" size=\"50\" value=\"".$etatcolldebf."\" onchange=\"textchanged('etatcolldebf')\"></td></tr>\n";
echo "<tr><td><b>etatcollfina : </b></td><td><input name=\"etatcollfina\" type=\"text\" size=\"50\" value=\"".$etatcollfina."\" onchange=\"textchanged('etatcollfina')\"></td></tr>\n";
echo "<tr><td><b>etatcollfinv : </b></td><td><input name=\"etatcollfinv\" type=\"text\" size=\"50\" value=\"".$etatcollfinv."\" onchange=\"textchanged('etatcollfinv')\"></td></tr>\n";
echo "<tr><td><b>etatcollfinf : </b></td><td><input name=\"etatcollfinf\" type=\"text\" size=\"50\" value=\"".$etatcollfinf."\" onchange=\"textchanged('etatcollfinf')\"></td></tr>\n";
echo "<tr><td><b>embargo : </b></td><td><input name=\"embargo\" type=\"text\" size=\"50\" value=\"".$embargo."\" onchange=\"textchanged('embargo')\"></td></tr>\n";
echo "<tr><td><b>url : </b></td><td><input name=\"url\" type=\"text\" size=\"50\" value=\"".$url."\" onchange=\"textchanged('url')\"></td></tr>\n";
echo "<tr><td><b>rss : </b></td><td><input name=\"rss\" type=\"text\" size=\"50\" value=\"".$rss."\" onchange=\"textchanged('rss')\"></td></tr>\n";
echo "<tr><td><b>acceselecinst1 : </b></td><td><input name=\"acceselecinst1\" type=\"text\" size=\"50\" value=\"".$acceselecinst1."\" onchange=\"textchanged('acceselecinst1')\"></td></tr>\n";
echo "<tr><td><b>acceselecinst2 : </b></td><td><input name=\"acceselecinst2\" type=\"text\" size=\"50\" value=\"".$acceselecinst2."\" onchange=\"textchanged('acceselecinst2')\"></td></tr>\n";
echo "<tr><td><b>acceseleclibre : </b></td><td><input name=\"acceseleclibre\" type=\"text\" size=\"50\" value=\"".$acceseleclibre."\" onchange=\"textchanged('acceseleclibre')\"></td></tr>\n";
echo "<tr><td><b>titreexclu : </b></td><td><input name=\"titreexclu\" type=\"text\" size=\"50\" value=\"".$titreexclu."\" onchange=\"textchanged('titreexclu')\"></td></tr>\n";
echo "<tr><td><b>support : </b></td><td><input name=\"support\" type=\"text\" size=\"50\" value=\"".$support."\" onchange=\"textchanged('support')\"></td></tr>\n";
echo "<tr><td><b>licence : </b></td><td><input name=\"licence\" type=\"text\" size=\"50\" value=\"".$licence."\" onchange=\"textchanged('licence')\"></td></tr>\n";
echo "<tr><td><b>plateforme : </b></td><td><input name=\"plateforme\" type=\"text\" size=\"50\" value=\"".$plateforme."\" onchange=\"textchanged('plateforme')\"></td></tr>\n";
echo "<tr><td><b>gestion : </b></td><td><input name=\"gestion\" type=\"text\" size=\"50\" value=\"".$gestion."\" onchange=\"textchanged('gestion')\"></td></tr>\n";
echo "<tr><td><b>historiqueabo : </b></td><td><input name=\"historiqueabo\" type=\"text\" size=\"50\" value=\"".$historiqueabo."\" onchange=\"textchanged('historiqueabo')\"></td></tr>\n";
echo "<tr><td><b>statutabo : </b></td><td><input name=\"statutabo\" type=\"text\" size=\"50\" value=\"".$statutabo."\" onchange=\"textchanged('statutabo')\"></td></tr>\n";
echo "<tr><td><b>cote : </b></td><td><input name=\"cote\" type=\"text\" size=\"50\" value=\"".$cote."\" onchange=\"textchanged('cote')\"></td></tr>\n";
echo "<tr><td><b>localisation : </b></td><td><input name=\"localisation\" type=\"text\" size=\"50\" value=\"".$localisation."\" onchange=\"textchanged('localisation')\"></td></tr>\n";
echo "<tr><td><b>user : </b></td><td><input name=\"user\" type=\"text\" size=\"50\" value=\"".$user."\" onchange=\"textchanged('user')\"></td></tr>\n";
echo "<tr><td><b>pwd : </b></td><td><input name=\"pwd\" type=\"text\" size=\"50\" value=\"".$pwd."\" onchange=\"textchanged('pwd')\"></td></tr>\n";
echo "<tr><td><b>keywords : </b></td><td><input name=\"keywords\" type=\"text\" size=\"50\" value=\"".$keywords."\" onchange=\"textchanged('keywords')\"></td></tr>\n";
echo "<tr><td><b>commentairepro : </b></td><td><input name=\"commentairepro\" type=\"text\" size=\"50\" value=\"".$commentairepro."\" onchange=\"textchanged('commentairepro')\"></td></tr>\n";
echo "<tr><td><b>commentairepub : </b></td><td><input name=\"commentairepub\" type=\"text\" size=\"50\" value=\"".$commentairepub."\" onchange=\"textchanged('commentairepub')\"></td></tr>\n";
echo "<tr><td><b>signaturecreation : </b></td><td><input name=\"signaturecreation\" type=\"text\" size=\"50\" value=\"".$signaturecreation."\" onchange=\"textchanged('signaturecreation')\"></td></tr>\n";
echo "<tr><td><b>signaturemodif : </b></td><td><input name=\"signaturemodif\" type=\"text\" size=\"50\" value=\"".$signaturemodif."\" onchange=\"textchanged('signaturemodif')\"></td></tr>\n";
echo "<tr><td><b>datecreation : </b></td><td><input name=\"datecreation\" type=\"text\" size=\"50\" value=\"".$datecreation."\" onchange=\"textchanged('datecreation')\"></td></tr>\n";
echo "<tr><td><b>datemodif : </b></td><td><input name=\"datemodif\" type=\"text\" size=\"50\" value=\"".$datemodif."\" onchange=\"textchanged('datemodif')\"></td></tr>\n";
echo "<tr><td><b>sujetsfm : </b></td><td><input name=\"sujetsfm\" type=\"text\" size=\"50\" value=\"".$sujetsfm."\" onchange=\"textchanged('sujetsfm')\"></td></tr>\n";
echo "<tr><td><b>fmid : </b></td><td><input name=\"fmid\" type=\"text\" size=\"50\" value=\"".$fmid."\" onchange=\"textchanged('fmid')\"></td></tr>\n";
echo "<tr><td><b>soustitre : </b></td><td><input name=\"soustitre\" type=\"text\" size=\"50\" value=\"".$soustitre."\" onchange=\"textchanged('soustitre')\"></td></tr>\n";
echo "<tr><td><b>format : </b></td><td><input name=\"format\" type=\"text\" size=\"50\" value=\"".$format."\" onchange=\"textchanged('format')\"></td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Créer une nouvelle fiche\">\n";
echo "</form></td></tr></table>\n";
echo "<br /><br />\n";
echo "</ul>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
}
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
