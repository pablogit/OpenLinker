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
// Lookup page to import external content from bibliographic databases : PubMed, Web of Science, CrossRef, RERO, etc.
//
require ("includes/config.php");
if(isset($_GET['isbn']))
{
$isbn = $_GET['isbn'];
$url = "http://opac.rero.ch/gateway?function=MARCSCR&search=KEYWORD&u1=7&rootsearch=KEYWORD&t1=" . $isbn;
//  $url = $_SERVER['QUERY_STRING'];
$ch = curl_init($url);
curl_exec($ch);
}

if(isset($_GET['reroid']))
{
$reroid = $_GET['reroid'];
$url = "http://opac.rero.ch/gateway?function=MARCSCR&search=KEYWORD&u1=12&rootsearch=KEYWORD&t1=" . $reroid;
//  $url = $_SERVER['QUERY_STRING'];
$ch = curl_init($url);
curl_exec($ch);
}

if(isset($_GET['pmid']))
{
$pmid = $_GET['pmid'];
$url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&retmode=xml&tool=OpenLinker&email=" . $configemail . "&id=" . $pmid;
//  $url = $_SERVER['QUERY_STRING'];
$ch = curl_init($url);
curl_exec($ch);
}

if(isset($_GET['doi']))
{
$doi = $_GET['doi'];
$fp = fsockopen("www.crossref.org", 80, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET /openurl/?pid=" . $configcrossrefpid1 . "%3A" . $configcrossrefpid2 . "&noredirect=true&id=doi%3A" . $doi . " HTTP/1.1\r\n";
    $out .= "Host: www.crossref.org\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
}

if(isset($_GET['wosid']))
{
$ut = $_GET['wosid'];
$ut = trim($ut);
$url = "http://www2.unil.ch/openillink/openlinker/isi/wos.php?ut=".$ut;
$ch = curl_init($url);
curl_exec($ch);
}

?>
