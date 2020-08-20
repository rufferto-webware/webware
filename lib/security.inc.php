<?PHP
include_once($_SESSION['file_root'].'/lib/Class_db.php');


/// secruity functions Here
/*
function sec_db_check_access($f_uid,$f_mod,$f_level,$f_dept="") --- returns -1 if no access, 0 if access is denided, 1 if access is good
function sec_db_add_access($f_uid,$f_mod,$f_level,$f_access,$f_dept="") --- returns null if error, 1 on sucess
function sec_db_add_access_group($f_gid,$f_mod,$f_level,$f_access,$f_dept="") --- returns null if error, 1 on sucess
function sec_db_get_modID($f_modName) --- returns 0 if none listed, # of mod ID 
function sec_db_get_groupID($f_groupName) --- returns 0 if none listed, # of group ID 
function sec_db_get_userID($f_userName) --- returns 0 if none listed, # of user ID
function sec_db_get_user_rights($f_uID) --- returns array of all security listed in DB for user
function sec_db_get_user_groups($f_uID)--- returns array of all groups in DB for user
function sec_db_add_user_group($f_uid,$f_group) --- adds user to group rights
function sec_db_get_user_info($f_uid) ---- returns user info
function sec_db_get_group_info($f_id='ALL')  ----returns all group info or one certon one
function sec_db_get_group_rights($f_gID) --- returns array of all security listed in DB for group
function sec_db_get_mod_info($f_id='ALL') ---- returns all module info or one certon one




*/

///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_check_access($f_uid,$f_mod,$f_level,$f_dept="")
{
	$ret_var=-1;
	if(empty($f_uid) || $f_uid=="" ||$f_uid<=0)
	{
		return NULL;
	}
		$DB= new ww_db;

		$sql="SELECT * FROM `system_rights`
					JOIN `system_webware` on `system_webware`.`id`=`system_rights`.`ww_id`
					WHERE `system_rights`.`user_id` = '$f_uid'
					  AND `system_rights`.`level` = '$f_level' ";
			if($f_dept!="")		  
				$sql.="	  AND `system_rights`.`dept` = '$f_dept' ";
		$sql.="			  AND `system_webware`.`name` = '$f_mod'
							 ";
	//	echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return $ret_var;
		}
		if($num == 1)
		{ 
				$var=$DB->fetch_array($res);
				$ret_var=$var['access'];
				return $ret_var;
			
		}
		return;
	
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG

function sec_db_add_access($f_uid,$f_mod,$f_level,$f_access,$f_dept="")
{
	$ret_var=-1;
	if(empty($f_uid) || $f_uid=="" ||$f_uid<=0)
	{
		return NULL;
	}
		$DB= new ww_db;
		$modID=sec_db_get_modID($f_mod);
		$sql="INSERT INTO`system_rights` (`access`,user_id,ww_id,`level`,`dept`,`group` )
		values ('$f_access','$f_uid','".$f_mod."','$f_level','$f_dept','0')
							 ";
//		echo "<br> $sql <br>"; exit();
/*		if($modID < 1) /// checks for  errors
		{	
			echo "<h2> !!!  Mod ID error  !!! </h2> ";
			exit();
		}///*/
		$res=$DB->query($sql);
		return 1;
	
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG

function sec_db_add_access_group($f_gid,$f_mod,$f_level,$f_access,$f_dept="")
{
	$ret_var=-1;
	if(empty($f_gid) || $f_gid=="" ||$f_gid<=0)
	{
		return NULL;
	}
		$DB= new ww_db;
		$modID=sec_db_get_modID($f_mod);
		$sql="INSERT INTO`system_rights` (`access`,user_id,ww_id,`level`,`dept`,`group` )
		values ('$f_access','0','".$f_mod."','$f_level','$f_dept','$f_gid')
							 ";
//		echo "<br> $sql <br>"; exit();
/*		if($modID < 1) /// checks for  errors
		{	
			echo "<h2> !!!  Mod ID error  !!! </h2> ";
			exit();
		}///*/
		$res=$DB->query($sql);
		return 1;
	
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_modID($f_modName)
{
	if(empty($f_modName) || $f_modName=="")
	{
		return 0;
	}
		$DB= new ww_db;
		$sql="SELECT * FROM `system_webware`
				  WHERE `name` = '$f_modName'
							 ";
	//	echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return -1;
		}
		if($num == 1)
		{ 
				$var=$DB->fetch_array($res);
				return $var['id'];
			
		}
		return 0;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_groupID($f_groupName)
{
	if(empty($f_groupName) || $f_groupName=="")
	{
		return 0;
	}
		$DB= new ww_db;
		$sql="SELECT * FROM `system_groups`
				  WHERE `name` = '$f_groupName'
							 ";
	//	echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return -1;
		}
		if($num == 1)
		{ 
				$var=$DB->fetch_array($res);
				return $var['id'];
			
		}
		return 0;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_userID($f_userName)
{
	if(empty($f_userName) || $f_userName=="")
	{
		return 0;
	}
		$DB= new ww_db;
		$sql="SELECT * FROM `system_user`
				  WHERE `loginname` = '$f_userName'
							 ";
	//	echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return -1;
		}
		if($num == 1)
		{ 
				$var=$DB->fetch_array($res);
				return $var['id'];
			
		}
		return 0;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_user_rights($f_uID)
{
	
	if(empty($f_uID) || $f_uID==""|| $f_uID==0)
	{
		return NULL;
	}
		$DB= new ww_db;
		$sql="SELECT * FROM `system_rights`
					JOIN `system_webware` on `system_webware`.`id`=`system_rights`.`ww_id`
					WHERE `system_rights`.`user_id` = '$f_uID'
					 order by `system_webware`.`name`, `system_rights`.`level` Asc 
							 ";
//		echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return NULL;
		}
		if($num > 0)
		{ 
			$ret_var=array();
			for($x_=0;$x_<$num;$x_++)
			{
				$var=$DB->fetch_array($res);
				$ret_var[]=array('ww_id'=>$var['ww_id'],
								 'name'=>$var['name'],
								 'level'=>$var['level'],
								 'dept'=>$var['dept'],
								 'access'=>$var['access']);
			}
			return $ret_var;
			
		}
return NULL;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_group_rights($f_gID)
{
	
	if(empty($f_gID) || $f_gID==""|| $f_gID==0)
	{
		return NULL;
	}
		$DB= new ww_db;
		$sql="SELECT * FROM `system_rights`
					JOIN `system_webware` on `system_webware`.`id`=`system_rights`.`ww_id`
					WHERE `system_rights`.`group` = '$f_gID'
					 order by `system_webware`.`name`, `system_rights`.`level` Asc 
							 ";
//		echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return NULL;
		}
		if($num > 0)
		{ 
			$ret_var=array();
			for($x_=0;$x_<$num;$x_++)
			{
				$var=$DB->fetch_array($res);
				$ret_var[]=array('ww_id'=>$var['ww_id'],
								 'name'=>$var['name'],
								 'level'=>$var['level'],
								 'dept'=>$var['dept'],
								 'access'=>$var['access']);
			}
			return $ret_var;
			
		}
return NULL;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_user_groups($f_uID)
{
	
	if(empty($f_uID) || $f_uID==""|| $f_uID==0)
	{
		return NULL;
	}
		$DB= new ww_db;
		$sql="SELECT `system_groups`.`name` as group_name, `system_user_group`.* FROM `system_user_group`
		JOIN `system_groups` on `system_groups`.`id`=`system_user_group`.`group_id`
					WHERE `user_id` = '$f_uID'
					 order by `system_groups`.`name` Asc 
							 ";
		//echo "<br> $sql <br>"; exit();
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num == 0)
		{
			return NULL;
		}
		if($num > 0)
		{ 
			$ret_var=array();
			for($x_=0;$x_<$num;$x_++)
			{
				$var=$DB->fetch_array($res);
				$ret_var[]=array( 'name' =>$var['group_name'], 'id' => $var['group_id'] );
			}
			return $ret_var;
			
		}
return NULL;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG

function sec_db_add_user_group($f_uID,$f_groupID)
{
	$ret_var=-1;
	if(empty($f_uID) || $f_uID=="" ||$f_uID<=0)
	{
		return NULL;
	}
		$DB= new ww_db;

	$u_group=sec_db_get_user_groups($f_uID);
	if (is_array($u_group))
	foreach($u_group as $groupT) 
	if ($groupT['id'] == $f_groupID) 
	{
		return $ret_var;
	}

		$sql="INSERT INTO`system_user_group` (user_id,`group_id` )
		values ('$f_uID','$f_groupID')
							 ";
		$res=$DB->query($sql);
		return 1;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_user_info($f_uid)
{
	$ret_var=-1;
	if(empty($f_uid) || $f_uid=="" ||$f_uid<=0)
	{
		return $ret_var;
	}
	$DB= new ww_db;
	
	$sql="SELECT *,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` WHERE `uID` = '$f_uid'";
	
	$ret_var=$DB->query_first($sql);
	return $ret_var;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_group_info($f_id='ALL')
{
	if(empty($f_id) || $f_id=="" )
	{
		return NULL;
	}
	$DB= new ww_db;
	
	$sql="SELECT * FROM `system_groups` WHERE 1 ";
	if($f_id!='ALL')
		$sql.=" AND `id`= '$f_id' ";
	if(strtolower($f_id) == 'active')
		$sql="SELECT * FROM `system_groups` WHERE `active` = '1' ";

		$sql.=" ORDER BY  `name` ASC ";
	
		$res=$DB->query($sql);
		$num=$DB->numrows($res);

		if($num == 0)
		{
			return NULL;
		}
		if($num > 0)
		{ 
			$ret_var=array();
			for($x_=0;$x_<$num;$x_++)
			{
				$ret_var[]=$DB->fetch_array($res);
			}
			return $ret_var;
			
		}
	return NULL;
}
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
///GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
function sec_db_get_mod_info($f_id='ALL')
{
	if(empty($f_id) || $f_id=="" )
	{
		return NULL;
	}
	$DB= new ww_db;
	
	$sql="SELECT * FROM `system_webware` WHERE 1 ";
	if($f_id!='ALL')
		$sql.=" AND `id`= '$f_id' ";
	
		$res=$DB->query($sql);
		$num=$DB->numrows($res);

		if($num == 0)
		{
			return NULL;
		}
		if($num > 0)
		{ 
			$ret_var=array();
			for($x_=0;$x_<$num;$x_++)
			{
				$ret_var[]=$DB->fetch_array($res);
			}
			return $ret_var;
			
		}
	return NULL;
}

?>