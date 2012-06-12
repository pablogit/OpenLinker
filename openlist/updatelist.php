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
// Table journals : modification de masses à partir du résultat d'une recherche administrateur
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin"))
{
$action=addslashes($_POST['action']);
$mes="";
$date=date("Y-m-d H:i:s");

// *******************************************
// *******************************************
// Recuperation des paramètres de la recherche
// *******************************************
// *******************************************

$titrereq = addslashes(trim($_POST['titrereq']));
$titreabregereq = addslashes(trim($_POST['titreabregereq']));
$variantetitrereq = addslashes(trim($_POST['variantetitrereq']));
$issnreq = addslashes($_POST['issnreq']);
$issnlreq = addslashes($_POST['issnlreq']);
$nlmidreq = addslashes($_POST['nlmidreq']);
$catalogidreq = addslashes($_POST['catalogidreq']);
$doireq = addslashes($_POST['doireq']);
$codenreq = addslashes($_POST['codenreq']);
$urnreq = addslashes($_POST['urnreq']);
$openaccessreq = addslashes($_POST['openaccessreq']);
$publiinstreq = addslashes($_POST['publiinstreq']);
$faitsuiteareq = addslashes(trim($_POST['faitsuiteareq']));
$devientreq = addslashes(trim($_POST['devientreq']));
$editeurreq = addslashes(trim($_POST['editeurreq']));
$etatcollreq = addslashes(trim($_POST['etatcollreq']));
$etatcolldebareq = addslashes($_POST['etatcolldebareq']);
$etatcolldebvreq = addslashes($_POST['etatcolldebvreq']);
$etatcolldebfreq = addslashes($_POST['etatcolldebfreq']);
$etatcollfinareq = addslashes($_POST['etatcollfinareq']);
$etatcollfinvreq = addslashes($_POST['etatcollfinvreq']);
$etatcollfinfreq = addslashes($_POST['etatcollfinfreq']);
$embargoreq = addslashes($_POST['embargoreq']);
$urlreq = $_POST['urlreq'];
$rssreq = $_POST['rssreq'];
$acceselecinst1req = addslashes($_POST['acceselecinst1req']);
$acceselecinst2req = addslashes($_POST['acceselecinst2req']);
$acceseleclibrereq = addslashes($_POST['acceseleclibrereq']);
$titreexclureq = addslashes($_POST['titreexclureq']);
$supportreq = addslashes($_POST['supportreq']);
$licencereq = addslashes($_POST['licencereq']);
$plateformereq = addslashes($_POST['plateformereq']);
$gestionreq = addslashes($_POST['gestionreq']);
$historiqueaboreq = addslashes($_POST['historiqueaboreq']);
$statutaboreq = addslashes($_POST['statutaboreq']);
$cotereq = addslashes(trim($_POST['cotereq']));
$localisationreq = addslashes($_POST['localisationreq']);
$userreq = addslashes($_POST['userreq']);
$pwdreq = addslashes($_POST['pwdreq']);
$keywordsreq = addslashes(trim($_POST['keywordsreq']));
$commentaireproreq = addslashes(trim($_POST['commentaireproreq']));
$commentairepubreq = addslashes(trim($_POST['commentairepubreq']));
$signaturecreationreq = addslashes($_POST['signaturecreationreq']);
$signaturemodifreq = addslashes($_POST['signaturemodifreq']);
$datecreationreq = addslashes($_POST['datecreationreq']);
$datemodifreq = addslashes($_POST['datemodifreq']);
$sujetsfmreq = addslashes($_POST['sujetsfmreq']);
$fmidreq = addslashes($_POST['fmidreq']);
$soustitrereq = addslashes(trim($_POST['soustitrereq']));
$formatreq = addslashes($_POST['formatreq']);
$packagereq = addslashes($_POST['packagereq']);
$corecollectionreq = addslashes($_POST['corecollectionreq']);
$idediteurreq = addslashes($_POST['idediteurreq']);
$codeediteurreq = addslashes($_POST['codeediteurreq']);
$themereq = addslashes($_POST['themereq']);
$qallreq = $_POST['allfieldsreq'];
$journalsidcrit1req = addslashes($_POST['journalsidcrit1req']);
$journalsid1req = addslashes($_POST['journalsid1req']);
$journalsidcrit2req = addslashes($_POST['journalsidcrit2req']);
$journalsid2req = addslashes($_POST['journalsid2req']);
$embargocritreq = addslashes($_POST['embargocritreq']);
$datecreationcrit1req = addslashes($_POST['datecreationcrit1req']);
$datecreation1req = addslashes($_POST['datecreation1req']);
$datecreationcrit2req = addslashes($_POST['datecreationcrit2req']);
$datecreation2req = addslashes($_POST['datecreation2req']);
$datemodifcrit1req = addslashes($_POST['datemodifcrit1req']);
$datemodif1req = addslashes($_POST['datemodif1req']);
$datemodifcrit2req = addslashes($_POST['datemodifcrit2req']);
$datemodif2req = addslashes($_POST['datemodif2req']);

// *******************************************
// *******************************************
// Recuperation des paramètres du formulaire
// *******************************************
// *******************************************

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
$url = $_POST['url'];
$rss = $_POST['rss'];
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
$package = addslashes($_POST['package']);
$corecollection = addslashes($_POST['corecollection']);
$idediteur = addslashes($_POST['idediteur']);
$codeediteur = addslashes($_POST['codeediteur']);
$supportnew = addslashes($_POST['supportnew']);
if ($support == "new")
$support = $supportnew;
$licencenew = addslashes($_POST['licencenew']);
if ($licence == "new")
$licence = $licencenew;
$plateformenew = addslashes($_POST['plateformenew']);
if ($plateforme == "new")
$plateforme = $plateformenew;
$gestionnew = addslashes($_POST['gestionnew']);
if ($gestion == "new")
$gestion = $gestionnew;
$historiqueabonew = addslashes($_POST['historiqueabonew']);
if ($historiqueabo == "new")
$historiqueabo = $historiqueabonew;
$formatnew = addslashes($_POST['formatnew']);
if ($format == "new")
$format = $formatnew;
$localisationnew = addslashes($_POST['localisationnew']);
if ($localisation == "new")
$localisation = $localisationnew;
$theme1=addslashes($_POST['theme1']);
$theme2=addslashes($_POST['theme2']);
$theme3=addslashes($_POST['theme3']);
$theme4=addslashes($_POST['theme4']);
$theme5=addslashes($_POST['theme5']);
$theme6=addslashes($_POST['theme6']);
$theme7=addslashes($_POST['theme7']);
$theme8=addslashes($_POST['theme8']);
$theme9=addslashes($_POST['theme9']);
$theme10=addslashes($_POST['theme10']);


// ******************************
// ******************************
// ******************************
// Recuperation des valeurs de la recherche
// ******************************
// ******************************
// ******************************

$searcheqa = "";
$andq = "";
$searchadvok = 0;
$searchadmok = 0;

if ($action == "updatelist")
{

if ($qallreq)
{
$qall = $qallreq;
$searcheqa = $searcheqa . $andq . "tous les champs = " . $qall;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($journalsid1req)
{
$searcheqa = $searcheqa . $andq . "journalsid";
if ($journalsidcrit1req == "equal")
$searcheqa = $searcheqa . " = " . $journalsid1req;
if ($journalsidcrit1req == "before")
$searcheqa = $searcheqa . " < " . $journalsid1req;
if ($journalsidcrit1req == "after")
$searcheqa = $searcheqa . " > " . $journalsid1req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($journalsid2req)
{
$searcheqa = $searcheqa . $andq . "journalsid";
if ($journalsidcrit2req == "equal")
$searcheqa = $searcheqa . " = " . $journalsid2req;
if ($journalsidcrit2req == "before")
$searcheqa = $searcheqa . " < " . $journalsid2req;
if ($journalsidcrit2req == "after")
$searcheqa = $searcheqa . " > " . $journalsid2req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}


if ($titrereq)
{
$searcheqa = $searcheqa . $andq . "titre = " . $titrereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$titrereq = str_ireplace("*","%",$titrereq);
$titrereq = str_ireplace("'","\\'",$titrereq);
$titre2req = str_ireplace(" ","%",$titrereq);

if ($soustitrereq)
{
$searcheqa = $searcheqa . $andq . "soustitre = " . $soustitrereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$soustitrereq=str_ireplace("*","%",$soustitrereq);
$soustitre2req=str_ireplace(" ","%",$soustitrereq);

if ($titreabregereq)
{
$searcheqa = $searcheqa . $andq . "titreabrege = " . $titreabregereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$titreabregereq=str_ireplace("*","%",$titreabregereq);
$titreabrege2req=str_ireplace(" ","%",$titreabregereq);

if ($variantetitrereq)
{
$searcheqa = $searcheqa . $andq . "variantetitre = " . $variantetitrereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$variantetitrereq=str_ireplace("*","%",$variantetitrereq);
$variantetitre2req=str_ireplace(" ","%",$variantetitrereq);

if ($faitsuiteareq)
{
$searcheqa = $searcheqa . $andq . "faitsuitea = " . $faitsuiteareq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$faitsuiteareq=str_ireplace("*","%",$faitsuiteareq);
$faitsuitea2req=str_ireplace(" ","%",$faitsuiteareq);

if ($devientreq)
{
$searcheqa = $searcheqa . $andq . "devient = " . $devientreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$devientreq=str_ireplace("*","%",$devientreq);
$devient2req=str_ireplace(" ","%",$devientreq);

if ($editeurreq)
{
$searcheqa = $searcheqa . $andq . "editeur = " . $editeurreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$editeurreq=str_ireplace("*","%",$editeurreq);
$editeur2req=str_ireplace(" ","%",$editeurreq);

if ($codeediteurreq)
{
$searcheqa = $searcheqa . $andq . "codeediteur = " . $codeediteurreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$codeediteurreq=str_ireplace("*","%",$codeediteurreq);

if ($publiinstreq != "")
{
$searcheqa = $searcheqa . $andq . "publiinst = " . $publiinstreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($openaccessreq != "")
{
$searcheqa = $searcheqa . $andq . "openaccess = " . $openaccessreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($issnlreq)
{
$searcheqa = $searcheqa . $andq . "issnl = " . $issnlreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$issnlreq=str_ireplace("*","%",$issnlreq);

if ($issnreq)
{
$searcheqa = $searcheqa . $andq . "issn = " . $issnreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$issnreq=str_ireplace("*","%",$issnreq);
$issn2req=str_ireplace(" ","%",$issnreq);

if ($catalogidreq)
{
$searcheqa = $searcheqa . $andq . "catalogid = " . $catalogidreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$catalogidreq=str_ireplace("*","%",$catalogidreq);

if ($nlmidreq)
{
$searcheqa = $searcheqa . $andq . "nlmid = " . $nlmidreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$nlmidreq=str_ireplace("*","%",$nlmidreq);

if ($codenreq)
{
$searcheqa = $searcheqa . $andq . "coden = " . $codenreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$codenreq=str_ireplace("*","%",$codenreq);

if ($doireq)
{
$searcheqa = $searcheqa . $andq . "doi = " . $doireq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$doireq=str_ireplace("*","%",$doireq);

if ($urnreq)
{
$searcheqa = $searcheqa . $andq . "urn = " . $urnreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$urnreq=str_ireplace("*","%",$urnreq);

if ($urlreq)
{
$searcheqa = $searcheqa . $andq . "url = " . $urlreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$urlreq=str_ireplace("*","%",$urlreq);

if ($rssreq)
{
$searcheqa = $searcheqa . $andq . "rss = " . $rssreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$rssreq=str_ireplace("*","%",$rssreq);

if ($userreq)
{
$searcheqa = $searcheqa . $andq . "user = " . $userreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$userreq=str_ireplace("*","%",$userreq);

if ($pwdreq)
{
$searcheqa = $searcheqa . $andq . "pwd = " . $pwdreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$pwdreq=str_ireplace("*","%",$pwdreq);

if ($licencereq)
{
$searcheqa = $searcheqa . $andq . "licence = " . $licencereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$licencereq=str_ireplace("*","%",$licencereq);

if ($statutaboreq != "")
{
$searcheqa = $searcheqa . $andq . "statutabo = " . $statutaboreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$statutaboreq=str_ireplace("*","%",$statutaboreq);

if ($titreexclureq != "")
{
$searcheqa = $searcheqa . $andq . "titreexclu = " . $titreexclureq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($corecollectionreq != "")
{
$searcheqa = $searcheqa . $andq . "corecollection = " . $corecollectionreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($plateformereq)
{
$searcheqa = $searcheqa . $andq . "plateforme = " . $plateformereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$plateformereq=str_ireplace("*","%",$plateformereq);

if ($gestionreq)
{
$searcheqa = $searcheqa . $andq . "gestion = " . $gestionreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$gestionreq=str_ireplace("*","%",$gestionreq);

if ($historiqueaboreq)
{
$searcheqa = $searcheqa . $andq . "historiqueabo = " . $historiqueaboreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$historiqueaboreq=str_ireplace("*","%",$historiqueaboreq);

if ($supportreq)
{
$searcheqa = $searcheqa . $andq . "support = " . $supportreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$supportreq=str_ireplace("*","%",$supportreq);

if ($formatreq)
{
$searcheqa = $searcheqa . $andq . "format = " . $formatreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$formatreq=str_ireplace("*","%",$formatreq);

if ($acceselecinst1req)
{
$searcheqa = $searcheqa . $andq . "acceselecinst1 = " . $acceselecinst1req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($acceselecinst2req)
{
$searcheqa = $searcheqa . $andq . "acceselecinst2 = " . $acceselecinst2req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($acceseleclibrereq)
{
$searcheqa = $searcheqa . $andq . "acceseleclibre = " . $acceseleclibrereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($packagereq)
{
$searcheqa = $searcheqa . $andq . "package = " . $packagereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$packagereq=str_ireplace("*","%",$packagereq);

if ($idediteurreq)
{
$searcheqa = $searcheqa . $andq . "idediteur = " . $idediteurreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$idediteurreq=str_ireplace("*","%",$idediteurreq);

if ($etatcollreq)
{
$searcheqa = $searcheqa . $andq . "etatcoll = " . $etatcollreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$etatcollreq=str_ireplace("*","%",$etatcollreq);

if ($embargoreq)
{
$searcheqa = $searcheqa . $andq . "embargo";
if ($embargocritreq == "equal")
$searcheqa = $searcheqa . " = " . $embargoreq;
if ($embargocritreq == "before")
$searcheqa = $searcheqa . " < " . $embargoreq;
if ($embargocritreq == "after")
$searcheqa = $searcheqa . " > " . $embargoreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$embargoreq=str_ireplace("*","%",$embargoreq);

if ($etatcolldebareq != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldeba = " . $etatcolldebareq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($etatcolldebvreq != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldebv = " . $etatcolldebvreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($etatcolldebfreq != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldebf = " . $etatcolldebfreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($etatcollfinareq != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfina = " . $etatcollfinareq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($etatcollfinvreq != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfinv = " . $etatcollfinvreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($etatcollfinfreq != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfinf = " . $etatcollfinfreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($localisationreq)
{
$searcheqa = $searcheqa . $andq . "localisation = " . $localisationreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$localisationreq=str_ireplace("*","%",$localisationreq);

if ($cotereq)
{
$searcheqa = $searcheqa . $andq . "cote = " . $cotereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$cotereq=str_ireplace("*","%",$cotereq);

if ($commentaireproreq)
{
$searcheqa = $searcheqa . $andq . "commentairepro = " . $commentaireproreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$commentaireproreq=str_ireplace("*","%",$commentaireproreq);
$commentairepro2req=str_ireplace(" ","%",$commentaireproreq);

if ($commentairepubreq)
{
$searcheqa = $searcheqa . $andq . "commentairepub = " . $commentairepubreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$commentairepubreq=str_ireplace("*","%",$commentairepubreq);
$commentairepub2req=str_ireplace(" ","%",$commentairepubreq);

if ($keywordsreq)
{
$searcheqa = $searcheqa . $andq . "keywords = " . $keywordsreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$keywordsreq=str_ireplace("*","%",$keywordsreq);
$keywords2req=str_ireplace(" ","%",$keywordsreq);

if ($sujetreq)
{
$searcheqa = $searcheqa . $andq . "sujet = " . $sujetreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$sujetreq=str_ireplace("*","%",$sujetreq);

if ($sujetsfmreq)
{
$searcheqa = $searcheqa . $andq . "sujetsfm = " . $sujetsfmreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$sujetsfmreq=str_ireplace("*","%",$sujetsfmreq);
$sujetsfm2req=str_ireplace(" ","%",$sujetsfm2req);

if ($fmidreq)
{
$searcheqa = $searcheqa . $andq . "fmid = " . $fmidreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($signaturecreationreq)
{
$searcheqa = $searcheqa . $andq . "signaturecreation = " . $signaturecreationreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$signaturecreationreq=str_ireplace("*","%",$signaturecreationreq);

if ($signaturemodifreq)
{
$searcheqa = $searcheqa . $andq . "signaturemodif = " . $signaturemodifreq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$signaturemodifreq=str_ireplace("*","%",$signaturemodifreq);


if ($datecreation1req)
{
$searcheqa = $searcheqa . $andq . "datecreation";
if ($datecreationcrit1req == "equal")
$searcheqa = $searcheqa . " = " . $datecreation1req;
if ($datecreationcrit1req == "before")
$searcheqa = $searcheqa . " < " . $datecreation1req;
if ($datecreationcrit1req == "after")
$searcheqa = $searcheqa . " > " . $datecreation1req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}


if ($datecreation2req)
{
$searcheqa = $searcheqa . $andq . "datecreation";
if ($datecreationcrit2req == "equal")
$searcheqa = $searcheqa . " = " . $datecreation2req;
if ($datecreationcrit2req == "before")
$searcheqa = $searcheqa . " < " . $datecreation2req;
if ($datecreationcrit2req == "after")
$searcheqa = $searcheqa . " > " . $datecreation2req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}


if ($datemodif1req)
{
$searcheqa = $searcheqa . $andq . "datemodif";
if ($datemodifcrit1req == "equal")
$searcheqa = $searcheqa . " = " . $datemodif1req;
if ($datemodifcrit1req == "before")
$searcheqa = $searcheqa . " < " . $datemodif1req;
if ($datemodifcrit1req == "after")
$searcheqa = $searcheqa . " > " . $datemodif1req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}


if ($datemodif2req)
{
$searcheqa = $searcheqa . $andq . "datemodif";
if ($datemodifcrit2req == "equal")
$searcheqa = $searcheqa . " = " . $datemodif2req;
if ($datemodifcrit2req == "before")
$searcheqa = $searcheqa . " < " . $datemodif2req;
if ($datemodifcrit2req == "after")
$searcheqa = $searcheqa . " > " . $datemodif2req;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

if ($historiquereq)
{
$searcheqa = $searcheqa . $andq . "historique = " . $historiquereq;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$historiquereq=str_ireplace("*","%",$historiquereq);
$historique2req=str_ireplace(" ","%",$historiquereq);

$and = "";
$reqadm = "";


if ($qall)
{
$qall=trim($qall);
$qallstop = " " . $qall . " ";
$qallstop = str_ireplace(",","",$qallstop);
$qallstop = str_ireplace(".","",$qallstop);
$qallstop = str_ireplace(": "," ",$qallstop);
$qallstop = str_ireplace(":"," ",$qallstop);
$qallstop = str_ireplace(";","",$qallstop);
$qallstop = str_ireplace(" (the) "," ",$qallstop);
$qallstop = str_ireplace(" [the] "," ",$qallstop);
$qallstop = str_ireplace(" the "," ",$qallstop);
$qallstop = str_ireplace(" of "," ",$qallstop);
$qallstop = str_ireplace(" de "," ",$qallstop);
$qallstop = str_ireplace(" du "," ",$qallstop);
$qallstop = str_ireplace(" le "," ",$qallstop);
$qallstop = str_ireplace(" les "," ",$qallstop);
$qallstop = str_ireplace(" des "," ",$qallstop);
$qallstop = str_ireplace(" la "," ",$qallstop);
$qallstop = str_ireplace(" l'"," ",$qallstop);
$qallstop = str_ireplace(" los "," ",$qallstop);
$qallstop = str_ireplace(" el "," ",$qallstop);
$qallstop = str_ireplace(" las "," ",$qallstop);
$qallstop = str_ireplace(" der "," ",$qallstop);
$qallstop = str_ireplace(" die "," ",$qallstop);
$qallstop = str_ireplace(" das "," ",$qallstop);
$qallstop = str_ireplace(" and "," ",$qallstop);
$qallstop = str_ireplace(" (and) "," ",$qallstop);
$qallstop = str_ireplace(" [and] "," ",$qallstop);
$qallstop = str_ireplace(" et "," ",$qallstop);
$qallstop = str_ireplace(" (et) "," ",$qallstop);
$qallstop = str_ireplace(" [et] "," ",$qallstop);
$qallstop = str_ireplace(" y "," ",$qallstop);
$qallstop = str_ireplace(" und "," ",$qallstop);
$qallstop = str_ireplace(" fur "," ",$qallstop);
$qallstop = str_ireplace(" für "," ",$qallstop);
$qallstop = str_ireplace(" & "," ",$qallstop);
$qallstop = str_ireplace(" (&) "," ",$qallstop);
$qallstop = str_ireplace(" [&] "," ",$qallstop);
$qallstop = str_ireplace(" &amp; "," ",$qallstop);
$qallstop=trim($qallstop);
if (($qallstop=="")||($qallstop==" "))
{
$qallstop = $qall;
}
$qallstop=str_ireplace("*","%",$qallstop);
$qall1=str_ireplace(" ","%",$qallstop);
$startespaceqall = stripos($qallstop, " ");
if ($startespaceqall !== false)
{
$ktqall=split(" ",$qallstop);
while(list($keyqall,$valqall)=each($ktqall))
{
if($valqall<>" " and strlen($valqall) > 0)
{
$qall2 .= "(journalsid LIKE '%$valqall%' OR titre LIKE '%$valqall%' OR titreabrege LIKE '%$valqall%' OR variantetitre LIKE '%$valqall%' OR soustitre LIKE '%$valqall%' OR issn LIKE '%$valqall%' OR issnl LIKE '%$valqall%' OR nlmid LIKE '%$valqall%' OR catalogid LIKE '%$valqall%' OR doi LIKE '%$valqall%' OR coden LIKE '%$valqall%' OR urn LIKE '%$valqall%' OR faitsuitea LIKE '%$valqall%' OR devient LIKE '%$valqall%' OR editeur LIKE '%$valqall%' OR etatcoll LIKE '%$valqall%' OR url LIKE '%$valqall%' OR rss LIKE '%$valqall%' OR licence LIKE '%$valqall%' OR plateforme LIKE '%$valqall%' OR gestion LIKE '%$valqall%' OR historiqueabo LIKE '%$valqall%' OR cote LIKE '%$valqall%' OR localisation LIKE '%$valqall%' OR user LIKE '%$valqall%' OR keywords LIKE '%$valqall%' OR commentairepub LIKE '%$valqall%') AND ";
}
}
$qall2=substr($qall2,0,(strlen($qall2)-4));
}
else
$qall2= "(journalsid LIKE '%$qall1%' OR titre LIKE '%$qall1%' OR titreabrege LIKE '%$qall1%' OR variantetitre LIKE '%$qall1%' OR soustitre LIKE '%$qall1%' OR issn LIKE '%$qall1%' OR issnl LIKE '%$qall1%' OR nlmid LIKE '%$qall1%' OR catalogid LIKE '%$qall1%' OR doi LIKE '%$qall1%' OR coden LIKE '%$qall1%' OR urn LIKE '%$qall1%' OR faitsuitea LIKE '%$qall1%' OR devient LIKE '%$qall1%' OR editeur LIKE '%$qall1%' OR etatcoll LIKE '%$qall1%' OR url LIKE '%$qall1%' OR rss LIKE '%$qall1%' OR licence LIKE '%$qall1%' OR plateforme LIKE '%$qall1%' OR gestion LIKE '%$qall1%' OR historiqueabo LIKE '%$qall1%' OR cote LIKE '%$qall1%' OR localisation LIKE '%$qall1%' OR user LIKE '%$qall1%' OR keywords LIKE '%$qall1%' OR commentairepub LIKE '%$qall1%')";

$reqadm = "($qall2)";
$and = " AND ";
}

if ($journalsid1req)
{
if ($journalsidcrit1req == "equal")
$reqadm = $reqadm . $and . "(journalsid = $journalsid1req)";
if ($journalsidcrit1req == "before")
$reqadm = $reqadm . $and . "(journalsid < $journalsid1req)";
if ($journalsidcrit1req == "after")
$reqadm = $reqadm . $and . "(journalsid > $journalsid1req)";
$and = " AND ";
}
if ($journalsid2req)
{
if ($journalsidcrit2req == "equal")
$reqadm = $reqadm . $and . "(journalsid = $journalsid2req)";
if ($journalsidcrit2req == "before")
$reqadm = $reqadm . $and . "(journalsid < $journalsid2req)";
if ($journalsidcrit2req == "after")
$reqadm = $reqadm . $and . "(journalsid > $journalsid2req)";
$and = " AND ";
}


if ($titrereq)
{
$reqadm = $reqadm . $and . "(titre LIKE '%$titre2req%')";
$and = " AND ";
}
if ($soustitrereq)
{
$reqadm = $reqadm . $and . "(soustitre LIKE '%$soustitre2req%')";
$and = " AND ";
}
if ($titreabregereq)
{
$reqadm = $reqadm . $and . "(titreabrege LIKE '%$titreabrege2req%')";
$and = " AND ";
}
if ($variantetitrereq)
{
$reqadm = $reqadm . $and . "(variantetitre LIKE '%$variantetitre2req%')";
$and = " AND ";
}
if ($faitsuiteareq)
{
$reqadm = $reqadm . $and . "(faitsuitea LIKE '%$faitsuitea2req%')";
$and = " AND ";
}
if ($devientreq)
{
$reqadm = $reqadm . $and . "(devient LIKE '%$devient2req%')";
$and = " AND ";
}
if ($editeurreq)
{
$reqadm = $reqadm . $and . "(editeur LIKE '%$editeur2req%')";
$and = " AND ";
}
if ($codeediteurreq)
{
$reqadm = $reqadm . $and . "(codeediteur LIKE '$codeediteurreq')";
$and = " AND ";
}
if ($publiinstreq != "")
{
$reqadm = $reqadm . $and . "(publiinst = $publiinstreq)";
$and = " AND ";
}
if ($openaccessreq != "")
{
$reqadm = $reqadm . $and . "(openaccess LIKE '$openaccessreq')";
$and = " AND ";
}
if ($issnlreq)
{
$reqadm = $reqadm . $and . "(issnl LIKE '$issnlreq')";
$and = " AND ";
}
if ($issnreq)
{
$reqadm = $reqadm . $and . "(issn LIKE '%$issnreq%')";
$and = " AND ";
}
if ($catalogidreq)
{
$reqadm = $reqadm . $and . "(catalogid LIKE '$catalogidreq')";
$and = " AND ";
}
if ($nlmidreq)
{
$reqadm = $reqadm . $and . "(nlmid LIKE '$nlmidreq')";
$and = " AND ";
}
if ($codenreq)
{
$reqadm = $reqadm . $and . "(coden LIKE '$codenreq')";
$and = " AND ";
}
if ($doireq)
{
$reqadm = $reqadm . $and . "(doi LIKE '$doireq')";
$and = " AND ";
}
if ($urnreq)
{
$reqadm = $reqadm . $and . "(urn LIKE '$urnreq')";
$and = " AND ";
}
if ($urlreq)
{
$reqadm = $reqadm . $and . "(url LIKE '%$urlreq%')";
$and = " AND ";
}
if ($rssreq)
{
$reqadm = $reqadm . $and . "(rss LIKE '%$rssreq%')";
$and = " AND ";
}
if ($userreq)
{
$reqadm = $reqadm . $and . "(user LIKE '$userreq')";
$and = " AND ";
}
if ($pwdreq)
{
$reqadm = $reqadm . $and . "(pwd LIKE '$pwdreq')";
$and = " AND ";
}
if ($licencereq)
{
$reqadm = $reqadm . $and . "(licence LIKE '$licencereq')";
$and = " AND ";
}
if ($statutaboreq != "")
{
$reqadm = $reqadm . $and . "(statutabo = $statutaboreq)";
$and = " AND ";
}
if ($titreexclureq != "")
{
$reqadm = $reqadm . $and . "(titreexclu = $titreexclureq)";
$and = " AND ";
}
if ($corecollectionreq != "")
{
$reqadm = $reqadm . $and . "(corecollection = $corecollectionreq)";
$and = " AND ";
}
if ($plateformereq)
{
$reqadm = $reqadm . $and . "(plateforme LIKE '$plateformereq')";
$and = " AND ";
}
if ($gestionreq)
{
$reqadm = $reqadm . $and . "(gestion LIKE '$gestionreq')";
$and = " AND ";
}
if ($historiqueaboreq)
{
$reqadm = $reqadm . $and . "(historiqueabo LIKE '$historiqueaboreq')";
$and = " AND ";
}
if ($supportreq)
{
$reqadm = $reqadm . $and . "(support LIKE '$supportreq')";
$and = " AND ";
}
if ($formatreq)
{
$reqadm = $reqadm . $and . "(format LIKE '$formatreq')";
$and = " AND ";
}
if ($acceselecinst1req)
{
$reqadm = $reqadm . $and . "(acceselecinst1 = $acceselecinst1req)";
$and = " AND ";
}
if ($acceselecinst2req)
{
$reqadm = $reqadm . $and . "(acceselecinst2 = $acceselecinst2req)";
$and = " AND ";
}
if ($acceseleclibrereq)
{
$reqadm = $reqadm . $and . "(acceseleclibre = $acceseleclibrereq)";
$and = " AND ";
}
if ($packagereq)
{
$reqadm = $reqadm . $and . "(package LIKE '$packagereq')";
$and = " AND ";
}
if ($idediteurreq)
{
$reqadm = $reqadm . $and . "(idediteur LIKE '$idediteurreq')";
$and = " AND ";
}
if ($etatcollreq)
{
$reqadm = $reqadm . $and . "(etatcoll LIKE '%$etatcollreq%')";
$and = " AND ";
}
if ($embargoreq)
{
if ($embargocritreq == "equal")
$reqadm = $reqadm . $and . "(embargo = $embargoreq)";
if ($embargocritreq == "before")
$reqadm = $reqadm . $and . "(embargo < $embargoreq)";
if ($embargocritreq == "after")
$reqadm = $reqadm . $and . "(embargo > $embargoreq)";
$and = " AND ";
}
if ($etatcolldebareq != "")
{
$reqadm = $reqadm . $and . "(etatcolldeba = $etatcolldebareq)";
$and = " AND ";
}
if ($etatcolldebvreq != "")
{
$reqadm = $reqadm . $and . "(etatcolldebv = $etatcolldebvreq)";
$and = " AND ";
}
if ($etatcolldebfreq != "")
{
$reqadm = $reqadm . $and . "(etatcolldebf = $etatcolldebfreq)";
$and = " AND ";
}
if ($etatcollfinareq != "")
{
$reqadm = $reqadm . $and . "(etatcollfina = $etatcollfinareq)";
$and = " AND ";
}
if ($etatcollfinvreq != "")
{
$reqadm = $reqadm . $and . "(etatcollfinv = $etatcollfinvreq)";
$and = " AND ";
}
if ($etatcollfinfreq != "")
{
$reqadm = $reqadm . $and . "(etatcollfinf = $etatcollfinfreq)";
$and = " AND ";
}
if ($localisationreq)
{
$reqadm = $reqadm . $and . "(localisation LIKE '$localisationreq')";
$and = " AND ";
}
if ($cotereq)
{
$reqadm = $reqadm . $and . "(cote LIKE '%$cotereq%')";
$and = " AND ";
}
if ($commentaireproreq)
{
$reqadm = $reqadm . $and . "(commentairepro LIKE '%$commentairepro2req%')";
$and = " AND ";
}
if ($commentairepubreq)
{
$reqadm = $reqadm . $and . "(commentairepub LIKE '%$commentairepub2req%')";
$and = " AND ";
}
if ($keywordsreq)
{
$reqadm = $reqadm . $and . "(keywords LIKE '%$keywords2req%')";
$and = " AND ";
}
if ($sujetreq)
{
$reqadm = $reqadm . $and . "(journals_sujets.sujetsid LIKE '$sujetreq')";
$and = " AND ";
}
if ($sujetsfmreq)
{
$reqadm = $reqadm . $and . "(sujetsfm LIKE '%$sujetsfm2req%')";
$and = " AND ";
}
if ($fmidreq)
{
$reqadm = $reqadm . $and . "(fmid = $fmidreq)";
$and = " AND ";
}
if ($signaturecreationreq)
{
$reqadm = $reqadm . $and . "(signaturecreation LIKE '$signaturecreationreq')";
$and = " AND ";
}
if ($signaturemodifreq)
{
$reqadm = $reqadm . $and . "(signaturemodif LIKE '$signaturemodifreq')";
$and = " AND ";
}
if ($datecreation1req)
{
if ($datecreationcrit1req == "equal")
$reqadm = $reqadm . $and . "(datecreation LIKE '$datecreation1req%')";
if ($datecreationcrit1req == "before")
$reqadm = $reqadm . $and . "(datecreation < '$datecreation1req')";
if ($datecreationcrit1req == "after")
$reqadm = $reqadm . $and . "(datecreation > '$datecreation1req')";
$and = " AND ";
}
if ($datecreation2req)
{
if ($datecreationcrit2req == "equal")
$reqadm = $reqadm . $and . "(datecreation LIKE '$datecreation2req%')";
if ($datecreationcrit2req == "before")
$reqadm = $reqadm . $and . "(datecreation < '$datecreation2req')";
if ($datecreationcrit2req == "after")
$reqadm = $reqadm . $and . "(datecreation > '$datecreation2req')";
$and = " AND ";
}
if ($datemodif1req)
{
if ($datemodifcrit1req == "equal")
$reqadm = $reqadm . $and . "(datemodif LIKE '$datemodif1req%')";
if ($datemodifcrit1req == "before")
$reqadm = $reqadm . $and . "(datemodif < '$datemodif1req')";
if ($datemodifcrit1req == "after")
$reqadm = $reqadm . $and . "(datemodif > '$datemodif1req')";
$and = " AND ";
}
if ($datemodif2req)
{
if ($datemodifcrit2req == "equal")
$reqadm = $reqadm . $and . "(datemodif LIKE '$datemodif2req%')";
if ($datemodifcrit2req == "before")
$reqadm = $reqadm . $and . "(datemodif < '$datemodif2req')";
if ($datemodifcrit2req == "after")
$reqadm = $reqadm . $and . "(datemodif > '$datemodif2req')";
$and = " AND ";
}
if ($historiquereq)
{
$reqadm = $reqadm . $and . "(historique LIKE '%$historique2req%')";
$and = " AND ";
}

// *************************************************
// *************************************************
// Recuperation des valeurs à modifier
// *************************************************
// *************************************************

$modifq = "";
$andq = "";
$modifqok = 0;


if ($titre)
{
$modifq = $modifq . $andq . "titre = " . $titre;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($soustitre)
{
$modifq = $modifq . $andq . "soustitre = " . $soustitre;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($titreabrege)
{
$modifq = $modifq . $andq . "titreabrege = " . $titreabrege;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($variantetitre)
{
$modifq = $modifq . $andq . "variantetitre = " . $variantetitre;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($faitsuitea)
{
$modifq = $modifq . $andq . "faitsuitea = " . $faitsuitea;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($devient)
{
$modifq = $modifq . $andq . "devient = " . $devient;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($editeur)
{
$modifq = $modifq . $andq . "editeur = " . $editeur;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($codeediteur)
{
$modifq = $modifq . $andq . "codeediteur = " . $codeediteur;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($publiinst != "")
{
$modifq = $modifq . $andq . "publiinst = " . $publiinst;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($openaccess != "")
{
$modifq = $modifq . $andq . "openaccess = " . $openaccess;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($issnl)
{
$modifq = $modifq . $andq . "issnl = " . $issnl;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($issn)
{
$modifq = $modifq . $andq . "issn = " . $issn;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($catalogid)
{
$modifq = $modifq . $andq . "catalogid = " . $catalogid;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($nlmid)
{
$modifq = $modifq . $andq . "nlmid = " . $nlmid;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($coden)
{
$modifq = $modifq . $andq . "coden = " . $coden;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($doi)
{
$modifq = $modifq . $andq . "doi = " . $doi;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($urn)
{
$modifq = $modifq . $andq . "urn = " . $urn;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($url)
{
$modifq = $modifq . $andq . "url = " . $url;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($rss)
{
$modifq = $modifq . $andq . "rss = " . $rss;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($user)
{
$modifq = $modifq . $andq . "user = " . $user;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($pwd)
{
$modifq = $modifq . $andq . "pwd = " . $pwd;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($licence)
{
$modifq = $modifq . $andq . "licence = " . $licence;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($statutabo != "")
{
$modifq = $modifq . $andq . "statutabo = " . $statutabo;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($titreexclu != "")
{
$modifq = $modifq . $andq . "titreexclu = " . $titreexclu;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($corecollection != "")
{
$modifq = $modifq . $andq . "corecollection = " . $corecollection;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($plateforme)
{
$modifq = $modifq . $andq . "plateforme = " . $plateforme;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($gestion)
{
$modifq = $modifq . $andq . "gestion = " . $gestion;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($historiqueabo)
{
$modifq = $modifq . $andq . "historiqueabo = " . $historiqueabo;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($support)
{
$modifq = $modifq . $andq . "support = " . $support;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($format)
{
$modifq = $modifq . $andq . "format = " . $format;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($acceselecinst1)
{
$modifq = $modifq . $andq . "acceselecinst1 = " . $acceselecinst1;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($acceselecinst2)
{
$modifq = $modifq . $andq . "acceselecinst2 = " . $acceselecinst2;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($acceseleclibre)
{
$modifq = $modifq . $andq . "acceseleclibre = " . $acceseleclibre;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($package)
{
$modifq = $modifq . $andq . "package = " . $package;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($idediteur)
{
$modifq = $modifq . $andq . "idediteur = " . $idediteur;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcoll)
{
$modifq = $modifq . $andq . "etatcoll = " . $etatcoll;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($embargo)
{
$modifq = $modifq . $andq . "embargo = " . $embargo;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcolldeba != "")
{
$modifq = $modifq . $andq . "etatcolldeba = " . $etatcolldeba;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcolldebv != "")
{
$modifq = $modifq . $andq . "etatcolldebv = " . $etatcolldebv;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcolldebf != "")
{
$modifq = $modifq . $andq . "etatcolldebf = " . $etatcolldebf;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcollfina != "")
{
$modifq = $modifq . $andq . "etatcollfina = " . $etatcollfina;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcollfinv != "")
{
$modifq = $modifq . $andq . "etatcollfinv = " . $etatcollfinv;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($etatcollfinf != "")
{
$modifq = $modifq . $andq . "etatcollfinf = " . $etatcollfinf;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($localisation)
{
$modifq = $modifq . $andq . "localisation = " . $localisation;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($cote)
{
$modifq = $modifq . $andq . "cote = " . $cote;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($commentairepro)
{
$modifq = $modifq . $andq . "commentairepro = " . $commentairepro;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($commentairepub)
{
$modifq = $modifq . $andq . "commentairepub = " . $commentairepub;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($keywords)
{
$modifq = $modifq . $andq . "keywords = " . $keywords;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($sujetsfm)
{
$modifq = $modifq . $andq . "sujetsfm = " . $sujetsfm;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($fmid)
{
$modifq = $modifq . $andq . "fmid = " . $fmid;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($signaturecreation)
{
$modifq = $modifq . $andq . "signaturecreation = " . $signaturecreation;
$andq = " ET ";
$modifqok = $modifqok + 1;
}

if ($signaturemodif)
{
$modifq = $modifq . $andq . "signaturemodif = " . $signaturemodif;
$andq = " ET ";
$modifqok = $modifqok + 1;
}


$and = "";
$modifreq = "";

if ($titre)
{
$modifreq = $modifreq . $and . "titre = '$titre'";
$modifs .= $and . "'titre [', titre , '] - '";
$and = ", ";

}
if ($soustitre)
{
$modifreq = $modifreq . $and . "soustitre = '$soustitre'";
$modifs .= $and . "'soustitre [', soustitre , '] - '";
$and = ", ";
}
if ($titreabrege)
{
$modifreq = $modifreq . $and . "titreabrege = '$titreabrege'";
$modifs .= $and . "'titreabrege [', titreabrege , '] - '";
$and = ", ";
}
if ($variantetitre)
{
$modifreq = $modifreq . $and . "variantetitre = '$variantetitre'";
$modifs .= $and . "'variantetitre [', variantetitre , '] - '";
$and = ", ";
}
if ($faitsuitea)
{
$modifreq = $modifreq . $and . "faitsuitea = '$faitsuitea'";
$modifs .= $and . "'faitsuitea [', faitsuitea , '] - '";
$and = ", ";
}
if ($devient)
{
$modifreq = $modifreq . $and . "devient = '$devient'";
$modifs .= $and . "'devient [', devient , '] - '";
$and = ", ";
}
if ($editeur)
{
$modifreq = $modifreq . $and . "editeur = '$editeur'";
$modifs .= $and . "'editeur [', editeur , '] - '";
$and = ", ";
}
if ($codeediteur)
{
$modifreq = $modifreq . $and . "codeediteur = '$codeediteur'";
$modifs .= $and . "'codeediteur [', codeediteur , '] - '";
$and = ", ";
}
if ($publiinst != "")
{
$modifreq = $modifreq . $and . "publiinst = $publiinst";
$modifs .= $and . "'publiinst [', publiinst , '] - '";
$and = ", ";
}
if ($openaccess != "")
{
$modifreq = $modifreq . $and . "openaccess = '$openaccess'";
$modifs .= $and . "'openaccess [', openaccess , '] - '";
$and = ", ";
}
if ($issnl)
{
$modifreq = $modifreq . $and . "issnl = '$issnl'";
$modifs .= $and . "'issnl [', issnl , '] - '";
$and = ", ";
}
if ($issn)
{
$modifreq = $modifreq . $and . "issn = '$issn'";
$modifs .= $and . "'issn [', issn , '] - '";
$and = ", ";
}
if ($catalogid)
{
$modifreq = $modifreq . $and . "catalogid = '$catalogid'";
$modifs .= $and . "'catalogid [', catalogid , '] - '";
$and = ", ";
}
if ($nlmid)
{
$modifreq = $modifreq . $and . "nlmid = '$nlmid'";
$modifs .= $and . "'nlmid [', nlmid , '] - '";
$and = ", ";
}
if ($coden)
{
$modifreq = $modifreq . $and . "coden = '$coden'";
$modifs .= $and . "'coden [', coden , '] - '";
$and = ", ";
}
if ($doi)
{
$modifreq = $modifreq . $and . "doi = '$doi'";
$modifs .= $and . "'doi [', doi , '] - '";
$and = ", ";
}
if ($urn)
{
$modifreq = $modifreq . $and . "urn = '$urn'";
$modifs .= $and . "'urn [', urn , '] - '";
$and = ", ";
}
if ($url)
{
$modifreq = $modifreq . $and . "url = '$url'";
$modifs .= $and . "'url [', url , '] - '";
$and = ", ";
}
if ($rss)
{
$modifreq = $modifreq . $and . "rss = '$rss'";
$modifs .= $and . "'rss [', rss , '] - '";
$and = ", ";
}
if ($user)
{
$modifreq = $modifreq . $and . "user = '$user'";
$modifs .= $and . "'user [', user , '] - '";
$and = ", ";
}
if ($pwd)
{
$modifreq = $modifreq . $and . "pwd = '$pwd'";
$modifs .= $and . "'pwd [', pwd , '] - '";
$and = ", ";
}
if ($licence)
{
$modifreq = $modifreq . $and . "licence = '$licence'";
$modifs .= $and . "'licence [', licence , '] - '";
$and = ", ";
}
if ($statutabo != "")
{
$modifreq = $modifreq . $and . "statutabo = $statutabo";
$modifs .= $and . "'statutabo [', statutabo , '] - '";
$and = ", ";
}
if ($titreexclu != "")
{
$modifreq = $modifreq . $and . "titreexclu = $titreexclu";
$modifs .= $and . "'titreexclu [', titreexclu , '] - '";
$and = ", ";
}
if ($corecollection != "")
{
$modifreq = $modifreq . $and . "corecollection = $corecollection";
$modifs .= $and . "'corecollection [', corecollection , '] - '";
$and = ", ";
}
if ($plateforme)
{
$modifreq = $modifreq . $and . "plateforme = '$plateforme'";
$modifs .= $and . "'plateforme [', plateforme , '] - '";
$and = ", ";
}
if ($gestion)
{
$modifreq = $modifreq . $and . "gestion = '$gestion'";
$modifs .= $and . "'gestion [', gestion , '] - '";
$and = ", ";
}
if ($historiqueabo)
{
$modifreq = $modifreq . $and . "historiqueabo = '$historiqueabo'";
$modifs .= $and . "'historiqueabo [', historiqueabo , '] - '";
$and = ", ";
}
if ($support)
{
$modifreq = $modifreq . $and . "support = '$support'";
$modifs .= $and . "'support [', support , '] - '";
$and = ", ";
}
if ($format)
{
$modifreq = $modifreq . $and . "format = '$format'";
$modifs .= $and . "'format [', format , '] - '";
$and = ", ";
}
if ($acceselecinst1)
{
$modifreq = $modifreq . $and . "acceselecinst1 = $acceselecinst1";
$modifs .= $and . "'acceselecinst1 [', acceselecinst1 , '] - '";
$and = ", ";
}
if ($acceselecinst2)
{
$modifreq = $modifreq . $and . "acceselecinst2 = $acceselecinst2";
$modifs .= $and . "'acceselecinst2 [', acceselecinst2 , '] - '";
$and = ", ";
}
if ($acceseleclibre)
{
$modifreq = $modifreq . $and . "acceseleclibre = $acceseleclibre";
$modifs .= $and . "'acceseleclibre [', acceseleclibre , '] - '";
$and = ", ";
}
if ($package)
{
$modifreq = $modifreq . $and . "package = '$package'";
$modifs .= $and . "'package [', package , '] - '";
$and = ", ";
}
if ($idediteur)
{
$modifreq = $modifreq . $and . "idediteur = '$idediteur'";
$modifs .= $and . "'tidediteur [', idediteur , '] - '";
$and = ", ";
}
if ($etatcoll)
{
$modifreq = $modifreq . $and . "etatcoll = '$etatcoll'";
$modifs .= $and . "'etatcoll [', etatcoll , '] - '";
$and = ", ";
}
if ($embargo)
{
$modifreq = $modifreq . $and . "embargo = $embargo";
$modifs .= $and . "'embargo [', embargo , '] - '";
$and = ", ";
}
if ($etatcolldeba != "")
{
$modifreq = $modifreq . $and . "etatcolldeba = $etatcolldeba";
$modifs .= $and . "'etatcolldeba [', etatcolldeba , '] - '";
$and = ", ";
}
if ($etatcolldebv != "")
{
$modifreq = $modifreq . $and . "etatcolldebv = $etatcolldebv";
$modifs .= $and . "'etatcolldebv [', etatcolldebv , '] - '";
$and = ", ";
}
if ($etatcolldebf != "")
{
$modifreq = $modifreq . $and . "etatcolldebf = $etatcolldebf";
$modifs .= $and . "'etatcolldebf [', etatcolldebf , '] - '";
$and = ", ";
}
if ($etatcollfina != "")
{
$modifreq = $modifreq . $and . "etatcollfina = $etatcollfina";
$modifs .= $and . "'etatcollfina [', etatcollfina , '] - '";
$and = ", ";
}
if ($etatcollfinv != "")
{
$modifreq = $modifreq . $and . "etatcollfinv = $etatcollfinv";
$modifs .= $and . "'etatcollfinv [', etatcollfinv , '] - '";
$and = ", ";
}
if ($etatcollfinf != "")
{
$modifreq = $modifreq . $and . "etatcollfinf = $etatcollfinf";
$modifs .= $and . "'etatcollfinf [', etatcollfinf , '] - '";
$and = ", ";
}
if ($localisation)
{
$modifreq = $modifreq . $and . "localisation = '$localisation'";
$modifs .= $and . "'localisation [', localisation , '] - '";
$and = ", ";
}
if ($cote)
{
$modifreq = $modifreq . $and . "cote = '$cote'";
$modifs .= $and . "'cote [', cote , '] - '";
$and = ", ";
}
if ($commentairepro)
{
$modifreq = $modifreq . $and . "commentairepro = '$commentairepro'";
$modifs .= $and . "'commentairepro [', commentairepro , '] - '";
$and = ", ";
}
if ($commentairepub)
{
$modifreq = $modifreq . $and . "commentairepub = '$commentairepub'";
$modifs .= $and . "'commentairepub [', commentairepub , '] - '";
$and = ", ";
}
if ($keywords)
{
$modifreq = $modifreq . $and . "keywords = '$keywords'";
$modifs .= $and . "'keywords [', keywords , '] - '";
$and = ", ";
}
if ($sujetsfm)
{
$modifreq = $modifreq . $and . "sujetsfm = '$sujetsfm'";
$modifs .= $and . "'sujetsfm [', sujetsfm , '] - '";
$and = ", ";
}
if ($fmid)
{
$modifreq = $modifreq . $and . "fmid = $fmid";
$modifs .= $and . "'fmid [', fmid , '] - '";
$and = ", ";
}

// 
// Début de l'édition
//

if (($modifreq!="")&&($reqadm!=""))
{
$modifreq = str_ireplace("NULL","",$modifreq);
$historique = "'Fiche modifiée par " . $monlog . " le " . $date . " : ', " . $modifs . ", ' | '";

$req = "UPDATE journals SET historique = CONCAT(IFNULL(historique,''), " . $historique . "), signaturemodif = '" . $monlog . "', datemodif = '" . $date . "' WHERE (" . $reqadm . ")";
$req2 = "UPDATE journals SET " . $modifreq . " WHERE (" . $reqadm . ")";


$pagetitle = "Revues de " . $configinstitution . " : modification de la liste '" . $searcheqa . "'";
require ("connexion.php");
require ("header.php");
require ("menurech.php");
$result = mysql_query($req) or die("Error : ".mysql_error());
$result2 = mysql_query($req2) or die("Error : ".mysql_error());
$nb = mysql_affected_rows();

if ($nb > 0)
{
echo "<center><br/><b><font color=\"#339966\">\n";
echo "La modification a été enregistrée avec succès</b></font></center>\n";
echo "<br /><br /><b>" . $nb . " fiches ont été modifiées avec les valeurs suivants :</b><br /><br />";
echo $modifreq . "\n";
echo "<br /><br /><b>Selon les critères de recherche :</b><br /><br />";
echo $searcheqa . "<br /><br /><br /><br />\n";
echo "req = " . $req . "<br /><br />\n";
echo "req2 = " . $req2 . "<br /><br />\n";
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La requête n'a modifié aucun enregistrement</b></font>\n";
echo "<br /><br /><b>Veuillez verifier votre recherche et relancer la modification</b></center><br /><br /><br /><br />\n";
}
echo "</div>\n";
echo "</div>\n";
require ("footer.php");

}
else
{
require ("header.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car il y a une erreur dans la requête</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche</b></center><br /><br /><br /><br />\n";
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
echo "La modification n'a pas été enregistrée car il y a une erreur dans la requête</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche</b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
// 
// Fin de l'édition
//
}
else
{
require ("header.php");
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
