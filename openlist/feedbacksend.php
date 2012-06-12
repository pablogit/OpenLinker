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
// Envoi du message de feedback à l'utilisateur et au gestionnaire de la base
require ("config.php");
$pagetitle = "Revues de " . $configinstitution . " : signaler une erreur ou soumettre une suggestion";
require ("header.php");
// Receiving variables

$name = addslashes($_POST['Votre_nom']);
$name = str_replace("<","[lt]",$name);
$name = str_replace(">","[gt]",$name);
$name = str_replace("script","scrpt",$name);
// mandatory field

$email = addslashes($_POST['email']);
$email = str_replace("<","[lt]",$email);
$email = str_replace(">","[gt]",$email);
$email = str_replace("script","scrpt",$email);
// mandatory field

$titre = addslashes($_POST['Type_derreur']);
$titre = str_replace("<","[lt]",$titre);
$titre = str_replace(">","[gt]",$titre);
$titre = str_replace("script","scrpt",$titre);
// mandatory field

$siteweb = addslashes($_POST['Adresse_URL_de_la_page_qui_pos']);
$siteweb = str_replace("<","[lt]",$siteweb);
$siteweb = str_replace(">","[gt]",$siteweb);
$siteweb = str_replace("script","scrpt",$siteweb);
// mandatory field

$lien_rompu = addslashes($_POST['Dans_le_cas_dun_lien_rompu_ad']);
$lien_rompu = str_replace("<","[lt]",$lien_rompu);
$lien_rompu = str_replace(">","[gt]",$lien_rompu);
$lien_rompu = str_replace("script","scrpt",$lien_rompu);

$page_referer = addslashes($_POST['referer']);
$page_referer = str_replace("<","[lt]",$page_referer);
$page_referer = str_replace(">","[gt]",$page_referer);
$page_referer = str_replace("script","scrpt",$page_referer);

$commentaire = addslashes($_POST['Commentaires_ou_precisions']);
$commentaire = str_replace("<","[lt]",$commentaire);
$commentaire = str_replace(">","[gt]",$commentaire);
$commentaire = str_replace("script","scrpt",$commentaire);
$commentaireligne = str_replace("\r\n"," - ",$commentaire);
$commentaireligne = str_replace("\r"," - ",$commentaireligne);
$commentaireligne = str_replace("\n"," - ",$commentaireligne);

$ip = $_SERVER['REMOTE_ADDR'];
$referer = $_SERVER['HTTP_REFERER'];
$sd = (date("Y")*7)+(date("m")*11)+(date("d")*331)+753;
$sdf = addslashes($_POST['sd']);
$datejour = date("d/m/Y H:i:s");

if ($sd != $sdf)
{
die("<p><b><ul><font color='#FF0000'>The system is down for maintenance. If this error persists, please contact the site administrator " . $configemail . "</font></ul></b></p><p><center><br /><br /><b><a href=\"javascript:history.back()\">Retourner au formulaire</a></b><br /><br /></center>");
}

// Validation mandatory fields

$validation = 0;
$monmessage = "";

if ($name == "")
{
$validation = $validation + 1;
$monmessage .= "<li>Nom</li>";
}

if ($email == "")
{
$validation = $validation + 1;
$monmessage .= "<li>Adresse e-mail</li>";
}
else
{
// Validation E-mail
if (! ereg('[A-Za-z0-9_-]+\@[A-Za-z0-9_-]+\.[A-Za-z0-9_-]+', $email))
{
$validation = $validation + 1;
$monmessage .= "<li>Adresse email de contact non conforme</li>";
}
}

if ($titre == "")
{
$validation = $validation + 1;
$monmessage .= "<li>Type d'erreur</li>";
}

// if ($commentaire == "")
// {
// $validation = $validation + 1;
// $monmessage .= "<li>Commentaire</li>";
// }

if ($validation > 0)
{
die("<p><b>Vous devez compléter ou corriger les informations suivantes :<br /><br /><font color='#FF0000'><ul>" . $monmessage . "</font></ul></b></p><p><center><br /><br /><b><a href=\"javascript:history.back()\">Retourner au formulaire</a></b><br /><br /></center>");
}


//Sending Email to form owner
# Email to Owner 
$pfw_header = "From: " . $configemail;
$pfw_subject = "Suggestion ou erreur sur la base de revues de " . $configinstitution;
$pfw_email_to = $configemailto;
$pfw_message = "Nouvelle suggestion ou erreur signalé sur la base de revues de " . $configinstitution . " :\n";
$pfw_message .= "\n";
$pfw_message .= "-------------------------------\n";
$pfw_message .= "Nom : " . $name . "\n";
$pfw_message .= "Adresse email : " . $email ."\n";
$pfw_message .= "Type d'erreur : " . $titre ."\n";
$pfw_message .= "Page qui pose problème : " . $siteweb ."\n";
$pfw_message .= "Lien cassé ou faux : " . $lien_rompu ."\n";
$pfw_message .= "Page referer : " . $page_referer ."\n";
$pfw_message .= "Commentaire : " . $commentaireligne . "\n";
$pfw_message .= "\n";
$pfw_message .= "Date de soumission du formulaire : " . $datejour . "\n";
$pfw_message .= "Referer : " . $referer . "\n";
$pfw_message .= "IP : " . $ip . "\n";
$pfw_message .= "-------------------------------\n";
mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;


//Sending auto respond Email to user
# Email to User 
$pfw_header = "From: " . $configemail;
$pfw_subject = "Nouvelle suggestion ou erreur sur la base de revues de " . $configinstitution . " : confirmation";
$pfw_email_to = $email;
$pfw_message = "Nous vous confirmons que votre suggestion ou erreur signalé \n";
$pfw_message .= "sur Revues de " . $configinstitution . " a été enregistrée avec succès.\n";
$pfw_message .= "\n";
$pfw_message .= "Voici le récapitulatif des données que vous avez soumis dans le formulaire.\n";
$pfw_message .= "Pour toute correction veuillez nous contacter.\n";
$pfw_message .= "\n";
$pfw_message .= "-------------------------------\n";
$pfw_message .= "Nom : " . $name . "\n";
$pfw_message .= "Adresse email : " . $email ."\n";
$pfw_message .= "Type d'erreur : " . $titre ."\n";
$pfw_message .= "Page qui pose problème : " . $siteweb ."\n";
if ($lien_rompu)
$pfw_message .= "Lien cassé ou faux : " . $lien_rompu ."\n";
if ($commentaireligne)
$pfw_message .= "Commentaire : " . $commentaireligne . "\n";
$pfw_message .= "\n";
$pfw_message .= "Date de soumission du formulaire : " . $datejour . "\n";
$pfw_message .= "-------------------------------\n";
$pfw_message .= "\n";
$pfw_message .= $configadresse;
$pfw_message .= "\n";
mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;


//saving record in a text file
$pfw_file_name = "data123.csv";
$pfw_first_raw = "Nom;Email;Page_web;Type_erreur;Lien_rompu;Page_referer;Commentaire;Date;Referer;IP\r\n";
$pfw_values = "$name;$email;$siteweb;$titre;$lien_rompu;$page_referer;$commentaireligne;$datejour;$referer;$ip\r\n";
$pfw_is_first_row = false;
if(!file_exists($pfw_file_name))
{
 $pfw_is_first_row = true ;
}
if (!$pfw_handle = fopen($pfw_file_name, 'a+')) {
 die("Cannot open file");
 exit;
}
if ($pfw_is_first_row)
{
  if (fwrite($pfw_handle, $pfw_first_raw ) === FALSE) {
  die("Cannot write to file");
  exit;
  }
}
if (fwrite($pfw_handle, $pfw_values) === FALSE) {
  die("Cannot write to file");
  exit;
}
fclose($pfw_handle);


//Page affichée
echo "<br/>\n";
echo "\n";
echo "<div id=\"feedback\">\n";
echo "<h2>Signaler une erreur ou soumettre une suggestion : Confirmation</h2>\n";
echo "<p>Merci pour votre suggestion ou pour nous avoir signalé une erreur, le formulaire a été enregistré avec succès et nous allons le traiter dans les meilleurs delais possibles.<br /><br />\n";
echo "Dans quelques instants vous recevrez par e-mail, à l'adresse de contact que vous avez indiqué, un message de confirmation avec les informations envoyées:</p><br /><ul>\n";
echo "<b>Nom : </b>" . $name . "<br />\n";
echo "<b>Adresse e-mail : </b>" . $email ."<br />\n";
echo "<b>Type d'erreur : </b>" . $titre ."<br />\n";
echo "<b>Page web qui pose problème : </b>" . $siteweb ."<br />\n";
if ($lien_rompu)
echo "<b>Adresse URL du lien cassé : </b>" . $lien_rompu ."<br />\n";
if ($commentaireligne)
echo "<b>Commentaire : </b>" . $commentaireligne ."<br />\n";
echo "<br />\n";
echo "<b>Date de soumission du formulaire : </b>" . $datejour . "<br />\n";
echo "</ul>\n";
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
