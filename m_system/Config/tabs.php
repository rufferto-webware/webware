<?PHP



$title_tabs=array();

/// usage array(tab_page,tab_text,security_array(array(webware_app,level)))

$title_tabs[]=array( 'nav' => 'user', 'text' => 'User', 'security' => array(  array( 'app' => '','level' => '' ) ) ) ;
$title_tabs[]=array( 'nav' => 'manage', 'text' => 'Manage', 'security' => array(  array( 'app' => '','level' => '' ) ) ) ;
$title_tabs[]=array( 'nav' => '@../m_system_build', 'text' => 'System Build', 'security' => array(  array( 'app' => 'system','level' => 'admin' ), array( 'app' => 'system','level' => 'supervisor' ) ) ) ;



Return $title_tabs;

?>