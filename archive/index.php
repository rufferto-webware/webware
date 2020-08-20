<!DOCTYPE html>
<?PHP
include "./CSS/mainC.css";
?>

/* jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj */

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Webware 3.0</title>
	
	</head>
<!-- Title section -->	
	<body>		
		<header id="header">
			<div class="logo">
			<img src="./images/homer.gif" width="200" height="100">
			</div>
			<div class="tabs">
			
<?PHP		
//echo "  $_GET[nav]  ";	
# sets the class of the tab
function link_class($name, $nav)
{	if($nav == $name) {
		$class = 'selected'; }
	else {
		$class = 'plain'; }
  	return $class;
}			
			
		$html .= "\n<a href=\"index.php?nav=page1\" target=\"_top\" class=\"" . link_class('page1', $_GET['nav']) . "\">Main</a>";	
		$html .= "\n<a href=\"index.php?nav=page2\" target=\"_top\" class=\"" . link_class('page2', $_GET['nav']) . "\">Ajax Test</a>";	
		$html .= "\n<a href=\"index.php?nav=page3\" target=\"_top\" class=\"" . link_class('page3', $_GET['nav']) . "\">Doc Test</a>";	
		$html .= "\n<a href=\"index.php?nav=page4\" target=\"_top\" class=\"" . link_class('page4', $_GET['nav']) . "\">Long Page</a>\n";	
			
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
		</header>
<!-- main info section -->				
		<main>
			<div class="innertube">
			<script type="text/javascript" >
				//document.getElementById('loader').style.display='none';			
	function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "page1-2.php", true);
        xmlhttp.send();
    }
}			
			</script>

<div id="loader"></div>
				
				<p>
				
			
				<span id="txtHint">

<?PHP

$file=$_GET['nav'];
if(!empty($_GET['page']))
	$file=$_GET['page'];
	$file.=".php";
	//	include $file;
	 
		 echo "<iframe src=\"$file\" height=\"2000\" width=\"100%\" style=\"border:none;\"></iframe>"; 
?>				
				
				</p>
				
			</div>
		</main>


<script type="text/javascript" >
// document.getElementById('loader').style.display='none';
</script> 		




<!-- Navigation section -->

		<nav id="nav">
			<div class="innertube">
				<h1>Heading 1 </h1>
				<ul>
					<li><a href="<?php echo $_SERVER['PHP_SELF']."?nav=page1&page=page1-1 " ; ?>">another page</a></li>
					<li><a href="#" onclick="showHint('page1-2')">page by Ajax</a></li>
					<li><a  onclick="javascript:document.getElementById('loader').style.display='block';"  href="<?php echo $_SERVER['PHP_SELF']."?nav=page2&page=spinner " ; ?>">slow page</a></li>
					<li><a href="#">Link 4</a></li>
					<li><a href="#">Link 5</a></li>
				</ul>
				<h1>Heading 2 </h1>
				<ul>
					<li><a  onclick="javascript:document.getElementById('loader').style.display='block';"  href="<?php echo $_SERVER['PHP_SELF']."?nav=page1&page=table2 " ; ?>">Table Page</a></li>
					<li><a  onclick="javascript:document.getElementById('loader').style.display='block';"  href="<?php echo $_SERVER['PHP_SELF']."?nav=page1&page=fourm " ; ?>">Form Page</a></li>
					<li><a href="#">Link 3</a></li>
					<li><a href="#">Link 4</a></li>
					<li><a href="#">Link 5</a></li>
				</ul>
				<h1>Heading 3 </h1>
				<ul>
					<li><a href="#">Link 1</a></li>
					<li><a href="#">Link 2</a></li>
					<li><a href="#">Link 3</a></li>
					<li><a href="#">Link 4</a></li>
					<li><a href="#">Link 5</a></li>
				</ul>
			</div>
		</nav>	
	</body>
</html>
