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
// Orders search results
//
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user")||($monaut == "guest"))
{
if ((isset($_GET['champ']))&&(isset($_GET['term'])))
{
$champ = $_GET['champ'];

if ($monaut == "guest")
{
if($champ == 'id')
{
$id = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and illinkid like '$id' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and illinkid like '$id' order by illinkid desc";
}
if($champ == 'atitle')
{
$atitle = urldecode($_GET['term']);
$atitle = strtr($atitle, ' ', '%');
$atitle = '%'.$atitle.'%';
$req = "select * from orders where mail like '$monnom' and titre_article like '$atitle' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and titre_article like '$atitle' order by illinkid desc";
}
if($champ == 'auteurs')
{
$atitle = urldecode($_GET['term']);
$atitle = strtr($atitle, ' ', '%');
$atitle = '%'.$atitle.'%';
$req = "select * from orders where mail like '$monnom' and auteurs like '$atitle' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and auteurs like '$atitle' order by illinkid desc";
}
if($champ == 'title')
{
$title = urldecode($_GET['term']);
$title = strtr($title, ' ', '%');
$title = '%'.$title.'%';
$req = "select * from orders where mail like '$monnom' and titre_periodique like '$title' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and titre_periodique like '$title' order by illinkid desc";
}
if($champ == 'datecom')
{
$datecom = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and date like '$datecom' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and date like '$datecom' order by illinkid desc";
}
if($champ == 'dateenv')
{
$dateenv = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and envoye like '$dateenv' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and envoye like '$dateenv' order by illinkid desc";
}
if($champ == 'datefact')
{
$datefact = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and facture like '$datefact' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and facture like '$datefact' order by illinkid desc";
}
if($champ == 'service')
{
$service = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and service like '$service' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and service like '$service' order by illinkid desc";
}
if($champ == 'issn')
{
$issn = $_GET['term'];
$req = "select * from orders where issn like '$issn' or eissn like '$issn' and mail like '$monnom' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where issn like '$issn' or eissn like '$issn' and mail like '$monnom' order by illinkid desc";
}
if($champ == 'pmid')
{
$pmid = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and PMID like '$pmid' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and PMID like '$pmid' order by illinkid desc";
}
if($champ == 'statut')
{
$statut = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and stade like '$statut' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and stade like '$statut' order by illinkid desc";
}
if($champ == 'localisation')
{
$localisation = $_GET['term'];
$req = "select * from orders where mail like '$monnom' and localisation like '$localisation' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and localisation like '$localisation' order by illinkid desc";
}
if($champ == 'reff')
{
$reff = '%'.$_GET['term'].'%';
$req = "select * from orders where mail like '$monnom' and ref like '$reff' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and ref like '$reff' order by illinkid desc";
}
if($champ == 'refb')
{
$refb = '%'.$_GET['term'].'%';
$req = "select * from orders where mail like '$monnom' and refinterbib like '$refb' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and refinterbib like '$refb' order by illinkid desc";
}
if($champ == 'all')
{
$all = urldecode($_GET['term']);
$all = strtr($all, ' ', '%');
$all = '%'.$all.'%';
$req = "select * from orders where mail like '$monnom' and ((illinkid like '$all') or (localisation like '$all') or (ref like '$all') or (nom like '$all') or (prenom like '$all') or (service like '$all') or (cgra like '$all') or (cgrb like '$all') or (mail like '$all') or (tel like '$all') or (adresse like '$all') or (code_postal like '$all') or (localite like '$all') or (envoi_par like '$all') or (titre_periodique like '$all') or (annee like '$all') or (volume like '$all') or (numero like '$all') or (supplement like '$all') or (pages like '$all') or (titre_article like '$all') or (auteurs like '$all') or (edition like '$all') or (isbn like '$all') or (issn like '$all') or (eissn like '$all') or (doi like '$all') or (uid like '$all') or (remarques like '$all') or (remarquespub like '$all') or (historique like '$all') or (refinterbib like '$all') or (PMID like '$all') or (ip like '$all')) order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and ((illinkid like '$all') or (localisation like '$all') or (ref like '$all') or (nom like '$all') or (prenom like '$all') or (service like '$all') or (cgra like '$all') or (cgrb like '$all') or (mail like '$all') or (tel like '$all') or (adresse like '$all') or (code_postal like '$all') or (localite like '$all') or (envoi_par like '$all') or (titre_periodique like '$all') or (annee like '$all') or (volume like '$all') or (numero like '$all') or (supplement like '$all') or (pages like '$all') or (titre_article like '$all') or (auteurs like '$all') or (edition like '$all') or (isbn like '$all') or (issn like '$all') or (eissn like '$all') or (doi like '$all') or (uid like '$all') or (remarques like '$all') or (remarquespub like '$all') or (historique like '$all') or (refinterbib like '$all') or (PMID like '$all') or (ip like '$all')) order by illinkid desc";
}
if($champ == 'nom')
{
$pos1 = strpos(urldecode($_GET['term']),',');
$pos2 = strpos(urldecode($_GET['term']),' ');
if (($pos1 === false)&&($pos2 === false))
{
$nom='%'.urldecode($_GET['term']).'%';
$req = "select * from orders where mail like '$monnom' and (nom like '$nom' OR prenom like '$nom') order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and (nom like '$nom' OR prenom like '$nom') order by illinkid desc";
}
else
{
if ($pos1 === false)
$pos=$pos2;
else
$pos=$pos1;
$nom=substr(urldecode($_GET['term']),0,$pos);
$prenom=substr(urldecode($_GET['term']),$pos+1);
$req = "select * from orders where mail like '$monnom' and (nom like '$nom' AND prenom like '$prenom') order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$monnom' and (nom like '$nom' AND prenom like '$prenom') order by illinkid desc";
}
}
}
else
{
if($champ == 'id')
{
$id = $_GET['term'];
$req = "select * from orders where illinkid like '$id' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where illinkid like '$id' order by illinkid desc";
}
if($champ == 'atitle')
{
$atitle = urldecode($_GET['term']);
$atitle = strtr($atitle, ' ', '%');
$atitle = '%'.$atitle.'%';
$req = "select * from orders where titre_article like '$atitle' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where titre_article like '$atitle' order by illinkid desc";
}
if($champ == 'auteurs')
{
$atitle = urldecode($_GET['term']);
$atitle = strtr($atitle, ' ', '%');
$atitle = '%'.$atitle.'%';
$req = "select * from orders where auteurs like '$atitle' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where auteurs like '$atitle' order by illinkid desc";
}
if($champ == 'title')
{
$title = urldecode($_GET['term']);
$title = strtr($title, ' ', '%');
$title = '%'.$title.'%';
$req = "select * from orders where titre_periodique like '$title' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where titre_periodique like '$title' order by illinkid desc";
}
if($champ == 'datecom')
{
$datecom = $_GET['term'];
$req = "select * from orders where date like '$datecom' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where date like '$datecom' order by illinkid desc";
}
if($champ == 'dateenv')
{
$dateenv = $_GET['term'];
$req = "select * from orders where envoye like '$dateenv' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where envoye like '$dateenv' order by illinkid desc";
}
if($champ == 'datefact')
{
$datefact = $_GET['term'];
$req = "select * from orders where facture like '$datefact' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where facture like '$datefact' order by illinkid desc";
}
if($champ == 'service')
{
$service = $_GET['term'];
$req = "select * from orders where service like '$service' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where service like '$service' order by illinkid desc";
}
if($champ == 'issn')
{
$issn = $_GET['term'];
$req = "select * from orders where issn like '$issn' or eissn like '$issn' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where issn like '$issn' or eissn like '$issn' order by illinkid desc";
}
if($champ == 'pmid')
{
$pmid = $_GET['term'];
$req = "select * from orders where PMID like '$pmid' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where PMID like '$pmid' order by illinkid desc";
}
if($champ == 'statut')
{
$statut = $_GET['term'];
$req = "select * from orders where stade like '$statut' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where stade like '$statut' order by illinkid desc";
}
if($champ == 'localisation')
{
$localisation = $_GET['term'];
$req = "select * from orders where localisation like '$localisation' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where localisation like '$localisation' order by illinkid desc";
}
if($champ == 'reff')
{
$reff = '%'.$_GET['term'].'%';
$req = "select * from orders where ref like '$reff' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where ref like '$reff' order by illinkid desc";
}
if($champ == 'refb')
{
$refb = '%'.$_GET['term'].'%';
$req = "select * from orders where refinterbib like '$refb' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where refinterbib like '$refb' order by illinkid desc";
}
if($champ == 'all')
{
$all = urldecode($_GET['term']);
$all = strtr($all, ' ', '%');
$all = '%'.$all.'%';
$req = "select * from orders where ((illinkid like '$all') or (localisation like '$all') or (ref like '$all') or (nom like '$all') or (prenom like '$all') or (service like '$all') or (cgra like '$all') or (cgrb like '$all') or (mail like '$all') or (tel like '$all') or (adresse like '$all') or (code_postal like '$all') or (localite like '$all') or (envoi_par like '$all') or (titre_periodique like '$all') or (annee like '$all') or (volume like '$all') or (numero like '$all') or (supplement like '$all') or (pages like '$all') or (titre_article like '$all') or (auteurs like '$all') or (edition like '$all') or (isbn like '$all') or (issn like '$all') or (eissn like '$all') or (doi like '$all') or (uid like '$all') or (remarques like '$all') or (historique like '$all') or (refinterbib like '$all') or (PMID like '$all') or (ip like '$all')) order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where ((illinkid like '$all') or (localisation like '$all') or (ref like '$all') or (nom like '$all') or (prenom like '$all') or (service like '$all') or (cgra like '$all') or (cgrb like '$all') or (mail like '$all') or (tel like '$all') or (adresse like '$all') or (code_postal like '$all') or (localite like '$all') or (envoi_par like '$all') or (titre_periodique like '$all') or (annee like '$all') or (volume like '$all') or (numero like '$all') or (supplement like '$all') or (pages like '$all') or (titre_article like '$all') or (auteurs like '$all') or (edition like '$all') or (isbn like '$all') or (issn like '$all') or (eissn like '$all') or (doi like '$all') or (uid like '$all') or (remarques like '$all') or (historique like '$all') or (refinterbib like '$all') or (PMID like '$all') or (ip like '$all')) order by illinkid desc";
}
if($champ == 'email')
{
$emailr = '%'.$_GET['term'].'%';
$req = "select * from orders where mail like '$emailr' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where mail like '$emailr' order by illinkid desc";
}
if($champ == 'nom')
{
$pos1 = strpos(urldecode($_GET['term']),',');
$pos2 = strpos(urldecode($_GET['term']),' ');
if (($pos1 === false)&&($pos2 === false))
{
$nom='%'.urldecode($_GET['term']).'%';
$req = "select * from orders where nom like '$nom' OR prenom like '$nom' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where nom like '$nom' OR prenom like '$nom' order by illinkid desc";
}
else
{
if ($pos1 === false)
$pos=$pos2;
else
$pos=$pos1;
$nom=substr(urldecode($_GET['term']),0,$pos);
$prenom=substr(urldecode($_GET['term']),$pos+2);
$req = "select * from orders where nom like '$nom' AND prenom like '$prenom' order by illinkid desc limit $from, $max_results";
$req2 = "select illinkid from orders where nom like '$nom' AND prenom like '$prenom' order by illinkid desc";
}
}

}
}
}
?>
