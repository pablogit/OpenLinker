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
// Table journals : affichage de la fiche complète
require ("config.php");
$epinglerid=$_GET['epinglerid'];
$epingleroutid=$_GET['epingleroutid'];
$ip = $_SERVER['REMOTE_ADDR'];
$sep = ".";
$ips1 = strtok( $ip, $sep );
$ips2 = strtok( $sep );
$ips3 = strtok( $sep );
$ips4 = strtok( $sep );
if (($ips1 == $configipainst1) && ($ips2 == $configipbinst1))
{
$locip = "INST1";
}
else
{
if (($ips1 == $configipainst2) && ($ips2 == $configipbinst2))
{
$locip = "INST2";
}
else
{
$locip = "WWW";
}
}
if (!empty($_COOKIE[journalsid]))
{
$monnom=$_COOKIE['journalsid']['nom'];
$monbib=$_COOKIE['journalsid']['bib'];
$monaut=$_COOKIE['journalsid']['aut'];
$monlog=$_COOKIE['journalsid']['log'];
$monpwd=$_COOKIE['journalsid']['pwd'];
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
}
require ("connexion.php");

$id=$_GET['id'];
if ($id)
$req = "select * from journals where journalsid like '$id' order by journalsid desc";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
// $total_results = mysql_result(mysql_query("SELECT COUNT (*) as Num FROM commandes"),0);

for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$journalsid = $enreg['journalsid'];
$titre = $enreg['titre'];
$url = $enreg['url'];
if ($epinglerid!="")
{
$monidok = "out";
if (($myjournals1id != $epinglerid)&&($myjournals2id != $epinglerid)&&($myjournals3id != $epinglerid)&&($myjournals4id != $epinglerid)&&($myjournals5id != $epinglerid)&&($myjournals6id != $epinglerid)&&($myjournals7id != $epinglerid)&&($myjournals8id != $epinglerid)&&($myjournals9id != $epinglerid)&&($myjournals10id != $epinglerid))
{
if ($myjournals1id == "")
{
setcookie('journalsid[myjournals1id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals1ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals1url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals2id == "")
{
setcookie('journalsid[myjournals2id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals2ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals2url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals3id == "")
{
setcookie('journalsid[myjournals3id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals3ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals3url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals4id == "")
{
setcookie('journalsid[myjournals4id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals4ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals4url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals5id == "")
{
setcookie('journalsid[myjournals5id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals5ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals5url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals6id == "")
{
setcookie('journalsid[myjournals6id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals6ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals6url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals7id == "")
{
setcookie('journalsid[myjournals7id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals7ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals7url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals8id == "")
{
setcookie('journalsid[myjournals8id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals8ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals8url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals9id == "")
{
setcookie('journalsid[myjournals9id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals9ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals9url]', $url, (time() + 60*60*24*365*10));
}
elseif ($myjournals10id == "")
{
setcookie('journalsid[myjournals10id]', $journalsid, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals10ti]', $titre, (time() + 60*60*24*365*10));
setcookie('journalsid[myjournals10url]', $url, (time() + 60*60*24*365*10));
}
}

}
else
{
if (($myjournals1id == $journalsid)||($myjournals2id == $journalsid)||($myjournals3id == $journalsid)||($myjournals4id == $journalsid)||($myjournals5id == $journalsid)||($myjournals6id == $journalsid)||($myjournals7id == $journalsid)||($myjournals8id == $journalsid)||($myjournals9id == $journalsid)||($myjournals10id == $journalsid))
{
$monidok = "out";
if ($epingleroutid!="")
{
if ($myjournals1id == $epingleroutid)
{
setcookie('journalsid[myjournals1id]', '', (time() - 3600));
setcookie('journalsid[myjournals1ti]', '', (time() - 3600));
setcookie('journalsid[myjournals1url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals2id == $epingleroutid)
{
setcookie('journalsid[myjournals2id]', '', (time() - 3600));
setcookie('journalsid[myjournals2ti]', '', (time() - 3600));
setcookie('journalsid[myjournals2url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals3id == $epingleroutid)
{
setcookie('journalsid[myjournals3id]', '', (time() - 3600));
setcookie('journalsid[myjournals3ti]', '', (time() - 3600));
setcookie('journalsid[myjournals3url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals4id == $epingleroutid)
{
setcookie('journalsid[myjournals4id]', '', (time() - 3600));
setcookie('journalsid[myjournals4ti]', '', (time() - 3600));
setcookie('journalsid[myjournals4url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals5id == $epingleroutid)
{
setcookie('journalsid[myjournals5id]', '', (time() - 3600));
setcookie('journalsid[myjournals5ti]', '', (time() - 3600));
setcookie('journalsid[myjournals5url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals6id == $epingleroutid)
{
setcookie('journalsid[myjournals6id]', '', (time() - 3600));
setcookie('journalsid[myjournals6ti]', '', (time() - 3600));
setcookie('journalsid[myjournals6url]', '', (time() - 3600));
}
elseif ($myjournals7id == $epingleroutid)
{
setcookie('journalsid[myjournals7id]', '', (time() - 3600));
setcookie('journalsid[myjournals7ti]', '', (time() - 3600));
setcookie('journalsid[myjournals7url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals8id == $epingleroutid)
{
setcookie('journalsid[myjournals8id]', '', (time() - 3600));
setcookie('journalsid[myjournals8ti]', '', (time() - 3600));
setcookie('journalsid[myjournals8url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals9id == $epingleroutid)
{
setcookie('journalsid[myjournals9id]', '', (time() - 3600));
setcookie('journalsid[myjournals9ti]', '', (time() - 3600));
setcookie('journalsid[myjournals9url]', '', (time() - 3600));
$monidok = "";
}
elseif ($myjournals10id == $epingleroutid)
{
setcookie('journalsid[myjournals10id]', '', (time() - 3600));
setcookie('journalsid[myjournals10ti]', '', (time() - 3600));
setcookie('journalsid[myjournals10url]', '', (time() - 3600));
$monidok = "";
}
}
}
}


$pagetitle = $titre . " - Revues de " . $configinstitution . " [fiche " . $id . "]";
require ("header.php");
require ("menurech.php");
echo "<br /></b>";
echo "<ul>\n";
require ("fichecomp.php");
}
echo "</center>\n";
echo "</div>\n";
echo "</div>\n";
echo "\n";
// echo "encodage : " . $charset;
echo "\n";
echo "\n";
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
echo "\n";
require ("footer.php");
?>
