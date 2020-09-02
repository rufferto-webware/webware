<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
include_once($_SESSION['file_root'].'/lib/Function_system.inc.php');
include_once($_SESSION['file_root'].'/lib/security.inc.php');
$DB= new ww_db;

echo "<!DOCTYPE html>\n";

echo "<h2> Add Tab To Module  </h2>";

//	echo "<pre>"; var_dump($_POST); var_dump($_SESSION['tabs_var']);

if(!empty($_POST['org_mod']) && !empty($_POST['text_v']) && !empty($_POST['nav_v']) && !empty($_SESSION['tabs_var']))
{
	$_POST=check_input($_POST);
	$_SESSION['tabs_var'][]=array( 'nav' => $_POST['nav_v'], 'text' => $_POST['text_v'], 'security' => array(  array( 'app' => '','level' => '' ) ) ) ;
//	echo "<pre>"; var_dump($_POST); var_dump($_SESSION['tabs_var']);
	system_write_tabs($_POST['org_mod'],$_SESSION['tabs_var']);
	
 echo "<script type=\"text/javascript\">
        window.opener.location.href = 'module.php?ref=".$_POST['org_mod']."';
        window.close(); 
</script>
";//*/

}



if(!empty($_GET['mod'])&&!empty($_SESSION['tabs_var']))
{
	$_GET=check_input($_GET);
	
	echo "<form method='POST'><Table>";
	echo "<TR><TH> tab Text </TH><td><input type='text' name='text_v' Value='' /></td></TR>";
	echo "<TR><TH> nav Value </TH><td><input type='text' name='nav_v' Value='' /></td></TR>";
	echo "</Table>";
	echo "<input type='hidden' name='org_mod' Value='".$_GET['mod']."' />";
	echo "<input type='submit' name='sub' Value='Submit' />";
	echo "</form>";
	
}
?>