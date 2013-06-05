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
// List of values froms each table (orders, libraries, units, etc.)
//
require ("includes/config.php");
require ("includes/authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
// switch from table parameter
$table = $_GET['table'];
switch ($table)
{
case 'orders':
require ("includes/orders_list.php");
break;
case 'users':
require ("includes/users_list.php");
break;
case 'libraries':
require ("includes/libraries_list.php");
break;
case 'units':
require ("includes/units_list.php");
break;
case 'status':
require ("includes/status_list.php");
break;
case 'localizations':
require ("includes/localizations_list.php");
break;
case 'links':
require ("includes/links_list.php");
break;
default:
require ("includes/orders_list.php");
}
// end of switch
}
else
{
require ("includes/header.php");
require ("includes/loginfail.php");
require ("includes/footer.php");
}
?>
