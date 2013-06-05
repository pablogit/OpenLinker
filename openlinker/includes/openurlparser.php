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
// 
// Includes : OpenURL parser
//
$urlquery = $_SERVER['QUERY_STRING'];
$qs = str_replace('rft.', '', $urlquery);
parse_str($qs);
// if ($rft_isbn != '') $url = 'http://catalogue.londonpubliclibrary.ca/search/?searchtype=i&searcharg=' . $rft_isbn . '&searchscope=20&SORT=D';
// else $url = 'http://catalogue.londonpubliclibrary.ca/search/X?SEARCH=t:(' . $rft_btitle . ')+and+a:(' . $rft_au . ')&SORT=D';

// OpenURL 0.1 (http://alcme.oclc.org/openurl/docs/pdf/openurl-01.pdf)
// atitle
// aulast
// aufirst
// auinit
// auinit1
// auinitm
// date
// eissn
// isbn
// issn
// coden
// issue
// uid
// pid
// sid
// spage
// epage
// pages
// artnum
// title
// stitle
// volume
// part

// OpenURL 1.0 (http://nj.oclc.org/1cate/ig.html)
// rft.atitle
// rft.title
// rft.jtitle
// rft.stitle
// rft.date
// rft.volume
// rft.issue
// rft.spage
// rft.epage
// rft.pages
// rft.artnum
// rft.issn
// rft.eissn
// rft.aulast
// rft.aufirst
// rft.auinit
// rft.auinit1
// rft.auinitm
// rft.ausuffix
// rft.au
// rft.aucorp
// rft.isbn
// rft.coden
// rft.sici
// rft.genre [issue, article, proceeding, conference, preprint, unknown]
// rft.chron
// rft.ssn
// rft.quarter
// rft.part 
$authors = "";
if ($aulast)
$authors = $authors . $aulast;
if ($aufirst)
$authors = $authors . ", " . $aufirst;
else
{
if ($auinit)
$authors = $authors . ", " . $auinit;
}
?>
