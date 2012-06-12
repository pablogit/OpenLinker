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
// Table journals : recherche rapide pour l'affichage des suggestions en cours de frappe
require ("config.php");
require ("connexion.php");
$input = strtolower( $_GET['input']);
$input = str_replace(" ","%",$input);
$input = str_replace("'","\'",$input);
$input2 = mb_strtoupper($_GET['input'], "utf-8");
$input3 = str_replace("é","e",$input);
// echo $input2;
$max_results = 10;
$req = "select journalsid,titre from journals where titre like '$input%' AND titreexclu = 0 GROUP BY titre order by titre asc limit 0, $max_results";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
if ($nb == 0)
{
$req = "select journalsid,titre from journals where titre like '%$input%' AND titreexclu = 0 GROUP BY titre order by titre asc limit 0, $max_results";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
}
// echo "nb = " . $nb;
$aUsers = array();
$aInfo = array();
function wd_remove_accents($str, $charset='utf-8')
{
$str = htmlentities($str, ENT_NOQUOTES, $charset);
$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

return $str;
}
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$journalsid = $enreg['journalsid'];
$journalstitre = $enreg['titre'];
$journalstitre = str_replace("&amp;","&",$journalstitre);
$aUsers[$i] = $journalstitre;
$aInfo[$i] = $journalsid;
// echo $journalstitre;
}


$len = strlen($input);
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;


$aResults = array();
$count = 0;

if ($len)
{
for ($i=0;$i<count($aUsers);$i++)
{
// had to use utf_decode, here
// not necessary if the results are coming from mysql
// if (strtolower(substr($aUsers[$i],0,$len)) == $input)
// if (mb_strtoupper(substr($aUsers[$i],0,$len), "utf-8") == $input2)
// if (wd_remove_accents(mb_strtoupper(substr($aUsers[$i],0,$len), "utf-8")) == wd_remove_accents($input2))
// if (strtolower(substr($aUsers[$i],0,$len)) == $input)
// {
$count++;
$aResults[] = array( "id"=>($i+1) ,"value"=>($aUsers[$i]), "info"=>htmlspecialchars($aInfo[$i]) );
// }

if ($limit && $count==$limit)
break;
}
}
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0
if (isset($_REQUEST['json']))
{
header("Content-Type: application/json");

echo "{\"results\": [";
$arr = array();
for ($i=0;$i<count($aResults);$i++)
{
$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"\"}";
}
echo implode(", ", $arr);
echo "]}";
}
else
{
header ('Content-type: text/xml; charset=utf-8');
echo "<?phpxml version=\"1.0\" encoding=\"utf-8\" ?><results>";
for ($i=0;$i<count($aResults);$i++)
{
echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
}
echo "</results>";
}
?>
