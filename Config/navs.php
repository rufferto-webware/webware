<?PHP



$nav_links=array();

/// usage array(nav_page,nav_text,nav_Heading,Nav_Onclick,security_array(array(webware_app,level)))

$nav_links['nav'][]=$nav_nav='page2';
	$nav_links[$nav_nav]['default_page']='page2';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Main Heading';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "page1-1", 'text' => 'Another Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "#", 'text' => 'Page By Ajax', 'OnClick' => "show_AJAX('page1-2')", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "spinner", 'text' => 'Slow Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "assy", 'text' => 'Assembly AJAX', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));

$nav_links['nav'][]=$nav_nav='page1';
	$nav_links[$nav_nav]['default_page']='page1';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Second Heading';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table2", 'text' => 'Table Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "fourm", 'text' => 'Form Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table_class", 'text' => 'class Table', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));

$nav_links['nav'][]=$nav_nav='page3';
	$nav_links[$nav_nav]['default_page']='page3';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Add Data';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "add_data", 'text' => 'Add Data', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));

$nav_links['nav'][]=$nav_nav='page4';
	$nav_links[$nav_nav]['default_page']='page1-1';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='Main Heading';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "page1-1", 'text' => 'Another Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "#",       'text' => 'Page By Ajax', 'OnClick' =>"show_AJAX('page1-2')", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page'=> "spinner", 'text' => 'Slow Page',    'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));

	$nav_links[$nav_nav]['heading'][]=$nav_heading='Second Heading';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table2", 'text' => 'Table Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "fourm", 'text' => 'Form Page', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "table_class", 'text' => 'class Table', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));


return $nav_links;
?>