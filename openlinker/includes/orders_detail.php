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
// Order details only for administrators
//
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$id=$_GET['id'];
$myhtmltitle = "Commandes de " . $configinstitution[$lang] . " : détail de la commande " . $id;
require ("connect.php");
if ($id)
{
$req = "SELECT orders.*, status.title1 AS statusname, status.help1 AS statushelp, status.special AS statusspecial, status.color AS statuscolor, libraries.name1 AS libname, localizations.name1 AS locname, units.name1 AS unitname FROM orders LEFT JOIN status ON orders.stade = status.code LEFT JOIN libraries ON orders.bibliotheque = libraries.code LEFT JOIN localizations ON orders.localisation = localizations.code LEFT JOIN units ON orders.service = units.code WHERE orders.illinkid LIKE '$id' GROUP BY orders.illinkid ORDER BY orders.illinkid DESC";

$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
require ("headeradmin.php");
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$id = $enreg['illinkid'];
$date = $enreg['date'];
$stade = $enreg['stade'];
$localisation = $enreg['localisation'];
$nom = $enreg['nom'].', '.$enreg['prenom'];
$mail = $enreg['mail'];
$locname = $enreg['locname'];
$unitname = $enreg['unitname'];
$statusname = $enreg['statusname'];
$statushelp = $enreg['statushelp'];
$statusspecial = $enreg['statusspecial'];
$statuscolor = $enreg['statuscolor'];
$libname = $enreg['libname'];

if ($mail)
{
$pos1 = strpos($mail,';');
$pos2 = strpos($mail,',');
$pos3 = strpos($mail,' ');
if (($pos1 === false)&&($pos2 === false)&&($pos3 === false))
{
$maillog = strtolower($mail);
}
else
{
if (($pos1 != false)&&($pos2 != false)&&($pos3 != false))
$pos = min($pos1, $pos2, $pos3);
else if (($pos1 != false)&&($pos2 != false))
$pos = min($pos1, $pos2);
else if (($pos1 != false)&&($pos3 != false))
$pos = min($pos1, $pos3);
else if (($pos2 != false)&&($pos3 != false))
$pos = min($pos2, $pos3);
else if ($pos1 != false)
$pos = $pos1;
else if ($pos2 != false)
$pos = $pos2;
else if ($pos3 != false)
$pos = $pos3;
$maillog = substr($mail,0,$pos);
$maillog = strtolower($maillog);
}
$mailg = $maillog . $secure_string_guest_login;
$passwordg = substr(md5($mailg), 0, 8);
}
$adresse = $enreg['adresse'].', '.$enreg['code_postal'].' '.$enreg['localite'];
$titreper = $enreg['titre_periodique'];
$titreper = strtr($titreper, '&', ' ');
$titreper = strtr($titreper, '/', ' ');
$titreper = strtr($titreper, '-', ' ');
$titreart = $enreg['titre_article'];
$titreart = strtr($titreart, '&', ' ');
$titreart = strtr($titreart, '/', ' ');
$titreart = strtr($titreart, '-', ' ');
$titreart = strtr($titreart, '?', ' ');
$titreart = htmlspecialchars($titreart, ENT_COMPAT);
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
echo "<tr><td valign=\"top\" width=\"74%\">\n";
echo "<b>Commande no : </b>".$id;
if ($enreg['urgent']=='1' || $enreg['urgent']=='oui')
echo " (<b><font color=\"red\">Commande URGENTE</font></b>)\n";
if ($enreg['urgent']=='3' || $enreg['urgent']=='non')
echo " (<font color=\"SteelBlue\">Commande pas prioritaire</font>)\n";
if (($enreg['type_doc']!='article') && ($enreg['type_doc']!='Article'))
echo "&nbsp;&nbsp;&nbsp;<img src=\"img/book.png\">";
echo "<br /><b>Date de la commande : </b>".$date;
if ($enreg['envoye']>0)
echo "\n<br /><b>Date d'envoi : </b>".$enreg['envoye'];
if ($enreg['facture']>0)
echo "\n<br /><b>Date de facturation : </b>".$enreg['facture'];
if ($enreg['renouveler']>0)
echo "\n<br /><b>Date de renouvellement : </b>".$enreg['renouveler'];
echo "\n<br /><b>Bibliothèque d'attribution : </b>";
echo $libname . " (" . $enreg['bibliotheque'] . ")";
if ($localisation)
echo "\n<br /><b>Localisation : </b>" . $locname . " (" . $localisation . ")";
echo "<br /><b>Status : \n";
echo "<a href=\"#\" class=\"info\" onclick=\"return false\"><font color=\"".$statuscolor."\">".$statusname."</font><span>".$statushelp."</span></a></b>";
if ($statusspecial == "renew")
{
if ($enreg['renouveler'])
echo " le ".$enreg['renouveler'];
}

echo "<br /><b>Lecteur : </b><a href=\"list.php?folder=search&champ=nom&term=".urlencode ($nom)."\" title=\"chercher les commandes de ce lecteur\">\n";
echo $nom."</a>\n";
// formated e-mails
if ($mail)
{
echo "<br /><b>E-mail : </b><a href=\"list.php?folder=search&champ=email&term=".$mail."\" title=\"chercher les commandes pour cet email\">".$mail."</a>\n";
require ("email.php");
}
if ($enreg['adresse'])
echo "<br /><b>Adresse : </b>".stripslashes($adresse);
if ($enreg['service'])
echo "<br /><b>Service : </b><a href=\"list.php?folder=search&champ=service&term=".$enreg['service']."\" title=\"chercher les commandes de ce service\">".$enreg['service']."</a>\n";
if ($enreg['type_doc'])
echo "<br /><b>Type de document : </b>".$enreg['type_doc'];
echo "<br />\n";
if ($enreg['titre_article'])
echo "<b>Titre : </b><a href=\"list.php?folder=search&champ=atitle&term=".urlencode (stripslashes($enreg['titre_article']))."\" title=\"chercher les commandes pour ce titre\">".stripslashes($enreg['titre_article'])."</a><br />\n";
if ($enreg['auteurs'])
echo "<b>Auteur(s) : </b>".stripslashes($enreg['auteurs'])."<br />\n";
if ($enreg['titre_periodique'])
{
if (($enreg['type_doc']=='article') || ($enreg['type_doc']=='Article'))
echo "<b>P&eacute;riodique : </b>\n";
if ($enreg['type_doc']=='journal')
echo "<b>P&eacute;riodique : </b>\n";
if (($enreg['type_doc']=='Livre') || ($enreg['type_doc']=='book'))
echo "<b>Livre : </b>\n";
if (($enreg['type_doc']=='thesis') || ($enreg['type_doc']=='These') || ($enreg['type_doc']=='Thèse'))
echo "<b>Th&egrave;se : </b>\n";
if (($enreg['type_doc']=='Chapitre') || ($enreg['type_doc']=='preprint') || ($enreg['type_doc']=='bookitem'))
echo "<b>In : </b>\n";
if (($enreg['type_doc']=='autre') || ($enreg['type_doc']=='Autre') || ($enreg['type_doc']=='other'))
echo "<b>In : </b>\n";
if (($enreg['type_doc']=='Congres') || ($enreg['type_doc']=='proceeding') || ($enreg['type_doc']=='conference'))
echo "<b>In : </b>\n";
echo "</b><a href=\"list.php?folder=search&champ=title&term=".urlencode (stripslashes($enreg['titre_periodique']))."\" title=\"chercher les commandes pour ce titre\">".stripslashes($enreg['titre_periodique'])."</a>\n";
}
if ($enreg['volume'])
echo "<br /><b>Volume : </b>".$enreg['volume'];
if ($enreg['numero'])
echo "\n<br /><b>Issue : </b>".$enreg['numero'];
if ($enreg['supplement'])
echo "\n<br /><b>Suppl. : </b>".$enreg['supplement'];
if ($enreg['pages'])
echo "\n<br /><b>Pages : </b>".$enreg['pages'];
if ($enreg['annee'])
echo "\n<br /><b>Ann&eacute;e : </b>".$enreg['annee'];
if ($enreg['issn'])
echo "\n<br /><b>ISSN : </b>".$enreg['issn'];
if ($enreg['eissn'])
echo "\n<br /><b>eISSN : </b>".$enreg['eissn'];
if ($enreg['isbn'])
echo "\n<br /><b>ISBN : </b>".$enreg['isbn'];
if ($enreg['PMID'])
echo "\n<br /><b>PMID : </b><a href=\"http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?otool=ichuvlib&cmd=Retrieve&db=pubmed&dopt=citation&list_uids=".$enreg['PMID']."\" target=\"_blank\">".$enreg['PMID']."</a>\n";
if ($enreg['uid'])
echo "\n<br /><b>Autre identificateur : </b>".$enreg['uid'];
if ($enreg['cgra'])
echo "\n<br /><b>Code de gestion A : </b>".$enreg['cgra'];
if ($enreg['cgrb'])
echo "\n<br /><b>Code de gestion B : </b>".$enreg['cgrb'];
if ($enreg['tel'])
echo "\n<br /><b>No t&eacute;l. : </b>".$enreg['tel'];
if ($enreg['saisie_par'])
echo "\n<br /><b>Saisie par : </b>".$enreg['saisie_par'];
if ($enreg['ip'])
echo "\n<br /><b>Adresse IP : </b>".$enreg['ip'];
if ($enreg['referer'])
echo "\n<br /><b>URL de provenance : </b>".rawurldecode($enreg['referer']);
if ($enreg['arrivee'])
echo "\n<br /><b>Arriv&eacute;e par : </b>".$enreg['arrivee'];
if ($enreg['envoi_par'])
echo "\n<br /><b>Envoyer par : </b>";
if ($enreg['envoi_par'] == 'surplace')
echo "<b><font color=\"red\">Avertir le lecteur si disponible sur place</font></b>";
else
echo $enreg['envoi_par'];
if ($enreg['prix'])
echo "\n<br /><b>Prix : </b>".$enreg['prix'];
if ($enreg['prepaye'])
echo "\n<br /><b><font color=\"green\">Payé à l'avance : </b>".strtr($enreg['prepaye'], "on", "OK")." </font>";
if ($enreg['ref'])
echo "\n<br /><b>Réf. fournisseur : </b>".$enreg['ref'];
if ($enreg['refinterbib'])
echo "\n<br /><b>Réf. interne à la bibliothèque : </b>".$enreg['refinterbib'];
if ($mail)
echo "\n<br /><b>Code accès guest : </b> Username: ".$maillog." | Password: ".$passwordg;
if ($enreg['remarquespub'])
echo "\n<br /><b>Commentaire public : </b>".stripslashes(nl2br($enreg['remarquespub']));
if ($enreg['remarques'])
echo "\n<br /><b>Commentaire professionnel : </b>".stripslashes(nl2br($enreg['remarques']));
echo "\n<br /><br /><b>Historique de la commande : </b>\n<br />".$enreg['historique'];
echo "</td>\n";
echo "<td valign=\"top\" width=\"26%\">\n";
require ("links.php");
echo "</td></tr></table>\n";
}
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
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
