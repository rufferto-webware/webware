<?PHP



$title_tabs=array();

/// usage array(tab_page,tab_text,security_array(array('app'=>'','level'=>'')))

$title_tabs[]=array('nav' => 'page1', 'text' => 'System Build', 'security' => array(array('app'=>'','level'=>'')));
$title_tabs[]=array('nav' => 'manage', 'text' => 'Manage', 'security' =>  array(array('app'=>'system_build','level'=>'admin'),array('app'=>'system_build','level'=>'supervisor')));
$title_tabs[]=array('nav' => '@../m_system', 'text' => 'User', 'security' => array(array('app'=>'','level'=>'')));




RETURN $title_tabs;
?>