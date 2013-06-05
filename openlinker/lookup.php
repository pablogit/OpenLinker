<?php
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
$url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&id=&retmode=xml&tool=OpenLinker&email=bdfm@chuv.ch&id=" . $pmid;
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
    $out = "GET /openurl/?pid=udm%3Audm124&noredirect=true&id=doi%3A" . $doi . " HTTP/1.1\r\n";
    $out .= "Host: www.crossref.org\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
}



?>