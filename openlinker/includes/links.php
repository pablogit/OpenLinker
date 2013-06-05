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
// Links displayed on the order details
//
echo "<div id=\"illinks\">\n";
echo "<div class=\"box\"><div class=\"box-content\">\n";
echo "<ul><li><a href=\"edit.php?table=orders&id=".$enreg['illinkid']."\"><b><font color=\"red\">\n";
echo "Editer la commande</font></a></b></li>\n";
// echo "<ul><li><b><font color=\"grey\">\n";
// echo "Editer la commande [en maintenance]</font></b></li>\n";
if ($directoryurl1 != "")
{
$mydirectory1search = str_replace("XNAMEX",urlencode ($enreg['nom']),$directoryurl1);
$mydirectory1search = str_replace("XFIRSTNAMEX",urlencode ($enreg['prenom']),$mydirectory1search);
echo "<li><a href=\"" . $mydirectory1search . "\" target=_blank title=\"" . $directory1message[$lang] . "\">\n";
echo $directoryname1 . "</a></li>\n";
}

if ($directoryurl2 != "")
{
$mydirectory2search = str_replace("XNAMEX",urlencode ($enreg['nom']),$directoryurl2);
$mydirectory2search = str_replace("XFIRSTNAMEX",urlencode ($enreg['prenom']),$mydirectory2search);
echo "<li><a href=\"" . $mydirectory2search . "\" target=_blank title=\"" . $directory2message[$lang] . "\">\n";
echo $directoryname2 . "</a></li>\n";
}
echo "</ul>\n";

// Cleaning journal title to improve search results
$stitleclean = $enreg['titre_periodique'];
$stitleclean = str_replace(" & "," ",$stitleclean);
$stitleclean = str_replace(" the "," ",$stitleclean);
$stitleclean = str_replace("The ","",$stitleclean);
$stitleclean = str_replace(" and "," ",$stitleclean);
$stitleclean = str_replace(" of "," ",$stitleclean);
$stitleclean = str_replace(" - "," ",$stitleclean);
// $stitleclean = str_replace("-"," ",$stitleclean);
$pos1 = strpos($stitleclean, ":");
if ($pos1 !== false)
$stitleclean = substr($stitleclean, 0, $pos1);
$pos2 = strpos($stitleclean, "=");
if ($pos2 !== false)
$stitleclean = substr($stitleclean, 0, $pos2);
$pos3 = strpos($stitleclean, ".");
if ($pos3 !== false)
$stitleclean = substr($stitleclean, 0, $pos3);
$pos4 = strpos($stitleclean, ";");
if ($pos4 !== false)
$stitleclean = substr($stitleclean, 0, $pos4);
$pos5 = strpos($stitleclean, "(");
if ($pos5 !== false)
$stitleclean = substr($stitleclean, 0, $pos5);
$titreebsco = str_replace(" ","* ",$stitleclean);
$titreebsco = $titreebsco ."*";


// Add suppl. to issue 
$issue2 = $enreg['numero'];
if ($enreg['supplement']!='')
{
if ($enreg['numero']!='')
$issue2 = $issue2 . " suppl. " . $enreg['supplement'];
else
$issue2 = "suppl. " . $enreg['supplement'];
}


// Links by article title
if ($enreg['titre_article']!='')
{
echo "</ul><b>Chercher par titre d'article</b>\n";
$reqlinks="SELECT title, url FROM links WHERE search_atitle = 1 AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkurlreplace = str_replace("XTITLEX",urlencode ($enreg['titre_article']),$linkurl);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}


// Links by journal title or ISSN
}
if (($enreg['type_doc']=='article')||($enreg['type_doc']=='Article')||($enreg['type_doc']=='preprint')||($enreg['type_doc']=='journal'))
{
// Links by journal ISSN
if ($enreg['issn']!='')
{
echo "<b>Chercher par ISSN</b>\n";
$reqlinks="SELECT title, url FROM links WHERE search_issn = 1 AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkurlreplace = str_replace("XISSNX",urlencode ($enreg['issn']),$linkurl);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}
}

if ($enreg['issn']=='')
{
echo "<b>Chercher par titre du périodique</b>\n";
$reqlinks="SELECT title, url FROM links WHERE search_ptitle = 1 AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkurlreplace = str_replace("XTITLEX",urlencode ($stitleclean),$linkurl);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}
}
}

// Links for books, chapters and thesis
if (($enreg['type_doc']=='livre')||($enreg['type_doc']=='Livre')||($enreg['type_doc']=='book')||($enreg['type_doc']=='bookitem')||($enreg['type_doc']=='thesis'))
{
// Links by ISBN
if ($enreg['isbn']!='')
{
echo "<b>Chercher par ISBN</b>\n";
$reqlinks="SELECT title, url FROM links WHERE search_isbn = 1 AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkurlreplace = str_replace("XISBNX",urlencode ($stitleclean),$linkurl);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}
}
// Links by Book Title
if ($enreg['titre_periodique']!='')
{
echo "<b>Chercher par titre du livre</b>\n";
$reqlinks="SELECT title, url FROM links WHERE search_btitle = 1 AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkurlreplace = str_replace("XTITLEX",urlencode ($stitleclean),$linkurl);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}
}
}

// Links to transfert orders
$reqlinks="SELECT title, url, openurl, order_form FROM links WHERE (order_ext = 1 OR order_form = 1) AND library = '$monbib' AND active = 1 ORDER BY title ASC";
$listlinks="";
$resultlinks = mysql_query($reqlinks,$link);
$nblinks = mysql_num_rows($resultlinks);
if ($nblinks > 0)
{
echo "<b>Traiter la commande</b>\n";
while ($rowlinks = mysql_fetch_array($resultlinks))
{
$linktitle = $rowlinks["title"];
$linkurl = $rowlinks["url"];
$linkopenurl = $rowlinks["openurl"];
$linkorder_form = $rowlinks["order_form"];
if ($linkopenurl == 1)
{
// OpenURL 0.1 Spec
// http://alcme.oclc.org/openurl/docs/pdf/openurl-01.pdf
// ORIGIN-DESCRIPTION ::= sid '=' VendorID ':' DatabaseID
// GLOBAL-NAMESPACE ::= ( 'doi' | 'pmid' | 'bibcode' | 'oai' )
// OBJECT-METADATA-ZONE ::= META-TAG '=' META -VALUE (& META -TAG '=' META-VALUE) *
// META-TAG ::= ( 'genre' | 'aulast' | 'aufirst' | 'auinit' | 'auinit1' | 'auinitm' | 'coden' | 'issn' | 'eissn' | 'isbn' | 'title' | 'stitle' | 'atitle' | 'volume' | 'part' | 'issue' | 'spage' | 'epage' | 'pages' | 'artnum' | 'sici' | 'bici' | 'ssn' | 'quarter' | 'date' )
// genre bundles:
// journal (a journal, volume of a journal, issue of a journal)
// book (a book)
// conference (a publication bundling proceedings of a conference)
// individual items:
// article (a journal article)
// preprint (a preprint)
// proceeding (a conference proceeding)
// bookitem (an item that is part of a book)
// LOCAL-IDENTIFIER-ZONE ::= 'pid' '=' VCHAR+
// 
$pos = strpos($linkurl, "?");
if ($pos === false)
$linkurl = $linkurl . "?" . $openurlsid;
else
$linkurl = $linkurl . "&" . $openurlsid;
if ($enreg['doi']!='')
$linkurl .= "&id=doi:" . urlencode ($enreg['doi']);
if ($enreg['PMID']!='')
$linkurl .= "&id=pmid:" . urlencode ($enreg['PMID']);
// if ($enreg['uid']!='')
// $linkurl .= "&id=" . urlencode ($enreg['uid'];
$linkurl .= "&genre=" . urlencode ($enreg['type_doc']);
$linkurl .= "&aulast=" . urlencode ($enreg['auteurs']);
$linkurl .= "&issn=" . $enreg['issn'];
$linkurl .= "&eissn=" . $enreg['eissn'];
$linkurl .= "&isbn=" . $enreg['isbn'];
$linkurl .= "&title=" . urlencode ($stitleclean);
$linkurl .= "&atitle=" . urlencode ($enreg['titre_article']);
$linkurl .= "&volume=" . urlencode ($enreg['volume']);
$linkurl .= "&issue=" . urlencode ($issue2);
$linkurl .= "&pages=" . urlencode ($enreg['pages']);
$linkurl .= "&date=" . urlencode ($enreg['annee']);
}

if ($linkorder_form == 1)
$linkurl = $linkurl . "&id=" . $enreg['illinkid'];

// OpenURL replacements
// sid : XSIDX
// pid : XPIDX
// doi : XDOIX
// pmid (PubMed identifier) : XPMIDX
// genre (Document Type) : XGENREX
// aulast (Authors names) : XAULASTX
// issn : XISSNX
// eissn : XEISSNX
// isbn : XISBNX
// title (Journal name) : XTITLEX
// atitle (Article/chapter title) : XATITLEX
// volume : XVOLUMEX
// issue : XISSUEX
// pages : XPAGESX
// date : XDATEX
// 
// Other replacements
// end user name : XNAMEX
// 

$linkurlreplace = $linkurl;
$linkurlreplace = str_replace("XSIDX",$openurlsid,$linkurlreplace);
$linkurlreplace = str_replace("XPIDX",urlencode ($enreg['illinkid']),$linkurlreplace);
$linkurlreplace = str_replace("XDOIX",urlencode ($enreg['doi']),$linkurlreplace);
$linkurlreplace = str_replace("XPMIDX",urlencode ($enreg['PMID']),$linkurlreplace);
$linkurlreplace = str_replace("XGENREX",urlencode ($enreg['type_doc']),$linkurlreplace);
$linkurlreplace = str_replace("XAULASTX",urlencode ($enreg['auteurs']),$linkurlreplace);
$linkurlreplace = str_replace("XISSNX",urlencode ($enreg['issn']),$linkurlreplace);
$linkurlreplace = str_replace("XEISSNX",urlencode ($enreg['eissn']),$linkurlreplace);
$linkurlreplace = str_replace("XISBNX",urlencode ($enreg['isbn']),$linkurlreplace);
$linkurlreplace = str_replace("XPMIDX",urlencode ($enreg['PMID']),$linkurlreplace);
$linkurlreplace = str_replace("XTITLEX",urlencode ($stitleclean),$linkurlreplace);
$linkurlreplace = str_replace("XATITLEX",urlencode ($enreg['titre_article']),$linkurlreplace);
$linkurlreplace = str_replace("XVOLUMEX",urlencode ($enreg['volume']),$linkurlreplace);
$linkurlreplace = str_replace("XISSUEX",urlencode ($enreg['numero']),$linkurlreplace);
$linkurlreplace = str_replace("XPAGESX",urlencode ($enreg['pages']),$linkurlreplace);
$linkurlreplace = str_replace("XDATEX",urlencode ($enreg['annee']),$linkurlreplace);
$linkurlreplace = str_replace("XNAMEX",urlencode ($enreg['nom'] . ", " . $enreg['prenom']),$linkurlreplace);
$listlinks.="<li><a href=\"" . $linkurlreplace . "\" target=\"_blank\">" . $linktitle . "</a></li>\n";
}
echo "<ul>\n";
echo $listlinks;
echo "</ul>\n";
}

echo "<br /></div></div><div class=\"box-footer\"><div class=\"box-footer-right\"></div></div>\n";
echo "</div>\n";
?>
