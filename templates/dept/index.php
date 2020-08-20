<?PHP
session_start();
if(empty($_SESSION['nav_path']) || empty($_SESSION['file_root']))
{
	$_SESSION['file_root']='/var/www/test_ems/webware';
	$_SESSION['url_root']='/webware';
	$_SESSION['nav_path']=array(array('title'=>'Main', 'link'=>$_SESSION['url_root'] ));
}


include_once $_SESSION['file_root'].'/default/module/index.php';
?>