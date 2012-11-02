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
// Order update or delete
//
$id = $_GET['id'];
$action = $_POST['action'];
$action2 = $_GET['action'];
if ($action2 != "")
$action = $action2;
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
// 
// Début de l'édition
//
if ($action == "update")
{
$id = $_POST['id'];
if ($id)
{
require ("connect.php");

$mes="";
$doi="";
$pmid="";
$isbn="";
$issn="";
$eissn="";
$userid=$_POST['userid'];
$action=$_POST['action'];
$stade=$_POST['stade'];
$date=$_POST['datesaisie'];
if ($date=='')
$date=date("Y-m-d");
$date2=date("d/m/Y H:i:s");
$envoye=$_POST['envoye'];
$facture=$_POST['facture'];
$renouveler=$_POST['renouveler'];
// Ajouter un delai de renouvellement d'un mois si status.special = renew et pas de date de renouvellement
$req = "SELECT status.* FROM status WHERE status.special = \"renew\"";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb > 0)
{
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$statuscoderenew = $enreg['code'];
if (($stade==$statuscoderenew) && ($renouveler=='0000-00-00'))
$renouveler = date("Y-m-d", mktime(0, 0, 0, date("m")+1, date("d"), date("Y")));
}
}
// Ajouter la date du jour si status.special = sent
$req = "SELECT status.* FROM status WHERE status.special = \"sent\"";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb > 0)
{
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$statuscodesent = $enreg['code'];
if (($stade==$statuscodesent) && ($envoye=='0000-00-00'))
{
$envoye=date("Y-m-d");
}
}
}
// Ajouter la date du jour si status.special = paid
$req = "SELECT status.* FROM status WHERE status.special = \"paid\"";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb > 0)
{
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$statuscodepaid = $enreg['code'];
if (($stade==$statuscodepaid) && ($facture=='0000-00-00'))
{
$facture=date("Y-m-d");
}
}
}
$localisation=$_POST['localisation'];
$sid=$_POST['sid'];
$pid=$_POST['pid'];
$bibliotheque=$_POST['bibliotheque'];
$source=$_POST['source'];
$nom=addslashes($_POST['nom']);
$prenom=addslashes($_POST['prenom']);
$service=$_POST['service'];
$prix=$_POST['prix'];
$prepaye=$_POST['avance'];
$urgent=$_POST['urgent'];
$ref=$_POST['ref'];
$refinterbib=$_POST['refinterbib'];
$source=$_POST['source'];
$servautre=$_POST['servautre'];
if (($servautre!='') && ($servautre!=$service))
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
$issn='';
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
$modifs=addslashes($_POST['modifs']);
$ip=$_SERVER['REMOTE_ADDR'];
$historique=$_POST['historique'].'<br /> Commande modifiée par ' . $monnom . ' le ' . $date2;
if ($modifs)
$historique=$historique.' ['.$modifs.']';
if (!$_POST['nom'])
  $mes="le nom est obligatoire";
if (!$_POST['title'])
  $mes=$mes."<br>le titre du périodique ou du livre est obligatoire";
if ($mes)
{
require ("headeradmin.php");
echo "\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<center><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire de saisie</a></b></center><br />\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
require ("footer.php");
}
else
{
$query ="UPDATE orders SET stade='$stade', localisation='$localisation', date='$date', envoye='$envoye', facture='$facture', renouveler='$renouveler', prix='$prix', prepaye='$prepaye', ref='$ref', arrivee='$source', nom='$nom', prenom='$prenom', service='$service', cgra='$cgra', cgrb='$cgrb', mail='$mail', tel='$tel', adresse='$adresse', code_postal='$postal', localite='$localite', type_doc='$typedoc', urgent='$urgent', envoi_par='$envoi', titre_periodique='$journal', annee='$annee', volume='$vol', numero='$no', supplement='$suppl', pages='$pages', titre_article='$titre', auteurs='$auteurs', edition='$edition', isbn='$isbn', issn='$issn', eissn='$eissn', doi='$doi', uid='$uid', remarques='$remarques', remarquespub='$remarquespub', historique='$historique', saisie_par='$userid', bibliotheque='$bibliotheque', refinterbib='$refinterbib', PMID='$pmid', ip='$ip' WHERE illinkid=$id";
$result = mysql_query($query) or die("Error : ".mysql_error());
require ("headeradmin.php");
echo "\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "\n";
echo "<center><b><font color=\"green\">Votre commande a été modifiée avec succès</b></center></font>\n";
echo "<div class=\"hr\"><hr></div>\n";
echo "<table align=\"center\">\n";
echo "</td></tr>\n";
echo "<tr><td width=\"90\"><b>Commande</b></td>\n";
echo "<td><b>".$id."</b></td></tr>\n";
echo "<tr><td width=\"90\"><b>Nom</b></td>\n";
echo "<td>".$nom.", ".$prenom."</td></tr>\n";
if ($mail) {
echo "<tr><td width=\"90\"><b>Courriel</b></td>\n";
echo "<td>".$mail."</td></tr>\n";
}
if ($service) {
echo "<tr><td width=\"90\"><b>Service</b></td>\n";
echo "<td>".$service."</td></tr>\n";
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
if ($pmid) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>PMID</b></td>\n";
echo "<td>$pmid</td></tr>\n";
}
if ($doi) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>DOI</b></td>\n";
echo "<td>$doi</td></tr>\n";
}
if ($uid) {
echo "<tr><td  width=\"90\" valign=\"top\"><b>Uuserid</b></td>\n";
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
echo "<b><center><a href=\"detail.php?table=orders&id=".$id."\">Retourner à la fiche de commande</a></center></b>\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
}
}
else
{
require ("headeradmin.php");
require ("loginfail.php");
}
require ("footer.php");

}
// 
// Fin de la modification
//
// Début de la suppresion
//
if ($action == "delete")
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : confirmation pour la suppresion de la commande " . $id;
require ("headeradmin.php");
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement supprimer la fiche " . $id . "?</b></font>\n";
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"table\" type=\"hidden\" value=\"orders\">\n";
echo "<input name=\"id\" type=\"hidden\" value=\"".$id."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"deleteok\">\n";
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression de la fiche " . $id . " en cliquant ici\">\n";
echo "</form>\n";
echo "<br/><br/><br/><a href=\"list.php?table=orders\">Retour à la liste des commandes</a></center>\n";
echo "</center>\n";
echo "\n";
}
else
{
require ("headeradmin.php");
require ("loginfail.php");
}
require ("footer.php");
}

// Confimation de la suppresion
if ($action == "deleteok")
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$id = $_POST['id'];
$myhtmltitle = $configname[$lang] . " : suppresion de la commande " . $id;
require ("connect.php");
require ("headeradmin.php");
$query = "DELETE FROM orders WHERE orders.illinkid = '$id'";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La fiche " . $id . " a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=orders\">Retour à la liste des commandes</a></center>\n";
echo "</center>\n";
echo "\n";
}
else
{
require ("headeradmin.php");
require ("loginfail.php");
}
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
