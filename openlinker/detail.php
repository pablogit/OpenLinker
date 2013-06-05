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
// Record detail by id (order, library, unit, etc.)
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
require ("includes/orders_detail.php");
break;
case 'users':
require ("includes/users_detail.php");
break;
case 'libraries':
require ("includes/libraries_detail.php");
break;
case 'units':
require ("includes/units_detail.php");
break;
case 'status':
require ("includes/status_detail.php");
break;
case 'localizations':
require ("includes/localizations_detail.php");
break;
case 'links':
require ("includes/links_detail.php");
break;
default:
require ("includes/orders_detail.php");
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
