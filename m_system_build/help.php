<?PHP
session_start();

if (empty($_SESSION['test_data']))$_SESSION['test_data']="";
if (empty($_SESSION['nav_path']))
		$_SESSION['nav_path']=array(array('title'=>'Main', 'link'=>$_SERVER['PHP_SELF'] ));

	$temp_path= include '../Config/web_path.php';

	$_SESSION['file_root']=$temp_path['file_path'];
	$_SESSION['url_root']=$temp_path['web_path'];


$mainCSS='mainC.css';
if (strstr($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0;" ))
{  /// for IE6(XP)
	$mainCSS='mainC_ie6.css';
}
else
{
	echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />\n";
}

//include_once './CSS/'.$mainCSS;

echo "<H1> <center> Help Page</center> </H1>";
echo "<body bgcolor=\"#d9ff66\">
Module Help (".$_SESSION['loc_mod'].")
	<p class=\"mod\" Style=\"border-style: groove;border-color: orange;\"> "; 

$help_file='./Help/_Module.help.php';
if(file_exists($help_file))
	include "$help_file" ;
	else
	echo "Sorry Charlie. No Help ";

echo"	</p>
Tab Help	(".$_SESSION['loc_tab'].")
	<p class=\"nav\" Style=\"border-style: groove;border-color: Blue;\"> ";
	
$help_file='./Help/_nav.'.$_SESSION['loc_tab'].'.help.php' ;
if(file_exists($help_file))
	include "$help_file" ;
	else
	echo "Sorry Charlie. No Help ";

echo" 	</p>
Page Help	(".$_SESSION['loc_page'].")
	<p class=\"page\" Style=\"border-style: groove;border-color: Green;\"> ";

$help_file='./Help/_page.'.$_SESSION['loc_page'].'.help.php' ;
if(file_exists($help_file))
	include "$help_file" ;
	else
	echo "Sorry Charlie. No Help ";

echo "	</p>
	




</body>" ;
















?>