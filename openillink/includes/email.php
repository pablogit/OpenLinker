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
// formated e-mail
//
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user")||($monaut == "guest"))
{
$monhost = "http://" . $_SERVER['SERVER_NAME'];
$monuri = $monhost . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
echo "&nbsp;&nbsp;<a href=\"mailto:".$mail."?subject=Commande%20%28".$id."%29%20:%20".rawurlencode($titreper)."%2E".$enreg['annee'].";".$enreg['volume'].":".$enreg['pages'];
echo "&body=Bonjour%2C%0D%0A%0D%0ASuite%20à%20votre%20commande%20d'article%20nous%20avons%20le%20plaisir%20de%20vous%20transmettre%20en%20fichier%20attaché%20le%20document%20demandé%20:%0D%0A%0D%0A";
if ($enreg['titre_article'])
echo "Titre%20:%20".rawurlencode(stripslashes($titreart))."%0D%0A";
if ($enreg['auteurs'])
echo "Auteur%28s%29%20:%20".rawurlencode(stripslashes($enreg['auteurs']))."%0D%0A";
if ($enreg['titre_periodique'])
echo "Source%20:%20".rawurlencode($titreper)."%0D%0A";
if ($enreg['volume'])
echo "Volume%20:%20".$enreg['volume']."%0D%0A";
if ($enreg['numero'])
echo "Issue%20:%20".$enreg['numero']."%0D%0A";
if ($enreg['supplement'])
echo "Suppl.%20:%20".$enreg['supplement']."%0D%0A";
if ($enreg['pages'])
echo "Pages%20:%20".$enreg['pages']."%0D%0A";
if ($enreg['annee'])
echo "Année%20:%20".$enreg['annee']."%0D%0A";
if ($enreg['issn'])
echo "ISSN%20:%20".$enreg['issn']."%0D%0A";
if ($enreg['isbn'])
echo "ISBN%20:%20".$enreg['isbn']."%0D%0A";
if ($enreg['PMID'])
echo "PMID%20:%20".$enreg['PMID']."%0D%0A";
if ($enreg['uid'])
echo "Autre%20identificateur%20:%20".rawurlencode($enreg['uid'])."%0D%0A";
if ($nom)
echo "Commandé%20par:%20".rawurlencode($nom)."%0D%0A";
if ($enreg['refinterbib'])
echo "Réf%20interne%20:%20".rawurlencode($enreg['refinterbib'])."%0D%0A";
if ($enreg['remarquespub'])
echo "Remarques%20:%20".rawurlencode($enreg['remarquespub'])."%0D%0A";
echo "%0D%0ANouveau%20service%20:%20suivez%20vos%20commandes%20d'articles%20en%20temps%20réel.%20Vous%20pouvez%20vous%20connecter%20à%20l'adresse%20" . $monuri . "login.php%0D%0A";
echo "Username%20:%20".$maillog."%20|%20Password%20:%20".$passwordg."%0D%0A";
echo "%0D%0AMeilleurs%20messages%0D%0A";
echo "*****************************************************";
echo "\" title=\"envoyer un massage avec le document attaché au lecteur\"><img src=\"img/email.gif\" height=\"20\"></a>\n";
}
?>
