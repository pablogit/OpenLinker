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
// Table journals : création ou modification d'un enregistrement
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$id=addslashes($_POST['journalsid']);
$action=addslashes($_POST['action']);
$mes="";
$date=date("Y-m-d H:i:s");
$journalsid = addslashes($_POST['journalsid']);
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
if (!$etatcollfina)
$etatcollfina = "999999";
$etatcollfinv = addslashes($_POST['etatcollfinv']);
if (!$etatcollfinv)
$etatcollfinv = "999999";
$etatcollfinf = addslashes($_POST['etatcollfinf']);
if (!$etatcollfinf)
$etatcollfinf = "999999";
$embargo = addslashes($_POST['embargo']);
$url = $_POST['url'];
$rss = $_POST['rss'];
$acceselecinst1 = addslashes($_POST['acceselecinst1']);
if ($acceselecinst1 != "1")
$acceselecinst1 = "0";
$acceselecinst2 = addslashes($_POST['acceselecinst2']);
if ($acceselecinst2 != "1")
$acceselecinst2 = "0";
$acceseleclibre = addslashes($_POST['acceseleclibre']);
if ($acceseleclibre != "1")
$acceseleclibre = "0";
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
$time = addslashes($_POST['time']);
$timenow = time();
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
$modifs=addslashes($_POST['modifs']);
$historique = "Fiche modifiée par " . $monlog . " le " . $date . " : " . $modifs . " | ";
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

if ($titre == "")
$mes = $mes . "<br/>le titre est obligatoire";
if ($support == "")
$mes = $mes . "<br/>le support est obligatoire";
if ($licence == "")
$mes = $mes . "<br/>la licence est obligatoire";
if ($statutabo == "")
$mes = $mes . "<br/>le statut de l'abonnement est obligatoire";
if ($mes != "")
{
require ("header.php");
require ("menurech.php");
echo "<center><br/><b><font color=\"red\">\n";
echo $mes."</b></font>\n";
echo "<br /><br /><a href=\"javascript:history.back();\"><b>retour au formulaire</a></b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{
// 
// Début de l'édition
//
if ($action == "update")
{
if ($id != "")
{
require ("connexion.php");
require ("header.php");
require ("menurech.php");
$reqid = "SELECT journalsid, time, historique FROM journals WHERE journals.journalsid = '$id'";
$pagetitle = "Revues de " . $configinstitution . " : édition de la fiche " . $id;
$resultid = mysql_query($reqid,$link);
$nb = mysql_num_rows($resultid);
if ($nb == 1)
{
$enregid = mysql_fetch_array($resultid);
$timeenreg = $enregid['time'];
$historique = $enregid['historique'] . $historique;
if (($timeenreg == "") || ($timeenreg < $time))
{
$query ="UPDATE journals SET titre='$titre', titreabrege='$titreabrege', variantetitre='$variantetitre', issn='$issn', issnl='$issnl', nlmid='$nlmid', catalogid='$catalogid', doi='$doi', coden='$coden', urn='$urn', openaccess='$openaccess', publiinst='$publiinst', faitsuitea='$faitsuitea', devient='$devient', editeur='$editeur', etatcoll='$etatcoll', etatcolldeba='$etatcolldeba', etatcolldebv='$etatcolldebv', etatcolldebf='$etatcolldebf', etatcollfina='$etatcollfina', etatcollfinv='$etatcollfinv', etatcollfinf='$etatcollfinf', embargo='$embargo', url='$url', rss='$rss', acceselecinst1='$acceselecinst1', acceselecinst2='$acceselecinst2', acceseleclibre='$acceseleclibre', titreexclu='$titreexclu', support='$support', licence='$licence', plateforme='$plateforme', gestion='$gestion', historiqueabo='$historiqueabo', statutabo='$statutabo', cote='$cote', localisation='$localisation', user='$user', pwd='$pwd', keywords='$keywords', commentairepro='$commentairepro', commentairepub='$commentairepub', signaturemodif='$monlog', datemodif='$date', soustitre='$soustitre', format='$format', time='$timenow', historique='$historique', package='$package', corecollection='$corecollection', idediteur='$idediteur', codeediteur='$codeediteur' WHERE journalsid=$id";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
$query ="DELETE FROM journals_sujets WHERE journals_sujets.journalsid = '$id'";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
if ($theme1)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme1')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme2)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme2')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme3)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme3')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme4)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme4')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme5)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme5')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme6)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme6')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme7)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme7')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme8)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme8')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme9)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme9')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme10)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme10')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
echo "<center><br/><b><font color=\"green\">\n";
echo "La modification de la fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/></center>\n";
$req = "SELECT * FROM journals WHERE journals.journalsid = '$id'";
$result = mysql_query($req,$link);
$enreg = mysql_fetch_array($result);
require ("fichecomp.php");
}
else
{
echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car la fiche " . $id . " a été modifié par une autre personne pendant l'intervalle.</b></font>\n";
echo "<br /><br /><a href=\"edit.php?id=" . $id . "\"><b>Cliquez ici pour éditer de nouveau la fiche dans son nouvel état</a></b></center><br /><br /><br /><br />\n";
}
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
else
{

echo "<center><br/><b><font color=\"red\">\n";
echo "La modification n'a pas été enregistrée car l'identifiant de la fiche " . $id . " n'a pas été trouvée dans la base.</b></font>\n";
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
echo "La modification n'a pas été enregistrée car il manque l'identifiant de la fiche</b></font>\n";
echo "<br /><br /><b>Veuillez relancer de nouveau votre recherche</b></center><br /><br /><br /><br />\n";
echo "</div>\n";
echo "</div>\n";
require ("footer.php");
}
}
// 
// Fin de l'édition
//
// Début de la duplication
//
if ($action == "new")
{
require ("connexion.php");
require ("header.php");
require ("menurech.php");
$signaturecreation=$monlog;
$datecreation=$date;
$pagetitle = "Revues de " . $configinstitution . " : nouvelle fiche " . $id;
$query ="INSERT INTO `journals` (`journalsid`, `titre`, `titreabrege`, `variantetitre`, `issn`, `issnl`, `nlmid`, `catalogid`, `doi`, `coden`, `urn`, `openaccess`, `publiinst`, `faitsuitea`, `devient`, `editeur`, `etatcoll`, `etatcolldeba`, `etatcolldebv`, `etatcolldebf`, `etatcollfina`, `etatcollfinv`, `etatcollfinf`, `embargo`, `url`, `rss`, `acceselecinst1`, `acceselecinst2`, `acceseleclibre`, `titreexclu`, `support`, `licence`, `plateforme`, `gestion`, `historiqueabo`, `statutabo`, `cote`, `localisation`, `user`, `pwd`, `keywords`, `commentairepro`, `commentairepub`, `signaturecreation`, `datecreation`, `soustitre`, `format`, `time`, `package`, `corecollection`, `idediteur`, `codeediteur`) VALUES ('', '$titre', '$titreabrege', '$variantetitre', '$issn', '$issnl', '$nlmid', '$catalogid', '$doi', '$coden', '$urn', '$openaccess', '$publiinst', '$faitsuitea', '$devient', '$editeur', '$etatcoll', '$etatcolldeba', '$etatcolldebv', '$etatcolldebf', '$etatcollfina', '$etatcollfinv', '$etatcollfinf', '$embargo', '$url', '$rss', '$acceselecinst1', '$acceselecinst2', '$acceseleclibre', '$titreexclu', '$support', '$licence', '$plateforme', '$gestion', '$historiqueabo', '$statutabo', '$cote', '$localisation', '$user', '$pwd', '$keywords', '$commentairepro', '$commentairepub', '$signaturecreation', '$datecreation', '$soustitre', '$format', '$time', '$package', '$corecollection', '$idediteur', '$codeediteur')";

$result = mysql_query($query) or die("Error : ".mysql_error());
$id = mysql_insert_id();
if ($theme1)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme1')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme2)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme2')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme3)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme3')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme4)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme4')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme5)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme5')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme6)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme6')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme7)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme7')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme8)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme8')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme9)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme9')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
if ($theme10)
{
$query ="INSERT INTO `journals_sujets` (`id`, `journalsid`, `sujetsid`) VALUES ('', '$id', '$theme10')";
$resultupdate = mysql_query($query) or die("Error : ".mysql_error());
}
echo "<center><br/><b><font color=\"green\">\n";
echo "La nouvelle fiche " . $id . " a été enregistrée avec succès</b></font>\n";
echo "<br/><br/></center>\n";
$req = "SELECT * FROM journals WHERE journals.journalsid = '$id'";
$result = mysql_query($req,$link);
$enreg = mysql_fetch_array($result);
require ("fichecomp.php");
echo "</center>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
// echo "encodage : " . $charset;
echo "\n";
echo "\n";
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
echo "\n";
require ("footer.php");
}
// 
// Fin de la saisie
//
}
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
