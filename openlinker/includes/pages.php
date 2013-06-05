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
// Construct pages links
// parameters : &page, $total_pages, $total_results, $pageslinksurl

if ($total_results > 0)
{
echo "<center><b>\n";

// Build Previous Link

if($page > 1)
{
$prev = ($page - 1);
echo "<a href=\"" . $pageslinksurl . "&page=".$prev."\"><- </a>&nbsp;\n";
}

$spage = $page - 10;
if ($spage <= 0)
$spage = 1;
$epage = $page + 10;
if ($epage > $total_pages)
$epage = $total_pages;
if($epage > 1)
{
for($h = $spage ; $h <= $epage; $h++)
{
if(($page) == $h)
{
echo "<font color=\"red\">".$h."</font>&nbsp;\n";
}
else
{
echo "<a href=\"" . $pageslinksurl . "&page=".$h."\">".$h."</a>&nbsp;\n";
}
}
}

// Build Next Link

if($page < $total_pages)
{
$next = ($page + 1);
echo "&nbsp;<a href=\"" . $pageslinksurl . "&page=".$next."\"> -></a>\n";
}
echo "</b></center>\n";
}
?>
