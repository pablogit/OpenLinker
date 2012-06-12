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
// Table journals : résultat des recherches administrateur, avancée, simple ou par sujet
require ("config.php");
// 
// Fonctions communes
//
// Fonction pour coder en format Excel
// $titre = encoding_conv($titre,'Windows-1252');
//
function encoding_conv($var, $enc_out, $enc_in='utf-8')
{
$var = htmlentities($var, ENT_QUOTES, $enc_in);
return html_entity_decode($var, ENT_QUOTES, $enc_out);
}
//
// Function pour nettoyer les critères de recherche (mots vides, ponctuation...)
//
function clean_search($var)
{
$var = " " . $var . " ";
$var = str_ireplace(",","",$var);
$var = str_ireplace(". "," ",$var);
$var = str_ireplace(": "," ",$var);
$var = str_ireplace(":"," ",$var);
$var = str_ireplace("-"," ",$var);
$var = str_ireplace(";","",$var);
$var = str_ireplace(" (the) "," ",$var);
$var = str_ireplace(" the "," ",$var);
$var = str_ireplace(" [the] "," ",$var);
$var = str_ireplace(" of "," ",$var);
$var = str_ireplace(" de "," ",$var);
$var = str_ireplace(" du "," ",$var);
$var = str_ireplace(" le "," ",$var);
$var = str_ireplace(" les "," ",$var);
$var = str_ireplace(" des "," ",$var);
$var = str_ireplace(" l'"," ",$var);
$var = str_ireplace(" la "," ",$var);
$var = str_ireplace(" los "," ",$var);
$var = str_ireplace(" el "," ",$var);
$var = str_ireplace(" and "," ",$var);
$var = str_ireplace(" (and) "," ",$var);
$var = str_ireplace(" [and] "," ",$var);
$var = str_ireplace(" et "," ",$var);
$var = str_ireplace(" (et) "," ",$var);
$var = str_ireplace(" [et] "," ",$var);
$var = str_ireplace(" y "," ",$var);
$var = str_ireplace(" und "," ",$var);
$var = str_ireplace(" der "," ",$var);
$var = str_ireplace(" die "," ",$var);
$var = str_ireplace(" das "," ",$var);
$var = str_ireplace(" fur "," ",$var);
$var = str_ireplace(" für "," ",$var);
$var = str_ireplace(" & "," ",$var);
$var = str_ireplace(" (&) "," ",$var);
$var = str_ireplace(" [&] "," ",$var);
$var = str_ireplace(" &amp "," ",$var);
$var = trim($var);
return $var;
}


//
// Extraction de l'adresse IP du client
//
$ip = $_SERVER['REMOTE_ADDR'];
$sep = ".";
$ips1 = strtok( $ip, $sep );
$ips2 = strtok( $sep );
$ips3 = strtok( $sep );
$ips4 = strtok( $sep );
if (($ips1 == $configipainst1) && ($ips2 == $configipbinst1))
{
$locip = "INST1";
}
else
{
if (($ips1 == $configipainst2) && ($ips2 == $configipbinst2))
{
$locip = "INST2";
}
else
{
$locip = "WWW";
}
}
$moncollapse="0";
$collapsetemp="";
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$moncollapse=$_COOKIE['journalsid']['collapse'];
$monsuggest=$_COOKIE['journalsid']['suggest'];
}
$collapse=$_GET['collapse'];
$collapsetemp=$_GET['collapsetemp'];
if ($collapse=="")
{
if ($collapsetemp=="")
$collapse=$moncollapse;
else
$collapse=$collapsetemp;
}
require ("connexion.php");
if(!isset($_GET['page']))
{
$page = 1;
}
else
{ 
$page = $_GET['page'];
} 
// 
// Define the number of results per page 
// 
$max_results = 25; 
$from = (($page * $max_results) - $max_results);
$searchadvok = 0;
$searchadmok = 0;
$searcheq = "";
$searcheqs = "";
$searcheqa = "";
$andq = "";
$recherchetype=$_GET['search'];
$export=$_GET['export'];
$init=$_GET['init'];
$qall=$_GET['allfields'];
if ($qall)
{
$searcheq = $searcheq . $andq . "tous les champs = " . $qall;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
$searchadmok = $searchadmok + 1;
}
$qall = str_ireplace("'","\\'",$qall);
$q=$_GET['q'];
$searcheqs = $q;
$q = str_ireplace("'","\\'",$q);
$q1="";
$title=$_GET['title'];
if ($title)
{
$searcheq = $searcheq . $andq . "titre = " . $title;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
$searchadmok = $searchadmok + 1;
}
$title = str_ireplace("'","\\'",$title);
$title1="";
// 
// Split de la chaine de recherche q pour les combinaisons dans les differents ordres
// 
if ($q)
{
$q=trim($q);
$qstop = clean_search($q);
if (($qstop=="")||($qstop==" "))
{
$qstop = $q;
}
$qstop=str_ireplace("*","%",$qstop);
$q1=str_ireplace(" ","%",$qstop);
$startespaceq = stripos($qstop, " ");
if ($startespaceq !== false)
{
$ktq=split(" ",$qstop);
while(list($keyq,$valq)=each($ktq))
{
if($valq<>" " and strlen($valq) > 0)
{
$q2 .= "(titre LIKE '%$valq%' OR titreabrege LIKE '%$valq%' OR variantetitre LIKE '%$valq%' OR soustitre LIKE '%$valq%') AND ";
$q3 .= "(journalsid LIKE '%$valq%' OR titre LIKE '%$valq%' OR titreabrege LIKE '%$valq%' OR variantetitre LIKE '%$valq%' OR soustitre LIKE '%$valq%' OR issn LIKE '%$valq%' OR issnl LIKE '%$valq%' OR nlmid LIKE '%$valq%' OR catalogid LIKE '%$valq%' OR doi LIKE '%$valq%' OR coden LIKE '%$valq%' OR urn LIKE '%$valq%' OR faitsuitea LIKE '%$valq%' OR devient LIKE '%$valq%' OR editeur LIKE '%$valq%' OR etatcoll LIKE '%$valq%' OR url LIKE '%$valq%' OR rss LIKE '%$valq%' OR licence LIKE '%$valq%' OR plateforme LIKE '%$valq%' OR gestion LIKE '%$valq%' OR historiqueabo LIKE '%$valq%' OR cote LIKE '%$valq%' OR localisation LIKE '%$valq%' OR user LIKE '%$valq%' OR keywords LIKE '%$valq%' OR commentairepub LIKE '%$valq%' OR commentairepro LIKE '%$valq%') AND ";
}
}
$q2=substr($q2,0,(strlen($q2)-4));
$q3=substr($q3,0,(strlen($q3)-4));
}
else
{
$q2 = "(titre LIKE '%$q1%' OR titreabrege LIKE '%$q1%' OR variantetitre LIKE '%$q1%' OR soustitre LIKE '%$q1%' OR issn LIKE '%$q1%' OR issnl LIKE '%$q1%' OR journalsid LIKE '$q1' OR url LIKE '%$q1%')";
$q3 = "(journalsid LIKE '%$q1%' OR titre LIKE '%$q1%' OR titreabrege LIKE '%$q1%' OR variantetitre LIKE '%$q1%' OR soustitre LIKE '%$q1%' OR issn LIKE '%$q1%' OR issnl LIKE '%$q1%' OR nlmid LIKE '%$q1%' OR catalogid LIKE '%$q1%' OR doi LIKE '%$q1%' OR coden LIKE '%$q1%' OR urn LIKE '%$q1%' OR faitsuitea LIKE '%$q1%' OR devient LIKE '%$q1%' OR editeur LIKE '%$q1%' OR etatcoll LIKE '%$q1%' OR url LIKE '%$q1%' OR rss LIKE '%$q1%' OR licence LIKE '%$q1%' OR plateforme LIKE '%$q1%' OR gestion LIKE '%$q1%' OR historiqueabo LIKE '%$q1%' OR cote LIKE '%$q1%' OR localisation LIKE '%$q1%' OR user LIKE '%$q1%' OR keywords LIKE '%$q1%' OR commentairepub LIKE '%$q1%' OR commentairepro LIKE '%$q1%')";
}
}
// ******************************
// ******************************
// ******************************
// début de la recherche administrateur
// ******************************
// ******************************
// ******************************
if ($recherchetype=="admin")
{
$searcheqa = $searcheq;
$searcheq = "";

$journalsidcrit1=$_GET['journalsidcrit1'];
$journalsid1=$_GET['journalsid1'];
if ($journalsid1)
{
$searcheqa = $searcheqa . $andq . "journalsid";
if ($journalsidcrit1 == "equal")
$searcheqa = $searcheqa . " = " . $journalsid1;
if ($journalsidcrit1 == "before")
$searcheqa = $searcheqa . " < " . $journalsid1;
if ($journalsidcrit1 == "after")
$searcheqa = $searcheqa . " > " . $journalsid1;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$journalsidcrit2=$_GET['journalsidcrit2'];
$journalsid2=$_GET['journalsid2'];
if ($journalsid2)
{
$searcheqa = $searcheqa . $andq . "journalsid";
if ($journalsidcrit2 == "equal")
$searcheqa = $searcheqa . " = " . $journalsid2;
if ($journalsidcrit2 == "before")
$searcheqa = $searcheqa . " < " . $journalsid2;
if ($journalsidcrit2 == "after")
$searcheqa = $searcheqa . " > " . $journalsid2;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$titre=$_GET['titre'];
if ($titre)
{
$searcheqa = $searcheqa . $andq . "titre = " . $titre;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$titre=str_ireplace("*","%",$titre);
$titre2=str_ireplace(" ","%",$titre);

$soustitre=$_GET['soustitre'];
if ($soustitre)
{
$searcheqa = $searcheqa . $andq . "soustitre = " . $soustitre;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$soustitre=str_ireplace("*","%",$soustitre);
$soustitre2=str_ireplace(" ","%",$soustitre);

$titreabrege=$_GET['titreabrege'];
if ($titreabrege)
{
$searcheqa = $searcheqa . $andq . "titreabrege = " . $titreabrege;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$titreabrege=str_ireplace("*","%",$titreabrege);
$titreabrege2=str_ireplace(" ","%",$titreabrege);

$variantetitre=$_GET['variantetitre'];
if ($variantetitre)
{
$searcheqa = $searcheqa . $andq . "variantetitre = " . $variantetitre;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$variantetitre=str_ireplace("*","%",$variantetitre);
$variantetitre2=str_ireplace(" ","%",$variantetitre);

$faitsuitea=$_GET['faitsuitea'];
if ($faitsuitea)
{
$searcheqa = $searcheqa . $andq . "faitsuitea = " . $faitsuitea;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$faitsuitea=str_ireplace("*","%",$faitsuitea);
$faitsuitea2=str_ireplace(" ","%",$faitsuitea);

$devient=$_GET['devient'];
if ($devient)
{
$searcheqa = $searcheqa . $andq . "devient = " . $devient;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$devient=str_ireplace("*","%",$devient);
$devient2=str_ireplace(" ","%",$devient);

$editeur=$_GET['editeur'];
if ($editeur)
{
$searcheqa = $searcheqa . $andq . "editeur = " . $editeur;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$editeur=str_ireplace("*","%",$editeur);
$editeur2=str_ireplace(" ","%",$editeur);

$codeediteur=$_GET['codeediteur'];
if ($codeediteur)
{
$searcheqa = $searcheqa . $andq . "codeediteur = " . $codeediteur;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$codeediteur=str_ireplace("*","%",$codeediteur);

$publiinst=$_GET['publiinst'];
if ($publiinst != "")
{
$searcheqa = $searcheqa . $andq . "publiinst = " . $publiinst;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$openaccess=$_GET['openaccess'];
if ($openaccess != "")
{
$searcheqa = $searcheqa . $andq . "openaccess = " . $openaccess;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$issnl=$_GET['issnl'];
if ($issnl)
{
$searcheqa = $searcheqa . $andq . "issnl = " . $issnl;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$issnl=str_ireplace("*","%",$issnl);

$issn=$_GET['issn'];
if ($issn)
{
$searcheqa = $searcheqa . $andq . "issn = " . $issn;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$issn=str_ireplace("*","%",$issn);
$issn2=str_ireplace(" ","%",$issn);

$catalogid=$_GET['catalogid'];
if ($catalogid)
{
$searcheqa = $searcheqa . $andq . "catalogid = " . $catalogid;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$catalogid=str_ireplace("*","%",$catalogid);

$nlmid=$_GET['nlmid'];
if ($nlmid)
{
$searcheqa = $searcheqa . $andq . "nlmid = " . $nlmid;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$nlmid=str_ireplace("*","%",$nlmid);

$coden=$_GET['coden'];
if ($coden)
{
$searcheqa = $searcheqa . $andq . "coden = " . $coden;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$coden=str_ireplace("*","%",$coden);

$doi=$_GET['doi'];
if ($doi)
{
$searcheqa = $searcheqa . $andq . "doi = " . $doi;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$doi=str_ireplace("*","%",$doi);

$urn=$_GET['urn'];
if ($urn)
{
$searcheqa = $searcheqa . $andq . "urn = " . $urn;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$urn=str_ireplace("*","%",$urn);

$url=$_GET['url'];
if ($url)
{
$searcheqa = $searcheqa . $andq . "url = " . $url;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$url=str_ireplace("*","%",$url);

$rss=$_GET['rss'];
if ($rss)
{
$searcheqa = $searcheqa . $andq . "rss = " . $rss;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$rss=str_ireplace("*","%",$rss);

$user=$_GET['user'];
if ($user)
{
$searcheqa = $searcheqa . $andq . "user = " . $user;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$user=str_ireplace("*","%",$user);

$pwd=$_GET['pwd'];
if ($pwd)
{
$searcheqa = $searcheqa . $andq . "pwd = " . $pwd;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$pwd=str_ireplace("*","%",$pwd);

$licence=$_GET['licence'];
if ($licence)
{
$searcheqa = $searcheqa . $andq . "licence = " . $licence;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$licence=str_ireplace("*","%",$licence);

$statutabo=$_GET['statutabo'];
if ($statutabo != "")
{
$searcheqa = $searcheqa . $andq . "statutabo = " . $statutabo;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$statutabo=str_ireplace("*","%",$statutabo);

$titreexclu=$_GET['titreexclu'];
if ($titreexclu != "")
{
$searcheqa = $searcheqa . $andq . "titreexclu = " . $titreexclu;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$corecollection=$_GET['corecollection'];
if ($corecollection != "")
{
$searcheqa = $searcheqa . $andq . "corecollection = " . $corecollection;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$plateforme=$_GET['plateforme'];
if ($plateforme)
{
$searcheqa = $searcheqa . $andq . "plateforme = " . $plateforme;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$plateforme=str_ireplace("*","%",$plateforme);

$gestion=$_GET['gestion'];
if ($gestion)
{
$searcheqa = $searcheqa . $andq . "gestion = " . $gestion;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$gestion=str_ireplace("*","%",$gestion);

$historiqueabo=$_GET['historiqueabo'];
if ($historiqueabo)
{
$searcheqa = $searcheqa . $andq . "historiqueabo = " . $historiqueabo;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$historiqueabo=str_ireplace("*","%",$historiqueabo);

$support=$_GET['support'];
if ($support)
{
$searcheqa = $searcheqa . $andq . "support = " . $support;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$support=str_ireplace("*","%",$support);

$format=$_GET['format'];
if ($format)
{
$searcheqa = $searcheqa . $andq . "format = " . $format;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$format=str_ireplace("*","%",$format);

$acceselecinst1=$_GET['acceselecinst1'];
if ($acceselecinst1)
{
$searcheqa = $searcheqa . $andq . "acceselecinst1 = " . $acceselecinst1;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$acceselecinst2=$_GET['acceselecinst2'];
if ($acceselecinst2)
{
$searcheqa = $searcheqa . $andq . "acceselecinst2 = " . $acceselecinst2;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$acceseleclibre=$_GET['acceseleclibre'];
if ($acceseleclibre)
{
$searcheqa = $searcheqa . $andq . "acceseleclibre = " . $acceseleclibre;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$package=$_GET['package'];
if ($package)
{
$searcheqa = $searcheqa . $andq . "package = " . $package;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$package=str_ireplace("*","%",$package);

$idediteur=$_GET['idediteur'];
if ($idediteur)
{
$searcheqa = $searcheqa . $andq . "idediteur = " . $idediteur;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$idediteur=str_ireplace("*","%",$idediteur);

$etatcoll=$_GET['etatcoll'];
if ($etatcoll)
{
$searcheqa = $searcheqa . $andq . "etatcoll = " . $etatcoll;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$etatcoll=str_ireplace("*","%",$etatcoll);

$embargo=$_GET['embargo'];
$embargocrit=$_GET['embargocrit'];
if ($embargo)
{
$searcheqa = $searcheqa . $andq . "embargo";
if ($embargocrit == "equal")
$searcheqa = $searcheqa . " = " . $embargo;
if ($embargocrit == "before")
$searcheqa = $searcheqa . " < " . $embargo;
if ($embargocrit == "after")
$searcheqa = $searcheqa . " > " . $embargo;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$embargo=str_ireplace("*","%",$embargo);

$etatcolldeba=$_GET['etatcolldeba'];
if ($etatcolldeba != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldeba = " . $etatcolldeba;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$etatcolldebv=$_GET['etatcolldebv'];
if ($etatcolldebv != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldebv = " . $etatcolldebv;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$etatcolldebf=$_GET['etatcolldebf'];
if ($etatcolldebf != "")
{
$searcheqa = $searcheqa . $andq . "etatcolldebf = " . $etatcolldebf;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$etatcollfina=$_GET['etatcollfina'];
if ($etatcollfina != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfina = " . $etatcollfina;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$etatcollfinv=$_GET['etatcollfinv'];
if ($etatcollfinv != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfinv = " . $etatcollfinv;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$etatcollfinf=$_GET['etatcollfinf'];
if ($etatcollfinf != "")
{
$searcheqa = $searcheqa . $andq . "etatcollfinf = " . $etatcollfinf;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$localisation=$_GET['localisation'];
if ($localisation)
{
$searcheqa = $searcheqa . $andq . "localisation = " . $localisation;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$localisation=str_ireplace("*","%",$localisation);

$cote=$_GET['cote'];
if ($cote)
{
$searcheqa = $searcheqa . $andq . "cote = " . $cote;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$cote=str_ireplace("*","%",$cote);

$commentairepro=$_GET['commentairepro'];
if ($commentairepro)
{
$searcheqa = $searcheqa . $andq . "commentairepro = " . $commentairepro;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$commentairepro=str_ireplace("*","%",$commentairepro);
$commentairepro2=str_ireplace(" ","%",$commentairepro);

$commentairepub=$_GET['commentairepub'];
if ($commentairepub)
{
$searcheqa = $searcheqa . $andq . "commentairepub = " . $commentairepub;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$commentairepub=str_ireplace("*","%",$commentairepub);
$commentairepub2=str_ireplace(" ","%",$commentairepub);

$keywords=$_GET['keywords'];
if ($keywords)
{
$searcheqa = $searcheqa . $andq . "keywords = " . $keywords;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$keywords=str_ireplace("*","%",$keywords);
$keywords2=str_ireplace(" ","%",$keywords);

$sujet=$_GET['theme'];
if ($sujet)
{
$searcheqa = $searcheqa . $andq . "sujet = " . $sujet;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$sujet=str_ireplace("*","%",$sujet);

$sujetsfm=$_GET['sujetsfm'];
if ($sujetsfm)
{
$searcheqa = $searcheqa . $andq . "sujetsfm = " . $sujetsfm;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$sujetsfm=str_ireplace("*","%",$sujetsfm);
$sujetsfm2=str_ireplace(" ","%",$sujetsfm2);

$fmid=$_GET['fmid'];
if ($fmid)
{
$searcheqa = $searcheqa . $andq . "fmid = " . $fmid;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$signaturecreation=$_GET['signaturecreation'];
if ($signaturecreation)
{
$searcheqa = $searcheqa . $andq . "signaturecreation = " . $signaturecreation;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$signaturecreation=str_ireplace("*","%",$signaturecreation);

$signaturemodif=$_GET['signaturemodif'];
if ($signaturemodif)
{
$searcheqa = $searcheqa . $andq . "signaturemodif = " . $signaturemodif;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$signaturemodif=str_ireplace("*","%",$signaturemodif);

$datecreation1=$_GET['datecreation1'];
$datecreationcrit1=$_GET['datecreationcrit1'];
if ($datecreation1)
{
$searcheqa = $searcheqa . $andq . "datecreation";
if ($datecreationcrit1 == "equal")
$searcheqa = $searcheqa . " = " . $datecreation1;
if ($datecreationcrit1 == "before")
$searcheqa = $searcheqa . " < " . $datecreation1;
if ($datecreationcrit1 == "after")
$searcheqa = $searcheqa . " > " . $datecreation1;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$datecreation2=$_GET['datecreation2'];
$datecreationcrit2=$_GET['datecreationcrit2'];
if ($datecreation2)
{
$searcheqa = $searcheqa . $andq . "datecreation";
if ($datecreationcrit2 == "equal")
$searcheqa = $searcheqa . " = " . $datecreation2;
if ($datecreationcrit2 == "before")
$searcheqa = $searcheqa . " < " . $datecreation2;
if ($datecreationcrit2 == "after")
$searcheqa = $searcheqa . " > " . $datecreation2;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$datemodif1=$_GET['datemodif1'];
$datemodifcrit1=$_GET['datemodifcrit1'];
if ($datemodif1)
{
$searcheqa = $searcheqa . $andq . "datemodif";
if ($datemodifcrit1 == "equal")
$searcheqa = $searcheqa . " = " . $datemodif1;
if ($datemodifcrit1 == "before")
$searcheqa = $searcheqa . " < " . $datemodif1;
if ($datemodifcrit1 == "after")
$searcheqa = $searcheqa . " > " . $datemodif1;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$datemodif2=$_GET['datemodif2'];
$datemodifcrit2=$_GET['datemodifcrit2'];
if ($datemodif2)
{
$searcheqa = $searcheqa . $andq . "datemodif";
if ($datemodifcrit2 == "equal")
$searcheqa = $searcheqa . " = " . $datemodif2;
if ($datemodifcrit2 == "before")
$searcheqa = $searcheqa . " < " . $datemodif2;
if ($datemodifcrit2 == "after")
$searcheqa = $searcheqa . " > " . $datemodif2;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}

$historique=$_GET['historique'];
if ($historique)
{
$searcheqa = $searcheqa . $andq . "historique = " . $historique;
$andq = " ET ";
$searchadmok = $searchadmok + 1;
}
$historique=str_ireplace("*","%",$historique);
$historique2=str_ireplace(" ","%",$historique);

$and = "";
$reqadm = "";


if ($qall)
{
$qall=trim($qall);
$qallstop = clean_search($qall);
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
if ($title)
{
if (($field != "tbegin")&&($field != "texact"))
{
$reqadm = $reqadm . $and . "($title2)";
$and = " AND ";
}
else
{
$mapostitle = strpos($title, "the ");
if (($mapostitle = 0) && (strlen($title)>7))
$titlesanst = substr($title,4,(strlen($title)));
else
$titlesanst = $title;
$titleavect = "the " . $title;
$titleavectf = $title . ", the";
$titleavectf2 = $title . " (the)";
$titleavectf3 = $titlesanst . " (the)";
$titleavectf4 = $titlesanst . ", the";
$titleandv1 = str_ireplace(" & "," and ",$title);
$titleandv2 = str_ireplace(" and "," & ",$title);
$titleavecs = $title . " :";
$titleavecm = $title . " /";
$titleavectp = $title . " =";
if ($field == "tbegin")
{
$reqadm = $reqadm . $and . "(titre LIKE '$title%' OR titre LIKE '$titlesanst%' OR titre LIKE '$titleavect%' OR titre LIKE '$titleandv1%' OR titre LIKE '$titleandv2%')";
$and = " AND ";
}
if ($field == "texact")
{
$reqadm = $reqadm . $and . "(titre LIKE '$title' OR titre LIKE '$titlesanst' OR titre LIKE '$titleavect' OR titre LIKE '$titleavectf' OR titre LIKE '$titleavectf2' OR titre LIKE '$titleavectf3' OR titre LIKE '$titleavectf4' OR titre LIKE '$titleavecs%'  OR titre LIKE '$titleavecm%' OR titre LIKE '$titleavectp%' OR titre LIKE '$titleandv1' OR titre LIKE '$titleandv2')";
$and = " AND ";
}
}
}

if ($journalsid1)
{
if ($journalsidcrit1 == "equal")
$reqadm = $reqadm . $and . "(journalsid = $journalsid1)";
if ($journalsidcrit1 == "before")
$reqadm = $reqadm . $and . "(journalsid < $journalsid1)";
if ($journalsidcrit1 == "after")
$reqadm = $reqadm . $and . "(journalsid > $journalsid1)";
$and = " AND ";
}
if ($journalsid2)
{
if ($journalsidcrit2 == "equal")
$reqadm = $reqadm . $and . "(journalsid = $journalsid2)";
if ($journalsidcrit2 == "before")
$reqadm = $reqadm . $and . "(journalsid < $journalsid2)";
if ($journalsidcrit2 == "after")
$reqadm = $reqadm . $and . "(journalsid > $journalsid2)";
$and = " AND ";
}


if ($titre)
{
$reqadm = $reqadm . $and . "(titre LIKE '%$titre2%')";
$and = " AND ";
}
if ($soustitre)
{
$reqadm = $reqadm . $and . "(soustitre LIKE '%$soustitre2%')";
$and = " AND ";
}
if ($titreabrege)
{
$reqadm = $reqadm . $and . "(titreabrege LIKE '%$titreabrege2%')";
$and = " AND ";
}
if ($variantetitre)
{
$reqadm = $reqadm . $and . "(variantetitre LIKE '%$variantetitre2%')";
$and = " AND ";
}
if ($faitsuitea)
{
$reqadm = $reqadm . $and . "(faitsuitea LIKE '%$faitsuitea2%')";
$and = " AND ";
}
if ($devient)
{
$reqadm = $reqadm . $and . "(devient LIKE '%$devient2%')";
$and = " AND ";
}
if ($editeur)
{
$reqadm = $reqadm . $and . "(editeur LIKE '%$editeur2%')";
$and = " AND ";
}
if ($codeediteur)
{
$reqadm = $reqadm . $and . "(codeediteur LIKE '$codeediteur')";
$and = " AND ";
}
if ($publiinst != "")
{
$reqadm = $reqadm . $and . "(publiinst = $publiinst)";
$and = " AND ";
}
if ($openaccess != "")
{
$reqadm = $reqadm . $and . "(openaccess LIKE '$openaccess')";
$and = " AND ";
}
if ($issnl)
{
$reqadm = $reqadm . $and . "(issnl LIKE '$issnl')";
$and = " AND ";
}
if ($issn)
{
$reqadm = $reqadm . $and . "(issn LIKE '%$issn%')";
$and = " AND ";
}
if ($catalogid)
{
$reqadm = $reqadm . $and . "(catalogid LIKE '$catalogid')";
$and = " AND ";
}
if ($nlmid)
{
$reqadm = $reqadm . $and . "(nlmid LIKE '$nlmid')";
$and = " AND ";
}
if ($coden)
{
$reqadm = $reqadm . $and . "(coden LIKE '$coden')";
$and = " AND ";
}
if ($doi)
{
$reqadm = $reqadm . $and . "(doi LIKE '$doi')";
$and = " AND ";
}
if ($urn)
{
$reqadm = $reqadm . $and . "(urn LIKE '$urn')";
$and = " AND ";
}
if ($url)
{
$reqadm = $reqadm . $and . "(url LIKE '%$url%')";
$and = " AND ";
}
if ($rss)
{
$reqadm = $reqadm . $and . "(rss LIKE '%$rss%')";
$and = " AND ";
}
if ($user)
{
$reqadm = $reqadm . $and . "(user LIKE '$user')";
$and = " AND ";
}
if ($pwd)
{
$reqadm = $reqadm . $and . "(pwd LIKE '$pwd')";
$and = " AND ";
}
if ($licence)
{
$reqadm = $reqadm . $and . "(licence LIKE '$licence')";
$and = " AND ";
}
if ($statutabo != "")
{
$reqadm = $reqadm . $and . "(statutabo = $statutabo)";
$and = " AND ";
}
if ($titreexclu != "")
{
$reqadm = $reqadm . $and . "(titreexclu = $titreexclu)";
$and = " AND ";
}
if ($corecollection != "")
{
$reqadm = $reqadm . $and . "(corecollection = $corecollection)";
$and = " AND ";
}
if ($plateforme)
{
$reqadm = $reqadm . $and . "(plateforme LIKE '$plateforme')";
$and = " AND ";
}
if ($gestion)
{
$reqadm = $reqadm . $and . "(gestion LIKE '$gestion')";
$and = " AND ";
}
if ($historiqueabo)
{
$reqadm = $reqadm . $and . "(historiqueabo LIKE '$historiqueabo')";
$and = " AND ";
}
if ($support)
{
$reqadm = $reqadm . $and . "(support LIKE '$support')";
$and = " AND ";
}
if ($format)
{
$reqadm = $reqadm . $and . "(format LIKE '$format')";
$and = " AND ";
}
if ($acceselecinst1)
{
$reqadm = $reqadm . $and . "(acceselecinst1 = $acceselecinst1)";
$and = " AND ";
}
if ($acceselecinst2)
{
$reqadm = $reqadm . $and . "(acceselecinst2 = $acceselecinst2)";
$and = " AND ";
}
if ($acceseleclibre)
{
$reqadm = $reqadm . $and . "(acceseleclibre = $acceseleclibre)";
$and = " AND ";
}
if ($package)
{
$reqadm = $reqadm . $and . "(package LIKE '$package')";
$and = " AND ";
}
if ($idediteur)
{
$reqadm = $reqadm . $and . "(idediteur LIKE '$idediteur')";
$and = " AND ";
}
if ($etatcoll)
{
$reqadm = $reqadm . $and . "(etatcoll LIKE '%$etatcoll%')";
$and = " AND ";
}
if ($embargo)
{
if ($embargocrit == "equal")
$reqadm = $reqadm . $and . "(embargo = $embargo)";
if ($embargocrit == "before")
$reqadm = $reqadm . $and . "(embargo < $embargo)";
if ($embargocrit == "after")
$reqadm = $reqadm . $and . "(embargo > $embargo)";
$and = " AND ";
}
if ($etatcolldeba != "")
{
$reqadm = $reqadm . $and . "(etatcolldeba = $etatcolldeba)";
$and = " AND ";
}
if ($etatcolldebv != "")
{
$reqadm = $reqadm . $and . "(etatcolldebv = $etatcolldebv)";
$and = " AND ";
}
if ($etatcolldebf != "")
{
$reqadm = $reqadm . $and . "(etatcolldebf = $etatcolldebf)";
$and = " AND ";
}
if ($etatcollfina != "")
{
$reqadm = $reqadm . $and . "(etatcollfina = $etatcollfina)";
$and = " AND ";
}
if ($etatcollfinv != "")
{
$reqadm = $reqadm . $and . "(etatcollfinv = $etatcollfinv)";
$and = " AND ";
}
if ($etatcollfinf != "")
{
$reqadm = $reqadm . $and . "(etatcollfinf = $etatcollfinf)";
$and = " AND ";
}
if ($localisation)
{
$reqadm = $reqadm . $and . "(localisation LIKE '$localisation')";
$and = " AND ";
}
if ($cote)
{
$reqadm = $reqadm . $and . "(cote LIKE '%$cote%')";
$and = " AND ";
}
if ($commentairepro)
{
$reqadm = $reqadm . $and . "(commentairepro LIKE '%$commentairepro2%')";
$and = " AND ";
}
if ($commentairepub)
{
$reqadm = $reqadm . $and . "(commentairepub LIKE '%$commentairepub2%')";
$and = " AND ";
}
if ($keywords)
{
$reqadm = $reqadm . $and . "(keywords LIKE '%$keywords2%')";
$and = " AND ";
}
if ($sujet)
{
$reqadm = $reqadm . $and . "(journals_sujets.sujetsid LIKE '$sujet')";
$and = " AND ";
}
if ($sujetsfm)
{
$reqadm = $reqadm . $and . "(sujetsfm LIKE '%$sujetsfm2%')";
$and = " AND ";
}
if ($fmid)
{
$reqadm = $reqadm . $and . "(fmid = $fmid)";
$and = " AND ";
}
if ($signaturecreation)
{
$reqadm = $reqadm . $and . "(signaturecreation LIKE '$signaturecreation')";
$and = " AND ";
}
if ($signaturemodif)
{
$reqadm = $reqadm . $and . "(signaturemodif LIKE '$signaturemodif')";
$and = " AND ";
}
if ($datecreation1)
{
if ($datecreationcrit1 == "equal")
$reqadm = $reqadm . $and . "(datecreation LIKE '$datecreation1%')";
if ($datecreationcrit1 == "before")
$reqadm = $reqadm . $and . "(datecreation < '$datecreation1')";
if ($datecreationcrit1 == "after")
$reqadm = $reqadm . $and . "(datecreation > '$datecreation1')";
$and = " AND ";
}
if ($datecreation2)
{
if ($datecreationcrit2 == "equal")
$reqadm = $reqadm . $and . "(datecreation LIKE '$datecreation2%')";
if ($datecreationcrit2 == "before")
$reqadm = $reqadm . $and . "(datecreation < '$datecreation2')";
if ($datecreationcrit2 == "after")
$reqadm = $reqadm . $and . "(datecreation > '$datecreation2')";
$and = " AND ";
}
if ($datemodif1)
{
if ($datemodifcrit1 == "equal")
$reqadm = $reqadm . $and . "(datemodif LIKE '$datemodif1%')";
if ($datemodifcrit1 == "before")
$reqadm = $reqadm . $and . "(datemodif < '$datemodif1')";
if ($datemodifcrit1 == "after")
$reqadm = $reqadm . $and . "(datemodif > '$datemodif1')";
$and = " AND ";
}
if ($datemodif2)
{
if ($datemodifcrit2 == "equal")
$reqadm = $reqadm . $and . "(datemodif LIKE '$datemodif2%')";
if ($datemodifcrit2 == "before")
$reqadm = $reqadm . $and . "(datemodif < '$datemodif2')";
if ($datemodifcrit2 == "after")
$reqadm = $reqadm . $and . "(datemodif > '$datemodif2')";
$and = " AND ";
}
if ($historique)
{
$reqadm = $reqadm . $and . "(historique LIKE '%$historique2%')";
$and = " AND ";
}
if ($reqadm!="")
{
if($export == "yes")
{
$max_results = 10000;
$from = 0;
}
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadm . ") GROUP BY journals.journalsid ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid, support, licence, openaccess, acceseleclibre, statutabo FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadm . ") GROUP BY journals.journalsid";
if ($collapse == "1")
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadm . ") GROUP BY journals.journalsid, journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid, support, licence, openaccess, acceseleclibre, statutabo FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadm . ") GROUP BY journals.journalsid, journals.titre, journals.support";
}
$pagetitle = "Revues de " . $configinstitution . " : résultats de la recherche administrateur '" . $searcheqa . "'";
if($export == "yes")
{
require ("headerexport.php");
}
else
{
require ("header.php");
require ("menurech.php");
}
$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
$total_pages = ceil($total_results / $max_results);
}
else
{
$pagetitle = "Revues de " . $configinstitution . " : résultats de la recherche administrateur";
require ("header.php");
require ("menurech.php");
$total_results = 0;
}
}
// ******************************
// ******************************
// ******************************
// fin de la recherche administrateur
// début de la recherche avancée
// ******************************
// ******************************
// ******************************

if ($recherchetype=="advanced")
{
// 
// Split de la chaine de recherche title pour les combinaisons dans les differents ordres
// 
if ($title)
{
$title=trim($title);
$tstop = clean_search($title);
if (($tstop=="")||($tstop==" "))
{
$tstop = $title;
}
$tstop=str_ireplace("*","%",$tstop);
$title1=str_ireplace(" ","%",$tstop);
$startespace = stripos($tstop, " ");
if ($startespace !== false)
{
$kt=split(" ",$tstop);
while(list($key,$val)=each($kt))
{
if($val<>" " and strlen($val) > 0)
{
$title2 .= "(titre LIKE '%$val%' OR titreabrege LIKE '%$val%' OR variantetitre LIKE '%$val%' OR soustitre LIKE '%$val%') AND ";
}
}
$title2=substr($title2,0,(strlen($title2)-4));
}
else
$title2="(titre LIKE '%$title1%' OR titreabrege LIKE '%$title1%' OR variantetitre LIKE '%$title1%' OR soustitre LIKE '%$$title1%' OR issn LIKE '%$$title1%' OR issnl LIKE '%$$title1%')";;
}
$field=$_GET['field'];
$publisher=$_GET['publisher'];
if ($publisher)
{
$searcheq = $searcheq . $andq . "editeur = " . $publisher;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$publisher=str_ireplace("*","%",$publisher);
$publisher2=str_ireplace(" ","%",$publisher);
$issn=$_GET['issn'];
if ($issn)
{
$searcheq = $searcheq . $andq . "ISSN = " . $issn;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$format=$_GET['format'];
if ($format=="e")
{
$searcheq = $searcheq . $andq . "format = électronique";
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
if ($format=="p")
{
$searcheq = $searcheq . $andq . "format = papier";
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
if ($format == "")
$format = "all";
$platform=$_GET['platform'];
if ($platform)
{
$searcheq = $searcheq . $andq . "plateforme = " . $platform;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$platform=str_ireplace("*","%",$platform);
$platform2=str_ireplace(" ","%",$platform);
$licence=$_GET['licence'];
if ($licence)
{
$searcheq = $searcheq . $andq . "licence = " . $licence;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$licence=str_ireplace("*","%",$licence);
$licence2=str_ireplace(" ","%",$licence);
$accessinst=$_GET['accessinst'];
$accessinst2=$_GET['accessinst2'];
$accesslibre=$_GET['accesslibre'];
if (($accessinst=="1") && ($accesslibre!="1"))
{
$searcheq = $searcheq . $andq . "accès libre = non";
$andq = " ET ";
}
if (($accessinst!="1") && ($accesslibre=="1"))
{
$searcheq = $searcheq . $andq . "accès institutionnel = non";
$andq = " ET ";
}
$oa=$_GET['oa'];
$statut=$_GET['statut'];
if ($statut)
{
$searcheq = $searcheq . $andq . "abonnement = " . $statut;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$localisation=$_GET['localisation'];
if ($localisation)
{
$searcheq = $searcheq . $andq . "localisation = " . $localisation;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$localisation=str_ireplace("*","%",$localisation);
$localisation2=str_ireplace(" ","%",$localisation);
$cote=$_GET['cote'];
if ($cote)
{
$searcheq = $searcheq . $andq . "cote = " . $cote;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$cote=str_ireplace("*","%",$cote);
$cote2=str_ireplace(" ","%",$cote);
$sujet=$_GET['sujet'];
if ($sujet)
{
$searcheq = $searcheq . $andq . "thème = " . $sujet;
$andq = " ET ";
$searchadvok = $searchadvok + 1;
}
$and = "";
$reqadv = "";


if ($qall)
{
$qall=trim($qall);
$qallstop = clean_search($qall);
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

$reqadv = "($qall2)";
$and = " AND ";
}
if ($title)
{
if (($field != "tbegin")&&($field != "texact"))
{
$reqadv = $reqadv . $and . "($title2)";
$and = " AND ";
}
else
{
$mapostitle = strpos($title, "the ");
if (($mapostitle = 0) && (strlen($title)>7))
$titlesanst = substr($title,4,(strlen($title)));
else
$titlesanst = $title;
$titleavect = "the " . $title;
$titleavectf = $title . ", the";
$titleavectf2 = $title . " (the)";
$titleavectf3 = $titlesanst . " (the)";
$titleavectf4 = $titlesanst . ", the";
$titleandv1 = str_ireplace(" & "," and ",$title);
$titleandv2 = str_ireplace(" and "," & ",$title);
$titleavecs = $title . " :";
$titleavecm = $title . " /";
$titleavectp = $title . " =";
if ($field == "tbegin")
{
$reqadv = $reqadv . $and . "(titre LIKE '$title%' OR titre LIKE '$titlesanst%' OR titre LIKE '$titleavect%' OR titre LIKE '$titleandv1%' OR titre LIKE '$titleandv2%')";
$and = " AND ";
}
if ($field == "texact")
{
$reqadv = $reqadv . $and . "(titre LIKE '$title' OR titre LIKE '$titlesanst' OR titre LIKE '$titleavect' OR titre LIKE '$titleavectf' OR titre LIKE '$titleavectf2' OR titre LIKE '$titleavectf3' OR titre LIKE '$titleavectf4' OR titre LIKE '$titleavecs%'  OR titre LIKE '$titleavecm%' OR titre LIKE '$titleavectp%' OR titre LIKE '$titleandv1' OR titre LIKE '$titleandv2')";
$and = " AND ";
}
}
}


if ($publisher)
{
$reqadv = $reqadv . $and . "(editeur LIKE '%$publisher2%')";
$and = " AND ";
}

if ($issn)
{
$reqadv = $reqadv . $and . "(issn LIKE '%$issn%')";
$and = " AND ";
}

if ($format == "p")
{
$reqadv = $reqadv . $and . "(support LIKE 'papier')";
$and = " AND ";
}
if ($format == "e")
{
$reqadv = $reqadv . $and . "(support LIKE 'electronique')";
$and = " AND ";
}

if ($platform)
{
$reqadv = $reqadv . $and . "(plateforme LIKE '%$platform2%')";
$and = " AND ";
}

if ($licence)
{
$reqadv = $reqadv . $and . "(licence LIKE '$licence')";
$and = " AND ";
}

if (($accesslibre != "1")&&($accessinst == "1"))
{
$reqadv = $reqadv . $and . "(acceselecinst1 LIKE '1' OR acceselecinst2 LIKE '1')";
$and = " AND ";
}
if (($accesslibre == "1")&&($accessinst != "1"))
{
$reqadv = $reqadv . $and . "(acceseleclibre LIKE '1' OR openaccess LIKE '1')";
$and = " AND ";
}

// if ($oa == "1")
// {
// $reqadv = $reqadv . $and . "(openaccess LIKE '1')";
// $and = " AND ";
// }

if ($statut)
{
$reqadv = $reqadv . $and . "(statutabo LIKE '$statut')";
$and = " AND ";
}

if ($localisation)
{
$reqadv = $reqadv . $and . "(localisation LIKE '%$localisation2%')";
$and = " AND ";
}

if ($cote)
{
$reqadv = $reqadv . $and . "(cote LIKE '%$cote2%')";
$and = " AND ";
}

if ($sujet)
{
$reqadv = $reqadv . $and . "(journals_sujets.sujetsid LIKE '$sujet')";
$and = " AND ";
}

if ($reqadv!="")
{
if ($monaut != "admin")
$reqadv = $reqadv . " AND titreexclu = 0";
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadv . ") GROUP BY journals.journalsid ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadv . ") GROUP BY journals.journalsid";
if ($collapse == "1")
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadv . ") GROUP BY journals.journalsid, journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (" . $reqadv . ") GROUP BY journals.journalsid, journals.titre, journals.support";
}
$pagetitle = "Revues de " . $configinstitution . " : résultats de la recherche avancée '" . $searcheq . "'";
require ("header.php");
require ("menurech.php");
$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
$total_pages = ceil($total_results / $max_results);
}
else
{
$pagetitle = "Revues de " . $configinstitution . " : résultats de la recherche avancée";
require ("header.php");
require ("menurech.php");
$total_results = 0;
}
}
// ******************************
// ******************************
// ******************************
// fin de la recherche avancée
// début de la recherche sujets
// ******************************
// ******************************
// ******************************
if ($recherchetype=="subject")
{
$sujet=$_GET['subject'];
$sujetname=$_GET['sname'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') GROUP BY journals.journalsid ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') GROUP BY journals.journalsid";
if ($collapse == "1")
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') GROUP BY journals.journalsid, journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') GROUP BY journals.journalsid, journals.titre, journals.support";
}
}
else
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') AND titreexclu = 0 GROUP BY journals.journalsid ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') AND titreexclu = 0 GROUP BY journals.journalsid";
if ($collapse == "1")
{
$req = "SELECT * FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') AND titreexclu = 0 GROUP BY journals.journalsid, journals.titre, journals.support  ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals LEFT JOIN journals_sujets USING (journalsid) WHERE (journals_sujets.sujetsid LIKE '$sujet') AND titreexclu = 0 GROUP BY journals.journalsid, journals.titre, journals.support";
}
}
$pagetitle = "Revues de " . $configinstitution . " : périodiques sur le thème '" . $sujetname . "'";
require ("header.php");
require ("menurech.php");
echo "<br/>\n";
echo "<h2>Thème \"" . $sujetname . "\"</h2>\n";
$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
$total_pages = ceil($total_results / $max_results);
}
// ******************************
// ******************************
// ******************************
// fin de la recherche sujet
// début de la recherche simple
// ******************************
// ******************************
// ******************************
if (($recherchetype=="simple")||($init))
{
$query=$q;
$format=$_GET['format'];
if ($format == "")
$format = "all";
$field=$_GET['field'];

if ($init)
{
$searcheqs = "initiale = " . $init;
if ($init == "9")
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$req = "SELECT * FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%')";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') GROUP BY journals.titre, journals.support";
}
}
else
{
$req = "SELECT * FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') AND titreexclu = 0 ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') AND titreexclu = 0";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') AND titreexclu = 0 GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (titre LIKE '0%' OR titre LIKE '1%' OR titre LIKE '2%' OR titre LIKE '3%' OR titre LIKE '4%' OR titre LIKE '5%' OR titre LIKE '6%' OR titre LIKE '7%' OR titre LIKE '8%' OR titre LIKE '9%' OR titre LIKE '?%' OR titre LIKE '(%') AND titreexclu = 0 GROUP BY journals.titre, journals.support";
}
}
}
else
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$req = "SELECT * FROM journals WHERE titre LIKE '$init%' ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE titre LIKE '$init%'";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE titre LIKE '$init%' GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE titre LIKE '$init%' GROUP BY journals.titre, journals.support";
}
}
else
{
$req = "SELECT * FROM journals WHERE titre LIKE '$init%' AND titreexclu = 0 ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE titre LIKE '$init%' AND titreexclu = 0";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE titre LIKE '$init%' AND titreexclu = 0 GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE titre LIKE '$init%' AND titreexclu = 0 GROUP BY journals.titre, journals.support";
}
}
}
}
if ($q)
{
// $req1 = "(titre LIKE '%$q1%' OR titreabrege LIKE '%$q1%' OR variantetitre LIKE '%$q1%' OR soustitre LIKE '%$q1%' OR issn LIKE '%$q1%' OR issnl LIKE '%$q1%')";
$req1 = "$q2";
$q = trim($q);
$mapostheq = strpos($q, "the ");
if (($mapostheq = 0) && (strlen($q)>7))
$qsanst = substr($q,4,(strlen($q)));
else
$qsanst = $q;
// $qsanst = substr($q,4,(strlen($q)));
$qavect = "the " . $q;
$qavectf = $q . ", the";
$qavectf2 = $q . " (the)";
$qavectf3 = $qsanst . " (the)";
$qavectf4 = $qsanst . ", the";
$qandv1 = str_ireplace(" & "," and ",$q);
$qandv2 = str_ireplace(" and "," & ",$q);
$qavecs = $q . " :";
$qavecm = $q . " /";
$qavectp = $q . " =";

if ($field == "title")
{
$searcheqs = "mots du titre = " . $searcheqs;
$andq = " ET ";
}
if ($field == "tbegin")
{
$req1 = "(titre LIKE '$q%' OR titre LIKE '$qsanst%' OR titre LIKE '$qavect%' OR titre LIKE '$qandv1%' OR titre LIKE '$qandv2%')";
$searcheqs = "début du titre = " . $searcheqs;
$andq = " ET ";
}
if ($field == "texact")
{
$req1 = "(titre LIKE '$q' OR titre LIKE '$qsanst' OR titre LIKE '$qavect' OR titre LIKE '$qavectf' OR titre LIKE '$qavectf2' OR titre LIKE '$qavectf3' OR titre LIKE '$qavectf4' OR titre LIKE '$qavecs%'  OR titre LIKE '$qavecm%' OR titre LIKE '$qavectp%' OR titre LIKE '$qandv1' OR titre LIKE '$qandv2')";
$searcheqs = "titre exact = " . $searcheqs;
$andq = " ET ";
}
if ($field == "all")
{
$req1 = "$q3";
$searcheqs = "tous les champs = " . $searcheqs;
$andq = " ET ";
}
if ($format == "p")
{
$req1 = $req1 . " AND support LIKE 'papier'";
$searcheqs = $searcheqs . $andq . "format = papier";
$andq = " ET ";
}
if ($format == "e")
{
$req1 = $req1 . " AND support LIKE 'electronique'";
$searcheqs = $searcheqs . $andq . "format = électronique";
$andq = " ET ";
}
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$req = "SELECT * FROM journals WHERE (" . $req1 . ") ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (" . $req1 . ")";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE (" . $req1 . ") GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (" . $req1 . ") GROUP BY journals.titre, journals.support";
}
}
else
{
$req = "SELECT * FROM journals WHERE (" . $req1 . ") AND titreexclu = 0 ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (" . $req1 . ") AND titreexclu = 0";
if ($collapse == "1")
{
$req = "SELECT * FROM journals WHERE (" . $req1 . ") AND titreexclu = 0 GROUP BY journals.titre, journals.support ORDER BY titre,support ASC LIMIT $from, $max_results";
$req2 = "SELECT journalsid FROM journals WHERE (" . $req1 . ") AND titreexclu = 0 GROUP BY journals.titre, journals.support";
}
}
}
$req1t=str_ireplace(" LIKE "," = ",$req1);
$pagetitle = "Revues de " . $configinstitution . " : résultats de la recherche rapide '" . $searcheqs . "'";
require ("header.php");
require ("menurech.php");
$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
$total_pages = ceil($total_results / $max_results);
}

// ******************************
// ******************************
// ******************************
// fin de la recherche simple
// construction de la liste de résultats
// ******************************
// ******************************
// ******************************


// **************************************
// **************************************
// liste de résultats en format tableau excel
// **************************************
// **************************************
if($export == "yes")
{
echo "\"journalsid\";";
echo "\"titre\";";
echo "\"soustitre\";";
echo "\"titreabrege\";";
echo "\"variantetitre\";";
echo "\"issn\";";
echo "\"issnl\";";
echo "\"nlmid\";";
echo "\"catalogid\";";
echo "\"doi\";";
echo "\"coden\";";
echo "\"urn\";";
echo "\"openaccess\";";
echo "\"publiinst\";";
echo "\"faitsuitea\";";
echo "\"devient\";";
echo "\"editeur\";";
echo "\"etatcoll\";";
echo "\"etatcolldeba\";";
echo "\"etatcolldebv\";";
echo "\"etatcolldebf\";";
echo "\"etatcollfina\";";
echo "\"etatcollfinv\";";
echo "\"etatcollfinf\";";
echo "\"embargo\";";
echo "\"url\";";
echo "\"rss\";";
echo "\"acceselecinst1\";";
echo "\"acceselecinst2\";";
echo "\"acceseleclibre\";";
echo "\"titreexclu\";";
echo "\"support\";";
echo "\"licence\";";
echo "\"plateforme\";";
echo "\"gestion\";";
echo "\"historiqueabo\";";
echo "\"statutabo\";";
echo "\"cote\";";
echo "\"localisation\";";
echo "\"user\";";
echo "\"pwd\";";
echo "\"keywords\";";
echo "\"sujetsfm\";";
echo "\"fmid\";";
echo "\"format\";";
// echo "\"time\";";
// echo "\"historique\";";
echo "\"package\";";
echo "\"corecollection\";";
echo "\"idediteur\";";
echo "\"codeediteur\";";
echo "\"commentairepro\";";
echo "\"commentairepub\";";
echo "\"signaturecreation\";";
echo "\"signaturemodif\";";
echo "\"datecreation\";";
echo "\"datemodif\";";
echo "\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$id = $enreg['journalsid'];
$titre = $enreg['titre'];
$titrecsv = encoding_conv($titre,'Windows-1252');
$titreabrege = $enreg['titreabrege'];
$variantetitre = $enreg['variantetitre'];
$variantetitrecsv = encoding_conv($variantetitre,'Windows-1252');
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
$commentaireprocsv = encoding_conv($commentairepro,'Windows-1252');
$commentairepub = $enreg['commentairepub'];
$commentairepubcsv = encoding_conv($commentairepub,'Windows-1252');
$signaturecreation = $enreg['signaturecreation'];
$signaturemodif = $enreg['signaturemodif'];
$datecreation = $enreg['datecreation'];
$datemodif = $enreg['datemodif'];
$sujetsfm = $enreg['sujetsfm'];
$fmid = $enreg['fmid'];
$soustitre = $enreg['soustitre'];
$soustitrecsv = encoding_conv($soustitre,'Windows-1252');
$format = $enreg['format'];
$time = $enreg['time'];
$historique = $enreg['historique'];
$package = $enreg['package'];
$corecollection = $enreg['corecollection'];
$idediteur = $enreg['idediteur'];
$codeediteur = $enreg['codeediteur'];
echo "\"" . $id . "\";";
echo "\"" . $titrecsv . "\";";
echo "\"" . $soustitrecsv . "\";";
echo "\"" . $titreabrege . "\";";
echo "\"" . $variantetitrecsv . "\";";
echo "\"" . $issn . "\";";
echo "\"" . $issnl . "\";";
echo "\"" . $nlmid . "\";";
echo "\"" . $catalogid . "\";";
echo "\"" . $doi . "\";";
echo "\"" . $coden . "\";";
echo "\"" . $urn . "\";";
echo "\"" . $openaccess . "\";";
echo "\"" . $publiinst . "\";";
echo "\"" . $faitsuitea . "\";";
echo "\"" . $devient . "\";";
echo "\"" . $editeur . "\";";
echo "\"" . $etatcoll . "\";";
echo "\"" . $etatcolldeba . "\";";
echo "\"" . $etatcolldebv . "\";";
echo "\"" . $etatcolldebf . "\";";
echo "\"" . $etatcollfina . "\";";
echo "\"" . $etatcollfinv . "\";";
echo "\"" . $etatcollfinf . "\";";
echo "\"" . $embargo . "\";";
echo "\"" . $url . "\";";
echo "\"" . $rss . "\";";
echo "\"" . $acceselecinst1 . "\";";
echo "\"" . $acceselecinst2 . "\";";
echo "\"" . $acceseleclibre . "\";";
echo "\"" . $titreexclu . "\";";
echo "\"" . $support . "\";";
echo "\"" . $licence . "\";";
echo "\"" . $plateforme . "\";";
echo "\"" . $gestion . "\";";
echo "\"" . $historiqueabo . "\";";
echo "\"" . $statutabo . "\";";
echo "\"" . $cote . "\";";
echo "\"" . $localisation . "\";";
echo "\"" . $user . "\";";
echo "\"" . $pwd . "\";";
echo "\"" . $keywords . "\";";
echo "\"" . $sujetsfm . "\";";
echo "\"" . $fmid . "\";";
echo "\"" . $format . "\";";
// echo "\"" . $time . "\";";
// echo "\"" . $historique . "\";";
echo "\"" . $package . "\";";
echo "\"" . $corecollection . "\";";
echo "\"" . $idediteur . "\";";
echo "\"" . $codeediteur . "\";";
echo "\"" . $commentaireprocsv . "\";";
echo "\"" . $commentairepubcsv . "\";";
echo "\"" . $signaturecreation . "\";";
echo "\"" . $signaturemodif . "\";";
echo "\"" . $datecreation . "\";";
echo "\"" . $datemodif . "\";";
echo "\n";
}
}
else
{
echo "<br/><center>\n"; 
if ($total_results == 1)
{
for ($i=0 ; $i<$nb ; $i++)
{
$row = 1;
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " périodique trouv&eacute;</b>\n";
else
echo " périodiques trouv&eacute;s</b>\n";
if ($searcheqa)
echo " pour la recherche administrateur : '" . $searcheqa . "'\n";
if ($searcheq)
echo " pour la recherche avancée : '" . $searcheq . "'\n";
if ($searcheqs)
echo " pour la recherche rapide : '" . $searcheqs . "'\n";
echo "<br/>";
echo "<br/>";
$enreg = mysql_fetch_array($result);
require ("fichecomp.php");
}
}
else
{
if ($total_results == 0)
{
echo "<br/><h2><font color=\"red\">Aucun périodique n'a été trouvé</font></h2><br/>\n";
if ($recherchetype=="simple")
{
require ("searchebooks.php");
}
if ($searcheqa)
echo "Critères de recherche administrateur : '" . $searcheqa . "'\n";
if ($searcheq)
echo "Critères de recherche avancée : '" . $searcheq . "'\n";
if ($searcheqs)
echo "Critères de recherche rapide : '" . $searcheqs . "'\n";
echo "<br/>";
echo "<br/>";
if ($recherchetype=="simple")
{
require ("spell.php");
}

}
else
{
// **************************************
// **************************************
// liste de résultats en format html
// **************************************
// **************************************


// echo $total_results." - ".$total_pages; 
// 
// Construction de la pagination
if($page > 1)
{
$prev = ($page - 1);
echo "<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$prev."\" class=\"linkpages\"><- </a>&nbsp;\n";
}
$spage = $page - 10;
if ($spage <= 0)
$spage = 1;
$epage = $page + 10;
if ($epage > $total_pages)
$epage = $total_pages;
if($epage > 1)
{
for($h = $spage ; $h <= $epage; $h++)
{ 
if(($page) == $h)
{ 
echo "<font color=\"red\"><b>".$h."</b></font>&nbsp;\n";
}
else
{
echo "<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$h."\" class=\"linkpages\">".$h."</a>&nbsp;\n";
}
}
}
if($page < $total_pages)
{
$next = ($page + 1);
echo "&nbsp;<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$next."\" class=\"linkpages\"> -></a>\n";
}

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " périodique trouv&eacute;</b></font>\n";
else
echo " périodiques trouv&eacute;s</b></font>\n";
if ($searcheqa)
echo " pour la recherche administrateur : '" . $searcheqa . "'\n";
if ($searcheq)
echo " pour la recherche avancée : '" . $searcheq . "'\n";
if ($searcheqs)
echo " pour la recherche rapide : '" . $searcheqs . "'\n";
// Liens pour les administrateurs : format d'export et pour faire une modification de masses
if ((($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))&&($recherchetype == "admin"))
echo "&nbsp;&nbsp;[<a href=\"search.php?".$_SERVER['QUERY_STRING']."&nb=" . $total_results . "&export=yes\">Exporter la liste</a>]\n";
if ((($monaut == "admin")||($monaut == "sadmin"))&&($recherchetype == "admin"))
echo "&nbsp;&nbsp;[<a href=\"editlist.php?".$_SERVER['QUERY_STRING']."&nb=" . $total_results . "\">Modifier la liste</a>]\n";
echo "<br/>";
echo "<br/>";



// Construction des facettes
if ($facettes == "on")
{
$tour = 0;
$supportall = null;
$licenceall = null;
$openaccessall = null;
$acceseleclibreall = null;
$statutaboall = null;
// $sujetsidall = null;
while ($row = mysql_fetch_array($result2))
{
$supportall[$tour] = $row['support'];
$licenceall[$tour] = $row['licence'];
$openaccessall[$tour] = $row['openaccess'];
$acceseleclibreall[$tour] = $row['acceseleclibre'];
$statutaboall[$tour] = $row['statutabo'];
// $sujetsidall[$tour] = $row['sujetsid'];
$tour++;
}
$supports = array_count_values($supportall);
$supports_names = array_keys($supports);
$supports_counts = array_values($supports);
echo "<b>Supports</b><br/>";
for ($i = 0; $i < count($supports_names); $i++)
{
echo $supports_names[$i] . " (" . $supports_counts[$i] . ")<br />\n";
}
echo "<br/>";
echo "<br/>";
$licences = array_count_values($licenceall);
$licences_names = array_keys($licences);
$licences_counts = array_values($licences);
echo "<b>Licences</b><br/>";
for ($i = 0; $i < count($licences_names); $i++)
{
echo $licences_names[$i] . " (" . $licences_counts[$i] . ")<br />\n";
}
echo "<br/>";
echo "<br/>";
$openaccesss = array_count_values($openaccessall);
$openaccesss_names = array_keys($openaccesss);
$openaccesss_counts = array_values($openaccesss);
echo "<b>Open access</b><br/>";
for ($i = 0; $i < count($openaccesss_names); $i++)
{
echo $openaccesss_names[$i] . " (" . $openaccesss_counts[$i] . ")<br />\n";
}
echo "<br/>";
echo "<br/>";
$acceseleclibres = array_count_values($acceseleclibreall);
$acceseleclibres_names = array_keys($acceseleclibres);
$acceseleclibres_counts = array_values($acceseleclibres);
echo "<b>Gratuits</b><br/>";
for ($i = 0; $i < count($acceseleclibres_names); $i++)
{
echo $acceseleclibres_names[$i] . " (" . $acceseleclibres_counts[$i] . ")<br />\n";
}
echo "<br/>";
echo "<br/>";
$statutabos = array_count_values($statutaboall);
$statutabos_names = array_keys($statutabos);
$statutabos_counts = array_values($statutabos);
echo "<b>Statut</b><br/>";
for ($i = 0; $i < count($statutabos_names); $i++)
{
echo $statutabos_names[$i] . " (" . $statutabos_counts[$i] . ")<br />\n";
}
echo "<br/>";
echo "<br/>";
// $sujetsids = array_count_values($sujetsidall);
// $sujetsids_names = array_keys($sujetsids);
// $sujetsids_counts = array_values($sujetsids);
// echo "<b>Sujets</b><br/>";
// for ($i = 0; $i < count($sujetsids_names); $i++)
// {
// echo $sujetsids_names[$i] . " (" . $sujetsids_counts[$i] . ")<br />\n";
// }
// echo "<br/>";
// echo "<br/>";
}
// Fin des facettes




echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "    </colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Titre</th>\n";
if ($collapse != "1")
{
echo "<th scope=\"col\">Etat de la collection</th>\n";
echo "<th scope=\"col\">Plateforme / Dépôt</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "<th scope=\"col\"></th>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<th scope=\"col\"></th>\n";
}
}
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$row = $i+1+(($page-1)*25);
$enreg = mysql_fetch_array($result);
$id = $enreg['journalsid'];
$titre = $enreg['titre'];
$soustitre = $enreg['soustitre'];
$issn = $enreg['issn'];
$issnl = $enreg['issnl'];
$licence = $enreg['licence'];
$localisation = $enreg['localisation'];
$plateforme = $enreg['plateforme'];
$support = $enreg['support'];
$etatcoll = $enreg['etatcoll'];
$user = $enreg['user'];
$pwd = $enreg['pwd'];
$url = $enreg['url'];
$urlstat = str_replace("http://","",$url);
$urlstat = str_replace("https://","",$urlstat );
$urlstat = str_replace("ftp://","",$urlstat );
$openaccess = $enreg['openaccess'];
$commentairepub = $enreg['commentairepub'];

echo "<tr>\n";
if ($collapse != "1")
echo "<td class=\"titrestableau\"><b>";
else
echo "<td class=\"titrestableau2\"><b>";
if ($support == "papier")
echo "<img src=\"img/papier.png\" title=\"Revue disponible en format papier\" align=\"absmiddle\">&nbsp;&nbsp;\n";
else
echo "<img src=\"img/web.png\" title=\"Revue disponible en ligne\" align=\"absmiddle\">&nbsp;&nbsp;\n";
if ($url)
echo "<a href=\"".$url."\" title=\"Accès en ligne\" target=\"_blank\" onClick=\"javascript: pageTracker._trackPageview(\"/outgoing/" . $id . "/" . $urlstat."\");\">";
echo $titre;
if ($soustitre)
echo " : " . $soustitre;
if ($url)
echo "</a>";
if ($collapse != "1")
{
echo "</b></td>\n";
echo "\n";
echo "<td>".$etatcoll."</b>\n";
echo "</td>\n";
echo "<td>";
if ($support == "papier")
{
echo $localisation."\n";
if ($localisation == "")
echo str_ireplace("Abo ","",str_ireplace("gratuit","Accès libre",$licence)) . "\n";
}
else
{
if ($plateforme == "")
echo str_ireplace("Abo ","",str_ireplace("gratuit","Accès libre",$licence)) . "\n";
else
echo $plateforme."\n";

}
echo "</td>\n";
echo "<td>";
if ($openaccess == 1)
echo "<img src=\"img/oa.png\" title=\"Revue Open Access\" width=\"12\">&nbsp;\n";
// if ($commentairepub)
// echo "<a href=\"#\" class=\"info\" onclick=\"return false\"><img src=\"img/alert.png\" width=\"20\"><span>[Commentaire : " . $commentairepub . "]</span></a>&nbsp;\n";
if (($user) || ($pwd))
{
if (($locip == "INST1") || ($locip == "INST2"))
{
echo "<a href=\"#\" class=\"info\" onclick=\"return false\"><img src=\"img/login.png\" width=\"25\"><span>[login : " . $user . " <br/>password : " . $pwd . "]</span></a>\n";
}
}
echo "</td>\n";
echo "<td><a href=\"detail.php?row=" . $row . "&id=".$id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\"></a></td>";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<td><a href=\"edit.php?row=" . $row . "&id=".$id."\" target=\"_blank\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
}
echo "</tr>\n";
}
else
{
echo "<a href=\"search.php?q=" . urlencode($titre) . "&init=&search=simple&field=texact&format=" . substr($support, 0, 1) . "&collapsetemp=0\" title=\"Deployer\">";
echo "<img src=\"img/collapsed.gif\" title=\"Deployer\" style=\"float:right;\">\n";
echo "</a>\n";
echo "</b></td>\n";
}
}
echo "</tbody>\n";
echo "</table>\n";


// Construction de la pagination
echo "<br/><center>\n"; 
if($page > 1)
{
$prev = ($page - 1);
echo "<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$prev."\"  class=\"linkpages\"><- </a>&nbsp;\n";
} 
$spage = $page - 10;
if ($spage <= 0)
$spage = 1;
$epage = $page + 10;
if ($epage > $total_pages)
$epage = $total_pages;
if($epage > 1)
{
for($h = $spage ; $h <= $epage; $h++)
{
if(($page) == $h)
{
echo "<font color=\"red\"><b>".$h."</b></font>&nbsp;\n";
}
else
{
echo "<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$h."\" class=\"linkpages\">".$h."</a>&nbsp;\n";
}
}
}
if($page < $total_pages)
{
$next = ($page + 1);
echo "&nbsp;<a href=\"search.php?".$_SERVER['QUERY_STRING']."&page=".$next."\" class=\"linkpages\"> -></a>\n";
}
}
}

echo "</center>\n";
echo "</div>\n";
echo "</div>\n";
echo "<br/>\n";
// echo "encodage : " . $charset;
// echo "autorisation : " . $monaut;
echo "\n";
if ($suggest!="0")
{
echo "<script type=\"text/javascript\">\n";
echo "function submitform()\n";
echo "{\n";
echo "  document.search.submit();\n";
echo "}\n";
echo "</script>\n";
echo "<script type=\"text/javascript\">\n";
echo "var options = {\n";
echo "script:\"autosuggest.php?json=true&limit=100&\",\n";
echo "varname:\"input\",\n";
echo "json:true,\n";
echo "shownoresults:false,\n";
echo "maxresults:10,\n";
echo "timeout:5000,\n";
echo "callback: function (obj) { document.getElementById('q').value = obj.value; }\n";
echo "};\n";
echo "var as_json = new bsn.AutoSuggest('q', options);\n";
echo "</script>\n";
}
echo "\n";
require ("footer.php");
}
?>
