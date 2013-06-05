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
// Links table : List of deep links used to search databases or transfert orders into axternal systems
// 
require ("config.php");
require ("authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin"))
{
$myhtmltitle = $configname[$lang] . " : gestion des liens";
require ("headeradmin.php");
require ("connect.php");
echo "\n";
// 
// Localizations List
// 
echo "<h1>Gestion des liens externes</h1>\n";
$req = "SELECT * FROM links ORDER BY title ASC LIMIT 0, 200";
$result = mysql_query($req,$link);
$total_results = mysql_num_rows($result);
$nb = $total_results;

// Construction du tableau de resultats
echo "</center>\n";
echo "<b><br/>".$total_results;
if ($total_results == 1)
echo " lien trouvé</b></font>\n";
else
echo " liens trouvés</b></font>\n";
echo "<br/>";
echo "<br/>";

echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "</colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Nom</th>\n";
echo "<th scope=\"col\">URL</th>\n";
echo "<th scope=\"col\">Recherche par</th>\n";
echo "<th scope=\"col\">Formulaire de commande</th>\n";
echo "<th scope=\"col\">OpenURL</th>\n";
echo "<th scope=\"col\">Bibliothèque</th>\n";
echo "<th scope=\"col\">Lien actif</th>\n";
echo "<th scope=\"col\"></th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$linkid = $enreg['id'];
$linktitle = $enreg['title'];
$linkurl = $enreg['url'];
if (strlen($linkurl)>40)
$linkurls = substr($linkurl, 0, 40) . "[...]";
else
$linkurls = $linkurl;
$linksearch_issn = $enreg['search_issn'];
$linksearch_isbn = $enreg['search_isbn'];
$linksearch_ptitle = $enreg['search_ptitle'];
$linksearch_btitle = $enreg['search_btitle'];
$linksearch_atitle = $enreg['search_atitle'];
$linkorder_ext = $enreg['order_ext'];
$linkorder_form = $enreg['order_form'];
$linkopenurl = $enreg['openurl'];
$linklibrary = $enreg['library'];
$linkactive = $enreg['active'];
echo "<tr>\n";
echo "<td><b>" . $linktitle . "</b></td>\n";
echo "<td><a href=\"".$linkurl."\" target=\"_blank\">" . $linkurls . "</a></td>\n";
echo "<td>";
$separateur = "";
if ($linksearch_issn == 1)
{
echo "ISSN";
$separateur = " ; ";
}
if ($linksearch_isbn == 1)
{
echo $separateur . "ISBN";
$separateur = " ; ";
}
if ($linksearch_ptitle == 1)
{
echo $separateur . "Titre du périodique";
$separateur = " ; ";
}
if ($linksearch_btitle == 1)
{
echo $separateur . "Titre du livre";
$separateur = " ; ";
}
if ($linksearch_atitle == 1)
{
echo $separateur . "Titre de l'article";
$separateur = " ; ";
}
echo "</td>\n";
echo "<td>";
$separateur = "";
if ($linkorder_ext == 1)
{
echo "Externe";
$separateur = " ; ";
}
if ($linkorder_form == 1)
{
echo "Interne";
$separateur = " ; ";
}
echo "</td>\n";
echo "<td>".$linkopenurl."</td>\n";
echo "<td>".$linklibrary."</td>\n";
echo "<td>".$linkactive."</td>\n";
if (($monaut == "admin")||($monaut == "sadmin"))
{
echo "<td><a href=\"edit.php?table=links&id=".$linkid."\"><img src=\"img/edit.png\" title=\"Editer la fiche\" width=\"20\"></a></td>";
}
echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
echo "\n";
echo "<br/><br/><ul>\n";
echo "<b><a href=\"new.php?table=links\">Ajouter un nouveau lien </a></b>\n";
echo "<br/><br/>\n";
echo "</ul>\n";
require ("footer.php");
}
else
{
require ("header.php");
echo "Vos droits sont insuffisants pour consulter cette page</b></font></center><br /><br /><br /><br />\n";
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
