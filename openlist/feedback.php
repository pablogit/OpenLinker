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
// Formulaire pour donner son avis ou signaler un problème
require ("config.php");
$pagetitle = "Revues de " . $configinstitution . " : signaler une erreur ou soumettre une suggestion";
require ("header.php");
$sd = (date("Y")*7)+(date("m")*11)+(date("d")*331)+753;
echo "\n";
echo "<br/>\n";
echo "\n";
echo "<div id=\"feedback\">\n";
echo "<h2>Signaler une erreur ou soumettre une suggestion</h2>\n";
echo "<p>Le contenu des pages de cette base de données est sous la responsabilité de la \n";
echo "<a href=\"" . $configlibraryurl . "\" title=\"" . $configlibrary . "\" target=\"_balnk\">" . $configlibrary . "</a>. \n";
echo "L'équipe qui gère cette base de données tente par tous les moyens de diffuser une information valide, de garder celle-ci à jour et de s'assurer de la qualité du contenu et du bon fonctionnement de l'ensemble du site.\n";
echo "<br /><br />Il peut malheureusement arriver qu'une erreur, une coquille, une information erronée ou un problème de programmation se glisse dans une page. Nous vous invitons donc à nous signaler tout problème à l'aide du formulaire ci-dessous.\n";
echo "</p>\n";
echo "\n";
echo "<p>Si vos questions concernent plutôt le site de " . $configinstitution . ", ou pour toute autre question n'ayant pas trait à cetta base spécifiquement, veuillez \n";
echo "<a href=\"" . $confighelpdeskurl . "\" title=\"Contacter le Help Desk de " . $configinstitution . "\" target=\"_blank\">contacter le Help Desk de " . $configinstitution . "</a>.\n";
echo "</p>\n";
echo "\n";
echo "<form action=\"feedbacksend.php\" id=\"mailform\" name=\"mailform\" enctype=\"multipart/form-data\" method=\"post\" onsubmit=\"return validateForm('mailform','Votre_nom,Votre nom,email,Adresse e-mail,Type_derreur,Type d`erreur,Adresse_URL_de_la_page_qui_pos,Adresse URL de la page qui contient le problème','','Erreur - ces champs sont obligatoires :','Adresse de courriel non valide')\">\n";
echo "\n";
// echo "<input type=\"hidden\" name=\"html_enabled\" id=\"mailformhtml_enabled\" value=\"\" />\n";
echo "<input type=\"hidden\" name=\"subject\" id=\"mailformsubject\" value=\"Erreur ou suggestion pour la base de revues de " . $configinstitution . "\" />\n";
echo "<input type=\"hidden\" name=\"referer\" value=\"";
echo $_SERVER['HTTP_REFERER'];
echo "\" />\n";
echo "<input type=\"hidden\" name=\"sd\" value=\"";
echo $sd;
echo "\" />\n";
echo "\n";
echo "<fieldset class=\"csc-mailform\">\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<b><label for=\"mailformVotre_nom\">Votre nom *</label></b> \n";
echo "<input type=\"text\" name=\"Votre_nom\" id=\"mailformVotre_nom\" size=\"20\" value=\"\" />\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<b><label for=\"mailformemail\">E-mail *</label></b> \n";
echo "<input type=\"text\" name=\"email\" id=\"mailformemail\" size=\"20\" value=\"\" />\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<b><label for=\"mailformType_derreur\">Type d'erreur ou suggestion*</label></b> \n";
echo "<select name=\"Type_derreur\" id=\"mailformType_derreur\" size=\"1\">\n";
echo "<option value=\"Lien cassé ou faux\">Lien cassé ou faux</option>\n";
// echo "<option value=\"Image inexistante\">Image inexistante</option>\n";
echo "<option value=\"Faute d'orthographe ou grammaticale\">Faute d'orthographe ou grammaticale</option>\n";
echo "<option value=\"Information erronée ou pas à jour\">Information erronée ou pas à jour</option>\n";
echo "<option value=\"Suggestion de lien manquant\">Suggestion de lien manquant</option>\n";
echo "<option value=\"Suggestion de lien manquant\">Suggestion de nouvel abonnement</option>\n";
echo "</select>\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<b><label for=\"mailformAdresse_URL_de_la_page_qui_pos\">Adresse URL de la page qui contient le problème *</label></b> \n";
echo "<input type=\"text\" name=\"Adresse_URL_de_la_page_qui_pos\" id=\"mailformAdresse_URL_de_la_page_qui_pos\" size=\"20\" value=\"";
echo $_SERVER['HTTP_REFERER'];
echo "\" />\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<label for=\"mailformDans_le_cas_dun_lien_rompu_ad\">Adresse URL du lien cassé, faux ou manquant</label> \n";
echo "<input type=\"text\" name=\"Dans_le_cas_dun_lien_rompu_ad\" id=\"mailformDans_le_cas_dun_lien_rompu_ad\" size=\"20\" value=\"\" />\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\">\n";
echo "<label for=\"mailformCommentaires_ou_precisions\">Commentaires ou précisions</label> \n";
echo "<textarea name=\"Commentaires_ou_precisions\" id=\"mailformCommentaires_ou_precisions\" cols=\"20\" rows=\"5\">\n";
echo "</textarea>\n";
echo "</div>\n";
echo "\n";
echo "<div class=\"csc-mailform-field\"> \n";
echo "<input type=\"submit\" name=\"formtype_mail\" id=\"mailformformtype_mail\" value=\"Envoyer\" class=\"csc-mailform-submit\" />\n";
echo "</div>\n";
echo "\n";
echo "</fieldset>\n";
echo "\n";
echo "</form>\n";
echo "\n";
echo "\n";
echo "</div>\n";
echo "\n";
echo "<br/><br/><br/><br/>\n";
echo "\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
echo "\n";
require ("footer.php");
?>
