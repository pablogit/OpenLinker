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
//
// Translations of terms used on front-end

if ($langautodetect = 1)
{
// Define language from URL (priority) or from browser prefs
$langs = array("fr", "en", "de", "it", "es");
if (!isset($_REQUEST["lang"]))
{
if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
{
$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
if(!in_array($lang, $langs))
{
// default language
$lang = "fr";
}
}
else
{
// default language
$lang = "fr"; 
}
}
else
{
$lang = $_REQUEST["lang"];
}
}
else
{
if (!isset($_REQUEST["lang"]))
$lang = "fr";
else
$lang = $_REQUEST["lang"];
}

// Name of the system displayed in the main menu bar and on title HTML tag
$configname["fr"] = "OpenLinker : Générateur de liens de la bibliothèque de l'université XYZ";
$configname["en"] = "OpenLinker : Link resolver of the XYZ University Library";
$configname["de"] = "OpenLinker : Link resolver of the XYZ University Library";
$configname["it"] = "OpenLinker : Link resolver of the XYZ University Library";
$configname["es"] = "OpenLinker : Link resolver of the XYZ University Library";

// Main institution name
$configinstitution["fr"] = "Université XYZ";
$configinstitution["en"] = "XYZ University";
$configinstitution["de"] = "XYZ Universität";
$configinstitution["it"] = "Università XYZ";
$configinstitution["es"] = "Universidad XYZ";

// Secondary institution name
$configinstitution2["fr"] = "Hôpital universitaire de XYZ";
$configinstitution2["en"] = "University Hospital XYZ";
$configinstitution2["de"] = "University Hospital XYZ";
$configinstitution2["it"] = "University Hospital XYZ";
$configinstitution2["es"] = "University Hospital XYZ";


// Library name
$configlibrary["fr"] = "Bibliothèque de l'Université XYZ";
$configlibrary["en"] = "XYZ University Library";
$configlibrary["de"] = "XYZ University Library";
$configlibrary["it"] = "XYZ University Library";
$configlibrary["es"] = "XYZ University Library";

// Library address displayed on description pages and messages 
$configadresse["fr"] = "Bibliothèque de l'Université XYZ\n";
$configadresse["fr"] .= "Bâtiment XY - Code postal 1234\n";
$configadresse["fr"] .= "Ville QW - Pays\n";
$configadresse["fr"] .= "Tel. +12 34 567 89 01\n";
$configadresse["fr"] .= "library@xyz.com\n";
$configadresse["fr"] .= "http://www.xyz.com/library\n";
$configadresse["en"] = "XYZ University Library\n";
$configadresse["en"] .= "Building XY - P.O. 1234\n";
$configadresse["en"] .= "City QW - Cowntry\n";
$configadresse["en"] .= "Tel. +12 34 567 89 01\n";
$configadresse["en"] .= "library@xyz.com\n";
$configadresse["en"] .= "http://www.xyz.com/library\n";
$configadresse["de"] = "XYZ University Library\n";
$configadresse["de"] .= "Building XY - P.O. 1234\n";
$configadresse["de"] .= "City QW - Cowntry\n";
$configadresse["de"] .= "Tel. +12 34 567 89 01\n";
$configadresse["de"] .= "library@xyz.com\n";
$configadresse["de"] .= "http://www.xyz.com/library\n";
$configadresse["it"] = "XYZ University Library\n";
$configadresse["it"] .= "Building XY - P.O. 1234\n";
$configadresse["it"] .= "City QW - Cowntry\n";
$configadresse["it"] .= "Tel. +12 34 567 89 01\n";
$configadresse["it"] .= "library@xyz.com\n";
$configadresse["it"] .= "http://www.xyz.com/library\n";
$configadresse["es"] = "XYZ University Library\n";
$configadresse["es"] .= "Building XY - P.O. 1234\n";
$configadresse["es"] .= "City QW - Cowntry\n";
$configadresse["es"] .= "Tel. +12 34 567 89 01\n";
$configadresse["es"] .= "library@xyz.com\n";
$configadresse["es"] .= "http://www.xyz.com/library\n";

// URL of the IT help desk
$confighelpdeskurl["fr"] = "http://www.xyz.com/help";
$confighelpdeskurl["en"] = "http://www.xyz.com/help";
$confighelpdeskurl["de"] = "http://www.xyz.com/help";
$confighelpdeskurl["it"] = "http://www.xyz.com/help";
$confighelpdeskurl["es"] = "http://www.xyz.com/help";

// Informations about document delivery team
$configteam["fr"] = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam["fr"] .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam["fr"] .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";
$configteam["en"] = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam["en"] .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam["en"] .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";
$configteam["de"] = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam["de"] .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam["de"] .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";
$configteam["it"] = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam["it"] .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam["it"] .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";
$configteam["es"] = "<li>Lorem Ipsum (lorem.ipsum@xyz.com) - Bibliothèque A</li>\n";
$configteam["es"] .= "<li>Ipsum Lorem (ipsum.lorem@xyz.com) - Bibliothèque B</li>\n";
$configteam["es"] .= "<li>John Smith (john.smith@xyz.com) - Bibliothèque C</li>\n";

// Name and URL of AtoZ system
$atozname["fr"] = "Journals AtoZ list";
$atozname["en"] = "Journals AtoZ list";
$atozname["de"] = "Journals AtoZ list";
$atozname["it"] = "Journals AtoZ list";
$atozname["es"] = "Journals AtoZ list";

$atozlinkurl["fr"] = "../openlist";
$atozlinkurl["en"] = "../openlist";
$atozlinkurl["de"] = "../openlist";
$atozlinkurl["it"] = "../openlist";
$atozlinkurl["es"] = "../openlist";

// Library web site URL
$configlibraryurl["fr"] = "http://www.xyz.com/library";
$configlibraryurl["en"] = "http://www.xyz.com/library";
$configlibraryurl["de"] = "http://www.xyz.com/library";
$configlibraryurl["it"] = "http://www.xyz.com/library";
$configlibraryurl["es"] = "http://www.xyz.com/library";

// Library email
$configlibraryemail["fr"] = "library@xyz.com";
$configlibraryemail["en"] = "library@xyz.com";
$configlibraryemail["de"] = "library@xyz.com";
$configlibraryemail["it"] = "library@xyz.com";
$configlibraryemail["es"] = "library@xyz.com";

// Document types (based on OpenURL spec)
$doctypes[0]["code"] = "article";
$doctypes[1]["code"] = "preprint";
$doctypes[2]["code"] = "book";
$doctypes[3]["code"] = "bookitem";
$doctypes[4]["code"] = "thesis";
$doctypes[5]["code"] = "journal";
$doctypes[6]["code"] = "proceeding";
$doctypes[7]["code"] = "conference";
$doctypes[8]["code"] = "other";
$doctypes[0]["fr"] = "Article";
$doctypes[0]["en"] = "Article";
$doctypes[0]["de"] = "Article";
$doctypes[0]["it"] = "Article";
$doctypes[0]["es"] = "Article";
$doctypes[1]["fr"] = "Preprint";
$doctypes[1]["en"] = "Preprint";
$doctypes[1]["de"] = "Preprint";
$doctypes[1]["it"] = "Preprint";
$doctypes[1]["es"] = "Preprint";
$doctypes[2]["fr"] = "Livre";
$doctypes[2]["en"] = "Book";
$doctypes[2]["de"] = "Buch";
$doctypes[2]["it"] = "Libri";
$doctypes[2]["es"] = "Libro";
$doctypes[3]["fr"] = "Chapitre de livre";
$doctypes[3]["en"] = "Book chapter";
$doctypes[3]["de"] = "Book chapter";
$doctypes[3]["it"] = "Book chapter";
$doctypes[3]["es"] = "Book chapter";
$doctypes[4]["fr"] = "Thèse";
$doctypes[4]["en"] = "Thesis";
$doctypes[4]["de"] = "Thesis";
$doctypes[4]["it"] = "Thesis";
$doctypes[4]["es"] = "Thesis";
$doctypes[5]["fr"] = "No de revue";
$doctypes[5]["en"] = "Journal issue";
$doctypes[5]["de"] = "Journal issue";
$doctypes[5]["it"] = "Journal issue";
$doctypes[5]["es"] = "Journal issue";
$doctypes[6]["fr"] = "Actes d'un congrès";
$doctypes[6]["en"] = "Conference proceedings";
$doctypes[6]["de"] = "Conference proceedings";
$doctypes[6]["it"] = "Conference proceedings";
$doctypes[6]["es"] = "Conference proceedings";
$doctypes[7]["fr"] = "Article d'une conference";
$doctypes[7]["en"] = "Conference paper";
$doctypes[7]["de"] = "Conference paper";
$doctypes[7]["it"] = "Conference paper";
$doctypes[7]["es"] = "Conference paper";
$doctypes[8]["fr"] = "Autre";
$doctypes[8]["en"] = "Other";
$doctypes[8]["de"] = "Other";
$doctypes[8]["it"] = "Other";
$doctypes[8]["es"] = "Other";

// Commons terms

$loginmessage["fr"] = "Se connecter";
$loginmessage["en"] = "Login";
$loginmessage["de"] = "Login";
$loginmessage["it"] = "Login";
$loginmessage["es"] = "Login";

$logout["fr"] = "Déconnexion";
$logout["en"] = "Logout";
$logout["de"] = "Logout";
$logout["it"] = "Logout";
$logout["es"] = "Logout";

$neworder["fr"] = "Nouvelle commande";
$neworder["en"] = "New Order";
$neworder["de"] = "Neue Bestellung";
$neworder["it"] = "Nuovo ordine";
$neworder["es"] = "Nuevo pedido";

$inhelp["fr"] = "Commanes à fournir ou à valider";
$inhelp["en"] = "Inbox";
$inhelp["de"] = "Inbox";
$inhelp["it"] = "Inbox";
$inhelp["es"] = "Inbox";

$inbox["fr"] = "In";
$inbox["en"] = "In";
$inbox["de"] = "In";
$inbox["it"] = "In";
$inbox["es"] = "In";

$outhelp["fr"] = "Commandes envoyées à l'extérieur et pas encore reçues";
$outhelp["en"] = "Orders sent to the outside and not yet received";
$outhelp["de"] = "Orders sent to the outside and not yet received";
$outhelp["it"] = "Orders sent to the outside and not yet received";
$outhelp["es"] = "Orders sent to the outside and not yet received";

$outbox["fr"] = "Out";
$outbox["en"] = "Out";
$outbox["de"] = "Out";
$outbox["it"] = "Out";
$outbox["es"] = "Out";

$allhelp["fr"] = "Toutes les commandes";
$allhelp["en"] = "All orders";
$allhelp["de"] = "All orders";
$allhelp["it"] = "All orders";
$allhelp["fr"] = "All orders";

$allbox["fr"] = "All";
$allbox["en"] = "All";
$allbox["de"] = "All";
$allbox["it"] = "All";
$allbox["es"] = "All";

$trashhelp["fr"] = "Commandes supprimées";
$trashhelp["en"] = "Orders deleted";
$trashhelp["de"] = "Orders deleted";
$trashhelp["it"] = "Orders deleted";
$trashhelp["es"] = "Orders deleted";

$trashbox["fr"] = "Trash";
$trashbox["en"] = "Trash";
$trashbox["de"] = "Trash";
$trashbox["it"] = "Trash";
$trashbox["es"] = "Trash";

$adminhelp["fr"] = "Administration des utilisateurs et des valeurs";
$adminhelp["en"] = "Administration of users and values";
$adminhelp["de"] = "Administration of users and values";
$adminhelp["it"] = "Administration of users and values";
$adminhelp["es"] = "Administration of users and values";

$admindisp["fr"] = "Administration";
$admindisp["en"] = "Administration";
$admindisp["de"] = "Administration";
$admindisp["it"] = "Administration";
$admindisp["es"] = "Administration";

$myordershelp["fr"] = "Voir toutes mes commandes";
$myordershelp["en"] = "See all my orders";
$myordershelp["de"] = "See all my orders";
$myordershelp["it"] = "See all my orders";
$myordershelp["es"] = "See all my orders";

$myorders["fr"] = "Mes commandes";
$myorders["en"] = "My orders";
$myorders["de"] = "My orders";
$myorders["it"] = "My orders";
$myorders["es"] = "My orders";

$firstmessage["fr"] = "Formulaire de commande de documents à la ";
$firstmessage["en"] = "Document order form to the ";
$firstmessage["de"] = "Document order form to the ";
$firstmessage["it"] = "Document order form to the ";
$firstmessage["es"] = "Document order form to the ";

$statusmessage["fr"] = "Stade";
$statusmessage["en"] = "Status";
$statusmessage["de"] = "Status";
$statusmessage["it"] = "Status";
$statusmessage["es"] = "Status";

$localisationmessage["fr"] = "Localisation";
$localisationmessage["en"] = "Localization";
$localisationmessage["de"] = "Localization";
$localisationmessage["it"] = "Localization";
$localisationmessage["es"] = "Localization";

$localisationintmessage["fr"] = "Localisations propres";
$localisationintmessage["en"] = "Our Localizations";
$localisationintmessage["de"] = "Our Localizations";
$localisationintmessage["it"] = "Our Localizations";
$localisationintmessage["es"] = "Our Localizations";

$localisationextmessage["fr"] = "Bibliothèques du réseau";
$localisationextmessage["en"] = "Network libraries";
$localisationextmessage["de"] = "Network libraries";
$localisationextmessage["it"] = "Network libraries";
$localisationextmessage["es"] = "Network libraries";

$prioritymessage["fr"] = "Priorité";
$prioritymessage["en"] = "Priority";
$prioritymessage["de"] = "Priority";
$prioritymessage["it"] = "Priority";
$prioritymessage["es"] = "Priority";

$prioritynormmessage["fr"] = "Normale";
$prioritynormmessage["en"] = "Normal";
$prioritynormmessage["de"] = "Normal";
$prioritynormmessage["it"] = "Normal";
$prioritynormmessage["es"] = "Normal";

$priorityurgmessage["fr"] = "Urgente";
$priorityurgmessage["en"] = "Urgent";
$priorityurgmessage["de"] = "Urgent";
$priorityurgmessage["it"] = "Urgent";
$priorityurgmessage["es"] = "Urgent";

$prioritynonemessage["fr"] = "Pas prioritaire";
$prioritynonemessage["en"] = "Not a priority";
$prioritynonemessage["de"] = "Not a priority";
$prioritynonemessage["it"] = "Not a priority";
$prioritynonemessage["es"] = "Not a priority";

$sourcemessage["fr"] = "Origine de la commande";
$sourcemessage["en"] = "Origin of the order";
$sourcemessage["de"] = "Origin of the order";
$sourcemessage["it"] = "Origin of the order";
$sourcemessage["es"] = "Origin of the order";

$addvaluemessage["fr"] = "Ajouter une valeur...";
$addvaluemessage["en"] = "Add new value...";
$addvaluemessage["de"] = "Add new value...";
$addvaluemessage["it"] = "Add new value...";
$addvaluemessage["es"] = "Add new value...";

$orderdatehelpmessage["fr"] = "à remplir uniquement si différente de la date du jour";
$orderdatehelpmessage["en"] = "to be completed only if different from the current date";
$orderdatehelpmessage["de"] = "to be completed only if different from the current date";
$orderdatehelpmessage["it"] = "to be completed only if different from the current date";
$orderdatehelpmessage["es"] = "to be completed only if different from the current date";

$orderdatemessage["fr"] = "Date de commande";
$orderdatemessage["en"] = "Order date";
$orderdatemessage["de"] = "Order date";
$orderdatemessage["it"] = "Order date";
$orderdatemessage["es"] = "Order date";

$ordersentdatemessage["fr"] = "Date d'envoi";
$ordersentdatemessage["en"] = "Date of shipment";
$ordersentdatemessage["de"] = "Date of shipment";
$ordersentdatemessage["it"] = "Date of shipment";
$ordersentdatemessage["es"] = "Date of shipment";

$orderfactdatemessage["fr"] = "Date de facturation";
$orderfactdatemessage["en"] = "Invoice date";
$orderfactdatemessage["de"] = "Invoice date";
$orderfactdatemessage["it"] = "Invoice date";
$orderfactdatemessage["es"] = "Invoice date";

$orderrenewdatemessage["fr"] = "A renouveler le";
$orderrenewdatemessage["en"] = "To be renewed on";
$orderrenewdatemessage["de"] = "To be renewed on";
$orderrenewdatemessage["it"] = "To be renewed on";
$orderrenewdatemessage["es"] = "To be renewed on";

$pricemessage["fr"] = "Prix (CHF)";
$pricemessage["en"] = "Price (CHF)";
$pricemessage["de"] = "Price (CHF)";
$pricemessage["it"] = "Price (CHF)";
$pricemessage["es"] = "Price (CHF)";

$paidadvmessage["fr"] = "commande payée à l'avance";
$paidadvmessage["en"] = "order paid in advance";
$paidadvmessage["de"] = "order paid in advance";
$paidadvmessage["it"] = "order paid in advance";
$paidadvmessage["es"] = "order paid in advance";

$refextmessage["fr"] = "Réf. fournisseur";
$refextmessage["en"] = "Provider Ref.";
$refextmessage["de"] = "Provider Ref.";
$refextmessage["it"] = "Provider Ref.";
$refextmessage["es"] = "Provider Ref.";

$refintmessage["fr"] = "Réf. interne à la bibliothèque";
$refintmessage["en"] = "Ref. internal to the library";
$refintmessage["de"] = "Ref. internal to the library";
$refintmessage["it"] = "Ref. internal to the library";
$refintmessage["es"] = "Ref. internal to the library";

$alertmessage["fr"] = "Attention, toute commande est soumise à une participation financière";
$alertmessage["en"] = "Please note, all orders are subject to a financial contribution";
$alertmessage["de"] = "Please note, all orders are subject to a financial contribution";
$alertmessage["it"] = "Please note, all orders are subject to a financial contribution";
$alertmessage["es"] = "Please note, all orders are subject to a financial contribution";

$informationmessage["fr"] = "Pour plus de renseignements (tarifs, facturation, etc.) contactez nous par courriel";
$informationmessage["en"] = "Contact us by email for more information (pricing, billing, etc.)";
$informationmessage["de"] = "Contact us by email for more information (pricing, billing, etc.)";
$informationmessage["it"] = "Contact us by email for more information (pricing, billing, etc.)";
$informationmessage["es"] = "Contact us by email for more information (pricing, billing, etc.)";

$namemessage["fr"] = "Nom";
$namemessage["en"] = "Family name";
$namemessage["de"] = "Family name";
$namemessage["it"] = "Family name";
$namemessage["es"] = "Family name";

$firstnamemessage["fr"] = "Prénom";
$firstnamemessage["en"] = "First name";
$firstnamemessage["de"] = "First name";
$firstnamemessage["it"] = "First name";
$firstnamemessage["es"] = "First name";

$directory1message["fr"] = "Chercher le nom dans l'annuaire de l'université";
$directory1message["en"] = "Search the name in the directory of the university";
$directory1message["de"] = "Search the name in the directory of the university";
$directory1message["it"] = "Search the name in the directory of the university";
$directory1message["es"] = "Search the name in the directory of the university";

$directory2message["fr"] = "Chercher le nom dans l'annuaire de l'hôpital";
$directory2message["en"] = "Search the name in the directory of the hospital";
$directory2message["de"] = "Search the name in the directory of the hospital";
$directory2message["it"] = "Search the name in the directory of the hospital";
$directory2message["es"] = "Search the name in the directory of the hospital";

$unitmessage["fr"] = "Service";
$unitmessage["en"] = "Unit";
$unitmessage["de"] = "Unit";
$unitmessage["it"] = "Unit";
$unitmessage["es"] = "Unit";

$unitothermessage["fr"] = "Autre service";
$unitothermessage["en"] = "Other unit";
$unitothermessage["de"] = "Other unit";
$unitothermessage["it"] = "Other unit";
$unitothermessage["es"] = "Other unit";

$cgramessage["fr"] = "Code budgetaire";
$cgramessage["en"] = "Budget heading";
$cgramessage["de"] = "Budget heading";
$cgramessage["it"] = "Budget heading";
$cgramessage["es"] = "Budget heading";

$cgrbmessage["fr"] = "Ligne budgetaire";
$cgrbmessage["en"] = "Budget subheading";
$cgrbmessage["de"] = "Budget subheading";
$cgrbmessage["it"] = "Budget subheading";
$cgrbmessage["es"] = "Budget subheading";

$emailmessage["fr"] = "E-Mail";
$emailmessage["en"] = "E-Mail";
$emailmessage["de"] = "E-Mail";
$emailmessage["it"] = "E-Mail";
$emailmessage["es"] = "E-Mail";

$telmessage["fr"] = "Tél.";
$telmessage["en"] = "Tel.";
$telmessage["de"] = "Tel.";
$telmessage["it"] = "Tel.";
$telmessage["es"] = "Tel.";

$addressmessage["fr"] = "Adresse privée";
$addressmessage["en"] = "Private address";
$addressmessage["de"] = "Private address";
$addressmessage["it"] = "Private address";
$addressmessage["es"] = "Private address";

$cpmessage["fr"] = "Code postal";
$cpmessage["en"] = "Zip code";
$cpmessage["de"] = "Zip code";
$cpmessage["it"] = "Zip code";
$cpmessage["es"] = "Zip code";

$citymessage["fr"] = "Localité";
$citymessage["en"] = "City";
$citymessage["de"] = "City";
$citymessage["it"] = "City";
$citymessage["es"] = "City";

$dispomessage["fr"] = "Si disponible à la bibliothèque";
$dispomessage["en"] = "If available at the library";
$dispomessage["de"] = "If available at the library";
$dispomessage["it"] = "If available at the library";
$dispomessage["es"] = "If available at the library";

$dispofactmessage["fr"] = "envoi par e-mail (facturé)";
$dispofactmessage["en"] = "send by e-mail (billed)";
$dispofactmessage["de"] = "send by e-mail (billed)";
$dispofactmessage["it"] = "send by e-mail (billed)";
$dispofactmessage["es"] = "send by e-mail (billed)";

$disponotfactmessage["fr"] = "m'avertir et je passe faire la copie (non facturé)";
$disponotfactmessage["en"] = "let me know and I come to make a copy (not billed)";
$disponotfactmessage["de"] = "let me know and I come to make a copy (not billed)";
$disponotfactmessage["it"] = "let me know and I come to make a copy (not billed)";
$disponotfactmessage["es"] = "let me know and I come to make a copy (not billed)";

$savecookiemessage["fr"] = "Mémoriser ces données pour les prochaines commandes (cookies autorisées)";
$savecookiemessage["en"] = "Remember data for future orders (cookies allowed)";
$savecookiemessage["de"] = "Remember data for future orders (cookies allowed)";
$savecookiemessage["it"] = "Remember data for future orders (cookies allowed)";
$savecookiemessage["es"] = "Remember data for future orders (cookies allowed)";

$deletecookiemessage["fr"] = "supprimer le cookie";
$deletecookiemessage["en"] = "delete the cookie";
$deletecookiemessage["de"] = "delete the cookie";
$deletecookiemessage["it"] = "delete the cookie";
$deletecookiemessage["es"] = "delete the cookie";

$lookupmessage["fr"] = "Remplir la commande à partir du";
$lookupmessage["en"] = "Fulfill the order from";
$lookupmessage["de"] = "Fulfill the order from";
$lookupmessage["it"] = "Fulfill the order from";
$lookupmessage["es"] = "Fulfill the order from";

$stitlemessage["fr"] = "Titre du périodique ou du livre";
$stitlemessage["en"] = "Title of journal or book";
$stitlemessage["de"] = "Title of journal or book";
$stitlemessage["it"] = "Title of journal or book";
$stitlemessage["es"] = "Title of journal or book";

$atozlinkmessage["fr"] = "vérifier sur la base des périodiques";
$atozlinkmessage["en"] = "check on journals database";
$atozlinkmessage["de"] = "check on journals database";
$atozlinkmessage["it"] = "check on journals database";
$atozlinkmessage["es"] = "check on journals database";

$yearmessage["fr"] = "Année";
$yearmessage["en"] = "Year";
$yearmessage["de"] = "Year";
$yearmessage["it"] = "Year";
$yearmessage["es"] = "Year";

$volumemessage["fr"] = "Vol.";
$volumemessage["en"] = "Vol.";
$volumemessage["de"] = "Vol.";
$volumemessage["it"] = "Vol.";
$volumemessage["es"] = "Vol.";

$issuemessage["fr"] = "(No)";
$issuemessage["en"] = "(Issue)";
$issuemessage["de"] = "(Issue)";
$issuemessage["it"] = "(Issue)";
$issuemessage["es"] = "(Issue)";

$supplementmessage["fr"] = "Suppl.";
$supplementmessage["en"] = "Suppl.";
$supplementmessage["de"] = "Suppl.";
$supplementmessage["it"] = "Suppl.";
$supplementmessage["es"] = "Suppl.";

$pagesmessage["fr"] = "Pages";
$pagesmessage["en"] = "Pages";
$pagesmessage["de"] = "Pages";
$pagesmessage["it"] = "Pages";
$pagesmessage["es"] = "Pages";

$atitlemessage["fr"] = "Titre de l'article ou du chapitre";
$atitlemessage["en"] = "Title of article or book chapter";
$atitlemessage["de"] = "Title of article or book chapter";
$atitlemessage["it"] = "Title of article or book chapter";
$atitlemessage["es"] = "Title of article or book chapter";

$authorsmessage["fr"] = "Auteur(s)";
$authorsmessage["en"] = "Author(s)";
$authorsmessage["de"] = "Author(s)";
$authorsmessage["it"] = "Author(s)";
$authorsmessage["es"] = "Author(s)";

$editionmessage["fr"] = "Edition (pour les livres)";
$editionmessage["en"] = "Edition (for books)";
$editionmessage["de"] = "Edition (for books)";
$editionmessage["it"] = "Edition (for books)";
$editionmessage["es"] = "Edition (for books)";

$commentsmessage["fr"] = "Remarques professionneles";
$commentsmessage["en"] = "Professional Notes";
$commentsmessage["de"] = "Professional Notes";
$commentsmessage["it"] = "Professional Notes";
$commentsmessage["es"] = "Professional Notes";

$publiccommentsmessage["fr"] = "Remarques";
$publiccommentsmessage["en"] = "Notes";
$publiccommentsmessage["de"] = "Notes";
$publiccommentsmessage["it"] = "Notes";
$publiccommentsmessage["es"] = "Notes";

$submitmessage["fr"] = "Enregistrer";
$submitmessage["en"] = "Submit";
$submitmessage["de"] = "Submit";
$submitmessage["it"] = "Submit";
$submitmessage["es"] = "Submit";

$resetmessage["fr"] = "Effacer";
$resetmessage["en"] = "Reset";
$resetmessage["de"] = "Reset";
$resetmessage["it"] = "Reset";
$resetmessage["es"] = "Reset";

$newlinks["fr"] = "Générer des nouveaux liens";
$newlinks["en"] = "Reset";
$newlinks["de"] = "Reset";
$newlinks["it"] = "Reset";
$newlinks["es"] = "Reset";

$poweredmessage["fr"] = "Site propulsé par <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a><br />";
$poweredmessage["en"] = "Powered by <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a><br />";
$poweredmessage["de"] = "Powered by <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a><br />";
$poweredmessage["it"] = "Powered by <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a><br />";
$poweredmessage["es"] = "Powered by <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a><br />";

$copyrightmessage["fr"] = "&copy; <a href=\"http://www.pablog.ch\" target=\"_blank\">Pablo Iriarte</a> <a href=\"http://www.chuv.ch/bdfm/\" target=\"_blank\">BiUM</a>/<a href=\"http://www.chuv.ch\">CHUV</a> Lausanne & <a href=\"http://jankrause.net\" target=\"_blank\">Jan Krause</a> <a href=\"http://www.unige.ch/medecine/bibliotheque/\" target=\"_blank\">BFM</a>/<a href=\"http://www.unige.ch\" target=\"_blank\">UNIGE</a> Genève";




?>
