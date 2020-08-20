

<?PHP
//if(!empty($_GET))
	echo"Get: ";
 var_dump($_GET);
	echo"<br>Post: ";
 var_dump($_POST);


echo "<FoRM method=post action=".$_SERVER['PHP_SELF']."?somegetVar=getSome>";

echo "<br>Name: <input type=TEXT name=name value=\"none\" />";
echo "<br>age: <input type=TEXT name=age value=\"69\" />";
echo "<br>addre: <input type=TEXT name=addr value=\"\" />";
echo "<br>Assembly: <input type=TEXT name=assy value=\"\" />";
echo "<br> <input type=submit name=sun value=\"Submit\" />";



echo "</FoRM>";

//phpinfo();


?>


