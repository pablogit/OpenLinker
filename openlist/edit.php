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
// Table journals : formulaire de modification
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$id=$_GET['id'];
$action=$_GET['action'];
if ($id)
{
// $req = "SELECT * FROM journals LEFT JOIN journals_sujets ON journals_sujets.journalsid = journals.journalsid LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals.journalsid = '$id'";
$req = "SELECT * FROM journals WHERE journals.journalsid = '$id'";
$pagetitle = "Revues de " . $configinstitution . " : édition de la fiche " . $id;
require ("header.php");
require ("menurech.php");
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 1)
{
echo "<br /></b>";
echo "<ul>\n";
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
$package = $enreg['package'];
$corecollection = $enreg['corecollection'];
$idediteur = $enreg['idediteur'];
$codeediteur = $enreg['codeediteur'];
$reqlicence="SELECT licence FROM journals GROUP BY licence";
$optionslicence="";
$resultlicence = mysql_query($reqlicence,$link);
while ($rowlicence = mysql_fetch_array($resultlicence))
{
$namelicence = $rowlicence["licence"];
$optionslicence.="<option value=\"" . $namelicence . "\"";
if ($namelicence == $licence)
$optionslicence.=" selected";
$optionslicence.=">" . $namelicence . "</option>\n";
}
$reqplateforme="SELECT plateforme FROM journals WHERE plateforme != '' GROUP BY plateforme";
$optionsplateforme="";
$resultplateforme = mysql_query($reqplateforme,$link);
while ($rowplateforme = mysql_fetch_array($resultplateforme))
{
$nameplateforme = $rowplateforme["plateforme"];
$optionsplateforme.="<option value=\"" . $nameplateforme . "\"";
if ($nameplateforme == $plateforme)
$optionsplateforme.=" selected";
$optionsplateforme.=">" . $nameplateforme . "</option>\n";
}
$reqgestion="SELECT gestion FROM journals WHERE gestion != '' GROUP BY gestion";
$optionsgestion="";
$resultgestion = mysql_query($reqgestion,$link);
while ($rowgestion = mysql_fetch_array($resultgestion))
{
$namegestion = $rowgestion["gestion"];
$optionsgestion.="<option value=\"" . $namegestion . "\"";
if ($namegestion == $gestion)
$optionsgestion.=" selected";
$optionsgestion.=">" . $namegestion . "</option>\n";
}
$reqhistoriqueabo="SELECT historiqueabo FROM journals WHERE historiqueabo != '' GROUP BY historiqueabo";
$optionshistoriqueabo="";
$resulthistoriqueabo = mysql_query($reqhistoriqueabo,$link);
while ($rowhistoriqueabo = mysql_fetch_array($resulthistoriqueabo))
{
$namehistoriqueabo = $rowhistoriqueabo["historiqueabo"];
$optionshistoriqueabo.="<option value=\"" . $namehistoriqueabo . "\"";
if ($namehistoriqueabo == $historiqueabo)
$optionshistoriqueabo.=" selected";
$optionshistoriqueabo.=">" . $namehistoriqueabo . "</option>\n";
}
$reqlocalisation="SELECT localisation FROM journals WHERE localisation != '' GROUP BY localisation";
$optionslocalisation="";
$resultlocalisation = mysql_query($reqlocalisation,$link);
while ($rowlocalisation = mysql_fetch_array($resultlocalisation))
{
$namelocalisation = $rowlocalisation["localisation"];
$optionslocalisation.="<option value=\"" . $namelocalisation . "\"";
if ($namelocalisation == $localisation)
$optionslocalisation.=" selected";
$optionslocalisation.=">" . $namelocalisation . "</option>\n";
}
$reqformat="SELECT format FROM journals WHERE format != '' GROUP BY format";
$optionsformat="";
$resultformat = mysql_query($reqformat,$link);
while ($rowformat = mysql_fetch_array($resultformat))
{
$nameformat = $rowformat["format"];
$optionsformat.="<option value=\"" . $nameformat . "\"";
if ($nameformat == $format)
$optionsformat.=" selected";
$optionsformat.=">" . $nameformat . "</option>\n";
}
$reqsupport="SELECT support FROM journals WHERE support != '' GROUP BY support";
$optionssupport="";
$resultsupport = mysql_query($reqsupport,$link);
while ($rowsupport = mysql_fetch_array($resultsupport))
{
$namesupport = $rowsupport["support"];
$optionssupport.="<option value=\"" . $namesupport . "\"";
if ($namesupport == $support)
$optionssupport.=" selected";
$optionssupport.=">" . $namesupport . "</option>\n";
}
echo "<script type=\"text/javascript\">\n";
echo "function textchanged(changes) {\n";
echo "document.fiche.modifs.value = document.fiche.modifs.value + changes + ' - ';\n";
echo "}\n";
echo "function ajoutevaleur(champ) {\n";
echo "var champ2 = champ + 'new';\n";
echo "var res = document.getElementById(champ).value;\n";
echo "if (res == 'new')\n";
echo "{\n";
echo "document.getElementById(champ2).style.display='inline';\n";
echo "}\n";
echo "}\n";
echo "</script>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"journalsid\" type=\"hidden\" value=\"".$journalsid."\">\n";
if ($action == "new")
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
else
echo "<input name=\"action\" type=\"hidden\" value=\"update\">\n";
echo "<input name=\"time\" type=\"hidden\" value=\"" . time() ."\">\n";
echo "<input name=\"modifs\" type=\"hidden\" value=\"\">\n";
if ($action == "new")
echo "<b><font color=\"red\">Duplication de la fiche ".$journalsid.". ATTENTION, cet action va créér un nouvelle fiche</font></b><br/><br/>\n";
else
echo "<b><font color=\"red\">Modification de la fiche ".$journalsid."</font></b><br/><br/>\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='detail.php?id=" . $id . "'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
// border=\"0\" cellpadding=\"0\" cellspacing=\"0\" 
// 
// Champs bibliographiques
// 
echo "<tr><td class=\"odd\"><b>Titre *</b></td><td class=\"odd\"><input name=\"titre\" type=\"text\" size=\"60\" value=\"".$titre."\" onchange=\"textchanged('titre [" . $titre . "]')\"></td></tr>\n";
echo "<tr><td><b>Sous titre</b></td><td><input name=\"soustitre\" type=\"text\" size=\"60\" value=\"".$soustitre."\" onchange=\"textchanged('soustitre [" . $soustitre . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre abregé</b></td><td class=\"odd\"><input name=\"titreabrege\" type=\"text\" size=\"60\" value=\"".$titreabrege."\" onchange=\"textchanged('titreabrege [" . $titreabrege . "]')\"></td></tr>\n";
echo "<tr><td><b>Variante de titre</b></td><td><input name=\"variantetitre\" type=\"text\" size=\"60\" value=\"".$variantetitre."\" onchange=\"textchanged('variantetitre [" . $variantetitre . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Fait suite à</b></td><td class=\"odd\"><input name=\"faitsuitea\" type=\"text\" size=\"60\" value=\"".$faitsuitea."\" onchange=\"textchanged('faitsuitea [" . $faitsuitea . "]')\"></td></tr>\n";
echo "<tr><td><b>Devient</b></td><td><input name=\"devient\" type=\"text\" size=\"60\" value=\"".$devient."\" onchange=\"textchanged('devient [" . $devient . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Editeur</b></td><td class=\"odd\"><input name=\"editeur\" type=\"text\" size=\"60\" value=\"".$editeur."\" onchange=\"textchanged('editeur [" . $editeur . "]')\"></td></tr>\n";
echo "<tr><td><b>Code de la revue chez l'éditeur</b></td><td><input name=\"codeediteur\" type=\"text\" size=\"60\" value=\"".$codeediteur."\" onchange=\"textchanged('codeediteur [" . $codeediteur . "]')\"></td></tr>\n";
$publiinstselecton = "";
$publiinstselectoff = "";
if ($publiinst == "1")
$publiinstselecton = " checked";
else
$publiinstselectoff = " checked";
echo "<tr><td class=\"odd\"><b>Publication institutionnelle</b></td><td class=\"odd\"><input type=\"radio\" name=\"publiinst\" value=\"1\" onclick=\"textchanged('publiinst [" . $publiinst . "]')\"" . $publiinstselecton . "/> Oui  |  <input type=\"radio\" name=\"publiinst\" value=\"0\" onclick=\"textchanged('publiinst [" . $publiinst . "]')\"" . $publiinstselectoff . "/> Non</td></tr>\n";
$openaccessselecton = "";
$openaccessselectoff = "";
if ($openaccess == "1")
$openaccessselecton = " checked";
else
$openaccessselectoff = " checked";
echo "<tr><td><b>Open Access</b></td><td><input type=\"radio\" name=\"openaccess\" value=\"1\" onclick=\"textchanged('openaccess [" . $openaccess . "]')\"" . $openaccessselecton . "/> Oui  |  <input type=\"radio\" name=\"openaccess\" value=\"0\" onclick=\"textchanged('openaccess [" . $openaccess . "]')\"" . $openaccessselectoff . "/> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>ISSN-L</b></td><td class=\"odd\"><input name=\"issnl\" type=\"text\" size=\"10\" value=\"".$issnl."\" onchange=\"textchanged('issnl [" . $nlmid . "]')\">\n";
echo "  |  <b>ISSNs </b><input name=\"issn\" type=\"text\" size=\"40\" value=\"".$issn."\" onchange=\"textchanged('issn [" . $issn . "]')\"></td></tr>\n";
echo "<tr><td><b>Catalog ID</b></td><td><input name=\"catalogid\" type=\"text\" size=\"25\" value=\"".$catalogid."\" onchange=\"textchanged('catalogid [" . $catalogid . "]')\">\n";
echo "  |  <b>NLM ID </b><input name=\"nlmid\" type=\"text\" size=\"25\" value=\"".$nlmid."\" onchange=\"textchanged('nlmid [" . $titreabrege . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>CODEN</b></td><td class=\"odd\"><input name=\"coden\" type=\"text\" size=\"15\" value=\"".$coden."\" onchange=\"textchanged('coden [" . $coden . "]')\">\n";
echo "  |  <b>DOI </b><input name=\"doi\" type=\"text\" size=\"15\" value=\"".$doi."\" onchange=\"textchanged('doi [" . $doi . "]')\">\n";
echo "  |  <b>URN </b><input name=\"urn\" type=\"text\" size=\"15\" value=\"".$urn."\" onchange=\"textchanged('urn [" . $urn . "]')\"></td></tr>\n";
// 
// Cahmps de gestion
// 
echo "<tr><td><b>URL</b></td><td><input name=\"url\" type=\"text\" size=\"60\" value=\"".$url."\" onchange=\"textchanged('url [" . $url . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>RSS</b></td><td class=\"odd\"><input name=\"rss\" type=\"text\" size=\"60\" value=\"".$rss."\" onchange=\"textchanged('rss [" . $rss . "]')\"></td></tr>\n";
echo "<tr><td><b>Username</b></td><td><input name=\"user\" type=\"text\" size=\"25\" value=\"".$user."\" onchange=\"textchanged('user [" . $user . "]')\">\n";
echo "  |  <b>Password </b><input name=\"pwd\" type=\"text\" size=\"25\" value=\"".$pwd."\" onchange=\"textchanged('pwd [" . $pwd . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Abonnement / Licence *</b></td><td class=\"odd\">\n";
echo "<select name=\"licence\" id=\"licence\" onchange=\"textchanged('licence [" . $licence . "]');ajoutevaleur('licence');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslicence;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"licencenew\" id=\"licencenew\" type=\"text\" size=\"30\" value=\"\" onchange=\"textchanged('licencenew [" . $licence . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
$statutaboselect0 = "";
$statutaboselect1 = "";
$statutaboselect2 = "";
$statutaboselect3 = "";
$statutaboselect4 = "";
$statutaboselect5 = "";
switch ($statutabo)
{
case 1:
$statutaboselect1 = " selected";
break;
case 2:
$statutaboselect2 = " selected";
break;
case 3:
$statutaboselect3 = " selected";
break;
case 4:
$statutaboselect4 = " selected";
break;
case 5:
$statutaboselect5 = " selected";
break;
default:
$statutaboselect0 = " selected";
}
echo "<tr><td><b>Statut de l'abonnement *</b></td>\n";
echo "<td><select name=\"statutabo\" id=\"statutabo\" onchange=\"textchanged('statutabo [" . $statutabo . "]');\">\n";
echo "<option value=\"1\"" . $statutaboselect1 . ">Actif</option>\n";
echo "<option value=\"0\"" . $statutaboselect0 . ">Terminé</option>\n";
echo "<option value=\"2\"" . $statutaboselect2 . ">En test</option>\n";
echo "<option value=\"3\"" . $statutaboselect3 . ">Pardu</option>\n";
echo "<option value=\"4\"" . $statutaboselect4 . ">En panne</option>\n";
echo "<option value=\"5\"" . $statutaboselect5 . ">Gestion provisoire</option>\n";
echo "</select>\n";
echo "</td></tr>\n";
$titreexcluselecton = "";
$titreexcluselectoff = "";
if ($titreexclu == "1")
$titreexcluselecton = " checked";
else
$titreexcluselectoff = " checked";
echo "<tr><td class=\"odd\"><b>Titre exclu de la licence</b></td><td class=\"odd\"><input type=\"radio\" name=\"titreexclu\" value=\"1\" onclick=\"textchanged('titreexclu [" . $titreexclu . "]')\"" . $titreexcluselecton . "/> Oui  |  <input type=\"radio\" name=\"titreexclu\" value=\"0\" onclick=\"textchanged('titreexclu [" . $titreexclu . "]')\"" . $titreexcluselectoff . "/> Non</td></tr>\n";
$corecollectionselecton = "";
$corecollectionselectoff = "";
if ($corecollection == "1")
$corecollectionselecton = " checked";
else
$corecollectionselectoff = " checked";
echo "<tr><td><b>Core collection</b></td><td><input type=\"radio\" name=\"corecollection\" value=\"1\" onclick=\"textchanged('corecollection [" . $corecollection . "]')\"" . $corecollectionselecton . "/> Oui  |  <input type=\"radio\" name=\"corecollection\" value=\"0\" onclick=\"textchanged('corecollection [" . $corecollection . "]')\"" . $corecollectionselectoff . "/> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Plateforme</b></td><td class=\"odd\">\n";
echo "<select name=\"plateforme\" id=\"plateforme\" onchange=\"textchanged('plateforme [" . $plateforme . "]');ajoutevaleur('plateforme');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsplateforme;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"plateformenew\" id=\"plateformenew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('plateformenew [" . $plateforme . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Gestion</b></td><td>\n";
echo "<select name=\"gestion\" id=\"gestion\" onchange=\"textchanged('gestion [" . $gestion . "]');ajoutevaleur('gestion');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsgestion;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"gestionnew\" id=\"gestionnew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('gestionnew [" . $gestion . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Historique de l'abonnement</b></td><td class=\"odd\">\n";
echo "<select name=\"historiqueabo\" id=\"historiqueabo\" onchange=\"textchanged('historiqueabo [" . $historiqueabo . "]');ajoutevaleur('historiqueabo');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionshistoriqueabo;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"historiqueabonew\" id=\"historiqueabonew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('historiqueabonew [" . $historiqueabo . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Support *</b></td><td>\n";
echo "<select name=\"support\" id=\"support\" onchange=\"textchanged('support [" . $support . "]');ajoutevaleur('support');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionssupport;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"supportnew\" id=\"supportnew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('supportnew [" . $support . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Format</b></td><td class=\"odd\">\n";
echo "<select name=\"format\" id=\"format\" onchange=\"textchanged('format [" . $format . "]');ajoutevaleur('format');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsformat;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"formatnew\" id=\"formatnew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('formatnew [" . $format . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Accès électronique</b></td><td>\n";
echo "<input type=\"checkbox\" name=\"acceselecinst1\" value=\"1\"";
if ($acceselecinst1 == "1")
echo " checked";
echo " onclick=\"textchanged('acceselecinst1 [" . $acceselecinst1 . "]')\"/> " . $configinstitution . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceselecinst2\" value=\"1\"";
if ($acceselecinst2 == "1")
echo " checked";
echo " onclick=\"textchanged('acceselecinst2 [" . $acceselecinst2 . "]')\"/> " . $configinstitution2 . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceseleclibre\" value=\"1\"";
if ($acceseleclibre == "1")
echo " checked";
echo " onclick=\"textchanged('acceseleclibre [" . $acceseleclibre . "]')\"/> Libre\n";
echo "<tr><td class=\"odd\"><b>Nom du package</b></td><td class=\"odd\"><input name=\"package\" type=\"text\" size=\"60\" value=\"".$package."\" onchange=\"textchanged('package [" . $package . "]')\"></td></tr>\n";
echo "<tr><td><b>No d'abonnement</b></td><td><input name=\"idediteur\" type=\"text\" size=\"60\" value=\"".$idediteur."\" onchange=\"textchanged('idediteur [" . $idediteur . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Etat de collection</b></td><td class=\"odd\"><input name=\"etatcoll\" type=\"text\" size=\"60\" value=\"".$etatcoll."\" onchange=\"textchanged('etatcoll [" . $etatcoll . "]')\"></td></tr>\n";
echo "<tr><td><b>Embargo</b></td><td><input name=\"embargo\" type=\"text\" size=\"10\" value=\"".$embargo."\" onchange=\"textchanged('embargo [" . $embargo . "]')\"> (nombre de mois)</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Début de la collection</b></td>\n";
echo "<td class=\"odd\">Année <input name=\"etatcolldeba\" type=\"text\" size=\"5\" value=\"".$etatcolldeba."\" onchange=\"textchanged('etatcolldeba [" . $etatcolldeba . "]')\">\n";
echo " | Volume <input name=\"etatcolldebv\" type=\"text\" size=\"5\" value=\"".$etatcolldebv."\" onchange=\"textchanged('etatcolldebv [" . $etatcolldebv . "]')\">\n";
echo " | Numéro <input name=\"etatcolldebf\" type=\"text\" size=\"5\" value=\"".$etatcolldebf."\" onchange=\"textchanged('etatcolldebf [" . $etatcolldebf . "]')\"></td></tr>\n";
echo "<tr><td><b>Fin de la collection</b></td>\n";
echo "<td>Année <input name=\"etatcollfina\" type=\"text\" size=\"5\" value=\"".$etatcollfina."\" onchange=\"textchanged('etatcollfina [" . $etatcollfina . "]')\">\n";
echo " | Volume <input name=\"etatcollfinv\" type=\"text\" size=\"5\" value=\"".$etatcollfinv."\" onchange=\"textchanged('etatcollfinv [" . $etatcollfinv . "]')\">\n";
echo " | Numéro <input name=\"etatcollfinf\" type=\"text\" size=\"5\" value=\"".$etatcollfinf."\" onchange=\"textchanged('etatcollfinf [" . $etatcollfinf . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Localisation</b></td><td class=\"odd\">\n";
echo "<select name=\"localisation\" id=\"localisation\" onchange=\"textchanged('localisation [" . $localisation . "]');ajoutevaleur('localisation');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslocalisation;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"localisationnew\" id=\"localisationnew\" type=\"text\" size=\"20\" value=\"\" onchange=\"textchanged('localisationnew [" . $localisation . "]')\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Cote (papier)</b></td><td><input name=\"cote\" type=\"text\" size=\"60\" value=\"".$cote."\" onchange=\"textchanged('cote [" . $cote . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Commentaire professionnel</b></td><td class=\"odd\"><input name=\"commentairepro\" type=\"text\" size=\"60\" value=\"".$commentairepro."\" onchange=\"textchanged('commentairepro [" . $commentairepro . "]')\"></td></tr>\n";
echo "<tr><td><b>Commentaire publique</b></td><td><input name=\"commentairepub\" type=\"text\" size=\"60\" value=\"".$commentairepub."\" onchange=\"textchanged('commentairepub [" . $commentairepub . "]')\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Keywords</b></td><td class=\"odd\"><input name=\"keywords\" type=\"text\" size=\"60\" value=\"".$keywords."\" onchange=\"textchanged('keywords [" . $keywords . "]')\"></td></tr>\n";

$reqthemes = "SELECT * FROM journals_sujets LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals_sujets.journalsid = '$journalsid'";
$resultthemes = mysql_query($reqthemes,$link);
for ($i=0 ; $i<10 ; $i++)
{
$enregthemes = mysql_fetch_array($resultthemes);
$sujetsid = $enregthemes['sujetsid'];
$sujetsfr = $enregthemes['sujetsfr'];
$stmthemesliste = "1";
$reqthemesliste="SELECT sujetsfr, sujetsid, sujetsshs, sujetsstm FROM sujets ORDER BY sujetsshs DESC, sujetsfr ASC";
$optionsthemesliste="";
$resultthemesliste = mysql_query($reqthemesliste,$link);
while ($rowthemesliste = mysql_fetch_array($resultthemesliste))
{
$namethemesliste = $rowthemesliste["sujetsfr"];
$idthemesliste = $rowthemesliste["sujetsid"];
$shsthemesliste = $rowthemesliste["sujetsshs"];
if (($shsthemesliste == "0") && ($stmthemesliste == "1"))
{
$optionsthemesliste.="<optgroup label=\"Sciences biomédicales\">\n";
$stmthemesliste = "0";
}
$optionsthemesliste.="<option value=\"" . $idthemesliste . "\"";
if ($idthemesliste == $sujetsid)
$optionsthemesliste.=" selected";
$optionsthemesliste.=">" . $namethemesliste . "</option>\n";
}
$themei = $i+1;
if ($i % 2 == 0)
$styleodd = "";
else
$styleodd = " class=\"odd\"";
echo "<tr><td" . $styleodd . "><b>Thème</b></td><td" . $styleodd . ">\n";
echo "<select name=\"theme" . $themei . "\" id=\"theme" . $themei . "\" onchange=\"textchanged('theme" . $themei . " [" . $sujetsfr . "]')\">\n";
echo "<option value=\"\"></option>\n";
echo "<optgroup label=\"Sciences humaines\">\n";
echo $optionsthemesliste;
echo "</select>\n";
echo "</td></tr>\n";
}


echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer les modifications\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='detail.php?id=" . $id . "'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";

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
echo "<br /><br />\n";
echo "</ul>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";

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
