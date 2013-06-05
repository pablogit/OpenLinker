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
// Page to save the order, display errors or confirm if the order is normally saved
//


//
// START Common Vars
//
require ("connect.php");
$mes="";
$doi="";
$pmid="";
$isbn="";
$issn="";
$eissn="";
$userid=$_POST['userid'];
if ($userid=='')
$userid=$_SERVER['REMOTE_ADDR'];
$referer=$_POST['referer'];
$action=$_POST['action'];
$stade="";
$stade="";


//
// END common vars
//


//
// START admin vars
//
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$localisation=$_POST['localisation'];
$stade=$_POST['stade'];
$date=$_POST['datesaisie'];
if($date=="")
$date=date("Y-m-d");
$date2=date("d/m/Y H:i:s");
$envoye=$_POST['envoye'];
$facture=$_POST['facture'];
$renouveler=$_POST['renouveler'];
$reqstatus="SELECT code FROM status WHERE status.special = \"renew\"";
$optionsstatus="";
$resultstatus = mysql_query($reqstatus,$link);
while ($rowstatus = mysql_fetch_array($resultstatus))
{
$codestatus = $rowstatus["code"];
if (($stade==$codestatus) && ($renouveler==''))
{
$renouveler = date("Y-m-d", mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));
}
}

$sid=$_POST['sid'];
$pid=$_POST['pid'];
$bibliotheque=$_POST['bibliotheque'];
$source=$_POST['source'];
$nom=trim(addslashes($_POST['nom']));
$prenom=trim(addslashes($_POST['prenom']));
$service=$_POST['service'];
$prix=$_POST['prix'];
$prepaye=$_POST['avance'];
$urgent=$_POST['urgent'];
$ref=$_POST['ref'];
$refinterbib=$_POST['refinterbib'];
$source=$_POST['source'];
$servautre=$_POST['servautre'];
if($servautre)
$service=$servautre;
$cgra=addslashes($_POST['cgra']);
$cgrb=addslashes($_POST['cgrb']);
$mail=trim($_POST['mail']);
$tel=addslashes($_POST['tel']);
$adresse=addslashes($_POST['adresse']);
$postal=addslashes($_POST['postal']);
$localite=addslashes($_POST['localite']);
$envoi=$_POST['envoi'];
if ($_POST['tid']=='pmid')
$pmid=$_POST['uids'];
if ($_POST['tid']=='doi')
$doi=$_POST['uids'];
$typedoc=$_POST['genre'];
$journal=addslashes(trim($_POST['title']));
$annee=$_POST['date'];
$vol=$_POST['volume'];
$no=$_POST['issue'];
$suppl=$_POST['suppl'];
$pages=$_POST['pages'];
$titre=addslashes(trim($_POST['atitle']));
$auteurs=addslashes($_POST['auteurs']);
$edition=addslashes($_POST['edition']);
if ($_POST['issn']!='')
{
if (($_POST['genre']=='book')||($_POST['genre']=='bookitem')||($_POST['genre']=='proceeding')||($_POST['genre']=='conference'))
{
$isbn=$_POST['issn'];
$isbn='';
}
else
{
$pos = strpos($_POST['issn'],',');
if ($pos === false)
{
$issn=$_POST['issn'];
}
else
{
$issn=substr($_POST['issn'],0,$pos);
$eissn=substr($_POST['issn'],$pos+1);
}
}
}
$uid=$_POST['uid'];
if($pmid==''){
if(ereg("pmid:",$_POST['uid']))
$pmid=str_replace("pmid:","",$_POST['uid']);
}
$remarques=addslashes($_POST['remarques']);
$remarquespub=addslashes($_POST['remarquespub']);

// 
// END admin vars
// 
}
else
{
// 
// START public vars
// 
$date=date("Y-m-d");
$date2=date("d/m/Y H:i:s");
$uid=$_POST['uid'];
$uid=str_replace("<","[lt]",$uid);
$uid=str_replace(">","[gt]",$uid);
$uids=$_POST['uids'];
$uids=str_replace("<","[lt]",$uids);
$uids=str_replace(">","[gt]",$uids);
$sid=$_POST['sid'];
$pid=$_POST['pid'];
$source=$_POST['source'];
$nom=trim(addslashes($_POST['nom']));
$nom=str_replace("<","[lt]",$nom);
$nom=str_replace(">","[gt]",$nom);
$prenom=addslashes($_POST['prenom']);
$prenom=trim(str_replace("<","[lt]",$prenom));
$prenom=str_replace(">","[gt]",$prenom);
$service=$_POST['service'];
$bibliotheque="";
$localisation="";
$validation = 0;
$reqstatus="SELECT code FROM status WHERE status.special = \"new\"";
$optionsstatus="";
$resultstatus = mysql_query($reqstatus,$link);
while ($rowstatus = mysql_fetch_array($resultstatus))
{
$stade = $rowstatus["code"];
}
if ($service)
{
$reqlibfromunits="SELECT library, validation FROM units WHERE units.code = \"" . $service . "\"";
$resultunits = mysql_query($reqlibfromunits,$link);
while ($rowunits = mysql_fetch_array($resultunits))
{
$bibliotheque = $rowunits["library"];
$localisation =  $rowunits["library"];
$validation =  $rowunits["validation"];
}
}
if ($bibliotheque == "")
{
$reqlibdefault="SELECT code FROM libraries WHERE libraries.default = 1";
$resultlibdefault = mysql_query($reqlibdefault,$link);
while ($rowlibdefault = mysql_fetch_array($resultlibdefault))
{
$bibliotheque = $rowlibdefault["code"];
$localisation =  $rowlibdefault["code"];
}
}

if ($validation == 1)
{
$reqstatus="SELECT code FROM status WHERE status.special = \"tobevalidated\"";
$optionsstatus="";
$resultstatus = mysql_query($reqstatus,$link);
while ($rowstatus = mysql_fetch_array($resultstatus))
{
$stade = $rowstatus["code"];
}
}

$servautre=$_POST['servautre'];
if($servautre)
$service=$servautre;
$service=str_replace("<","[lt]",$service);
$service=str_replace(">","[gt]",$service);
$cgra=addslashes($_POST['cgra']);
$cgra=str_replace("<","[lt]",$cgra);
$cgra=str_replace(">","[gt]",$cgra);
$cgrb=addslashes($_POST['cgrb']);
$cgrb=str_replace("<","[lt]",$cgrb);
$cgrb=str_replace(">","[gt]",$cgrb);
$mail=trim($_POST['mail']);
$mail=str_replace("<","[lt]",$mail);
$mail=str_replace(">","[gt]",$mail);
$tel=addslashes($_POST['tel']);
$tel=str_replace("<","[lt]",$tel);
$tel=str_replace(">","[gt]",$tel);
$adresse=addslashes($_POST['adresse']);
$adresse=str_replace("<","[lt]",$adresse);
$adresse=str_replace(">","[gt]",$adresse);
$postal=addslashes($_POST['postal']);
$localite=addslashes($_POST['localite']);
$localite=str_replace("<","[lt]",$localite);
$localite=str_replace(">","[gt]",$localite);
$envoi=$_POST['envoi'];
if ($_POST['tid']=='pmid')
$pmid=$uids;
if ($_POST['tid']=='doi')
$doi=$uids;
$typedoc=$_POST['genre'];
$journal=addslashes(trim($_POST['title']));
$journal=str_replace("<","[lt]",$journal);
$journal=str_replace(">","[gt]",$journal);
$annee=$_POST['date'];
$annee=str_replace("<","[lt]",$annee);
$annee=str_replace(">","[gt]",$annee);
$vol=$_POST['volume'];
$vol=str_replace("<","[lt]",$vol);
$vol=str_replace(">","[gt]",$vol);
$no=$_POST['issue'];
$no=str_replace("<","[lt]",$no);
$no=str_replace(">","[gt]",$no);
$suppl=$_POST['suppl'];
$suppl=str_replace("<","[lt]",$suppl);
$suppl=str_replace(">","[gt]",$suppl);
$pages=$_POST['pages'];
$pages=str_replace("<","[lt]",$pages);
$pages=str_replace(">","[gt]",$pages);
$titre=addslashes(trim($_POST['atitle']));
$titre=str_replace("<","[lt]",$titre);
$titre=str_replace(">","&gt;",$titre);
$auteurs=addslashes($_POST['auteurs']);
$auteurs=str_replace("<","[lt]",$auteurs);
$auteurs=str_replace(">","[gt]",$auteurs);
$edition=addslashes($_POST['edition']);
$edition=str_replace("<","[lt]",$edition);
$edition=str_replace(">","[gt]",$edition);
if ($_POST['issn']!='')
{
if (($_POST['genre']=='book')||($_POST['genre']=='bookitem')||($_POST['genre']=='proceeding')||($_POST['genre']=='conference'))
{
$isbn=$_POST['issn'];
$isbn=str_replace("<","[lt]",$isbn);
$isbn=str_replace(">","[gt]",$isbn);
$issn='';
}
else
{
$pos = strpos($_POST['issn'],',');
if ($pos === false)
{
$issn=$_POST['issn'];
$issn=str_replace("<","[lt]",$issn);
$issn=str_replace(">","[gt]",$issn);
}
else
{
$issn=substr($_POST['issn'],0,$pos);
$issn=str_replace("<","[lt]",$issn);
$issn=str_replace(">","[gt]",$issn);
$eissn=substr($_POST['issn'],$pos+1);
$eissn=str_replace("<","[lt]",$eissn);
$eissn=str_replace(">","[gt]",$eissn);
}
}
}
if($pmid==''){
if(ereg("pmid:",$uid))
$pmid=str_replace("pmid:","",$uid);
}
$remarquespub=addslashes($_POST['remarquespub']);
$remarquespub=str_replace("<script>","",$remarquespub);
$remarquespub=str_replace("</script>","",$remarquespub);
$remarquespub=str_replace("script","scrpt",$remarquespub);
$remarquespub=str_replace("<","[lt]",$remarquespub);
$remarquespub=str_replace(">","[gt]",$remarquespub);
}
// 
// END public vars
// 

$ip=$_SERVER['REMOTE_ADDR'];
$historique='Commande saisie par ' . $userid . ' le ' . $date2;
if (!$_POST['nom'])
$mes="le nom est obligatoire";
if (!$_POST['service'])
{
if (!$_POST['servautre'])
$mes=$mes."<br>le nom du service ou de l'institution est obligatoire";
}
if (!$_POST['title'])
$mes=$mes."<br>le titre du périodique ou du livre est obligatoire";
if (!$_POST['mail'])
{
if (!$_POST['adresse'])
$mes=$mes."<br>le e-mail ou l'adresse privée sont obligatoires";
}
if ($mes)
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
require ("headeradmin.php");
else
require ("header.php");
echo "\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<center><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire de saisie</a></b></center><br />\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
require ("footer.php");

//
// Error message
// 
}
else
{
//
// No errors, searching duplicates
// 

require ("connect.php");
// Recherche de doublons par PMID ou par volume année et pages
$req2 = "";
if ($pmid!='')
{
if (($vol!='') && ($annee!='') && ($pages!=''))
$req2 = "SELECT illinkid FROM orders WHERE PMID LIKE '$pmid' OR (annee LIKE '$annee' AND volume LIKE '$vol' AND pages LIKE '$pages') ORDER BY illinkid DESC";
else
$req2 = "SELECT illinkid FROM orders WHERE PMID LIKE '$pmid' ORDER BY illinkid DESC";
}
else
{
if (($vol!='') && ($annee!='') && ($pages!=''))
$req2 = "SELECT illinkid FROM orders WHERE annee LIKE '$annee' AND volume LIKE '$vol' AND pages LIKE '$pages' ORDER BY illinkid DESC";
}
if ($req2!='')
{
$result2 = mysql_query($req2,$link);
$nb = mysql_num_rows($result2);
if ($nb > 0)
{
if ($remarques)
$remarques = $remarques."\r\n";
$remarques = $remarques."ATTENTION POSSIBLE DOUBLON DE LA COMMANDE";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg2 = mysql_fetch_array($result2);
$doublon = $enreg2['illinkid'];
$remarques = $remarques." ".$doublon;
}
}
}
// fin de la recherche des doublons

// 
// START save record
//

if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$query ="INSERT INTO `orders` (`illinkid`, `stade`, `localisation`, `date`, `envoye`, `facture`, `renouveler`, `prix`, `prepaye`, `ref`, `arrivee`, `nom`, `prenom`, `service`, `cgra`, `cgrb`, `mail`, `tel`, `adresse`, `code_postal`, `localite`, `type_doc`, `urgent`, `envoi_par`, `titre_periodique`, `annee`, `volume`, `numero`, `supplement`, `pages`, `titre_article`, `auteurs`, `edition`, `isbn`, `issn`, `eissn`, `doi`, `uid`, `remarques`, `remarquespub`, `historique`, `saisie_par`, `bibliotheque`, `refinterbib`, `PMID`, `ip`, `referer`) 
VALUES ('', '$stade', '$localisation', '$date', '$envoye', '$facture', '$renouveler', '$prix', '$prepaye', '$ref', '$source', '$nom', '$prenom', '$service', '$cgra', '$cgrb', '$mail', '$tel', '$adresse', '$postal', '$localite', '$typedoc', '$urgent', '$envoi', '$journal', '$annee', '$vol', '$no', '$suppl', '$pages', '$titre', '$auteurs', '$edition', '$isbn', '$issn', '$eissn', '$doi', '$uid', '$remarques', '$remarquespub', '$historique', '$userid', '$bibliotheque', '$refinterbib', '$pmid', '$ip', '$referer')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$monno = mysql_insert_id();
require ("headeradmin.php");
}
else
{
$query ="INSERT INTO `orders` (`illinkid`, `stade`, `localisation`, `date`, `envoye`, `facture`, `renouveler`, `prix`, `prepaye`, `ref`, `arrivee`, `nom`, `prenom`, `service`, `cgra`, `cgrb`, `mail`, `tel`, `adresse`, `code_postal`, `localite`, `type_doc`, `urgent`, `envoi_par`, `titre_periodique`, `annee`, `volume`, `numero`, `supplement`, `pages`, `titre_article`, `auteurs`, `edition`, `isbn`, `issn`, `eissn`, `doi`, `uid`, `remarques`, `remarquespub`, `historique`, `saisie_par`, `bibliotheque`, `refinterbib`, `PMID`, `ip`, `referer`) 
VALUES ('', '$stade', '$localisation', '$date', '', '', '', '', '', '', '$source', '$nom', '$prenom', '$service', '$cgra', '$cgrb', '$mail', '$tel', '$adresse', '$postal', '$localite', '$typedoc', '2', '$envoi', '$journal', '$annee', '$vol', '$no', '$suppl', '$pages', '$titre', '$auteurs', '$edition', '$isbn', '$issn', '$eissn', '$doi', '$uid', '$remarques', '$remarquespub', '$historique', '$userid', '$bibliotheque', '', '$pmid', '$ip', '$referer')";
$result = mysql_query($query) or die("Error : ".mysql_error());
$monno = mysql_insert_id();
require ("header.php");
}
echo "\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "\n";
echo "<center><b><font color=\"green\">Votre commande a été enregistrée avec succès et sera traitée prochainement</b></center></font>\n";
echo "<div class=\"hr\"><hr></div>\n";
echo "<table align=\"center\">\n";
echo "</td></tr>\n";
echo "<tr><td width=\"90\"><b>Commande</b></td>\n";
echo "<td><b>$monno</b></td></tr>\n";
echo "<tr><td width=\"90\"><b>Nom</b></td>\n";
echo "<td>$nom, $prenom</td></tr>\n";
if ($mail) {
echo "<tr><td width=\"90\"><b>Courriel</b></td>\n";
echo "<td>$mail</td></tr>\n";
}
if ($service) {
echo "<tr><td width=\"90\"><b>Service</b></td>\n";
echo "<td>$service</td></tr>\n";
}
if ($tel) {
echo "<tr><td width=\"90\"><b>Tél.</b></td>\n";
echo "<td>" . stripslashes($tel) . "</td></tr>\n";
}
if ($adresse) {
echo "<tr><td width=\"90\"><b>Adresse</b></td>\n";
echo "<td>" . stripslashes($adresse) . " ; " . stripslashes($postal) . ", " . stripslashes($localite) ."</td></tr>\n";
}
echo "<tr><td width=\"90\"><b>Document</b></td>\n";
echo "<td>$typedoc</td></tr>\n";
if ($titre) {
echo "<tr><td width=\"90\"><b>Titre</b></td>\n";
echo "<td>" . stripslashes($titre) . "</td></tr>\n";
}
if ($auteurs) {
echo "<tr><td width=\"90\"><b>Auteurs</b></td>\n";
echo "<td>" . stripslashes($auteurs) . "</td></tr>\n";
}
if ($typedoc=='Article')
echo "<tr><td width=\"90\"><b>Périodique</b></td>\n";
else
echo "<tr><td width=\"90\"><b>Titre du livre</b></td>\n";
echo "<td>" . stripslashes($journal) . "</td>\n";
echo "</tr><tr>\n";
if ($annee) {
echo "<td width=\"90\"><b>Année</b></td>\n";
echo "<td>$annee</td></tr>\n";
}
if ($vol) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Volume</b></td>\n";
echo "<td>$vol</td></tr>\n";
}
if ($no) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Numéro</b></td>\n";
echo "<td>$no</td></tr>\n";
}
if ($suppl) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Suppl.</b></td>\n";
echo "<td>$suppl</td></tr>\n";
}
if ($pages) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Pages</b></td>\n";
echo "<td>$pages</td></tr>\n";
}
if ($edition) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Edition</b></td>\n";
echo "<td>".stripslashes($edition)."</td></tr>\n";
}
if ($isbn) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>ISBN</b></td>\n";
echo "<td>$isbn</td></tr>\n";
}
if ($issn) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>ISSN</b></td>\n";
echo "<td>$issn</td></tr>\n";
}
if ($eissn) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>eISSN</b></td>\n";
echo "<td>$eissn</td></tr>\n";
}
if ($pmid) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>PMID</b></td>\n";
echo "<td>$pmid</td></tr>\n";
}
if ($doi) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>DOI</b></td>\n";
echo "<td>$doi</td></tr>\n";
}
if ($uid) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>UID</b></td>\n";
echo "<td>$uid</td></tr>\n";
}
if ($remarques) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Commentaire professionnel</b></td>\n";
echo "<td>".stripslashes(nl2br($remarques))."</td></tr>\n";
}
if ($remarquespub) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Commentaire public</b></td>\n";
echo "<td>".stripslashes(nl2br($remarquespub))."</td></tr>\n";
}
echo "</table>\n";
echo "<div class=\"hr\"><hr></div>\n";
echo "<b><center><a href=\"index.php\">Remplir une nouvelle commande</a></center></b>\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
require ("footer.php");
}
?>
