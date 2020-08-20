<?PHP
session_start();
ob_start();

include("./config/config.inc.php");
include("./config/common.inc.php");
include("./libraries/browser.inc.php"); //detect the browser
include("./styles/dynamic_css.php");    //set up font sizes, etc per browser
include_once('./libraries/Common.php');// includes fix for old code


// include language file
include ("./resources/title_".$LANGUAGE.".inc.php");

css_site("title.css");               //applice this to the style sheet


/// gets screen res
if(!isset($_SESSION['ScreenWidth']))
{
	if(!isset($_GET['ScreenWidth']))
	{
		echo "<script language=\"JavaScript\">
		<!--
		document.location=\"$PHP_SELF?r=1&ScreenWidth=\"+screen.width;
		//-->
		</script>";
	}
	else
	{
		$_SESSION['ScreenWidth']=$_GET['ScreenWidth'];
	}
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>Title</title>
<!-- Include style sheet to make web form similar to paper form -->
</head>
<body bgcolor="#F2BB24">
<div class="TitleImageBox">
                                        <img src="<?PHP echo $title_logo; ?>" width="<?PHP echo $ScreenWidth-200; ?>" height="40">
</div>
<div class="logo">
	                                        <img src="<?PHP echo $page_logo; ?>" width="200" height="60">
</div>
<div class="tabs">




<?PHP

# sets the class of the tab
function link_class($name, $nav)
{	if($nav == $name) {
		$class = 'selected'; }
	else {
		$class = 'plain'; }
  	return $class;
}
# Makes html for each navigation tab
# @param    string nav variable for url
#           string text to be displayed in tab
function tab_html($nav, $text)
{	$nav_html = "<a href=\"index.php?nav=$nav\" target=\"_top\" class=\" " . link_class("$nav", $_SESSION['nav']) . "\"onMouseOver=\"window.status='$nav';return true;\">
	$text</a>";
	return $nav_html; }

$user_id=$_SESSION['uID'];
$html="";
foreach($Ttab as $Vtab)
{
$flag=0;
if (isset($_SESSION['user_level']) && $_SESSION['user_level']!="")
	foreach($_SESSION['user_level'] as $test)
	{
	if ($test['wname']==$Vtab['wname'] )
		{
		$ddname=$Vtab['name'];
		$ddwname=$Vtab['wname'];
		$ddlink=$Vtab['link'];
		$html .= "<a href=\"$ddlink\" target=\"_top\" class=\"" . link_class('$ddwname', $nav) . "\">$ddname</a>";
		break;
		}
	}


}


///   if logged in
if (isset($user_id) && $user_id!="" )
{
	$html .= "<a href=\"index.php?nav=user\"  target=\"_top\" class=\"" .  link_class('user', $nav) . "\">$LANG_USER_NAME</a>";
}

echo $html;

?>
</div>

<div class="personalBar">




<div class="location">
<?PHP
foreach($_SESSION[nav_path] as $value)
{
	$dtmp=$value[title];
	echo " $dtmp -> " ;
}
// tab location
echo " $LANG_Home " ;

?>
</div>
<div class="auth">

<?PHP
if(!empty($_SESSION['user']))
{	echo $_SESSION['user'] . " $LANG_Is_logged_in :: <a href=\"/system/auth.php?logoff=Yes\" target=\"maintmain\" onMouseOver=\"window.status='Log Out';return true;\"><font color=\"YELLOW\"> $LANG_Logout </font></a>"; }

else
{


	echo "$LANG_NotLoggedin :<a href=\"/index.php\" onMouseOver=\"
		window.status='Login';return true;\" id=\"mylink\"><font color=\"YELLOW\"> $LANG_Login </font></a>";

}

?>
</div>
</div>
</body>
</html>
