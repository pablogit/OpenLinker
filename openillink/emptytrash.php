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
// Home page for administrators
require ("includes/config.php");
require ("includes/authcookie.php");
if (!empty($_COOKIE[illinkid]))
{
if (($monaut == "admin")||($monaut == "sadmin")||($monaut == "user"))
{
$action = "";
$action=$_POST['action'];
$pagetitle = "commandes de l'" . $configinstitution[$lang] . " : vider la corbeille definitivement ";
require ("includes/headeradmin.php");
echo "\n";
echo "<br/><br/>\n";
// 
// Liens pour les administrateurs
// 
echo "<h1>Vider la corbeille</h1>\n";
echo "<br/>\n";

if ($action == "deleteall")
{
require ("includes/connect.php");
$query = "DELETE orders.* FROM status, orders WHERE orders.stade = status.code AND status.trash = 1";
$result = mysql_query($query) or die("Error : ".mysql_error());
echo "<center><br/><b><font color=\"green\">\n";
echo "La corbeille a été supprimée avec succès</b></font>\n";
echo "<br/><br/><br/><a href=\"list.php?table=orders\">Retour à la liste des commandes</a></center>\n";
echo "</center>\n";
echo "\n";
require ("includes/footer.php");
}
else
{
$id=addslashes($_GET['id']);
echo "<center><br/><br/><br/><b><font color=\"red\">\n";
echo "Voulez-vous vraiement vider la corbeille définitivement?</b></font>\n";
echo "<form action=\"emptytrash.php\" method=\"POST\" enctype=\"x-www-form-encoded\" name=\"fiche\" id=\"fiche\">\n";
echo "<input name=\"action\" type=\"hidden\" value=\"deleteall\">\n";
echo "<br /><br />\n";
echo "<input type=\"submit\" value=\"Confirmer la suppression des commandes dans la corbeille en cliquant ici\">\n";
echo "</form>\n";
echo "<br/><br/><br/><a href=\"list.php?table=orders\">Retour à la liste des commandes</a></center>\n";
echo "</center>\n";
echo "\n";
require ("includes/footer.php");
}

}
else
{
require ("includes/header.php");
echo "<center><br/><b><font color=\"red\">\n";
echo "Vos droits sont insuffisants pour consulter cette page</b></font></center><br /><br /><br /><br />\n";
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
