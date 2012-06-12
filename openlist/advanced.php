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
// Table journals : formulaire de recherche avancée
require ("config.php");
$pagetitle = "Revues de " . $configinstitution . " : recherche avancée";
require ("header.php");
require ("initiales.php");
require ("connexion.php");
echo "\n";
echo "<br/><br/>\n";
echo "<center>\n";
echo "\n";
echo "<div id=\"rechercheavancee\">\n";
echo "<form action=\"search.php\" method=\"get\" enctype=\"x-www-form-encoded\" name=\"recherche\" onsubmit=\"return check_search()\">\n";
echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\">\n";
echo "<tr><td></td><td>\n";
echo "<a href=\"index.php\" alt=\"recherche rapide\">Recherche rapide</a>&nbsp; | &nbsp; <b>Recherche avancée</b>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
{
echo " | <a href=\"adminsearch.php\">Recherche administrateur</a>\n";
}
echo "<br/>\n";
echo "<br/>\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<b>Tous les champs : &nbsp;</b></td><td>\n";
echo "<input name=\"allfields\" type=\"text\" size=\"50\" value=\"\">\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<b>Titre : &nbsp;</b></td><td>\n";
echo "<input name=\"title\" id=\"title\" type=\"text\" size=\"50\" value=\"\">\n";
echo "<input name=\"search\" type=\"hidden\" value=\"advanced\">\n";
echo "</td></tr>\n";
echo "<tr><td></td><td>\n";
echo "<input type=\"radio\" name=\"field\" value=\"title\" checked/> mots du titre\n";
echo " | <input type=\"radio\" name=\"field\" value=\"tbegin\"/> début du titre\n";
echo " | <input type=\"radio\" name=\"field\" value=\"texact\"/> titre exact\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<b>Editeur : &nbsp;</b></td><td>\n";
echo "<input name=\"publisher\" type=\"text\" size=\"50\" value=\"\">\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>ISSN</b> (ex. 1939-1234) <b>:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>\n";
echo "<input name=\"issn\" type=\"text\" size=\"50\" value=\"\">\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Format : &nbsp;</b></td><td>\n";
echo "<input type=\"radio\" name=\"format\" value=\"all\" checked/> tous  \n";
echo "|  <input type=\"radio\" name=\"format\" value=\"e\" /> électroniques  \n";
echo "|  <input type=\"radio\" name=\"format\" value=\"p\"/> imprimés \n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Accès électronique : &nbsp;</b></td><td>\n";
echo "<input type=\"checkbox\" name=\"accessinst\" value=\"1\" checked/> abonnements institutionnels | \n";
echo "<input type=\"checkbox\" name=\"accesslibre\" value=\"1\" checked/> périodiques gratuits ou Open Access\n";
echo "\n";
// echo "<tr><td>\n";
// echo "<b>Politique éditoriale : &nbsp;</b></td><td>\n";
// echo "<input type=\"checkbox\" name=\"oa\" value=\"1\"/> Open Access\n";
// echo "\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Thème : &nbsp;</b></td><td>\n";
echo "\n";
echo "<select name=\"sujet\">\n";
echo "<option value=\"\">Tous</option>\n";
echo "<optgroup label=\"Sciences humaines\">\n";
$reqthemesliste="SELECT sujetsfr, sujetsid, sujetsshs, sujetsstm FROM sujets ORDER BY sujetsshs DESC, sujetsfr ASC";
$resultthemesliste = mysql_query($reqthemesliste,$link);
$stmthemesliste = "1";
while ($rowthemesliste = mysql_fetch_array($resultthemesliste))
{
$namethemesliste = $rowthemesliste["sujetsfr"];
$idthemesliste = $rowthemesliste["sujetsid"];
$shsthemesliste = $rowthemesliste["sujetsshs"];
if (($shsthemesliste == "0") && ($stmthemesliste == "1"))
{
echo "<optgroup label=\"Sciences biomédicales\">\n";
$stmthemesliste = "0";
}
echo "<option value=\"" . $idthemesliste . "\">" . $namethemesliste . "</option>\n";
}
// require ("themesform.php");
echo "</select>\n";
echo "</td></tr>\n";
echo "\n";
echo "\n";
// echo "<tr><td>\n";
// echo "<b>Thème 2 : &nbsp;</b></td><td>\n";
// echo "\n";
// echo "<select name=\"sujet2\">\n";
// require ("themesform.php");
// echo "</select>\n";
// echo "</td></tr>\n";
// echo "\n";
// echo "\n";
// echo "<tr><td>\n";
// echo "<b>Thème 3 : &nbsp;</b></td><td>\n";
// echo "\n";
// echo "<select name=\"sujet3\">\n";
// require ("themesform.php");
// echo "</select>\n";
// echo "</td></tr>\n";
// echo "\n";
// Début des champs de gestion
echo "<tr><td></td><td>\n";
echo "<div id=\"nochampsgestion\" style=\"position:relative; z-index:9; visibility:visible; display:block;\">\n";
echo "<a href=\"javascript:hidediv('nochampsgestion');showdiv('champsgestion');showdiv('leschampsgestion');\" alt=\"afficher les champs de gestion\" class=\"linkthemes\"><img src=\"img/collapsed.gif\"> Champs de gestion</a><br/>\n";
echo "</div>\n";
echo "<div id=\"champsgestion\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<a href=\"javascript:hidediv('champsgestion');showdiv('nochampsgestion');hidediv('leschampsgestion');\" alt=\"cacher les champs de gestion\" class=\"linkthemes\"><img src=\"img/expanded.gif\"> Champs de gestion</a><br/>\n";
echo "</div>\n";
echo "</td></tr>\n";
echo "<tr><td colspan=\"2\">\n";
echo "<div id=\"leschampsgestion\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<table border=\"0\" cellpadding=\"5\" cellspacing=\"0\">\n";
echo "<tr><td>\n";
echo "<b>Plateforme : </b></td><td>\n";
echo "<select name=\"platform\">\n";
echo "<option value=\"\">Toutes</option>\n";
$reqplateforme="SELECT plateforme FROM journals WHERE plateforme != '' GROUP BY plateforme";
$resultplateforme = mysql_query($reqplateforme,$link);
while ($rowplateforme = mysql_fetch_array($resultplateforme))
{
echo "<option value=\"" . $rowplateforme["plateforme"] . "\">" . $rowplateforme["plateforme"] . "</option>\n";
}
echo "</select>\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Abonnement / Licence : </b></td><td>\n";
echo "<select name=\"licence\">\n";
echo "<option value=\"\">Toutes</option>\n";
$reqlicence="SELECT licence FROM journals GROUP BY licence";
$resultlicence = mysql_query($reqlicence,$link);
while ($rowlicence = mysql_fetch_array($resultlicence))
{
echo "<option value=\"" . $rowlicence["licence"] . "\">" . $rowlicence["licence"] . "</option>\n";
}
echo "</select>\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Statut de l'abonnement : </b></td><td>\n";
echo "<select name=\"statut\">\n";
echo "<option value=\"\">Tous</option>\n";
echo "<option value=\"1\">Actif</option>\n";
echo "<option value=\"0\">Terminé</option>\n";
echo "<option value=\"2\">En test</option>\n";
echo "<option value=\"3\">Pardu</option>\n";
echo "<option value=\"4\">En panne</option>\n";
echo "<option value=\"5\">Gestion provisoire</option>\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Localisation : </b></td><td>\n";
echo "<select name=\"localisation\">\n";
echo "<option value=\"\">Toutes</option>\n";
$reqlocalisation="SELECT localisation FROM journals WHERE localisation != '' GROUP BY localisation";
$resultlocalisation = mysql_query($reqlocalisation,$link);
while ($rowlocalisation = mysql_fetch_array($resultlocalisation))
{
echo "<option value=\"" . $rowlocalisation["localisation"] . "\">" . $rowlocalisation["localisation"] . "</option>\n";
}
// echo "<option value=\"BCUD\">BCUD</option>\n";
// echo "<option value=\"BCUR\">BCUR</option>\n";
// echo "<option value=\"BCUE\">BCUE</option>\n";
// echo "<option value=\"Biochimie\">Biochimie</option>\n";
// echo "<option value=\"Biologie\">Biologie</option>\n";
// echo "<option value=\"BiUM\">BiUM</option>\n";
// echo "<option value=\"BPUL\">BPUL</option>\n";
// echo "<option value=\"CDSP\">CDSP</option>\n";
// echo "<option value=\"IST\">IST</option>\n";
// echo "<option value=\"IUHMSP\">IUHMSP</option>\n";
// echo "<option value=\"IUMSP\">IUMSP</option>\n";
// echo "<option value=\"MUBO\">Musée botanique</option>\n";
// echo "<option value=\"MZ\">Musée zoologique</option>\n";
// echo "<option value=\"CDCE\">Centre de droit comparé et européen</option>\n";
// echo "<option value=\"DROIT\">Institut de droit public</option>\n";
// echo "<option value=\"ISA\">Institut des sciences actuarielles</option>\n";
// echo "<option value=\"ST\">Sciences de la Terre</option>\n";
echo "</select>\n";
echo "</td></tr>\n";
echo "\n";
echo "<tr><td>\n";
echo "<b>Cote : </b></td><td>\n";
echo "<input name=\"cote\" type=\"text\" size=\"50\" value=\"\">\n";
echo "</td></tr></table>\n";
echo "</div>\n";
echo "</td></tr>\n";
// Fin des champs de gestion
echo "\n";
echo "\n";
echo "\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;\n";
echo "</td></tr>\n";
echo "<tr><td></td><td>\n";
echo "<input type=\"submit\" value=\"Rechercher\">\n";
echo " &nbsp;<input type=\"reset\" value=\"Annuler\">\n";
echo "</td></tr></table></form>\n";
echo "</div>\n";
echo "</center>\n";
echo "\n";
echo "\n";
echo "<br/><br/><br/>\n";
echo "</div>\n";
echo "\n";
// echo "\n";
// echo "<p class=\"bottom_dashed_box\">\n";
// echo "<h2>Accès direct aux principales plateformes</h2>\n";
// echo "\n";
// echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"20\"><tr><td>\n";
// echo "\n";
// echo "<a href=\"http://www.sciencedirect.com/\" target=\"_blank\"><img src=\"img/sciencedirect.png\" width=\"180\" title=\"Elsevier Science Direct\"></a>\n";
// echo "</td><td>\n";
// echo "<a href=\"http://www.tandfonline.com/\" target=\"_blank\"><img src=\"img/tandfonline.jpg\" width=\"60\" title=\"Taylor & Francis Online\"></a>\n";
// echo "</td><td>\n";
// echo "<a href=\"http://onlinelibrary.wiley.com/\" target=\"_blank\"><img src=\"img/wiley.jpg\" width=\"150\" title=\"Wiley\"></a>\n";
// echo "</td><td>\n";
// echo "<a href=\"http://www.springer.com/\" target=\"_blank\"><img src=\"img/springer.jpg\" width=\"160\" title=\"Springer\"></a>\n";
// echo "</td><td>\n";
// echo "<a href=\"http://www.jstor.org/\" target=\"_blank\"><img src=\"img/jstor.jpg\" width=\"60\" title=\"JSTOR\"></a>\n";
// echo "</td><td>\n";
// echo "<a href=\"http://www.ingentaconnect.com/\" target=\"_blank\"><img src=\"img/ingenta.png\" width=\"180\" title=\"Ingenta Connect\"></a>\n";
// echo "</td></tr></table>\n";
// echo "</p>\n";
echo "\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
echo "\n";
if ($suggest!="0")
{
echo "<script type=\"text/javascript\">\n";
echo "var options = {\n";
echo "script:\"autosuggest.php?json=true&limit=100&\",\n";
echo "varname:\"input\",\n";
echo "json:true,\n";
echo "shownoresults:false,\n";
echo "maxresults:10,\n";
echo "timeout:5000,\n";
echo "callback: function (obj) { document.getElementById('title').value = obj.value; }\n";
echo "};\n";
echo "var as_json = new bsn.AutoSuggest('title', options);\n";
echo "</script>\n";
}
echo "\n";
require ("footer.php");
?>
