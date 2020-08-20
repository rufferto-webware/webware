<?PHP
session_start();
if(empty($_SESSION['nav_path']) || empty($_SESSION['file_root']))
{
	$temp_path= include '../Config/web_path.php';
	$_SESSION['file_root']=$temp_path['file_path'];
	$_SESSION['url_root']=$temp_path['web_path'];
	$_SESSION['nav_path']=array(array('title'=>'Main', 'link'=>$_SESSION['url_root'] ));
}


include_once $_SESSION['file_root'].'/default/module/index.php';
?>