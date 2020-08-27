<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
include_once($_SESSION['file_root'].'/lib/Function_system.inc.php');
$DB= new ww_db;

echo "<!DOCTYPE html>\n";

echo "<h2> Add Tab To Module  </h2>";

if(!empty($_GET['mod'])&&!empty($_SESSION['tabs_var']))
{
	$_GET=check_input($_GET);
	
	echo "<form method='POST'><Table>";
	echo "<TR><TH> tab Text </TH><td><input type='text' name='text_v' Value='' /></td></TR>";
	echo "<TR><TH> nav Value </TH><td><input type='text' name='nav_v' Value='' /></td></TR>";
	echo "</Table>";
	echo "<input type='button' name='sub' Value='Submit' />";
	echo "</form>";
	
}
?>