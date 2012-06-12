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
// Message displayed if the login fails or if the permissions are fewer than required
//
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<b><font color=\"red\">Vous n'êtes pas autorisé à acceder à cette page ou votre session a expiré</font></b><br />\n";
echo "<form name=\"loginform\" id=\"loginform\" action=\"login.php\" method=\"post\">\n";
echo "<p><label>Username:<br /><input type=\"text\" name=\"log\" id=\"log\" value=\"\" size=\"20\" tabindex=\"1\" /></label></p>\n";
echo "<p><label>Password:<br /> <input type=\"password\" name=\"pwd\" id=\"pwd\" value=\"\" size=\"20\" tabindex=\"2\" /></label></p>\n";
echo "<p>\n";
// echo "  <label><input name=\"rememberme\" type=\"checkbox\" id=\"rememberme\" value=\"forever\" tabindex=\"3\" /> \n";
// echo "  Garder en mémoire</label></p>\n";
// echo "<p>\n";
echo "	<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"login\" tabindex=\"4\" />\n";
echo "	<input type=\"hidden\" name=\"redirect_to\" value=\"in/\" />\n";
echo "</p>\n";
echo "<br />\n";
echo "</div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "</form>\n";

?>
