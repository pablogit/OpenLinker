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
// Entête générale commune à la plupart des pages

header ('Content-type: text/html; charset=utf-8');
$moncollapse="0";
$collapsetemp="";
$monsuggest="1";
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$moncollapse=$_COOKIE['journalsid']['collapse'];
$monsuggest=$_COOKIE['journalsid']['suggest'];
}
$collapse=$_GET['collapse'];
$collapsetemp=$_GET['collapsetemp'];
if ($collapse=="")
{
if ($collapsetemp=="")
$collapse=$moncollapse;
else
$collapse=$collapsetemp;
}
else
setcookie('journalsid[collapse]', $collapse, (time() + 60*60*24*365*10));
$suggest=$_GET['suggest'];
if ($suggest=="")
$suggest=$monsuggest;
else
setcookie('journalsid[suggest]', $suggest, (time() + 60*60*24*365*10));
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"fr\" xml:lang=\"fr\" >\n";
echo "<head>\n";
echo "<link rel=\"icon\" href=\"favicon.ico\" type=\"image/x-icon\" />\n";
echo "<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-ico\n\" />\n";
echo "\n";
if ($pagetitle)
echo "<title>" . $pagetitle . "</title>\n";
else
echo "<title>Revues de " . $configinstitution . "</title>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\n";
echo "<meta name=\"description\" content=\"Recherche de périodiques " . $configinstitution . "\" />\n";
echo "<meta http-equiv=\"Content-Language\" content=\"fr\" />\n";
echo "<meta name=\"language\" content=\"fr\" />\n";
echo "<link rel=\"stylesheet\" href=\"calendar.css\" type=\"text/css\" media=\"all\" ></link>\n";
echo "<link rel=\"stylesheet\" href=\"style1.css\" type=\"text/css\" media=\"all\" ></link>\n";
echo "<link rel=\"stylesheet\" href=\"style2.css\" type=\"text/css\" media=\"print\" ></link>\n";
echo "<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\" media=\"all\" ></link>\n";
echo "<script language=\"javascript\" type=\"text/javascript\" src=\"script.js\" ></script>\n";
echo "<script language=\"javascript\" type=\"text/javascript\" src=\"calendar.js\" ></script>\n";
echo "<script type=\"text/javascript\" src=\"autosuggest.js\" charset=\"utf-8\"></script>\n";
echo "<link rel=\"stylesheet\" href=\"autosuggest.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />\n";
echo "<script language=\"JavaScript\">\n";
echo "  function check_search() {\n";
echo "      if (document.recherche.q.value == \"\") {\n";
echo "        alert(\"entrer un terme de recherche\");\n";
echo "        document.recherche.q.focus();\n";
echo "        return false;\n";
echo "      }\n";
echo "      else {\n";
echo "      return true;\n";
echo "    }\n";
echo "  }\n";
echo "</script>\n";
echo "<script type=\"text/javascript\" src=\"validateform.js\"></script>\n";
echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS Feed\" href=\"rss.xml\" ></link>\n";
echo "<script type=\"text/javascript\">\n";
echo "\n";
echo "  var _gaq = _gaq || [];\n";
echo "  _gaq.push(['_setAccount', '" . $configanalytics . "']);\n";
echo "  _gaq.push(['_trackPageview']);\n";
echo "\n";
echo "  (function() {\n";
echo "    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n";
echo "    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n";
echo "    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n";
echo "  })();\n";
echo "\n";
echo "</script>\n";
echo "</head>\n";
echo "<body id=\"tab1\" onLoad=\"document.recherche.q.focus();\">\n";
echo "  <div class=\"page\">\n";
echo "  <div class=\"headBar\">\n";
echo "\n";
echo "    <div class=\"headBarRow1c\">\n";
echo "    </div>\n";
echo "    <div class=\"headBarRow2\">\n";
echo "      <div class=\"topNavArea\">\n";
echo "<ul>\n";
echo "<li><a href=\"index.php\" style=\"font-size: 11pt;\">" . $configname . "</a></li>\n";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
echo "|&nbsp;&nbsp;&nbsp;<li><a class=\"liens\" href=\"administration.php\">Administration</a></li>\n";
if ($monlog!="")
echo "|&nbsp;&nbsp;&nbsp;<li>Login : <b>".$monnom."</b>&nbsp;<a class=\"liens\" href=\"login.php?action=logout\" title=\"Logout\">[Logout]</a></li>\n";
else
echo "|&nbsp;&nbsp;&nbsp;<li><a class=\"liens\" href=\"login.php\">Login</a></li>\n";

echo "</ul>\n";
echo "</div>\n";
echo "      <div class=\"sysNavArea\"></div>\n";
echo "      <div class=\"clb\"></div>\n";
echo "    </div>\n";
echo "  </div>\n";
echo "  <div class=\"contentArea\">\n";
echo "    <div class=\"content\">\n";
echo "\n";
echo "\n";
echo "\n";
// echo "<a href=\"#\">\n";
// echo "Préférences <img src=\"http://www.unil.ch/cms/images/f_white.gif\" width=\"15\" height=\"6\" border=\"0\" alt=\"Affichage\" />\n";
// echo "</a>\n";
// echo "<ul>\n";
// echo "<li class=\"prefs\">\n";
// if ($collapse=="1")
// echo "<a href=\"" . $_SERVER['PATH_INFO'] . "?" . $_SERVER['QUERY_STRING'] . "&collapse=0\">Afficher les résultats en format tableau</a>\n";
// else
// echo "<a href=\"" . $_SERVER['PATH_INFO'] . "?" . $_SERVER['QUERY_STRING'] . "&collapse=1\">Afficher les résultats en format liste de titres</a>\n";
// echo "</li>\n";
// echo "<li class=\"prefs\">\n";
// if ($suggest=="0")
// echo "<a href=\"" . $_SERVER['PATH_INFO'] . "?" . $_SERVER['QUERY_STRING'] . "&suggest=1\">Activer la proposition des titres en cours de frappe</a>\n";
// else
// echo "<a href=\"" . $_SERVER['PATH_INFO'] . "?" . $_SERVER['QUERY_STRING'] . "&suggest=0\">Désactiver la proposition des titres en cours de frappe</a>\n";
// echo "</li>\n";
// echo "<li>\n";
// echo "<a href=\"mobile/index.html\">Affichage pour téléphone mobile</a>\n";
// echo "</li>\n";
// echo "<ul id=\"tabnav\">\n";
// echo "	<li class=\"tab1\"><a href=\"index.php\" style=\"font-size: 12pt;\">Revues de " . $configinstitution . "</a></li>\n";
// echo "	<li class=\"tab2\"><a href=\"ebooks.php\" style=\"font-size: 10pt;\">ebooks de " . $configinstitution . "</a></li>\n";
// echo "</ul>\n";
?>
