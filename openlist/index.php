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
// Page d'accueil générale et formulaire de recherche rapide des périodiques
require ("config.php");
require ("header.php");
require ("initiales.php");
echo "\n";
echo "<br/><br/>\n";
echo "<center>\n";
echo "\n";
echo "<div id=\"rechercherapide\">\n";
echo "<form action=\"search.php\" method=\"get\" enctype=\"x-www-form-encoded\" name=\"recherche\" onsubmit=\"return check_search()\">\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>\n";
echo "<b>Recherche rapide</b>&nbsp; | &nbsp;<a href=\"advanced.php\">Recherche avancée</a>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "&nbsp; | &nbsp;<a href=\"adminsearch.php\">Recherche administrateur</a>\n";
}
echo "<br/><br/>\n";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<input name=\"q\" id=\"q\" type=\"text\" size=\"60\" value=\"\">\n";
echo "<input name=\"init\" type=\"hidden\" value=\"\">\n";
echo "<input name=\"search\" type=\"hidden\" value=\"simple\">\n";
echo "<input type=\"submit\" value=\"OK\">\n";
echo "<input type=\"reset\" value=\"Annuler\">\n";
echo "</td></tr><tr><td>\n";
echo "<input type=\"radio\" name=\"field\" value=\"title\" checked/>mots du titre | <input type=\"radio\" name=\"field\" value=\"tbegin\"/>début du titre  |  <input type=\"radio\" name=\"field\" value=\"texact\"/>titre exact  |  <input type=\"radio\" name=\"field\" value=\"all\"/>tous les champs\n";
echo "<br/>\n";
echo "<input type=\"radio\" name=\"format\" value=\"all\" checked/>tous | <input type=\"radio\" name=\"format\" value=\"e\" />électroniques | <input type=\"radio\" name=\"format\" value=\"p\"/>imprimés \n";
echo "</td></tr>\n";
echo "<tr><td></td></tr>\n";
echo "</table></form>\n";
echo "</div>\n";
echo "</center>\n";
echo "\n";
echo "\n";
echo "\n";
echo "<div style=\"position: relative; top: 20px; left: 350px;\">\n";
echo "\n";
echo "<div id=\"nothemes\" style=\"position:relative; z-index:9; visibility:visible; display:block;\">\n";
echo "<a href=\"javascript:hidediv('nothemes');showdiv('themes');\" alt=\"afficher les thèmes\" class=\"linkthemes\"><img src=\"img/collapsed.gif\">&nbsp; Feuilleter par thème</a><br/>\n";
echo "</div>\n";
echo "<div id=\"themes\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<a href=\"javascript:hidediv('themes');showdiv('nothemes');\" alt=\"fermer les thèmes\" class=\"linkthemes\"><img src=\"img/expanded.gif\">&nbsp; Feuilleter par thème</a><br/>\n";
echo "<div id=\"nothemesshs\" style=\"position:relative; z-index:9; visibility:visible; display:block;\">\n";
echo "<ul>\n";
echo "<a href=\"javascript:hidediv('nothemesshs');showdiv('themesshs');\" alt=\"afficher les thèmes en sciences humaines\" class=\"linkthemes\"><img src=\"img/collapsed.gif\">&nbsp; Sciences humaines</a><br/>\n";
echo "</ul>\n";
echo "</div>\n";
echo "<div id=\"themesshs\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<ul>\n";
echo "<a href=\"javascript:hidediv('themesshs');showdiv('nothemesshs');\" alt=\"fermer les thèmes en sciences humaines\" class=\"linkthemes\"><img src=\"img/expanded.gif\">&nbsp; Sciences humaines</a><br/>\n";
echo "<ul>\n";
echo "<li><a href=\"search.php?search=subject&subject=170&sname=Allemand\">Allemand</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=123&sname=Anglais\">Anglais</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=97&sname=Anthropologie\">Anthropologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=96&sname=Antiquité\">Antiquité</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=95&sname=Archéologie\">Archéologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=94&sname=Architecture\">Architecture</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=93&sname=Arts\">Arts</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=500&sname=Bibliographies\">Bibliographies</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=92&sname=Bibliothéconomie et sciences de l'information\">Bibliothéconomie et sciences de l'information</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=502&sname=Chine\">Chine</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=503&sname=Cinéma, radio et télévision\">Cinéma, radio et télévision</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=504&sname=Communication\">Communication</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=505&sname=Criminologie\">Criminologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=506&sname=Danse\">Danse</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=86&sname=Droit\">Droit</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=84&sname=Economie\">Economie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=83&sname=Education\">Education</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=523&sname=Epistémologie et histoire des sciences\">Epistémologie et histoire des sciences</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=524&sname=Ergonomie\">Ergonomie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=145&sname=Espagnol\">Espagnol</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=149&sname=Ethique\">Ethique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=140&sname=Etudes classiques\">Etudes classiques</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=153&sname=Etudes genre\">Etudes genre</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=122&sname=Français\">Français</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=81&sname=Géographie\">Géographie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=80&sname=Géologie\">Géologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=132&sname=Gériatrie, Gérontologie\">Gériatrie, Gérontologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=79&sname=Helvetica\">Helvetica</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=510&sname=Hispano-américaine\">Hispano-américaine</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=78&sname=Histoire\">Histoire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=511&sname=Inde\">Inde</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=137&sname=Informatique\">Informatique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=512&sname=International\">International</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=146&sname=Italien\">Italien</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=513&sname=Japon\">Japon</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=76&sname=Linguistique\">Linguistique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=75&sname=Littérature\">Littérature</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=73&sname=Management\">Management</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=72&sname=Mathématiques\">Mathématiques</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=65&sname=Musique\">Musique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=63&sname=Orientalisme\">Orientalisme</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=62&sname=Philosophie\">Philosophie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=515&sname=Photographie\">Photographie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=60&sname=Politique\">Politique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=59&sname=Préhistoire\">Préhistoire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=57&sname=Psychologie\">Psychologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=108&sname=Russe\">Russe</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=135&sname=Santé publique\">Santé publique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=52&sname=Science des religions\">Science des religions</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=516&sname=Sciences\">Sciences</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=56&sname=Sciences de la terre\">Sciences de la terre</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=85&sname=Sciences de l'environnement, Ecologie\">Sciences de l'environnement, Ecologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=55&sname=Sciences du sport\">Sciences du sport</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=102&sname=Sciences humaines\">Sciences humaines</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=518&sname=Slavistique\">Slavistique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=54&sname=Sociologie\">Sociologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=182&sname=Statistiques\">Statistiques</a></li>\n";
// echo "<li><a href=\"search.php?search=subject&subject=520&sname=Suisse\">Suisse</a></li>\n";
// echo "<li><a href=\"search.php?search=subject&subject=157&sname=Sujets\">Sujets</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=181&sname=Technologie\">Technologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=53&sname=Théâtre\">Théâtre</a></li>\n";
// echo "<li><a href=\"search.php?search=subject&subject=521&sname=Tibet\">Tibet</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=522&sname=Tourisme\">Tourisme</a></li>\n";
echo "</ul>\n";
echo "</ul>\n";
echo "</div>\n";
echo "<div id=\"nothemesstm\" style=\"position:relative; z-index:9; visibility:visible; display:block;\">\n";
echo "<ul>\n";
echo "<a href=\"javascript:hidediv('nothemesstm');showdiv('themesstm');\" alt=\"afficher les thèmes en sciences biomédicales\" class=\"linkthemes\"><img src=\"img/collapsed.gif\">&nbsp; Sciences biomédicales</a><br/>\n";
echo "</ul>\n";
echo "</div>\n";
echo "<div id=\"themesstm\" style=\"position:relative; z-index:9; visibility:hidden; display:none;\">\n";
echo "<ul>\n";
echo "<a href=\"javascript:hidediv('themesstm');showdiv('nothemesstm');\" alt=\"fermer les thèmes en sciences biomédicales\" class=\"linkthemes\"><img src=\"img/expanded.gif\">&nbsp; Sciences biomédicales</a><br/>\n";
echo "<ul>\n";
echo "<li><a href=\"search.php?search=subject&subject=160&sname=Addictions\">Addictions</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=99&sname=Agriculture\">Agriculture</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=107&sname=Aide médicosociale\">Aide médicosociale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=136&sname=Allergologie\">Allergologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=159&sname=Anatomie et morphologie\">Anatomie et morphologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=129&sname=Anesthésiologie\">Anesthésiologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=158&sname=Audiophonologie\">Audiophonologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=500&sname=Bibliographies\">Bibliographies</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=144&sname=Biochimie et Biologie Moléculaire\">Biochimie et Biologie Moléculaire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=91&sname=Biologie\">Biologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=115&sname=Biologie cellulaire\">Biologie cellulaire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=124&sname=Biophysique\">Biophysique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=90&sname=Botanique\">Botanique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=156&sname=Cardiologie\">Cardiologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=89&sname=Chimie\">Chimie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=88&sname=Chirurgie\">Chirurgie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=87&sname=Dermatologie\">Dermatologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=147&sname=Embryologie\">Embryologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=109&sname=Endocrinologie\">Endocrinologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=507&sname=Entomologie\">Entomologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=523&sname=Epistémologie et histoire des sciences\">Epistémologie et histoire des sciences</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=524&sname=Ergonomie\">Ergonomie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=149&sname=Ethique\">Ethique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=101&sname=Evaluation / Qualité\">Evaluation / Qualité</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=150&sname=Formation médicale\">Formation médicale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=116&sname=Gastroentérologie\">Gastroentérologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=82&sname=Génétique\">Génétique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=132&sname=Gériatrie, Gérontologie\">Gériatrie, Gérontologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=104&sname=Hématologie\">Hématologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=142&sname=Imagerie médicale\">Imagerie médicale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=112&sname=Immunologie\">Immunologie</a></li>\n";
// echo "<li><a href=\"search.php?search=subject&subject=137&sname=Informatique\">Informatique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=114&sname=Informatique médicale\">Informatique médicale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=111&sname=Maladies infectieuses, virologie\">Maladies infectieuses, virologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=72&sname=Mathématiques\">Mathématiques</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=71&sname=Médecine\">Médecine</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=70&sname=Médecine dentaire et chirurgie maxillo-faciale\">Médecine dentaire et chirurgie maxillo-faciale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=514&sname=Médecine du sport\">Médecine du sport</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=118&sname=Médecine du travail\">Médecine du travail</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=151&sname=Médecine d'urgence\">Médecine d'urgence</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=133&sname=Médecine générale et Médecine interne\">Médecine générale et Médecine interne</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=68&sname=Médecine légale\">Médecine légale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=67&sname=Medecine sociale et preventive\">Medecine sociale et preventive</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=128&sname=Médecine tropicale\">Médecine tropicale</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=110&sname=Médecine vétérinaire\">Médecine vétérinaire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=66&sname=Médecines alternatives\">Médecines alternatives</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=134&sname=Microbiologie\">Microbiologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=525&sname=Microscopie\">Microscopie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=174&sname=Neurosciences\">Neurosciences</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=64&sname=Nutrition\">Nutrition</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=100&sname=Obstétrique et Gynécologie\">Obstétrique et Gynécologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=163&sname=Oncologie\">Oncologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=162&sname=Ophtalmologie\">Ophtalmologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=168&sname=Orthopédie\">Orthopédie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=171&sname=Otorhinolaryngologie\">Otorhinolaryngologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=119&sname=Parasitologie\">Parasitologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=130&sname=Pathologie\">Pathologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=125&sname=Pédiatrie\">Pédiatrie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=165&sname=Pharmacologie\">Pharmacologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=515&sname=Photographie\">Photographie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=180&sname=Physiologie\">Physiologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=61&sname=Physique\">Physique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=173&sname=Pneumologie\">Pneumologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=58&sname=Psychiatrie\">Psychiatrie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=57&sname=Psychologie\">Psychologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=138&sname=Radiologie\">Radiologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=167&sname=Réadaptation, Réhabilitation\">Réadaptation, Réhabilitation</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=161&sname=Recherche\">Recherche</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=135&sname=Santé publique\">Santé publique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=516&sname=Sciences\">Sciences</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=56&sname=Sciences de la terre\">Sciences de la terre</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=517&sname=Sciences humaines\">Sciences humaines</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=178&sname=Soins infirmiers\">Soins infirmiers</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=519&sname=Soins intensifs\">Soins intensifs</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=182&sname=Statistiques\">Statistiques</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=127&sname=Techniques de laboratoire\">Techniques de laboratoire</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=181&sname=Technologie\">Technologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=143&sname=Thérapeutique\">Thérapeutique</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=126&sname=Toxicologie\">Toxicologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=175&sname=Transplantation\">Transplantation</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=172&sname=Traumatologie\">Traumatologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=131&sname=Urologie et néphrologie\">Urologie et néphrologie</a></li>\n";
echo "<li><a href=\"search.php?search=subject&subject=51&sname=Zoologie\">Zoologie</a></li>\n";
echo "</ul>\n";
echo "</ul>\n";
echo "</div>\n";
echo "\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
if (!empty($_COOKIE[journalsid]))
{
$myjournals1id=$_COOKIE['journalsid']['myjournals1id'];
$myjournals1ti=$_COOKIE['journalsid']['myjournals1ti'];
$myjournals1url=$_COOKIE['journalsid']['myjournals1url'];
$myjournals2id=$_COOKIE['journalsid']['myjournals2id'];
$myjournals2ti=$_COOKIE['journalsid']['myjournals2ti'];
$myjournals2url=$_COOKIE['journalsid']['myjournals2url'];
$myjournals3id=$_COOKIE['journalsid']['myjournals3id'];
$myjournals3ti=$_COOKIE['journalsid']['myjournals3ti'];
$myjournals3url=$_COOKIE['journalsid']['myjournals3url'];
$myjournals3id=$_COOKIE['journalsid']['myjournals3id'];
$myjournals3ti=$_COOKIE['journalsid']['myjournals3ti'];
$myjournals3url=$_COOKIE['journalsid']['myjournals3url'];
$myjournals4id=$_COOKIE['journalsid']['myjournals4id'];
$myjournals4ti=$_COOKIE['journalsid']['myjournals4ti'];
$myjournals4url=$_COOKIE['journalsid']['myjournals4url'];
$myjournals5id=$_COOKIE['journalsid']['myjournals5id'];
$myjournals5ti=$_COOKIE['journalsid']['myjournals5ti'];
$myjournals5url=$_COOKIE['journalsid']['myjournals5url'];
$myjournals6id=$_COOKIE['journalsid']['myjournals6id'];
$myjournals6ti=$_COOKIE['journalsid']['myjournals6ti'];
$myjournals6url=$_COOKIE['journalsid']['myjournals6url'];
$myjournals7id=$_COOKIE['journalsid']['myjournals7id'];
$myjournals7ti=$_COOKIE['journalsid']['myjournals7ti'];
$myjournals7url=$_COOKIE['journalsid']['myjournals7url'];
$myjournals8id=$_COOKIE['journalsid']['myjournals8id'];
$myjournals8ti=$_COOKIE['journalsid']['myjournals8ti'];
$myjournals8url=$_COOKIE['journalsid']['myjournals8url'];
$myjournals9id=$_COOKIE['journalsid']['myjournals9id'];
$myjournals9ti=$_COOKIE['journalsid']['myjournals9ti'];
$myjournals9url=$_COOKIE['journalsid']['myjournals9url'];
$myjournals10id=$_COOKIE['journalsid']['myjournals10id'];
$myjournals10ti=$_COOKIE['journalsid']['myjournals10ti'];
$myjournals10url=$_COOKIE['journalsid']['myjournals10url'];
if (($myjournals1id != "")||($myjournals2id != "")||($myjournals3id != "")||($myjournals4id != "")||($myjournals5id != "")||($myjournals6id != "")||($myjournals7id != "")||($myjournals8id != "")||($myjournals9id != "")||($myjournals10id != ""))
{
echo "<br/><br/><br/><br/>\n";
echo "\n";
echo "<p class=\"bottom_dashed_box\">\n";
echo "<h2>Ma sélection</h2>\n";
echo "\n";
echo "<table id=\"one-column-emphasis\" summary=\"\">\n";
echo "<colgroup>\n";
echo "<col class=\"oce-first\" />\n";
echo "    </colgroup>\n";
echo "\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<th scope=\"col\">Titre</th>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tbody>\n";
if ($myjournals1id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals1url)
echo "<a href=\"".$myjournals1url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals1ti;
if ($myjournals1url)
echo "</a>";
echo "<a href=\"detail.php?id=".$myjournals1id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals2id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals2url)
echo "<a href=\"".$myjournals2url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals2ti;
if ($myjournals2url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals2id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals3id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals3url)
echo "<a href=\"".$myjournals3url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals3ti;
if ($myjournals3url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals3id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals4id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals4url)
echo "<a href=\"".$myjournals4url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals4ti;
if ($myjournals4url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals4id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals5id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals5url)
echo "<a href=\"".$myjournals5url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals5ti;
if ($myjournals5url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals5id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals6id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals6url)
echo "<a href=\"".$myjournals6url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals6ti;
if ($myjournals6url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals6id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals7id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals7url)
echo "<a href=\"".$myjournals7url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals7ti;
if ($myjournals7url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals7id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals8id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals8url)
echo "<a href=\"".$myjournals8url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals8ti;
if ($myjournals8url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals8id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals9id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals9url)
echo "<a href=\"".$myjournals9url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals9ti;
if ($myjournals9url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals9id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
if ($myjournals10id != "")
{
echo "<tr>\n";
echo "<td class=\"titrestableau2\"><b>";
if ($myjournals10url)
echo "<a href=\"".$myjournals10url."\" title=\"Accès en ligne\" target=\"_blank\">";
echo $myjournals10ti;
if ($myjournals10url)
echo "</a>";
echo "\n";
echo "<a href=\"detail.php?id=".$myjournals10id."\"><img src=\"img/info.png\" title=\"Voir la notice complète\" width=\"20\" style=\"float:right;\"></a></td>\n";
echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
}
}


echo "<br/><br/><br/><br/>\n";
echo "<p class=\"bottom_dashed_box\">\n";
echo "<h2>Accès direct aux principales plateformes</h2>\n";
echo "\n";
echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"20\"><tr><td>\n";
echo "\n";
echo "<a href=\"http://www.sciencedirect.com/\" target=\"_blank\"><img src=\"img/sciencedirect.png\" width=\"180\" title=\"Elsevier Science Direct\"></a>\n";
echo "</td><td>\n";
echo "<a href=\"http://www.tandfonline.com/\" target=\"_blank\"><img src=\"img/tandfonline.jpg\" width=\"60\" title=\"Taylor & Francis Online\"></a>\n";
echo "</td><td>\n";
echo "<a href=\"http://onlinelibrary.wiley.com/\" target=\"_blank\"><img src=\"img/wiley.jpg\" width=\"150\" title=\"Wiley\"></a>\n";
echo "</td><td>\n";
echo "<a href=\"http://www.springer.com/\" target=\"_blank\"><img src=\"img/springer.jpg\" width=\"160\" title=\"Springer\"></a>\n";
echo "</td><td>\n";
echo "<a href=\"http://www.jstor.org/\" target=\"_blank\"><img src=\"img/jstor.jpg\" width=\"60\" title=\"JSTOR\"></a>\n";
echo "</td><td>\n";
echo "<a href=\"http://www.ingentaconnect.com/\" target=\"_blank\"><img src=\"img/ingenta.png\" width=\"180\" title=\"Ingenta Connect\"></a>\n";
echo "</td></tr></table>\n";
echo "</p>\n";
echo "\n";
echo "</div>\n";
echo "</div>\n";
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
echo "callback: function (obj) { document.getElementById('q').value = obj.value; }\n";
echo "};\n";
echo "var as_json = new bsn.AutoSuggest('q', options);\n";
echo "</script>\n";
}
echo "\n";
require ("footer.php");
?>
