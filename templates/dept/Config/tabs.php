<?PHP



$title_tabs=array();

/// usage array(tab_page,tab_text,security_array(array(webware_app,level)))

$title_tabs[]=array(nav =>'page1', text=>'Main', security=>array(array(webware_app,level)));
$title_tabs[]=array(nav =>'page2',text=>'Ajax Test',security=>array(array(webware_app,level)));
$title_tabs[]=array(nav =>'page3',text=>'Doc Test',security=>array(array(webware_app,level)));
$title_tabs[]=array(nav =>'page4',text=>'Long Page',security=>array(array(webware_app,level)));




RETURN $title_tabs;
?>