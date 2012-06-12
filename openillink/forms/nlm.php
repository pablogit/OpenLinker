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
// Order form for the NLM
// 
// The follow customer values must be coded in the link URL :
// my_customer_code
// my_customer_name
// my_contact_first_name
// my_contact_last_name
// my_contact_phone
// my_contact_email
// my_price_limit
// my_delivery_email
// 
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<h2>Envoi de la commande à la NLM</h2>\n";
echo "<FORM method=\"post\" action=\"http://wwwcf.nlm.nih.gov/mainweb/siebel/ill/index.cfm?stage=submit&lang=en\" name=\"ILLrequest\" id=\"ILLrequest\" enctype=\"multipart/form-data\" target=\"_blank\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\">\n";
echo "<TR><TD colspan=\"2\">\n";
echo "I certify that the request complies with:</TD></TD></TR>\n";
echo "<TR><TD colspan=\"2\">\n";
echo "<INPUT TYPE=\"radio\" NAME=\"request\" value=\"108(g)(2) Guidelines (CCG)\">&&nbsp;108(g)(2) Guidelines (CCG)</TD></TR>\n";
echo "<TR><TD colspan=\"2\">\n";
echo "<INPUT TYPE=\"radio\" NAME=\"request\" value=\"other provision of copyright (CCL)\" checked>&nbsp;other provision of copyright (CCL)</TD></TR>\n";
echo "<TR><TD>Authorized by: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"authorized\" value=\"".$enreg['nom'].", ".$enreg['prenom']."\"></TD></TR>\n";
echo "<TR><TD>LIBID: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"libid\" value=\"" . $_GET['my_customer_code'] . "\"></TD></TR>\n";
echo "<TR><TD>Borrowing Library: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"borrowing\" value=\"" . $_GET['my_customer_name'] . "\"></TD></TR>\n";
echo "<TR><TD>Contact first name: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"firstname\" value=\"" . $_GET['my_contact_first_name'] . "\"></TD></TR>\n";
echo "<TR><TD>Contact last name: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"lastname\" value=\"" . $_GET['my_contact_last_name'] . "\"></TD></TR>\n";
echo "<TR><TD>Contact phone: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"phone\" value=\"" . $_GET['my_contact_phone'] . "\"></TD></TR>\n";
echo "<TR><TD>Contact email: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"email\" VALUE=\"" . $_GET['my_contact_email'] . "\"></TD></TR>\n";
echo "<TR><TD>PubMed ID: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"pubmedid\" VALUE=\"".$enreg['PMID']."\"></TD></TR>\n";
echo "<TR><TD>NLM Unique ID: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"UniqueID\" VALUE=\"".$enreg['uid']."\"></TD></TR>\n";
echo "<TR><TD>Title: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"title\" VALUE=\"".$enreg['titre_periodique']."\"></TD></TR>\n";
if (($enreg['type_doc'] != "article")&&($enreg['type_doc'] != "bookitem")&&($enreg['type_doc'] != ""))
echo "<TR><TD>Author: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"author\" VALUE=\"".$enreg['auteurs']."\"></TD></TR>\n";
else
echo "<TR><TD>Author: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"author\" VALUE=\"\"></TD></TR>\n";
echo "<TR><TD>Article or chapter title: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"article\" VALUE=\"".$enreg['titre_article']."\"></TD></TR>\n";
echo "<TR><TD>Article or chapter author: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"articleauthor\" VALUE=\"".$enreg['auteurs']."\"></TD></TR>\n";
echo "<TR><TD>Publisher: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"publisher\" VALUE=\"".$enreg['edition']."\"></TD></TR>\n";
echo "<TR><TD>Place: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"place\" VALUE=\"\"></TD></TR>\n";
echo "<TR><TD>ISSN/ISBN: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"issn\" VALUE=\"".$enreg['issn']."\"></TD></TR>\n";
echo "<TR><TD>Year: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"year\" VALUE=\"".$enreg['annee']."\"></TD></TR>\n";
echo "<TR><TD>Volume: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"volume\" VALUE=\"".$enreg['volume']."\"></TD></TR>\n";
echo "<TR><TD>Issue: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"issue\" VALUE=\"".$issue2."\"></TD></TR>\n";
echo "<TR><TD>Pages: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"pages\" VALUE=\"".$enreg['pages']."\"></TD></TR>\n";
echo "<TR><TD>Material Type :</TD><TD>\n";
echo "<INPUT TYPE=\"radio\" NAME=\"material\" VALUE=\"Journal\"";
if (($enreg['type_doc'] == "article")||($enreg['type_doc'] == "bookitem")||($enreg['type_doc'] == ""))
echo " checked";
echo " /> Journal | \n";
echo "<INPUT TYPE=\"radio\" NAME=\"material\" VALUE=\"Monograph / Audiovisual\"";
if (($enreg['type_doc'] != "article")&&($enreg['type_doc'] != "bookitem")&&($enreg['type_doc'] != ""))
echo " checked";
echo " /> Monograph / Audiovisual</TD></TR>\n";
echo "<TR><TD>Maximum willing to pay: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"willingtopay\" VALUE=\"" . $_GET['my_price_limit'] . "\"></TD></TR>\n";
echo "<TR><TD>Patron name/Reference #: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"patronname\" value=\"".$enreg['nom'].", ".$enreg['prenom']."\"></TD></TR>\n";
echo "<TR><TD>Need before (MM/DD/YYYY): </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"needbefore\" value=\"\"></TD></TR>\n";
echo "<TR><TD>Comments: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"comments\" VALUE=\"Internal ref. ".$enreg['illinkid']."\"></TD></TR>\n";
echo "<TR><TD>Service Type:</TD><TD>\n";
echo "<INPUT TYPE=\"radio\" NAME=\"service\" value=\"Copy\" checked /> Copy | \n";
echo "<INPUT TYPE=\"radio\" NAME=\"service\" value=\"Color copy\" /> Color copy | \n";
echo "<INPUT TYPE=\"radio\" NAME=\"service\" value=\"Loan (US and US territories only)\" /> Loan (US and US territories only)</TD></TR>\n";
echo "<TR><TD>Deliver request via:</TD><TD>\n";
echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"EmailPDF\" checked /> Email PDF</TD></TR>\n";
// echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"WebPDF\"> Web PDF</TD></TR>\n";
// echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"ArielID\"> Ariel</TD></TR>\n";
// echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"OdysseyID\"> Odyssey</TD></TR>\n";
// echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"FaxID\"> Fax</TD></TR>\n";
// echo "<INPUT TYPE=\"radio\" NAME=\"delivery\" value=\"Mail\"> Poste</TD></TR>\n";
echo "<TR><TD>Email address: </TD><TD><INPUT TYPE=\"text\" size=\"60\" NAME=\"pdfemail\" VALUE=\"" . $_GET['my_delivery_email'] . "\"></TD></TR>\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"pdfweb\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"ariel\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"odyssey\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"faxnumber\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"altAddr\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailName\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailAddress\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailCity\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailState\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailZip\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailCountry\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"mailAddress\" VALUE=\"\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"from\" value=\"http://www.nlm.nih.gov/psd/cas/illhome.html\">\n";
// echo "<INPUT TYPE=\"reset\" VALUE=\"Cancel\"></TD></TR>\n";
echo "<TR><TD></TD><TD><INPUT TYPE=\"submit\" NAME=\"send\" VALUE=\"Order\"></TD></TR></TABLE>\n";
echo "</FORM>\n";
}
else
{
require ("../includes/header.php");
require ("../includes/loginfail.php");
require ("../includes/footer.php");
}
?>
