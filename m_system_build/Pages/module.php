<?PHP
session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
include_once($_SESSION['file_root'].'/lib/Function_system.inc.php');
$DB= new ww_db;

echo "<!DOCTYPE html>\n";

echo "<h2> Manage Modules in System </h2>";

if(!empty($_GET['ref']) )
{
$_POST['f_submit']='Add';
$_POST['f_mID']=sec_db_get_modID(substr($_GET['ref'],3 ) );
//var_dump($_POST);
}



if(!empty($_POST['m_submit']))
{
	$_POST=check_input($_POST); /// checks and trims input


	$sql="UPDATE `system_webware` SET `name`='".$_POST['f_name']."', 
												 `link`='".$_POST['f_link']."', 
												 `desc`='".$_POST['f_desc']."', 
												 `comment`='".$_POST['f_comment']."', 
												 `active` ='".$_POST['f_active']."'   
								 WHERE `id`='".$_POST['f_mID']."'";
	
		$res=$DB->query($sql);
		echo "<br> Updated Module Information<br>";





}

if(!empty($_POST['f_submit']))
{
	$_POST=check_input($_POST); /// checks and trims input
	
	$sql="SELECT * FROM `system_webware` WHERE `id`='".$_POST['f_mID']."'";
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
	if ($num==0)
	{
		echo "<br><br><br><br><br>No Modules .....";
	}
	else
	{
		$var=$DB->fetch_array($res);

	echo "<TABLE width='2000'><TR>";
		echo "<TD width='33%'><center><H1> Module Info</h1><TABLE >";
		echo "<form method='POST'>" ;
		echo "<input type='hidden' name='f_submit' value='edit'>";
		echo "<input type='hidden' name='f_mID' value='".$var['id']."'>";

		echo "<TR> <th> Name </th><th> <input  type='text' name='f_name'  value='".$var['name']."'/> </th> </TR> ";
		echo "<TR> <th> Link </th><th> <input  type='text' name='f_link'  value='".$var['link']."'/> </th> </TR> ";
		echo "<TR> <th> Descrtption </th><th> <input  type='text' name='f_desc'  value='".$var['desc']."'/> </th> </TR> ";
		echo "<TR> <th> Comment </th><th> <input  type='text' name='f_comment'  value='".$var['comment']."'/> </th> </TR> ";
		echo "<TR> <th> active </th><th> <input  type='text' name='f_active'  value='".$var['active']."'/> </th> </TR> ";
		echo "<TR><TD> <input type='submit' name='m_submit' value='edit'> </TD><TD> </TD></TR>";
		echo"</form>";
		echo "</TABLE></TD>";

		echo "<TD width='33%'><center><H1>Tabs Info (".$var['link'].") </h1><TABLE BORDER=\"1\" CELLSPACING=\"2\" CELLPADDING=\"10\">";
		$tabs_var=system_read_tabs($var['link']);
		$_SESSION['tabs_var']=$tabs_var;
	//	var_dump($tabs_var);
		
       if(is_array($tabs_var))
       {
       	echo "<TR> <TH> Order </TH><TH> Name </TH><TH> Nav= </TH><TH> Security </TH>  </TR>";
       	$tab_index=0;
	       foreach($tabs_var as $tabs_v)
	       {
	       	echo "<TR> <TD> <input type=\"button\" value=\"Edit\" onClick=\"window.open('edit_tabs.php?tab_index=$tab_index&mod=".$var['link']."','mywindow','scrollbars=1,width=800,height=600')\" onMouseOver=\"this.style.cursor='hand';return true;\">
	       			".($tab_index+1)." </TD><TD> ".$tabs_v['text']." </TD><TD> ".$tabs_v['nav']." </TD><TD> ";
       		if(is_array($tabs_v['security']))
	       		foreach($tabs_v['security'] as $sec_v)
	       		{
	       			if(!empty($sec_v['app']))
	       				echo $sec_v['app']." : ".$sec_v['level']."\n<br>";
	       			else
	       				echo "NONE ";
	       		}
	       		
	       	echo " </TD>  </TR>";
	       	$tab_index++;
	       }
    	 }
    	 else	
    	  echo " <b> No Tabs  listed </b>";	
		echo "<input type=\"button\" value=\"Add\" onClick=\"window.open('add_tab.php?mod=".$var['link']."','mywindow','scrollbars=1,width=800,height=600')\" onMouseOver=\"this.style.cursor='hand';return true;\">";		
		echo "</TABLE></TD>";
		
		echo "<TD width='33%'><center><H1>Side Nav Info</h1><TABLE BORDER=\"1\" CELLSPACING=\"2\" CELLPADDING=\"10\">";
		$nav_var=system_read_nav($var['link']);
		$_SESSION['nav_var']=$nav_var;
		//var_dump($nav_var);		

       if(is_array($nav_var['nav']))
       {
       	$t_counter=1;
       	echo "<TR> <TH>Tab </TH><TH> Info </TH>  </TR>";
	       foreach($nav_var['nav'] as $nav_v)
	       {
	       	echo "<TR> <TD> ".$nav_v." (default page= ".$nav_var[$nav_v]['default_page'].") </TD><TD> ";

      		if(is_array($nav_var[$nav_v]['heading']))
	       		foreach($nav_var[$nav_v]['heading'] as $heading_v)
	       		{
	       			echo "<b> $heading_v </b> <br>";

		      		if(is_array($nav_var[$nav_v][$heading_v]))
			       		foreach($nav_var[$nav_v][$heading_v] as $head_nav_v)
			       		{
			       			echo $head_nav_v['page']." : ".$head_nav_v['text']." <br>";
			       			
/*				       			if(!empty($sec_v['app']))
				       				echo $sec_v['app']." : ".$sec_v['level']."\n<br>";
				       			else
				       				echo "NONE ";//*/
			       		}
			       else
			       echo " ~ ";
			       
			       		
	       			
	       			
	       			
	       			
	       		}
	    //*/   		
	       	echo " </TD>  </TR>";
	       	
	       }
    	 }		
    	 else	
    	  echo " <b> No Navigations listed </b>";	

		echo "</TABLE></TD>";
		
	echo "</TR></TABLE>";
	}

	
}







//// get all module information
$sql="SELECT * FROM `system_webware`";

	$res=$DB->query($sql);
	$num=$DB->numrows($res);
if ($num==0)
{
	echo "<br><br><br><br><br>No Modules .....";
}
else
{
	echo "<TABLE BORDER=\"3\" CELLSPACING=\"2\" CELLPADDING=\"10\">";
	echo "<TR> <th>Edit</th><th>Name</th><th>link</th><th>description</th><th>comment</th><th>active</th>  </TR> ";
	for($x=0;$x<$num;$x++)
	{
		$var=$DB->fetch_array($res);
		echo "<form method='POST'>" ;
			echo "<input type='hidden' name='f_mID' value='".$var['id']."'>";
			echo "<TR> <td><input type='submit' name='f_submit' value='Edit'></td><td>".$var['name']."</td><td>".$var['link']."</td><td>".$var['desc']."</td><td>".$var['comment']."</td><td>".$var['active']."</td>  </TR> ";
		echo"</form>";
	}	
	
	echo "</TABLE>";
}






/*
/// Form to Add User
echo"<form method='POST'>";
echo "<input type='hidden' name='f_submit' value='Add'>";
echo "<table> ";
echo "<TR><TD> Group Name</TD><TD><input type='text' name='f_gname' value='$m_gname'></TD></TR>";
echo "<TR><TD> Descrtiption</TD><TD><input type='text' name='f_desc' value='$m_desc'></TD></TR>";
echo "<TR><TD> Home </TD><TD><input type='text' name='f_home' value='$m_home'></TD></TR>";

echo "<TR><TD> <input type='submit' name='submit' value='Add'> </TD><TD> </TD></TR>";
echo "</table> ";
echo"</form>";
//*/
echo "\n</html>";
?>

