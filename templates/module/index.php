<?PHP
if(!isset($_SESSION)) session_start();

if (empty($_SESSION['nav_path']))
		$_SESSION['nav_path']=array(array('title'=>'Main', 'link'=>$_SERVER['PHP_SELF'] ));
if(empty($_SESSION['g_prev_loc']))
{/// if just linked to this page sets vars needed
	$temp_path= include '../Config/web_path.php';
	$_SESSION['file_root']=$temp_path['file_path'];
	$_SESSION['url_root']=$temp_path['web_path'];
	$_SESSION['g_prev_loc']=array(array('title'=>'Main', 'link'=>$_SESSION['url_root'].'/index.php' ));
	$_SESSION['g_loc']=$_SESSION['url_root'].'/index.php';
}

if(empty($_SESSION['g_userID']))
{/// if Not Logged in
	$_SESSION['login_return_too']=$_SERVER['REQUEST_URI'] ; 
	include_once $_SESSION['file_root'].'/m_system/Pages/auth.php';
	exit();
}
// CSS include file 
	$mainCSS='mainC.css';
	if (strstr($_SERVER['HTTP_USER_AGENT'],"MSIE 6.0;" ))
	{  /// for IE6(XP)
		$mainCSS='mainC_ie6.css';
	}
	else
	{ /// other browsers
		echo "\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />\n";
	}

	if(file_exists('./CSS/'.$mainCSS)) /// uses default unless custom exists	
		include_once './CSS/'.$mainCSS; 
	  else 
		include_once $_SESSION['file_root'].'/CSS/'.$mainCSS;

//// configuration files
include_once './Config/tabs.php';
include_once './Config/navs.php';
include_once './Config/config.php';

/// gets custom logo file else get default
if(file_exists('./images/logo.gif')) /// uses default unless custom exists	
	$logo_file='./images/logo.gif'; 
  else 
	$logo_file=$_SESSION['file_root'].'/images/logo.gif';



//echo "<script>\n alert(\" self: ".$_SERVER["PHP_SELF"]." -=- LL: ".$_SESSION['g_loc']."\")\n</script>";

	if(!empty($_GET['bP'])) 
	{ /// if removing some links history
			for($p=0;$p<$_GET['bP'];$p++)
				$last_path=array_pop($_SESSION['g_prev_loc']);
	}
	elseif($_SERVER["PHP_SELF"]!=$_SESSION['g_loc'] )
	{
		$_SESSION['g_prev_loc'][]=array(title=>$Title_name,link=>$_SERVER["PHP_SELF"]);///  adds new to nav path
	}
	$_SESSION['g_loc']=$_SERVER["PHP_SELF"];
	$last_paths=array_slice($_SESSION['g_prev_loc'],-2);$last_path=$last_paths[0];

if(empty($_GET['nav'])) /// if no nav set to default
	$_GET['nav']=$Default_nav;

	


//echo str_replace("\n"," ",str_replace("\r\n","\n",file_get_contents('./CSS/mainC.css',TRUE)));
/* jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj */
?>
<!DOCTYPE html>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Webware 3.0</title>
	
<!-- Title section -->	
	<body>		
		<header id="header">
			<div class="logo">
			<img src="<?PHP echo $_SESSION['url_root'];?>/images/logo.gif" width="200" height="80">
			</div>
<div class="tabs">
<?PHP		
/// sets the class of the tab
function link_class($name, $nav)
{	
	if($nav == $name) 
		$class = 'selected'; 
	else 
		$class = 'plain'; 
  	return $class;
}	
$html="";			
if(is_array($title_tabs))			
foreach($title_tabs as $tab)
{
   $pos=strpos($tab['nav'], '@');
   $tab_sec=$tab['security'];
   $sec_flag=0;
   // if no security used
   if($tab_sec==array(array('app'=>'','level'=>'')))
   		$sec_flag=1;
   if(is_array($tab_sec))
   foreach($tab_sec as $t_sec )
   {
   	// checking if user has rights security used
   	if(isset($_SESSION['g_priv']['security'][$t_sec['app']][$t_sec['level']]))
   	{
   		$sec_flag=1;
   		break;
   	}
   }
 if($sec_flag==1)
	if ($pos === FALSE || $pos>0) 
	{
		$html .= "\n<a href=\"index.php?nav=".$tab['nav']."\" target=\"_top\" class=\"" . link_class($tab['nav'], $_GET['nav']) . "\">".$tab['text']."</a>\n";	
	}
	else
	{ /// if a module
		$tmp_nav=substr($tab['nav'],1);
		$html .= "\n<a href=\"".$tmp_nav."\" target=\"_top\" class=\"" . link_class($tab['nav'], $_GET['nav']) . "\">".$tab['text']."</a>\n";	
	}
}
		$html .= "\n<a href=\"".$last_path['link']."?bP=1\" target=\"_top\" class=\"" . link_class($tab['nav'], $_GET['nav']) . "\"> Back </a>\n";	
			
	echo $html;
?>	
</div>	
<div class="personalBar">
	<div class="location">
<?PHP





if(is_array($_SESSION['g_prev_loc']))
{
			
	$pop_value=count($_SESSION['g_prev_loc']);
	foreach($_SESSION['g_prev_loc'] as $value)
	{
		$pop_value--;
		$dtmp=$value['title'];
		if( $pop_value == 0 ) 
			echo "  $dtmp " ; /// last array
		else
			echo " <a style=\"color:green\" href=".$value['link']."?bP=$pop_value>$dtmp</a> -> " ;
	}
}

?>
	</div>
	<div class='bar_data' id='bar_data'>
		<?PHP echo $_SESSION['test_data'];?>
	</div>
<div class="auth">

<?PHP
if(!empty($_SESSION['g_userID']))
{	
	echo "\n\n\n\n\n".$_SESSION['g_username'] . " is logged in :: <a href=\"".$_SESSION['url_root']."/m_system/Pages/auth.php?logoff=Yes\" onMouseOver=\"window.status='Log Out';return true;\"><font color=\"YELLOW\"> Logout </font></a>"; 
}
else
{
	echo "\n\n\n\n\n Not Logged in :<a href=\"".$_SESSION['url_root']."/m_system/Pages/auth.php\" onMouseOver=\"
		window.status='Login';return true;\" ><font color=\"YELLOW\"> Login </font></a>";
}
?>
</div>
</div>

		</header>
<!-- main info section -->				
		<main>
		<div class="main">
			<div class="innertube">
<?PHP /// loader information is in the CSS file
?>
<div id="loader" ></div>
					<script type="text/javascript">
                      function iframeLoaded() {
                          var iFrameID = document.getElementById('idIframe');
						  var page_height = document.documentElement.scrollHeight;
                          if(iFrameID) {
                                // here you can make the height, I delete it first, then I make it again
                                iFrameID.height = "";
								page_height =  page_height - 110;
                                iFrameID.height = page_height + "px";
                          }
						document.getElementById('loader').style.display='none';						  
                      }
                    </script> 
<?PHP

if(empty($_SERVER['HTTP_REFERER']))
	$file=$Default_page;
//if(!empty($nav_links[$_GET['nav']]['default_page']))
///	$file=$nav_links[$_GET['nav']]['default_page'];
if(!empty($_GET['page']))
	$file=$_GET['page'];
elseif(empty($file))
	$file='default_page';
 $file.='.php';

		 echo "<iframe id=\"idIframe\" onload=\"iframeLoaded()\" frameborder=\"0\" src=\"Pages/$file\" 
					height=\"100%\" width=\"100%\"></iframe>";
?>				
			</div>
		</div>
	</main>

<!-- Navigation section -->

		<nav id="nav" ><div class="nav">
			<div class="innertube">
<?php
if (is_array($nav_links[$_GET['nav']]['heading']))
	foreach($nav_links[$_GET['nav']]['heading'] as $nHeading)
	{
		$print_links="";
		
		if (is_array($nav_links[$_GET['nav']][$nHeading]))
		foreach($nav_links[$_GET['nav']][$nHeading] as $nLink)
		{
		   $tmp_sec=$nLink['security'];
		   $sec_flag=0;
   		// if no security used
   		if($tmp_sec==array(array('app'=>'','level'=>'')))
		   		$sec_flag=1;
   		if(is_array($tmp_sec))
   		foreach($tmp_sec as $t_sec )
   		{
   			// checking if user has rights security used
   			if(isset($_SESSION['g_priv']['security'][$t_sec['app']][$t_sec['level']]))
   			{
   				$sec_flag=1;
   				break;
   			}
   		}
	 		if($sec_flag==1)
 			{
	
				$nLoader="block";
				$nref=$_SERVER['PHP_SELF']."?nav=".$_GET['nav']."&page=".$nLink['page'];
				if($nLink['page']==""||$nLink['page']=="#" )
				{
					$nref="#";
					$nLoader="none";
				}
				$print_links.= "\n			<li><a href=\"".$nref.
									"\"  onclick=\"javascript:document.getElementById('loader').style.display='".$nLoader."';".$nLink['OnClick']."\">".
												$nLink['text']."</a></li> " ;
			}
		}
		/// if no links dont show header
		if($print_links!="")
		{
			echo "<h3>".$nHeading."</h3> \n<ul>";
			echo $print_links;
		}
		echo "\n</ul>";
	}
?>			
				</div>
			</div>
		</nav>	
	</body>
</html>
