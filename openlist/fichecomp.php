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
// Table journals : bloc utilisé pour afficher tous les champs de la fiche du périodique quand on est authentifié

$journalsid = $enreg['journalsid'];
$id = $journalsid;
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
$urlstat = str_replace("http://","",$url);
$urlstat = str_replace("https://","",$urlstat );
$urlstat = str_replace("ftp://","",$urlstat );
if (strlen($url)>80)
$urlcut = substr($url, 0, 80) . "[...]";
else
$urlcut = $url;
$rss = $enreg['rss'];
if (strlen($rss)>80)
$rsscut = substr($rss, 0, 80) . "[...]";
else
$rsscut = $rss;
$rssstat = str_replace("http://","",$rss);
$rssstat = str_replace("https://","",$rssstat );
$rssstat = str_replace("ftp://","",$rssstat );
$acceselecinst1 = $enreg['acceselecinst1'];
$acceselecinst2 = $enreg['acceselecinst2'];
$acceseleclibre = $enreg['acceseleclibre'];
$titreexclu = $enreg['titreexclu'];
$support = $enreg['support'];
$licence = $enreg['licence'];
$licence = str_ireplace("gratuit","Accès libre",$licence);
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
$historique = $enreg['historique'];
$package = $enreg['package'];
$corecollection = $enreg['corecollection'];
$idediteur = $enreg['idediteur'];
$codeediteur = $enreg['codeediteur'];
$mestitres = "";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<center><b><a href=\"edit.php?id=".$journalsid."\">Modifier la fiche</a>  |  <a href=\"edit.php?id=".$journalsid."&action=new\">Dupliquer la fiche</a>  |  <a href=\"delete.php?id=".$journalsid."\">Supprimer la fiche</a>  |  <a href=\"new.php\">Créer une nouvelle fiche</a></b></center><br /><br />\n";
}
echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "    </colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Titre</th>\n";
if ($url)
echo "<th scope=\"col\"><a href=\"" . $url . "\" title=\"Accès en ligne\" target=\"_blank\" onClick=\"javascript: pageTracker._trackPageview(\"/outgoing/" . $journalsid . "/" . $urlstat."\");\">" . $titre . "</a></th>\n";
else
echo "<th scope=\"col\">" . $titre . "</th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
if ($soustitre)
echo "<tr><td><b>Sous titre : </b></td><td>".$soustitre."</td></tr>\n";
if ($titreabrege)
echo "<tr><td><b>Titre abrégé</b></td><td>".$titreabrege."</td></tr>\n";
if ($variantetitre)
echo "<tr><td><b>Variante de titre</b></td><td>".$variantetitre."</td></tr>\n";
if ($issn)
echo "<tr><td><b>ISSN</b></td><td>".$issn."</td></tr>\n";
if ($issnl)
echo "<tr><td><b>ISSN-L</b></td><td>".$issnl."</td></tr>\n";
if ($nlmid)
echo "<tr><td><b>NLM ID</b></td><td>".$nlmid."</td></tr>\n";
if ($catalogid)
echo "<tr><td><b>Catalog ID</b></td><td>".$catalogid."</td></tr>\n";
if ($doi)
echo "<tr><td><b>DOI</b></td><td>".$doi."</td></tr>\n";
if ($coden)
echo "<tr><td><b>CODEN</b></td><td>".$coden."</td></tr>\n";
if ($urn)
echo "<tr><td><b>URN</b></td><td>".$urn."</td></tr>\n";
if ($openaccess == '1')
echo "<tr><td><b>Open Access</b></td><td>Oui </td></tr>\n";
if ($publiinst == '1')
echo "<tr><td><b>Publication institutionnelle</b></td><td>Oui</td></tr>\n";
if ($faitsuitea)
echo "<tr><td><b>Fait Suite à</b></td><td>".$faitsuitea."</td></tr>\n";
if ($devient)
echo "<tr><td><b>Devient</b></td><td>".$devient."</td></tr>\n";
if ($editeur)
echo "<tr><td><b>Editeur</b></td><td>".$editeur."</td></tr>\n";
if ($codeediteur)
echo "<tr><td><b>Code de la revue chez l'éditeur</b></td><td>".$codeediteur."</td></tr>\n";
if ($etatcoll)
echo "<tr><td><b>Etat de collection</b></td><td>".$etatcoll."</td></tr>\n";
$reqthemes = "SELECT * FROM journals_sujets LEFT JOIN sujets ON journals_sujets.sujetsid = sujets.sujetsid WHERE journals_sujets.journalsid = '$journalsid'";
$resultthemes = mysql_query($reqthemes,$link);
$nbthemes = mysql_num_rows($resultthemes);
if ($nbthemes > 0)
{
for ($k=0 ; $k<$nbthemes ; $k++)
{
$enregthemes = mysql_fetch_array($resultthemes);
$sujetsfr = $enregthemes['sujetsfr'];
echo "<tr><td><b>Theme</b></td><td>".$sujetsfr."</td></tr>\n";
}
}
if ($keywords)
echo "<tr><td><b>Keywords</b></td><td>".$keywords."</td></tr>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
if ($sujetsfm)
echo "<tr><td><b>Thèmes FM</b></td><td>".$sujetsfm."</td></tr>\n";
if ($etatcolldeba>0)
echo "<tr><td><b>Etat de collection : Année de début</b></td><td>".$etatcolldeba."</td></tr>\n";
if ($etatcolldebv>0)
echo "<tr><td><b>Etat de collection : Volume de début</b></td><td>".$etatcolldebv."</td></tr>\n";
if ($etatcolldebf>0)
echo "<tr><td><b>Etat de collection : Numéro de début</b></td><td>".$etatcolldebf."</td></tr>\n";
if ($etatcollfina<99999)
echo "<tr><td><b>Etat de collection : Année de fin</b></td><td>".$etatcollfina."</td></tr>\n";
if ($etatcollfinv<99999)
echo "<tr><td><b>Etat de collection : Volume de fin</b></td><td>".$etatcollfinv."</td></tr>\n";
if ($etatcollfinf<99999)
echo "<tr><td><b>Etat de collection : Numéro de fin</b></td><td>".$etatcollfinf."</td></tr>\n";
}
if ($embargo)
echo "<tr><td><b>Embargo</b></td><td>".$embargo." mois</td></tr>\n";
if ($url)
echo "<tr><td><b>URL</b></td><td><a href=\"" . $url . "\" title=\"Accès en ligne\" target=\"_blank\" onClick=\"javascript: pageTracker._trackPageview(\"/outgoing/" . $journalsid . "/" . $urlstat."\");\">" . $urlcut . "</a></td></tr>\n";
if ($rss)
echo "<tr><td><b>RSS</b></td><td><a href=\"" . $rss . "\" title=\"Accès en ligne au format RSS\" target=\"_blank\" onClick=\"javascript: pageTracker._trackPageview(\"/outgoing/rss/" . $journalsid . "/" . $rssstat."\");\">" . $rsscut ."</a></td></tr>\n";
if ($acceseleclibre == '1')
echo "<tr><td><b>Accès électronique libre</b></td><td>Oui</td></tr>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
if ($acceselecinst1 == '1')
echo "<tr><td><b>Accès électronique à " . $configinstitution . "</b></td><td>Oui</td></tr>\n";
if ($acceselecinst2 == '1')
echo "<tr><td><b>Accès électronique à " . $configinstitution2 . "</b></td><td>Oui</td></tr>\n";
if ($titreexclu == '1')
echo "<tr><td><b>Titre exclu</b></td><td>Oui</td></tr>\n";
}
if ($support == 'papier')
echo "<tr><td><b>Support</b></td><td>Imprimé</td></tr>\n";
if ($support == 'electronique')
echo "<tr><td><b>Support</b></td><td>Electronique</td></tr>\n";
if ($licence)
echo "<tr><td><b>Abonnement / Licence</b></td><td>".$licence."</td></tr>\n";
if ($plateforme)
echo "<tr><td><b>Plateforme</b></td><td>".$plateforme."</td></tr>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
if ($gestion)
echo "<tr><td><b>Gestion</b></td><td>".$gestion."</td></tr>\n";
if ($historiqueabo)
echo "<tr><td><b>Historique d'abonnement</b></td><td>".$historiqueabo."</td></tr>\n";
}
echo "<tr><td><b>Statut de l'abonnement</b></td><td>";
switch ($statutabo)
{
case 1:
echo "Actif";
break;
case 2:
echo "Licence en test";
break;
case 3:
echo "Abonnement perdu";
break;
case 4:
echo "En panne";
break;
default:
echo "Terminé";
}
echo "</td></tr>\n";
if ($corecollection == '1')
echo "<tr><td><b>Core Collection</b></td><td>Oui</td></tr>\n";
if ($package)
echo "<tr><td><b>Nom du package</b></td><td>".$package."</td></tr>\n";
if ($idediteur)
echo "<tr><td><b>No d'abonnement</b></td><td>".$idediteur."</td></tr>\n";
if ($cote)
echo "<tr><td><b>Cote (exemplaire papier)</b></td><td>".$cote."</td></tr>\n";
if ($classification)
echo "<tr><td><b>Classification</b></td><td>".$classification."</td></tr>\n";
if ($localisation)
echo "<tr><td><b>Localisation (exemplaire papier)</b></td><td>".$localisation."</td></tr>\n";
// if ($user)
// echo "<tr><td><b>user</b></td><td>".$user."</td></tr>\n";
// if ($pwd)
// echo "<tr><td><b>pwd</b></td><td>".$pwd."</td></tr>\n";
if ($user || $pwd)
{
if (($locip == "INST1") || ($locip == "INST2") || ($monaut == "admin"))
{
if ($user)
echo "<tr><td><b>Login</b></td><td>".$user."</td></tr>\n";
if ($pwd)
echo "<tr><td><b>Mot de passe</b></td><td>".$pwd."</td></tr>\n";
}
}

if ($commentairepub)
echo "<tr><td><b>Commentaire public</b></td><td>".$commentairepub."</td></tr>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
if ($commentairepro)
echo "<tr><td><b>Commentaire professionnel</b></td><td>".$commentairepro."</td></tr>\n";
if ($signaturecreation)
echo "<tr><td><b>Signature de création</b></td><td>".$signaturecreation."</td></tr>\n";
if ($signaturemodif)
echo "<tr><td><b>Signature de modification</b></td><td>".$signaturemodif."</td></tr>\n";
if ($datecreation)
echo "<tr><td><b>Date de création de la fiche</b></td><td>".$datecreation."</td></tr>\n";
if ($datemodif)
echo "<tr><td><b>Date de dernière modification</b></td><td>".$datemodif."</td></tr>\n";
if ($fmid)
echo "<tr><td><b>FileMaker-ID</b></td><td>".$fmid."</td></tr>\n";
}
echo "<tr><td><b>Journals-ID</b></td><td>".$journalsid."</td></tr>\n";
echo "</table><br/><br/><center>\n";
// Activer le permalien sur www.purl.org
// echo "<a href=\"http://www.purl.org/net/[le nom de votre application]/".$id."\"><img src=\"img/permalink.png\" title=\"Permalink\" align=\"absmiddle\"></a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "<a href=\"detail.php?id=".$id."\"><img src=\"img/permalink.png\" title=\"Permalink\" align=\"absmiddle\"></a>&nbsp;&nbsp;|&nbsp;&nbsp;\n";
echo "<a href=\"detail.php?id=".$id."&epingler" . $monidok . "id=".$id."\"><img src=\"img/epingler" . $monidok . ".png\" title=\"Ajouter à ma page d'accueil\" align=\"absmiddle\"></a>\n";
echo "<br/></center>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
if ($historique)
{
echo "<br /><br />\n";
echo "<div id=\"nohist\" style=\"position:relative; z-index:9; visibility:visible; display:block;\">\n";
echo "<a href=\"javascript:hidediv('nohist');showdiv('hist');\" alt=\"afficher l'historique des modifications\" class=\"linkthemes\"><img src=\"img/collapsed.gif\">&nbsp; Historique des modifications</a><br/>\n";
echo "</div>\n";
echo "<div id=\"hist\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<a href=\"javascript:hidediv('hist');showdiv('nohist');\" alt=\"fermer l'historique des modifications\" class=\"linkthemes\"><img src=\"img/expanded.gif\">&nbsp; Historique des modifications</a><br/>\n";
echo "<ul>\n";
echo str_replace("|","<br/>",$historique);
echo "</ul>\n";
echo "</div>\n";
}
echo "<br /><br /><center><b><a href=\"edit.php?id=".$journalsid."\">Modifier la fiche</a>  |  <a href=\"edit.php?id=".$journalsid."&action=new\">Dupliquer la fiche</a>  |  <a href=\"delete.php?id=".$journalsid."\">Supprimer la fiche</a>  |  <a href=\"new.php\">Créer une nouvelle fiche</a></b></center>\n";
}
echo "<br /><br /></ul>\n";
?>
