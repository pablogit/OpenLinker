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
// Authentication by IP adress
//
$ip1 = 0;
$ip2 = 0;
$ipwww = 0;
$ip = $_SERVER['REMOTE_ADDR'];
$referer=$_SERVER['HTTP_REFERER'];
$sep = ".";
$ips1 = strtok( $ip, $sep );
$ips2 = strtok( $sep );
$ips3 = strtok( $sep );
$ips4 = strtok( $sep );
if (($ips1 == $configipainst1) && ($ips2 == $configipbinst1))
{
$ip1 = 1;
}
elseif (($ips1 == $configipainst2) && ($ips2 == $configipbinst2))
{
$ip2 = 1;
}
else
{
$ipwww = 1;
}


?>
