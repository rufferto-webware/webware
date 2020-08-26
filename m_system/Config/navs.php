<?PHP



$nav_links=array();

/// usage array(nav_page,nav_text,nav_Heading,Nav_Onclick,'security' => array(array('app'=>'','level'=>'')));


$nav_links['nav'][]=$nav_nav='user';
	$nav_links[$nav_nav]['default_page']='page1';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='User';
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "chg_pass", 'text'=> 'Change Password', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' => "edit_user_info", 'text' => 'Edit User Info', 'OnClick' => "", 'security' => array(array('app'=>'','level'=>'')));


$nav_links['nav'][]=$nav_nav='manage';
	$nav_links[$nav_nav]['default_page']='manage';
	$nav_links[$nav_nav]['heading'][]=$nav_heading='User Admin';
		$nav_links[$nav_nav][$nav_heading][]=array('page' =>"add_user", 'text'=>'Add User', 'OnClick' => "", 'security' => array(array('app'=>'system_build','level'=>'admin')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' =>"edit_user", 'text'=>'Edit User', 'OnClick' => "", 'security' => array(array('app'=>'system_build','level'=>'admin')));

	$nav_links[$nav_nav]['heading'][]=$nav_heading='Group';
		$nav_links[$nav_nav][$nav_heading][]=array('page' =>"add_group", 'text'=>'Add New Group', 'OnClick'=> "", 'security' => array(array('app'=>'system_build','level'=>'admin')));
		$nav_links[$nav_nav][$nav_heading][]=array('page' =>"edit_group", 'text'=>'Edit Group', 'OnClick'=> "", 'security' => array(array('app'=>'system_build','level'=>'admin')));

RETURN $nav_links;
?>