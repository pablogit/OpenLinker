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
// List of orders distributed in 4 folders : IN, OUT, ALL and TRASH
// Inbox : new orders to be processed, rejected orders by the other network libraries, renewed orders (ahead of print), orders in process
//
$monbibr=$monbib."%";
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user")||($monaut == "guest"))
{
$myhtmltitle = "Commandes de " . $configinstitution[$lang] . " : liste de commandes";
require ("connect.php");
if(!isset($_GET['page']))
{
$page = 1;
}
else
{ 
$page = $_GET['page'];
} 

// 
// Figure out the limit for the query based on the current page number
// 
require ("headeradmin.php");
require ("searchform.php");
$madatej=date("Y-m-d");
// Choice of folder
$folder = $_GET['folder'];
$pageslinksurl = "list.php?folder=".$folder;
switch ($folder)
{
case 'in':
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE ((status.in = 1 OR (status.special = 'renew' AND orders.renouveler <= '$madatej')) AND orders.localisation LIKE '$monbibr') OR (status.special = 'reject' AND orders.bibliotheque LIKE '$monbib') GROUP BY orders.illinkid";
break;
case 'out':
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE (orders.localisation LIKE '$monbibr' OR orders.bibliotheque LIKE '$monbib' OR orders.service LIKE '$monbib') AND status.out = 1 GROUP BY orders.illinkid";
break;
case 'all':
if ($monaut == "sadmin")
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.illinkid > 0 GROUP BY orders.illinkid";
else
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.bibliotheque LIKE '$monbib' OR orders.localisation LIKE '$monbibr' OR orders.service LIKE '$monbib' GROUP BY orders.illinkid";
break;
case 'trash':
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE status.trash = 1 AND orders.bibliotheque LIKE '$monbib' GROUP BY orders.illinkid";
break;
case 'guest':
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.mail LIKE '$monnom' GROUP BY orders.illinkid";
break;
case 'search':
require ("search.php");
break;
default:
$req2 = "SELECT orders.illinkid FROM status LEFT JOIN orders ON status.code = orders.stade WHERE ((status.in = 1 OR (status.renew = 1 AND orders.renouveler <= '$madatej')) AND orders.localisation LIKE '$monbibr') OR (status.reject = 1 AND orders.bibliotheque LIKE '$monbib') GROUP BY orders.illinkid";
}

$result2 = mysql_query($req2,$link);
$total_results = mysql_num_rows($result2);
$total_pages = ceil($total_results / $max_results);
$from = (($page * $max_results) - $max_results);

switch ($folder)
{
case 'in':
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE ((status.in = 1 OR (status.special = 'renew' AND orders.renouveler <= '$madatej')) AND orders.localisation LIKE '$monbibr') OR (status.special = 'reject' AND orders.bibliotheque LIKE '$monbib') GROUP BY orders.illinkid ORDER BY orders.urgent, orders.illinkid DESC LIMIT $from, $max_results";
break;
case 'out':
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE (orders.localisation LIKE '$monbibr' OR orders.bibliotheque LIKE '$monbib' OR orders.service LIKE '$monbib') AND status.out = 1 GROUP BY orders.illinkid ORDER BY orders.illinkid DESC LIMIT $from, $max_results";
break;
case 'all':
if ($monaut == "sadmin")
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.illinkid > 0 GROUP BY orders.illinkid ORDER BY orders.illinkid DESC LIMIT $from, $max_results";
else
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.bibliotheque LIKE '$monbib' OR orders.localisation LIKE '$monbibr' OR orders.service LIKE '$monbib' GROUP BY orders.illinkid ORDER BY orders.illinkid DESC LIMIT $from, $max_results";
break;
case 'trash':
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE status.trash = 1 AND orders.bibliotheque LIKE '$monbib' GROUP BY orders.illinkid ORDER BY orders.illinkid DESC LIMIT $from, $max_results";
break;
case 'guest':
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE orders.mail LIKE '$monnom' GROUP BY orders.illinkid ORDER BY orders.illinkid DESC LIMIT $from, $max_results";
break;
case 'search':
require ("search.php");
break;
default:
$req = "SELECT orders.*, status.* FROM status LEFT JOIN orders ON status.code = orders.stade WHERE ((status.in = 1 OR (status.special = 'renew' AND orders.renouveler <= '$madatej')) AND orders.localisation LIKE '$monbibr') OR (status.special = 'reject' AND orders.bibliotheque LIKE '$monbib') GROUP BY orders.illinkid ORDER BY orders.urgent, orders.illinkid DESC LIMIT $from, $max_results";
}

$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);

require ("orders_results.php");
require ("footer.php");
}
else
{
require ("header.php");
require ("loginfail.php");
require ("footer.php");
}
?>
