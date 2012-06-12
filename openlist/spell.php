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
// Récupération des suggestions orthographiques de Google

  $google = "www.google.com";
  $lang=$_GET['lang'];
  $q=$_GET['q'];
  if (!$lang)
  $lang="en";
  $path="/tbproxy/spell?lang=$lang";
  $result = array();
  $corrections = array();
  $startresult = "<spellresult ";
  $startsugg = "<c ";
  $startsugg2 = ">";
  $endsugg = "</c>";
  $suggi = "";
  $essayez = "";


	// Make word list based word boundries
	// result is array of words and non-words
	$wordlist = preg_split('/ /',$q, -1);
// echo $wordlist[0];
	// Filter to find real words
for($i = 0; $i < sizeof($wordlist); ++$i)
 {
	// word check
//	echo $word;

  $data =  "<?phpxml version=\"1.0\" encoding=\"utf-8\" ?><spellrequest textalreadyclipped=\"0\" ignoredups=\"0\" ignoredigits=\"1\" ignoreallcaps=\"1\"><text>" . $wordlist[$i] . "</text></spellrequest>";
  $store = "";
// Si votre configuration de PHP supporte OpenSSL utilisez la ligne suivante au lieu de celle d'après
// $fp = fsockopen("ssl://".$google, 443, $errno, $errstr, 30);
  $fp = fsockopen($google, 80, $errno, $errstr, 30);
  if ($fp)
  {
   $out = "POST $path HTTP/1.1\r\n";
   $out .= "Host: $google\r\n";
   $out .= "Content-Length: " . strlen($data) . "\r\n";
   $out .= "Content-type: application/x-www-form-urlencoded\r\n";
   $out .= "Connection: Close\r\n\r\n";
   $out .= $data;
   fwrite($fp, $out);
   while (!feof($fp)) {
       $store .= fgets($fp, 128);
   }
   fclose($fp);
  }
// echo $store;
// echo $out;
  $resultok = stripos($store, $startresult);
  if ($resultok !== false)
  {
  $startsuggpos = stripos($store, $startsugg, $resultok);
  $startsuggpos2 = stripos($store, $startsugg2, $startsuggpos) + 1;
  $endsuggpos = stripos($store, $endsugg, $startsuggpos);
  if ($startsuggpos !== false)
  {
  $suggi = substr($store, $startsuggpos2, $endsuggpos-$startsuggpos2);
  $corrections = preg_split('/\t/',$suggi, -1);
  $result[$i] = $corrections[0];
  }
  else
  $result[$i] = $wordlist[$i];
  $suggi = "";
  $corrections = "";
  $essayez .= $result[$i] . " ";
    }
	}
$essayez = trim($essayez);
$q = trim($q);
if (($essayez != "") && ($essayez != $q))
echo "Essayez avec cette orthographe : <b><a href=\"search.php?q=" . urlencode(strtolower($essayez)) . "&init=&search=simple&field=title&format=all&link=spell\">" . strtolower($essayez) . "</a></b><br/><br/>\n";

?>
