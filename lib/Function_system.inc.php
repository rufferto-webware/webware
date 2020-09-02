<?PHP

//// Functions for System usage
/*

function system_read_tabs($t_link) ---  read the tabs file in the config directory. To configure tabs.
function system_read_nav($t_link) ---  read the nav file in the config directory. T configure left navigation for each tab.
function system_write_tabs($t_mod,$t_array) ---- replaces and re-writes tab config file 


*/



/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
function system_read_tabs($t_link)
{
	if ($t_link=="" || empty($t_link))
				return NULL;
		if($t_link=='/')
				$t_link='';
	$file=$_SESSION['file_root'].$t_link.'/Config/tabs.php';
	if(false===file_exists($file))	
				return '\n !!!! File Error !!!!! \n';
	$ret_array = include $file;
	
	return $ret_array;

}
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
function system_write_tabs($t_mod,$t_array)
{
	if ($t_mod=="" || empty($t_mod) || !is_array($t_array))
				return NULL;
		if($t_mod=='/')
				$t_mod='';
	$file=$_SESSION['file_root'].$t_mod.'/Config/tabs.php';
	if(false===file_exists($file)	)			
				return '\n !!!! File Error !!!!! \n';
	
	
	 $h_file = fopen($file,"w",1);
	 $tab_f_header="<?PHP\n\n\n\n".'$'."title_tabs=array();\n\n/// usage array(tab_page,tab_text,security_array(array(webware_app,level)))\n\n";	
	 $tab_f_footer="\n\n\nReturn ".'$'."title_tabs;\n\n?>";	
	  fwrite($h_file,$tab_f_header);

	  for($t=0;$t < count($t_array);$t++)
	  {
	  		$sec_vs="'security' => array( ";
	  			foreach($t_array[$t]['security'] as $sec_temp)
	  				$sec_vs.=" array( 'app' => '".$sec_temp['app']."','level' => '".$sec_temp['level']."' ),";
	  			$sec_vs = rtrim($sec_vs, ",");
  				$sec_vs.=" )";
	  	
	  	
	  		$line='$'."title_tabs[]=array( 'nav' => '".$t_array[$t]['nav']."', 'text' => '".$t_array[$t]['text']."', ".$sec_vs." ) ;";
	  fwrite($h_file,$line."\n");		
	  }
	  		
	  fwrite($h_file,$tab_f_footer);		
	fclose($h_file);	
	return 1;		

}
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
/// HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
function system_read_nav($t_link)
{
	if ($t_link=="" || empty($t_link))
				return NULL;
		if($t_link=='/')
				$t_link='';
	$file=$_SESSION['file_root'].$t_link.'/Config/navs.php';
	if(false===file_exists($file))	
				return '\n !!!! File Error ('.$file.')!!!!! \n';
	$ret_array = include $file;
				
	return $ret_array;

}









?>