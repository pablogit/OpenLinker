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
// Table journals : formulaire de modification de masses suite à une recherche administrateur
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$nb=$_GET['nb'];
// *******************************************
// *******************************************
// Recuperation des paramètres de la recherche
// *******************************************
// *******************************************

$titrereq = addslashes(trim($_GET['titre']));
$titreabregereq = addslashes(trim($_GET['titreabrege']));
$variantetitrereq = addslashes(trim($_GET['variantetitre']));
$issnreq = addslashes($_GET['issn']);
$issnlreq = addslashes($_GET['issnl']);
$nlmidreq = addslashes($_GET['nlmid']);
$catalogidreq = addslashes($_GET['catalogid']);
$doireq = addslashes($_GET['doi']);
$codenreq = addslashes($_GET['coden']);
$urnreq = addslashes($_GET['urn']);
$openaccessreq = addslashes($_GET['openaccess']);
$publiinstreq = addslashes($_GET['publiinst']);
$faitsuiteareq = addslashes(trim($_GET['faitsuitea']));
$devientreq = addslashes(trim($_GET['devient']));
$editeurreq = addslashes(trim($_GET['editeur']));
$etatcollreq = addslashes(trim($_GET['etatcoll']));
$etatcolldebareq = addslashes($_GET['etatcolldeba']);
$etatcolldebvreq = addslashes($_GET['etatcolldebv']);
$etatcolldebfreq = addslashes($_GET['etatcolldebf']);
$etatcollfinareq = addslashes($_GET['etatcollfina']);
$etatcollfinvreq = addslashes($_GET['etatcollfinv']);
$etatcollfinfreq = addslashes($_GET['etatcollfinf']);
$embargoreq = addslashes($_GET['embargo']);
$urlreq = $_GET['url'];
$rssreq = $_GET['rss'];
$acceselecinst1req = addslashes($_GET['acceselecinst1']);
$acceselecinst2req = addslashes($_GET['acceselecinst2']);
$acceseleclibrereq = addslashes($_GET['acceseleclibre']);
$titreexclureq = addslashes($_GET['titreexclu']);
$supportreq = addslashes($_GET['support']);
$licencereq = addslashes($_GET['licence']);
$plateformereq = addslashes($_GET['plateforme']);
$gestionreq = addslashes($_GET['gestion']);
$historiqueaboreq = addslashes($_GET['historiqueabo']);
$statutaboreq = addslashes($_GET['statutabo']);
$cotereq = addslashes(trim($_GET['cote']));
$localisationreq = addslashes($_GET['localisation']);
$userreq = addslashes($_GET['user']);
$pwdreq = addslashes($_GET['pwd']);
$keywordsreq = addslashes(trim($_GET['keywords']));
$commentaireproreq = addslashes(trim($_GET['commentairepro']));
$commentairepubreq = addslashes(trim($_GET['commentairepub']));
$signaturecreationreq = addslashes($_GET['signaturecreation']);
$signaturemodifreq = addslashes($_GET['signaturemodif']);
$datecreationreq = addslashes($_GET['datecreation']);
$datemodifreq = addslashes($_GET['datemodif']);
$sujetsfmreq = addslashes($_GET['sujetsfm']);
$fmidreq = addslashes($_GET['fmid']);
$soustitrereq = addslashes(trim($_GET['soustitre']));
$formatreq = addslashes($_GET['format']);
$packagereq = addslashes($_GET['package']);
$corecollectionreq = addslashes($_GET['corecollection']);
$idediteurreq = addslashes($_GET['idediteur']);
$codeediteurreq = addslashes($_GET['codeediteur']);
$supportnewreq = addslashes($_GET['supportnew']);
if ($supportreq == "new")
$supportreq = $supportnewreq;
$licencenewreq = addslashes($_GET['licencenew']);
if ($licencereq == "new")
$licencereq = $licencenewreq;
$plateformenewreq = addslashes($_GET['plateformenew']);
if ($plateformereq == "new")
$plateformereq = $plateformenewreq;
$gestionnewreq = addslashes($_GET['gestionnew']);
if ($gestionreq == "new")
$gestionreq = $gestionnewreq;
$historiqueabonewreq = addslashes($_GET['historiqueabonew']);
if ($historiqueaboreq == "new")
$historiqueaboreq = $historiqueabonewreq;
$formatnewreq = addslashes($_GET['formatnew']);
if ($formatreq == "new")
$formatreq = $formatnewreq;
$localisationnewreq = addslashes($_GET['localisationnew']);
if ($localisationreq == "new")
$localisationreq = $localisationnewreq;
$themereq = addslashes($_GET['theme']);
$journalsidcrit1req = addslashes($_GET['journalsidcrit1']);
$journalsid1req = addslashes($_GET['journalsid1']);
$journalsidcrit2req = addslashes($_GET['journalsidcrit2']);
$journalsid2req = addslashes($_GET['journalsid2']);
$allfieldsreq = addslashes($_GET['allfields']);
$embargocritreq = addslashes($_GET['embargocrit']);
$datecreationcrit1req = addslashes($_GET['datecreationcrit1']);
$datecreation1req = addslashes($_GET['datecreation1']);
$datecreationcrit2req = addslashes($_GET['datecreationcrit2']);
$datecreation2req = addslashes($_GET['datecreation2']);
$datemodifcrit1req = addslashes($_GET['datemodifcrit1']);
$datemodif1req = addslashes($_GET['datemodif1']);
$datemodifcrit2req = addslashes($_GET['datemodifcrit2']);
$datemodif2req = addslashes($_GET['datemodif2']);
if (($monaut == "admin")||($monaut == "sadmin"))
{
require ("connexion.php");
// $req = "SELECT * FROM journals LEFT JOIN journals_sujets ON journals_sujets.journalsid = journals.journalsid LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals.journalsid = '$id'";
$pagetitle = "Revues de " . $configinstitution . " : édition de la fliste de résultats";
require ("header.php");
require ("menurech.php");
echo "<br /></b>";
echo "<ul>\n";
$reqlicence="SELECT licence FROM journals GROUP BY licence";
$optionslicence="";
$resultlicence = mysql_query($reqlicence,$link);
while ($rowlicence = mysql_fetch_array($resultlicence))
{
$namelicence = $rowlicence["licence"];
$optionslicence.="<option value=\"" . $namelicence . "\"";
$optionslicence.=">" . $namelicence . "</option>\n";
}
$reqplateforme="SELECT plateforme FROM journals WHERE plateforme != '' GROUP BY plateforme";
$optionsplateforme="";
$resultplateforme = mysql_query($reqplateforme,$link);
while ($rowplateforme = mysql_fetch_array($resultplateforme))
{
$nameplateforme = $rowplateforme["plateforme"];
$optionsplateforme.="<option value=\"" . $nameplateforme . "\"";
$optionsplateforme.=">" . $nameplateforme . "</option>\n";
}
$reqgestion="SELECT gestion FROM journals WHERE gestion != '' GROUP BY gestion";
$optionsgestion="";
$resultgestion = mysql_query($reqgestion,$link);
while ($rowgestion = mysql_fetch_array($resultgestion))
{
$namegestion = $rowgestion["gestion"];
$optionsgestion.="<option value=\"" . $namegestion . "\"";
$optionsgestion.=">" . $namegestion . "</option>\n";
}
$reqhistoriqueabo="SELECT historiqueabo FROM journals WHERE historiqueabo != '' GROUP BY historiqueabo";
$optionshistoriqueabo="";
$resulthistoriqueabo = mysql_query($reqhistoriqueabo,$link);
while ($rowhistoriqueabo = mysql_fetch_array($resulthistoriqueabo))
{
$namehistoriqueabo = $rowhistoriqueabo["historiqueabo"];
$optionshistoriqueabo.="<option value=\"" . $namehistoriqueabo . "\"";
$optionshistoriqueabo.=">" . $namehistoriqueabo . "</option>\n";
}
$reqlocalisation="SELECT localisation FROM journals WHERE localisation != '' GROUP BY localisation";
$optionslocalisation="";
$resultlocalisation = mysql_query($reqlocalisation,$link);
while ($rowlocalisation = mysql_fetch_array($resultlocalisation))
{
$namelocalisation = $rowlocalisation["localisation"];
$optionslocalisation.="<option value=\"" . $namelocalisation . "\"";
$optionslocalisation.=">" . $namelocalisation . "</option>\n";
}
$reqformat="SELECT format FROM journals WHERE format != '' GROUP BY format";
$optionsformat="";
$resultformat = mysql_query($reqformat,$link);
while ($rowformat = mysql_fetch_array($resultformat))
{
$nameformat = $rowformat["format"];
$optionsformat.="<option value=\"" . $nameformat . "\"";
$optionsformat.=">" . $nameformat . "</option>\n";
}
$reqsupport="SELECT support FROM journals WHERE support != '' GROUP BY support";
$optionssupport="";
$resultsupport = mysql_query($reqsupport,$link);
while ($rowsupport = mysql_fetch_array($resultsupport))
{
$namesupport = $rowsupport["support"];
$optionssupport.="<option value=\"" . $namesupport . "\"";
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
echo "<form action=\"updatelist.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"updatelist\">\n";
// echo "<input name=\"time\" type=\"hidden\" value=\"" . time() ."\">\n";
// echo "<input name=\"search\" type=\"hidden\" value=\"".$_SERVER['QUERY_STRING']."\">\n";
echo "<input name=\"journalsidcrit1req\" type=\"hidden\" value=\"".$journalsidcrit1req."\">\n";
echo "<input name=\"journalsid1req\" type=\"hidden\" value=\"".$journalsid1req."\">\n";
echo "<input name=\"journalsidcrit2req\" type=\"hidden\" value=\"".$journalsidcrit2req."\">\n";
echo "<input name=\"journalsid2req\" type=\"hidden\" value=\"".$journalsid2req."\">\n";
echo "<input name=\"allfieldsreq\" type=\"hidden\" value=\"".$allfieldsreq."\">\n";
echo "<input name=\"embargocritreq\" type=\"hidden\" value=\"".$embargocritreq."\">\n";
echo "<input name=\"datecreationcrit1req\" type=\"hidden\" value=\"".$datecreationcrit1req."\">\n";
echo "<input name=\"datecreation1req\" type=\"hidden\" value=\"".$datecreation1req."\">\n";
echo "<input name=\"datecreationcrit2req\" type=\"hidden\" value=\"".$datecreationcrit2req."\">\n";
echo "<input name=\"datecreation2req\" type=\"hidden\" value=\"".$datecreation2req."\">\n";
echo "<input name=\"datemodifcrit1req\" type=\"hidden\" value=\"".$datemodifcrit1req."\">\n";
echo "<input name=\"datemodif1req\" type=\"hidden\" value=\"".$datemodif1req."\">\n";
echo "<input name=\"datemodifcrit2req\" type=\"hidden\" value=\"".$datemodifcrit2req."\">\n";
echo "<input name=\"datemodif2req\" type=\"hidden\" value=\"".$datemodif2req."\">\n";
echo "<input name=\"titrereq\" type=\"hidden\" value=\"".$titrereq."\">\n";
echo "<input name=\"titreabregereq\" type=\"hidden\" value=\"".$titreabregereq."\">\n";
echo "<input name=\"variantetitrereq\" type=\"hidden\" value=\"".$variantetitrereq."\">\n";
echo "<input name=\"issnreq\" type=\"hidden\" value=\"".$issnreq."\">\n";
echo "<input name=\"issnlreq\" type=\"hidden\" value=\"".$issnlreq."\">\n";
echo "<input name=\"nlmidreq\" type=\"hidden\" value=\"".$nlmidreq."\">\n";
echo "<input name=\"catalogidreq\" type=\"hidden\" value=\"".$catalogidreq."\">\n";
echo "<input name=\"doireq\" type=\"hidden\" value=\"".$doireq."\">\n";
echo "<input name=\"codenreq\" type=\"hidden\" value=\"".$codenreq."\">\n";
echo "<input name=\"urnreq\" type=\"hidden\" value=\"".$urnreq."\">\n";
echo "<input name=\"openaccessreq\" type=\"hidden\" value=\"".$openaccessreq."\">\n";
echo "<input name=\"publiinstreq\" type=\"hidden\" value=\"".$publiinstreq."\">\n";
echo "<input name=\"faitsuiteareq\" type=\"hidden\" value=\"".$faitsuiteareq."\">\n";
echo "<input name=\"devientreq\" type=\"hidden\" value=\"".$devientreq."\">\n";
echo "<input name=\"editeurreq\" type=\"hidden\" value=\"".$editeurreq."\">\n";
echo "<input name=\"etatcollreq\" type=\"hidden\" value=\"".$etatcollreq."\">\n";
echo "<input name=\"etatcolldebareq\" type=\"hidden\" value=\"".$etatcolldebareq."\">\n";
echo "<input name=\"etatcolldebvreq\" type=\"hidden\" value=\"".$etatcolldebvreq."\">\n";
echo "<input name=\"etatcolldebfreq\" type=\"hidden\" value=\"".$etatcolldebfreq."\">\n";
echo "<input name=\"etatcollfinareq\" type=\"hidden\" value=\"".$etatcollfinareq."\">\n";
echo "<input name=\"etatcollfinvreq\" type=\"hidden\" value=\"".$etatcollfinvreq."\">\n";
echo "<input name=\"etatcollfinfreq\" type=\"hidden\" value=\"".$etatcollfinfreq."\">\n";
echo "<input name=\"embargoreq\" type=\"hidden\" value=\"".$embargoreq."\">\n";
echo "<input name=\"urlreq\" type=\"hidden\" value=\"".$urlreq."\">\n";
echo "<input name=\"rssreq\" type=\"hidden\" value=\"".$rssreq."\">\n";
echo "<input name=\"acceselecinst1req\" type=\"hidden\" value=\"".$acceselecinst1req."\">\n";
echo "<input name=\"acceselecinst2req\" type=\"hidden\" value=\"".$acceselecinst2req."\">\n";
echo "<input name=\"acceseleclibrereq\" type=\"hidden\" value=\"".$acceseleclibrereq."\">\n";
echo "<input name=\"titreexclureq\" type=\"hidden\" value=\"".$titreexclureq."\">\n";
echo "<input name=\"supportreq\" type=\"hidden\" value=\"".$supportreq."\">\n";
echo "<input name=\"licencereq\" type=\"hidden\" value=\"".$licencereq."\">\n";
echo "<input name=\"plateformereq\" type=\"hidden\" value=\"".$plateformereq."\">\n";
echo "<input name=\"gestionreq\" type=\"hidden\" value=\"".$gestionreq."\">\n";
echo "<input name=\"historiqueaboreq\" type=\"hidden\" value=\"".$historiqueaboreq."\">\n";
echo "<input name=\"statutaboreq\" type=\"hidden\" value=\"".$statutaboreq."\">\n";
echo "<input name=\"cotereq\" type=\"hidden\" value=\"".$cotereq."\">\n";
echo "<input name=\"localisationreq\" type=\"hidden\" value=\"".$localisationreq."\">\n";
echo "<input name=\"userreq\" type=\"hidden\" value=\"".$userreq."\">\n";
echo "<input name=\"pwdreq\" type=\"hidden\" value=\"".$pwdreq."\">\n";
echo "<input name=\"keywordsreq\" type=\"hidden\" value=\"".$keywordsreq."\">\n";
echo "<input name=\"commentaireproreq\" type=\"hidden\" value=\"".$commentaireproreq."\">\n";
echo "<input name=\"commentairepubreq\" type=\"hidden\" value=\"".$commentairepubreq."\">\n";
echo "<input name=\"signaturecreationreq\" type=\"hidden\" value=\"".$signaturecreationreq."\">\n";
echo "<input name=\"signaturemodifreq\" type=\"hidden\" value=\"".$signaturemodifreq."\">\n";
echo "<input name=\"datecreationreq\" type=\"hidden\" value=\"".$datecreationreq."\">\n";
echo "<input name=\"datemodifreq\" type=\"hidden\" value=\"".$datemodifreq."\">\n";
echo "<input name=\"sujetsfmreq\" type=\"hidden\" value=\"".$sujetsfmreq."\">\n";
echo "<input name=\"fmidreq\" type=\"hidden\" value=\"".$fmidreq."\">\n";
echo "<input name=\"soustitrereq\" type=\"hidden\" value=\"".$soustitrereq."\">\n";
echo "<input name=\"formatreq\" type=\"hidden\" value=\"".$formatreq."\">\n";
echo "<input name=\"packagereq\" type=\"hidden\" value=\"".$packagereq."\">\n";
echo "<input name=\"corecollectionreq\" type=\"hidden\" value=\"".$corecollectionreq."\">\n";
echo "<input name=\"idediteurreq\" type=\"hidden\" value=\"".$idediteurreq."\">\n";
echo "<input name=\"codeediteurreq\" type=\"hidden\" value=\"".$codeediteurreq."\">\n";
echo "<input name=\"themereq\" type=\"hidden\" value=\"".$themereq."\">\n";
echo "<b><font color=\"red\">Modification de la liste de résultats [".$nb." fiches]</font></b><br/><br/>\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Ecrasser les données des ".$nb." fiches avec les valeurs de ce formulaire\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='search.php?" . $_SERVER['QUERY_STRING'] . "'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
// border=\"0\" cellpadding=\"0\" cellspacing=\"0\" 
// 
// Champs bibliographiques
// 
echo "<tr><td class=\"odd\"><b>Titre</b></td><td class=\"odd\"><input name=\"titre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Sous titre</b></td><td><input name=\"soustitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre abregé</b></td><td class=\"odd\"><input name=\"titreabrege\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Variante de titre</b></td><td><input name=\"variantetitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Fait suite à</b></td><td class=\"odd\"><input name=\"faitsuitea\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Devient</b></td><td><input name=\"devient\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Editeur</b></td><td class=\"odd\"><input name=\"editeur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Code de la revue chez l'éditeur</b></td><td><input name=\"codeediteur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Publication institutionnelle</b></td><td class=\"odd\"><input type=\"radio\" name=\"publiinst\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"publiinst\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td><b>Open Access</b></td><td><input type=\"radio\" name=\"openaccess\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"openaccess\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>ISSN-L</b></td><td class=\"odd\"><input name=\"issnl\" type=\"text\" size=\"10\" value=\"\">\n";
echo "  |  <b>ISSNs </b><input name=\"issn\" type=\"text\" size=\"30\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Catalog ID</b></td><td><input name=\"catalogid\" type=\"text\" size=\"20\" value=\"\">\n";
echo "  |  <b>NLM ID </b><input name=\"nlmid\" type=\"text\" size=\"20\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>CODEN</b></td><td class=\"odd\"><input name=\"coden\" type=\"text\" size=\"10\" value=\"\">\n";
echo "  |  <b>DOI </b><input name=\"doi\" type=\"text\" size=\"15\" value=\"\">\n";
echo "  |  <b>URN </b><input name=\"urn\" type=\"text\" size=\"10\" value=\"\"></td></tr>\n";
// 
// Cahmps de gestion
// 
echo "<tr><td><b>URL</b></td><td><input name=\"url\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>RSS</b></td><td class=\"odd\"><input name=\"rss\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Username</b></td><td><input name=\"user\" type=\"text\" size=\"20\" value=\"\">\n";
echo "  |  <b>Password </b><input name=\"pwd\" type=\"text\" size=\"20\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Abonnement / Licence</b></td><td class=\"odd\">\n";
echo "<select name=\"licence\" id=\"licence\" onchange=\"ajoutevaleur('licence');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslicence;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"licencenew\" id=\"licencenew\" type=\"text\" size=\"30\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Statut de l'abonnement</b></td>\n";
echo "<td>";
echo "<select name=\"statutabo\">\n";
echo "<option value=\"\"></option>\n";
echo "<option value=\"1\">Actif</option>\n";
echo "<option value=\"0\">Terminé</option>\n";
echo "<option value=\"2\">En test</option>\n";
echo "<option value=\"3\">Pardu</option>\n";
echo "<option value=\"4\">En panne</option>\n";
echo "<option value=\"5\">Gestion provisoire</option>\n";
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre exclu de la licence</b></td><td class=\"odd\"><input type=\"radio\" name=\"titreexclu\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"titreexclu\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td><b>Core collection</b></td><td><input type=\"radio\" name=\"corecollection\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"corecollection\" value=\"0\"/> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Plateforme</b></td><td class=\"odd\">\n";
echo "<select name=\"plateforme\" id=\"plateforme\" onchange=\"ajoutevaleur('plateforme');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsplateforme;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"plateformenew\" id=\"plateformenew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Gestion</b></td><td>\n";
echo "<select name=\"gestion\" id=\"gestion\" onchange=\"ajoutevaleur('gestion');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsgestion;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"gestionnew\" id=\"gestionnew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Historique de l'abonnement</b></td><td class=\"odd\">\n";
echo "<select name=\"historiqueabo\" id=\"historiqueabo\" onchange=\"ajoutevaleur('historiqueabo');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionshistoriqueabo;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"historiqueabonew\" id=\"historiqueabonew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Support</b></td><td>\n";
echo "<select name=\"support\" id=\"support\" onchange=\"ajoutevaleur('support');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionssupport;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"supportnew\" id=\"supportnew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Format</b></td><td class=\"odd\">\n";
echo "<select name=\"format\" id=\"format\" onchange=\"ajoutevaleur('format');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsformat;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"formatnew\" id=\"formatnew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Accès électronique</b></td><td>\n";
echo "<input type=\"checkbox\" name=\"acceselecinst1\" value=\"1\"/> " . $configinstitution . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceselecinst2\" value=\"1\"/> " . $configinstitution2 . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceseleclibre\" value=\"1\"/> Libre\n";
echo "<tr><td class=\"odd\"><b>Nom du package</b></td><td class=\"odd\"><input name=\"package\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>No d'abonnement</b></td><td><input name=\"idediteur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Etat de collection</b></td><td class=\"odd\"><input name=\"etatcoll\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Embargo</b></td><td><input name=\"embargo\" type=\"text\" size=\"10\" value=\"\"> (nombre de mois)</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Début de la collection</b></td>\n";
echo "<td class=\"odd\">Année <input name=\"etatcolldeba\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Volume <input name=\"etatcolldebv\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Numéro <input name=\"etatcolldebf\" type=\"text\" size=\"5\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Fin de la collection</b></td>\n";
echo "<td>Année <input name=\"etatcollfina\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Volume <input name=\"etatcollfinv\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Numéro <input name=\"etatcollfinf\" type=\"text\" size=\"5\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Localisation</b></td><td class=\"odd\">\n";
echo "<select name=\"localisation\" id=\"localisation\" onchange=\"ajoutevaleur('localisation');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslocalisation;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"localisationnew\" id=\"localisationnew\" type=\"text\" size=\"20\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Cote (papier)</b></td><td><input name=\"cote\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Commentaire professionnel</b></td><td class=\"odd\"><input name=\"commentairepro\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Commentaire publique</b></td><td><input name=\"commentairepub\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Keywords</b></td><td class=\"odd\"><input name=\"keywords\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
// for ($i=0 ; $i<10 ; $i++)
// {
// $stmthemesliste = "1";
// $reqthemesliste="SELECT sujetsfr, sujetsid, sujetsshs, sujetsstm FROM sujets ORDER BY sujetsshs DESC, sujetsfr ASC";
// $optionsthemesliste="";
// $resultthemesliste = mysql_query($reqthemesliste,$link);
// while ($rowthemesliste = mysql_fetch_array($resultthemesliste))
// {
// $namethemesliste = $rowthemesliste["sujetsfr"];
// $idthemesliste = $rowthemesliste["sujetsid"];
// $shsthemesliste = $rowthemesliste["sujetsshs"];
// if (($shsthemesliste == "0") && ($stmthemesliste == "1"))
// {
// $optionsthemesliste.="<optgroup label=\"Sciences biomédicales\">\n";
// $stmthemesliste = "0";
// }
// $optionsthemesliste.="<option value=\"" . $idthemesliste . "\">" . $namethemesliste . "</option>\n";
// }
// $themei = $i+1;
// if ($i % 2 == 0)
// $styleodd = "";
// else
// $styleodd = " class=\"odd\"";
// echo "<tr><td" . $styleodd . "><b>Thème</b></td><td" . $styleodd . ">\n";
// echo "<select name=\"theme" . $themei . "\" id=\"theme" . $themei . "\">\n";
// echo "<option value=\"\"></option>\n";
// echo "<optgroup label=\"Sciences humaines\">\n";
// echo $optionsthemesliste;
// echo "</select>\n";
// echo "</td></tr>\n";
// }

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Ecrasser les données des ".$nb." fiches avec les valeurs de ce formulaire\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='search.php?" . $_SERVER['QUERY_STRING'] . "'\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";

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
?>
