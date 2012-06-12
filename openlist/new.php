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
// Table journals : formulaire de création d'une nouvelle fiche
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$pagetitle = "Revues de " . $configinstitution . " : nouvelle fiche";
require ("header.php");
require ("menurech.php");
echo "<br /></b>";
echo "<ul>\n";
// $enreg = mysql_fetch_array($result);
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
echo "<form action=\"update.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"journalsid\" type=\"hidden\" value=\"".$journalsid."\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"new\">\n";
echo "<input name=\"time\" type=\"hidden\" value=\"" . time() ."\">\n";
echo "<input name=\"modifs\" type=\"hidden\" value=\"\">\n";
echo "<b><font color=\"red\">Nouvelle fiche</font></b>\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer la fiche\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='index.php'\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
// border=\"0\" cellpadding=\"0\" cellspacing=\"0\" 
// 
// Champs bibliographiques
// 
echo "<tr><td class=\"odd\"><b>Titre *</b></td><td class=\"odd\"><input name=\"titre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Sous titre</b></td><td><input name=\"soustitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre abregé</b></td><td class=\"odd\"><input name=\"titreabrege\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Variante de titre</b></td><td><input name=\"variantetitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Fait suite à</b></td><td class=\"odd\"><input name=\"faitsuitea\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Devient</b></td><td><input name=\"devient\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Editeur</b></td><td class=\"odd\"><input name=\"editeur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Code de la revue chez l'éditeur</b></td><td><input name=\"codeediteur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Publication institutionnelle</b></td><td class=\"odd\"><input type=\"radio\" name=\"publiinst\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"publiinst\" value=\"0\" checked/> Non</td></tr>\n";
echo "<tr><td><b>Open Access</b></td><td><input type=\"radio\" name=\"openaccess\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"openaccess\" value=\"0\"  checked/> Non</td></tr>\n";
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
echo "<tr><td class=\"odd\"><b>Abonnement / Licence *</b></td><td class=\"odd\">\n";
echo "<select name=\"licence\" id=\"licence\" onchange=\"ajoutevaleur('licence');\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslicence;
echo "<option value=\"new\">Ajouter une valeur...</option>\n";
echo "</select>\n";
echo "&nbsp;<input name=\"licencenew\" id=\"licencenew\" type=\"text\" size=\"30\" value=\"\" style=\"display:none\">\n";
echo "</td></tr>\n";
echo "<tr><td><b>Statut de l'abonnement * </b></td>\n";
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
echo "<tr><td class=\"odd\"><b>Titre exclu de la licence</b></td><td class=\"odd\"><input type=\"radio\" name=\"titreexclu\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"titreexclu\" value=\"0\" checked/> Non</td></tr>\n";
echo "<tr><td><b>Core collection</b></td><td><input type=\"radio\" name=\"corecollection\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"corecollection\" value=\"0\" checked/> Non</td></tr>\n";
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
echo "<tr><td><b>Support *</b></td><td>\n";
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
for ($i=0 ; $i<10 ; $i++)
{
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
$optionsthemesliste.="<option value=\"" . $idthemesliste . "\">" . $namethemesliste . "</option>\n";
}
$themei = $i+1;
if ($i % 2 == 0)
$styleodd = "";
else
$styleodd = " class=\"odd\"";
echo "<tr><td" . $styleodd . "><b>Thème</b></td><td" . $styleodd . ">\n";
echo "<select name=\"theme" . $themei . "\" id=\"theme" . $themei . "\">\n";
echo "<option value=\"\"></option>\n";
echo "<optgroup label=\"Sciences humaines\">\n";
echo $optionsthemesliste;
echo "</select>\n";
echo "</td></tr>\n";
}
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Enregistrer la fiche\">\n";
echo "&nbsp;&nbsp;<input type=\"button\" value=\"Annuler\" onClick=\"self.location='index.php'\"></td></tr>\n";
echo "</table>\n";
echo "</form>\n";
echo "<br /><br />\n";
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
