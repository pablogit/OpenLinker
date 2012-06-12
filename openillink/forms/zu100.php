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
// Order form for Zu100
// 
// The follow customer values must be coded in the link URL :
// my_customer_code
// my_customer_name
// my_contact_name
// my_contact_phone
// my_contact_email
// my_contact_address
// my_contact_city
// my_contact_cp
// my_contact_cowntry
// 
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<h2>Envoi de la commande à Zurich 100</h2>\n";
echo "<FORM method=\"post\" name=\"illform_mbc\" action=\"http://www.uzh.ch/cgi-bin/mailform\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"---TO\" value=\"orders@hbz.uzh.ch\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"-FROM\" value=\"mbc@hbz.uzh.ch\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"-NAME\" value=\"W*W*W\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"-Subject\" value=\"WWW-Bestellung\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"-is_required\" value=\"a-Name:A-SO:B-PY:l-Lieferart\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"-footer\" value=\"INCLUDE:http://www.hbz.uzh.ch/staticfiles/bestaet.html\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\"></TD></TR>\n";
echo "<TR><TD>Name: </TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"a-Name\" value=\"" . $_GET['my_contact_name'] . "\"></TD></TR>\n";
echo "<TR><TD>Inst:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"b-Inst\" value=\"" . $_GET['my_customer_name'] . "\"></TD></TR>\n";
echo "<TR><TD>Str.:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"c-Str.\" value=\"" . $_GET['my_contact_address'] . "\"></TD></TR>\n";
echo "<TR><TD>Ort:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"d-Ort\" value=\"" . $_GET['my_contact_city'] . "; " . $_GET['my_contact_cp'] . ", " . $_GET['my_contact_cowntry'] ."\"></TD></TR>\n";
echo "<TR><TD>Tel:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"e-Tel\" value=\"" . $_GET['my_contact_phone'] . "\"></TD></TR>\n";
echo "<TR><TD>Bnum:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"f-Bnum\" VALUE=\"" . $_GET['my_customer_code'] . "\"></TD></TR>\n";
echo "<TR><TD>email:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"h-email\" VALUE=\"" . $_GET['my_contact_email'] . "\"></TD></TR>\n";
echo "<TR><TD>SO:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"A-SO\" VALUE=\"".$enreg['titre_periodique']."\"></TD></TR>\n";
echo "<TR><TD>ISSN:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"H-ISSN\" VALUE=\"".$enreg['issn']."\"></TD></TR>\n";
echo "<TR><TD>PY:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"B-PY\" VALUE=\"".$enreg['annee']."\"></TD></TR>\n";
echo "<TR><TD>VO:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"C-VO\" VALUE=\"".$enreg['volume']."\"></TD></TR>\n";
echo "<TR><TD>IS:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"D-IS\" VALUE=\"".$issue2."\"></TD></TR>\n";
echo "<TR><TD>PG:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"E-PG\" VALUE=\"".$enreg['pages']."\"></TD></TR>\n";
echo "<TR><TD>AU:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"F-AU\" VALUE=\"".$enreg['auteurs']."\"></TD></TR>\n";
echo "<TR><TD>TI:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"G-TI\" VALUE=\"".$enreg['titre_article']."\"></TD></TR>\n";
echo "<TR><TD>Bemerkung:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"z-Bemerkung\" VALUE=\"".$enreg['nom'].", ".$enreg['prenom']." (".$enreg['illinkid'].")\"></TD></TR>\n";
echo "<TR><TD>Ausland:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"k-Ausland\" VALUE=\"Inland\"></TD></TR>\n";
echo "<TR><TD>Lieferart:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"l-Lieferart\" VALUE=\"pdf\"></TD></TR>\n";
echo "<TR><TD>Conf:</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"z-Conf\" VALUE=\"Ja\"></TD></TR>\n";
echo "<TR><TD></TD><TD><INPUT TYPE=\"submit\" NAME=\"Submit\" VALUE=\"Senden\"> &nbsp;\n";
echo "<INPUT TYPE=\"reset\" NAME=\"Submit2\" VALUE=\"Löschen\"></TD></TR></TABLE>\n";
echo "</FORM>\n";
}
else
{
require ("../includes/header.php");
require ("../includes/loginfail.php");
require ("../includes/footer.php");
}
?>
