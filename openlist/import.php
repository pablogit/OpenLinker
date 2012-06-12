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
// Table journals : formulaire de recherche administrateur
require ("config.php");
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$inputab=$_POST['inputab'];
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("connexion.php");
$req2 = "SELECT journalsid FROM journals";
$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$pagetitle = "Revues de " . $configinstitution . " : recherche administrateur";
require ("header.php");
// require ("menurech.php");
echo "<br /></b>";
echo "<ul>\n";
$reqlicence="SELECT licence FROM journals GROUP BY licence";
$optionslicence="";
$resultlicence = mysql_query($reqlicence,$link);
while ($rowlicence = mysql_fetch_array($resultlicence))
{
$namelicence = $rowlicence["licence"];
$optionslicence.="<option value=\"" . $namelicence . "\">" . $namelicence . "</option>\n";
}
$reqplateforme="SELECT plateforme FROM journals GROUP BY plateforme";
$optionsplateforme="";
$resultplateforme = mysql_query($reqplateforme,$link);
while ($rowplateforme = mysql_fetch_array($resultplateforme))
{
$nameplateforme = $rowplateforme["plateforme"];
$optionsplateforme.="<option value=\"" . $nameplateforme . "\">" . $nameplateforme . "</option>\n";
}
$reqgestion="SELECT gestion FROM journals GROUP BY gestion";
$optionsgestion="";
$resultgestion = mysql_query($reqgestion,$link);
while ($rowgestion = mysql_fetch_array($resultgestion))
{
$namegestion = $rowgestion["gestion"];
$optionsgestion.="<option value=\"" . $namegestion . "\">" . $namegestion . "</option>\n";
}
$reqhistoriqueabo="SELECT historiqueabo FROM journals GROUP BY historiqueabo";
$optionshistoriqueabo="";
$resulthistoriqueabo = mysql_query($reqhistoriqueabo,$link);
while ($rowhistoriqueabo = mysql_fetch_array($resulthistoriqueabo))
{
$namehistoriqueabo = $rowhistoriqueabo["historiqueabo"];
$optionshistoriqueabo.="<option value=\"" . $namehistoriqueabo . "\">" . $namehistoriqueabo . "</option>\n";
}
$reqlocalisation="SELECT localisation FROM journals GROUP BY localisation";
$optionslocalisation="";
$resultlocalisation = mysql_query($reqlocalisation,$link);
while ($rowlocalisation = mysql_fetch_array($resultlocalisation))
{
$namelocalisation = $rowlocalisation["localisation"];
$optionslocalisation.="<option value=\"" . $namelocalisation . "\">" . $namelocalisation . "</option>\n";
}
$reqformat="SELECT format FROM journals GROUP BY format";
$optionsformat="";
$resultformat = mysql_query($reqformat,$link);
while ($rowformat = mysql_fetch_array($resultformat))
{
$nameformat = $rowformat["format"];
$optionsformat.="<option value=\"" . $nameformat . "\">" . $nameformat . "</option>\n";
}
$reqsupport="SELECT support FROM journals GROUP BY support";
$optionssupport="";
$resultsupport = mysql_query($reqsupport,$link);
while ($rowsupport = mysql_fetch_array($resultsupport))
{
$namesupport = $rowsupport["support"];
$optionssupport.="<option value=\"" . $namesupport . "\">" . $namesupport . "</option>\n";
}
$reqsignaturecreation="SELECT signaturecreation FROM journals GROUP BY signaturecreation";
$optionssignaturecreation="";
$resultsignaturecreation = mysql_query($reqsignaturecreation,$link);
while ($rowsignaturecreation = mysql_fetch_array($resultsignaturecreation))
{
$namesignaturecreation = $rowsignaturecreation["signaturecreation"];
$optionssignaturecreation.="<option value=\"" . $namesignaturecreation . "\">" . $namesignaturecreation . "</option>\n";
}
$reqsignaturemodif="SELECT signaturemodif FROM journals GROUP BY signaturemodif";
$optionssignaturemodif="";
$resultsignaturemodif = mysql_query($reqsignaturemodif,$link);
while ($rowsignaturemodif = mysql_fetch_array($resultsignaturemodif))
{
$namesignaturemodif = $rowsignaturemodif["signaturemodif"];
$optionssignaturemodif.="<option value=\"" . $namesignaturemodif . "\">" . $namesignaturemodif . "</option>\n";
}
//
// Convert csv file to associative array:
//

    function parsecsv($input, $delimiter = '	', $enclosure = '', $escape = '\\', $eol = '\n') {
        if (is_string($input) && !empty($input)) {
            $output = array();
            $tmp    = preg_split("/".$eol."/",$input);
            if (is_array($tmp) && !empty($tmp)) {
                while (list($line_num, $line) = each($tmp)) {
                    if (preg_match("/".$escape.$enclosure."/",$line)) {
                        while ($strlen = strlen($line)) {
                            $pos_delimiter       = strpos($line,$delimiter);
                            $pos_enclosure_start = strpos($line,$enclosure);
                            if (
                                is_int($pos_delimiter) && is_int($pos_enclosure_start)
                                && ($pos_enclosure_start < $pos_delimiter)
                                ) {
                                $enclosed_str = substr($line,1);
                                $pos_enclosure_end = strpos($enclosed_str,$enclosure);
                                $enclosed_str = substr($enclosed_str,0,$pos_enclosure_end);
                                $output[$line_num][] = $enclosed_str;
                                $offset = $pos_enclosure_end+3;
                            } else {
                                if (empty($pos_delimiter) && empty($pos_enclosure_start)) {
                                    $output[$line_num][] = substr($line,0);
                                    $offset = strlen($line);
                                } else {
                                    $output[$line_num][] = substr($line,0,$pos_delimiter);
                                    $offset = (
                                                !empty($pos_enclosure_start)
                                                && ($pos_enclosure_start < $pos_delimiter)
                                                )
                                                ?$pos_enclosure_start
                                                :$pos_delimiter+1;
                                }
                            }
                            $line = substr($line,$offset);
                        }
                    } else {
                        $line = preg_split("/".$delimiter."/",$line);
   
                        /*
                         * Validating against pesky extra line breaks creating false rows.
                         */
                        if (is_array($line) && !empty($line[0])) {
                            $output[$line_num] = $line;
                        } 
                    }
                }
                return $output;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

if ($inputab)
{
$inputparsed = parsecsv($inputab); 
echo "première ligne : " . $inputparsed[0][0] . " | " . $inputparsed[0][1] . " | " . $inputparsed[0][2];
echo "<br/>";
echo "<br/>";
$dataSetCount = count($inputparsed);
echo "<h1>nombre de lignes : $dataSetCount </h1>";   

$i = 0;
foreach ($inputparsed as $each_inputparsed)
{
$i++;
echo "<h2>Ligne $i</h2>";
foreach ($each_inputparsed as $position => $details)
{
echo "<b>$position</b>" . ": " . $details . "<br />";
}
}



}
else
{
echo "<form action=\"import.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"import\" id=\"import\">\n";
echo "<textarea name=\"inputab\" rows=\"10\" cols=\"80\" wrap=\"off\">\n";
echo "</textarea>\n";
echo "<br/>";
echo "<input type=\"submit\" value=\"Importer\">\n";
echo "&nbsp;&nbsp;<input type=\"reset\" value=\"Annuler\"></td></tr>\n";
echo "</form>\n";
}

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<form action=\"search.php\" method=\"GET\" enctype=\"x-www-form-encoded\" name=\"adminsearch\" id=\"adminsearch\">\n";
echo "<input name=\"search\" type=\"hidden\" value=\"admin\">\n";
echo "<b>Recherche administrateur sur un total de " . $total_results . " fiches</b><br/><br/>\n";
echo "<table id=\"hor-zebra\">\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Chercher\">\n";
echo "&nbsp;&nbsp;<input type=\"reset\" value=\"Annuler\"></td></tr>\n";
// echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
// border=\"0\" cellpadding=\"0\" cellspacing=\"0\" 
// 
// Champs bibliographiques
// 
echo "<tr><td class=\"odd\"><b>journalsid</b></td><td class=\"odd\">";
echo "<select name=\"journalsidcrit1\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"journalsid1\" type=\"text\" size=\"10\" value=\"\">\n";
echo "&nbsp;&nbsp;Et&nbsp;&nbsp;";
echo "<select name=\"journalsidcrit2\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"journalsid2\" type=\"text\" size=\"10\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Tous les champs</b></td><td><input name=\"allfields\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre</b></td><td class=\"odd\"><input name=\"titre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Sous titre</b></td><td><input name=\"soustitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Titre abregé</b></td><td class=\"odd\"><input name=\"titreabrege\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Variante de titre</b></td><td><input name=\"variantetitre\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Fait suite à</b></td><td class=\"odd\"><input name=\"faitsuitea\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Devient</b></td><td><input name=\"devient\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Editeur</b></td><td class=\"odd\"><input name=\"editeur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Code de la revue chez l'éditeur</b></td><td><input name=\"codeediteur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Publication Institutionnelle</b></td><td class=\"odd\"><input type=\"radio\" name=\"publiinst\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"publiinst\" value=\"0\" /> Non</td></tr>\n";
echo "<tr><td><b>Open Access</b></td><td><input type=\"radio\" name=\"openaccess\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"openaccess\" value=\"0\" /> Non</td></tr>\n";
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
echo "<select name=\"licence\" id=\"licence\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslicence;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Statut de l'abonnement</b></td><td>\n";
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
echo "<tr><td class=\"odd\"><b>Titre exclu de la licence</b></td><td class=\"odd\"><input type=\"radio\" name=\"titreexclu\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"titreexclu\" value=\"0\" /> Non</td></tr>\n";
echo "<tr><td><b>Core collection</b></td><td><input type=\"radio\" name=\"corecollection\" value=\"1\" /> Oui  |  <input type=\"radio\" name=\"corecollection\" value=\"0\" /> Non</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Plateforme</b></td><td class=\"odd\">\n";
echo "<select name=\"plateforme\" id=\"plateforme\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsplateforme;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Gestion</b></td><td>\n";
echo "<select name=\"gestion\" id=\"gestion\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsgestion;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Historique de l'abonnement</b></td><td class=\"odd\">\n";
echo "<select name=\"historiqueabo\" id=\"historiqueabo\">\n";
echo "<option value=\"\"></option>\n";
echo $optionshistoriqueabo;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Support</b></td><td>\n";
echo "<select name=\"support\" id=\"support\">\n";
echo "<option value=\"\"></option>\n";
echo $optionssupport;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Format</b></td><td class=\"odd\">\n";
echo "<select name=\"format\" id=\"format\">\n";
echo "<option value=\"\"></option>\n";
echo $optionsformat;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Accès électronique</b></td><td>\n";
echo "<input type=\"checkbox\" name=\"acceselecinst1\" value=\"1\"/> " . $configinstitution . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceselecinst2\" value=\"1\"/> " . $configinstitution2 . "\n";
echo "  |  <input type=\"checkbox\" name=\"acceseleclibre\" value=\"1\"/> Libre\n";
echo "<tr><td class=\"odd\"><b>Nom du package</b></td><td class=\"odd\"><input name=\"package\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>No d'abonnement</b></td><td><input name=\"idediteur\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Etat de collection</b></td><td class=\"odd\"><input name=\"etatcoll\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Embargo</b></td><td>";
echo "<select name=\"embargocrit\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"embargo\" type=\"text\" size=\"10\" value=\"\"> (nombre de mois)</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Début de la collection</b></td>\n";
echo "<td class=\"odd\">Année <input name=\"etatcolldeba\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Volume <input name=\"etatcolldebv\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Numéro <input name=\"etatcolldebf\" type=\"text\" size=\"5\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Fin de la collection</b></td>\n";
echo "<td>Année <input name=\"etatcollfina\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Volume <input name=\"etatcollfinv\" type=\"text\" size=\"5\" value=\"\">\n";
echo " | Numéro <input name=\"etatcollfinf\" type=\"text\" size=\"5\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Localisation</b></td><td class=\"odd\">\n";
echo "<select name=\"localisation\" id=\"localisation\">\n";
echo "<option value=\"\"></option>\n";
echo $optionslocalisation;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Cote (papier)</b></td><td><input name=\"cote\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Commentaire professionnel</b></td><td class=\"odd\"><input name=\"commentairepro\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>Commentaire publique</b></td><td><input name=\"commentairepub\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Keywords</b></td><td class=\"odd\"><input name=\"keywords\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
for ($i=0 ; $i<1 ; $i++)
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
// echo "<select name=\"theme" . $themei . "\" id=\"theme" . $themei . "\">\n";
echo "<select name=\"theme\" id=\"theme\">\n";
echo "<option value=\"\"></option>\n";
echo "<optgroup label=\"Sciences humaines\">\n";
echo $optionsthemesliste;
echo "</select>\n";
echo "</td></tr>\n";
}
echo "<tr><td class=\"odd\"><b>Sujets importés</b></td><td class=\"odd\"><input name=\"sujetsfm\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td><b>No de fiche importée</b></td><td><input name=\"fmid\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Signature de création</b></td><td class=\"odd\">";
echo "<select name=\"signaturecreation\" id=\"signaturecreation\">\n";
echo "<option value=\"\"></option>\n";
echo $optionssignaturecreation;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td><b>Signature de modification</b></td><td>";
echo "<select name=\"signaturemodif\" id=\"signaturemodif\">\n";
echo "<option value=\"\"></option>\n";
echo $optionssignaturemodif;
echo "</select>\n";
echo "</td></tr>\n";
echo "<tr><td class=\"odd\"><b>Date de création</b></td><td class=\"odd\">";
echo "<select name=\"datecreationcrit1\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"datecreation1\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "&nbsp;&nbsp;Et&nbsp;&nbsp;";
echo "<select name=\"datecreationcrit2\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"datecreation2\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\"></td></tr>\n";
echo "<tr><td><b>Date de modification</b></td><td>";
echo "<select name=\"datemodifcrit1\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"datemodif1\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\">\n";
echo "&nbsp;&nbsp;Et&nbsp;&nbsp;";
echo "<select name=\"datemodifcrit2\">\n";
echo "<option value=\"equal\">=</option>\n";
echo "<option value=\"before\"><</option>\n";
echo "<option value=\"after\">></option>\n";
echo "</select>&nbsp;&nbsp;\n";
echo "<input name=\"datemodif2\" type=\"text\" size=\"10\" value=\"\" class=\"tcal\"></td></tr>\n";
echo "<tr><td class=\"odd\"><b>Historique de modifications</b></td><td class=\"odd\"><input name=\"historique\" type=\"text\" size=\"60\" value=\"\"></td></tr>\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
echo "<tr><td></td><td><input type=\"submit\" value=\"Chercher\">\n";
echo "&nbsp;&nbsp;<input type=\"reset\" value=\"Annuler\"></td></tr>\n";
echo "</table>\n";
echo "</form><br /><br />\n";
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
