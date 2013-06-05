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
// Order form for the NLM
//
require ("includes/config.php");
require ("includes/authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
require ("includes/connect.php");
$id = $_GET['id'];
$myform = $_GET['form'];
if ($id && $myform)
{
$myform = "forms/" . $myform . ".php";
$req = "select * from orders where illinkid like '$id' order by illinkid desc";
$result = mysql_query($req,$link);
$nb = mysql_num_rows($result);
require ("includes/headeradmin.php");
for ($i=0 ; $i<$nb ; $i++)
{
$enreg = mysql_fetch_array($result);
$id = $enreg['illinkid'];
// Add suppl. to issue 
$issue2 = $enreg['numero'];
if ($enreg['supplement']!='')
{
if ($enreg['numero']!='')
$issue2 = $issue2 . " suppl. " . $enreg['supplement'];
else
$issue2 = "suppl. " . $enreg['supplement'];
}
require ($myform);
}
require ("includes/footer.php");
}
else
{
echo "<br/><br/><center><b>Missing id or form parameters</b></center><br/><br/><br/><br/>\n";
require ("includes/footer.php");
}
}
else
{
require ("includes/header.php");
require ("includes/loginfail.php");
require ("includes/footer.php");
}
}
else
{
require ("includes/header.php");
require ("includes/loginfail.php");
require ("includes/footer.php");
}
?>
