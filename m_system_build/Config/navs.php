<?PHP



$nav_links=array();

/// usage array(nav_page,nav_text,nav_Heading,Nav_Onclick,security_array(array(webware_app,level)))


$nav_links['nav'][]=$nav_nav='page1';
	$nav_links[$nav_nav]['default_page']='page1';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Second Heading';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table2", 'text' => 'Table Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "fourm", 'text' => 'Form Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table_class", 'text' => 'class Table', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));


$nav_links['nav'][]=$nav_nav='manage';
	$nav_links[$nav_nav]['default_page']='manage';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Stsyem Build';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "add_user", 'text' => 'Add User', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "edit_user", 'text' => 'Edit User', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));


?>