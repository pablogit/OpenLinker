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
// Table journals : recherche des ebooks quand la recherche des périodiques donne 0 résultats
require ("config.php");
require ("connexionebooks.php");
$q=$_GET['q'];
if ($q)
{
// 
// Split de la chaine de recherche q pour les combinaisons dans les differents ordres
// 
$q = str_replace("'","\\'",$q);
$q=trim($q);
$qstop = " " . $q . " ";
$qstop = str_ireplace(",","",$qstop);
$qstop = str_ireplace(".","",$qstop);
$qstop = str_ireplace(": "," ",$qstop);
$qstop = str_ireplace(":"," ",$qstop);
$qstop = str_ireplace(";","",$qstop);
$qstop = str_ireplace(" (the) "," ",$qstop);
$qstop = str_ireplace(" the "," ",$qstop);
$qstop = str_ireplace(" [the] "," ",$qstop);
$qstop = str_ireplace(" of "," ",$qstop);
$qstop = str_ireplace(" de "," ",$qstop);
$qstop = str_ireplace(" du "," ",$qstop);
$qstop = str_ireplace(" le "," ",$qstop);
$qstop = str_ireplace(" and "," ",$qstop);
$qstop = str_ireplace(" (and) "," ",$qstop);
$qstop = str_ireplace(" [and] "," ",$qstop);
$qstop = str_ireplace(" et "," ",$qstop);
$qstop = str_ireplace(" (et) "," ",$qstop);
$qstop = str_ireplace(" [et] "," ",$qstop);
$qstop = str_ireplace(" & "," ",$qstop);
$qstop = str_ireplace(" (&) "," ",$qstop);
$qstop = str_ireplace(" [&] "," ",$qstop);
$qstop = str_ireplace(" &amp; "," ",$qstop);
$qstop=trim($qstop);
if (($qstop=="")||($qstop==" "))
{
$qstop = $q;
}
$qstop=str_replace("*","%",$qstop);
$qb1=str_replace(" ","%",$qstop);
$startespaceq = stripos($qstop, " ");
if ($startespaceq !== false)
{
$ktq=split(" ",$qstop);
while(list($keyq,$valq)=each($ktq))
{
if($valq<>" " and strlen($valq) > 0)
{
$qb2 .= "(titre LIKE '%$valq%' OR titreabrege LIKE '%$valq%' OR variantetitre LIKE '%$valq%' OR soustitre LIKE '%$valq%') AND ";
$qb3 .= "(ebooksid LIKE '%$valq%' OR titre LIKE '%$valq%' OR titreabrege LIKE '%$valq%' OR variantetitre LIKE '%$valq%' OR soustitre LIKE '%$valq%' OR auteur LIKE '%$valq%' OR anneepublication LIKE '%$valq%' OR lieupublication LIKE '%$valq%' OR edition LIKE '%$valq%' OR isbn LIKE '%$valq%' OR isbn10 LIKE '%$valq%' OR catalogid LIKE '%$valq%' OR doi LIKE '%$valq%' OR urn LIKE '%$valq%' OR faitsuitea LIKE '%$valq%' OR devient LIKE '%$valq%' OR editeur LIKE '%$valq%' OR collection LIKE '%$valq%' OR etatcoll LIKE '%$valq%' OR url LIKE '%$valq%' OR licence LIKE '%$valq%' OR plateforme LIKE '%$valq%' OR gestion LIKE '%$valq%' OR historiqueabo LIKE '%$valq%' OR cote LIKE '%$valq%' OR localisation LIKE '%$valq%' OR user LIKE '%$valq%' OR keywords LIKE '%$valq%' OR commentairepub LIKE '%$valq%') AND ";
$qb4 .= "(ebooksid LIKE '%$valq%' OR titre LIKE '%$valq%' OR titreabrege LIKE '%$valq%' OR variantetitre LIKE '%$valq%' OR soustitre LIKE '%$valq%' OR auteur LIKE '%$valq%' OR anneepublication LIKE '%$valq%' OR lieupublication LIKE '%$valq%' OR edition LIKE '%$valq%' OR isbn LIKE '%$valq%' OR isbn10 LIKE '%$valq%' OR catalogid LIKE '%$valq%' OR doi LIKE '%$valq%' OR urn LIKE '%$valq%' OR faitsuitea LIKE '%$valq%' OR devient LIKE '%$valq%' OR editeur LIKE '%$valq%' OR collection LIKE '%$valq%' OR etatcoll LIKE '%$valq%' OR url LIKE '%$valq%') AND ";
}
}
$qb2=substr($qb2,0,(strlen($qb2)-4));
$qb3=substr($qb3,0,(strlen($qb3)-4));
$qb4=substr($qb4,0,(strlen($qb4)-4));
}
else
{
$qb2 = "(titre LIKE '%$qb1%' OR titreabrege LIKE '%$qb1%' OR variantetitre LIKE '%$qb1%' OR soustitre LIKE '%$qb1%' OR issn LIKE '%$qb1%' OR issnl LIKE '%$qb1%')";
$qb3 = "(ebooksid LIKE '%$qb1%' OR titre LIKE '%$qb1%' OR titreabrege LIKE '%$qb1%' OR variantetitre LIKE '%$qb1%' OR soustitre LIKE '%$qb1%' OR auteur LIKE '%$qb1%' OR anneepublication LIKE '%$qb1%' OR lieupublication LIKE '%$qb1%' OR edition LIKE '%$qb1%' OR isbn LIKE '%$qb1%' OR isbn10 LIKE '%$qb1%' OR catalogid LIKE '%$qb1%' OR doi LIKE '%$qb1%' OR urn LIKE '%$qb1%' OR faitsuitea LIKE '%$qb1%' OR devient LIKE '%$qb1%' OR editeur LIKE '%$qb1%' OR collection LIKE '%$qb1%' OR etatcoll LIKE '%$qb1%' OR url LIKE '%$qb1%' OR licence LIKE '%$qb1%' OR plateforme LIKE '%$qb1%' OR gestion LIKE '%$qb1%' OR historiqueabo LIKE '%$qb1%' OR cote LIKE '%$qb1%' OR localisation LIKE '%$qb1%' OR user LIKE '%$qb1%' OR keywords LIKE '%$qb1%' OR commentairepub LIKE '%$qb1%')";
$qb4 = "(ebooksid LIKE '%$qb1%' OR titre LIKE '%$qb1%' OR titreabrege LIKE '%$qb1%' OR variantetitre LIKE '%$qb1%' OR soustitre LIKE '%$qb1%' OR auteur LIKE '%$qb1%' OR anneepublication LIKE '%$qb1%' OR lieupublication LIKE '%$qb1%' OR edition LIKE '%$qb1%' OR isbn LIKE '%$qb1%' OR isbn10 LIKE '%$qb1%' OR catalogid LIKE '%$qb1%' OR doi LIKE '%$qb1%' OR urn LIKE '%$qb1%' OR faitsuitea LIKE '%$qb1%' OR devient LIKE '%$qb1%' OR editeur LIKE '%$qb1%' OR collection LIKE '%$qb1%' OR etatcoll LIKE '%$qb1%' OR url LIKE '%$qb1%')";
}
$reqb1 = $qb3;
if (($monaut == "admin")||($monaut == "sadmin"))
{
$reqb = "SELECT * FROM ebooks WHERE (" . $reqb1 . ") ORDER BY titre ASC LIMIT $from, $max_results";
$reqb2 = "SELECT ebooksid FROM ebooks WHERE (" . $reqb1 . ")";
}
else
{
$reqb = "SELECT * FROM ebooks WHERE " . $reqb1 . " AND titreexclu = 0 ORDER BY titre ASC LIMIT $from, $max_results";
$reqb2 = "SELECT ebooksid FROM ebooks WHERE " . $reqb1 . " AND titreexclu = 0";
}

$resultb2 = mysql_query($reqb2,$link);
$total_resultsb = mysql_num_rows($resultb2);

// 
// fin de la recherche simple
// 
if ($total_resultsb > 0)
{
if ($total_resultsb == 1)
echo "<b>Dans la base des ebooks cette recherche donne <a href=\"ebooks.php?".$_SERVER['QUERY_STRING']."\">" . $total_resultsb . " résultat</a></b>\n";
else
echo "<b>Dans la base des ebooks cette recherche donne <a href=\"ebooks.php?".$_SERVER['QUERY_STRING']."\">" . $total_resultsb . " résultats</a></b>\n";
echo "<br/>";
echo "<br/>";
}
// else
// echo "<br/>" . $reqb2 . "<br/>";
}
?>
