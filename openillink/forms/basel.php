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
// Order form for Basel Library network
// 
// The follow customer values must be coded in the link URL :
// my_customer_code
// my_customer_password
// my_customer_name
// 
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
echo "<h2>Envoi de la commande au réseau Bâle/Berne</h2>\n";
echo "<FORM method=\"post\" name=\"ILL\" action=\"http://www.ub.unibas.ch/cgi-bin/sfx_dod_m.pl\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"pickup\" VALUE=\"EMAIL - E-Mail\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"sfxurl\" value=\"#sfxurl\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"legal\" VALUE=\"on\">\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"B1\" VALUE=\"Bestellung abschicken\">\n";
echo "<Table Border=\"0\" Cellspacing=\"0\" Cellpadding=\"3\" width=\"100%\"></TD></TR>\n";
echo "<TR><TD>uid</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"uid\" VALUE=\"" . $_GET['my_customer_code'] . "\"></TD></TR>\n";
echo "<TR><TD>pwd</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"pwd\" VALUE=\"" . $_GET['my_customer_password'] . "\"></TD></TR>\n";
echo "<TR><TD>Source</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Source\" VALUE=\"OpenILLink (" . $_GET['my_customer_name'] . ")\"></TD></TR>\n";
echo "<TR><TD>meduid</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"meduid\" VALUE=\"".$enreg['PMID']."\"></TD></TR>\n";
echo "<TR><TD>Journal</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Journal\" VALUE=\"".$enreg['titre_periodique']."\"></TD></TR>\n";
echo "<TR><TD>ISSN</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"ISSN\" VALUE=\"".$enreg['issn']."\"></TD></TR>\n";
echo "<TR><TD>Year</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Year\" VALUE=\"".$enreg['annee']."\"></TD></TR>\n";
echo "<TR><TD>Volume</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Volume\" VALUE=\"".$enreg['volume']."\"></TD></TR>\n";
echo "<TR><TD>Issue</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Issue\" VALUE=\"".$issue2."\"></TD></TR>\n";
echo "<TR><TD>Pages</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Pages\" VALUE=\"".$enreg['pages']."\"></TD></TR>\n";
echo "<TR><TD>Author</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Author\" VALUE=\"".$enreg['auteurs']."\"></TD></TR>\n";
echo "<TR><TD>Article</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"Article\" VALUE=\"".$enreg['titre_article']."\"></TD></TR>\n";
echo "<TR><TD>bemerkung</TD><TD><INPUT TYPE=\"text\" SIZE=\"60\" NAME=\"bemerkung\" VALUE=\"".$enreg['nom'].", ".$enreg['prenom']." (".$enreg['illinkid'].")\"></TD></TR>\n";
echo "<TR><TD></TD><TD><INPUT TYPE=\"submit\" NAME=\"action\" VALUE=\"submit\"></TD></TR></TABLE>\n";
echo "</FORM>\n";
}
else
{
require ("../includes/header.php");
require ("../includes/loginfail.php");
require ("../includes/footer.php");
}
?>
