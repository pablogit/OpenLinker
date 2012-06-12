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
// Pied de page général commun à toutes les pages
echo "  <div class=\"footerArea\">\n";
echo "    <div class=\"footer\" id=\"footer\">\n";
echo "<a href=\"impressum.php\" class=\"liens\" >Impressum</a>\n";
echo "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href=\"mailto:" . $configemail . "\">Contact</a>\n";
echo "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href=\"feedback.php\">Signaler une erreur ou soumettre une suggestion</a>";
// echo "Site propulsé par <a href=\"http://www.openlinker.org\" target=\"_blank\">OpenLinker</a> | <a href=\"about.html\" target=\"_blank\">Plus d'informations sur ce projet</a><br />\n";
// echo "&copy; <a href=\"http://www.pablog.ch\" target=\"_blank\">Pablo Iriarte</a> <a href=\"http://www.chuv.ch/bdfm/\" target=\"_blank\">BiUM</a>/<a href=\"http://www.saphirdoc.ch/cdsp.htm\" target=\"_blank\">CDSP</a>, <a href=\"http://www.chuv.ch\">CHUV</a> - Lausanne\n";
echo "    </div>\n";
echo "  </div>\n";
echo "</div>\n";
echo "</body>\n";
echo "</html>";
?>
