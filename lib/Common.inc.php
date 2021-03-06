<?PHP
/// common include for most pages


/// acess to database 
/// includes
include_once($_SESSION['file_root'].'/lib/Class_db.php');
include_once($_SESSION['file_root'].'/lib/security.inc.php');


/*
Functions list

check_input($f_var) ---- filters arrays 
time_elapsed_string($datetime, $full = false) ---- returns string of time elapesed from now
get_user_name($f_uID)   ----   returns full username from user ID
display_other_options($f_table,$f_type,$f_select="") ---- displays option from other tables
display_options_array($f_array,$f_value,$f_disp,$f_select="") --- displays option from array
array_change_key($a_array,$o_oldKey,$o_newKey) --- will swap out keys within an array



*/
/// common scripts
echo "
<script>

</script>
";


/// FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS
/// FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS
/// FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS FUNCTIONS

/// Filter input from GET and POST
function check_input($f_var)
{
	if(!is_array($f_var))
	{
		$f_var=trim($f_var); /// removes spaces
		//$f_var=addslashes($f_var); /// addes slashes
		$f_var=filter_var($f_var, FILTER_SANITIZE_SPECIAL_CHARS);
		return $f_var;
	}
	else
	{
		foreach ($f_var as $key => $value )
		{
			$value=trim($value); /// removes spaces
		//	$value=addslashes($value); /// addes slashes
			$value=filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
			$f_var[$key]= $value;
		}
		return $f_var;
	}
}
/// time time time time time time time time time time time time time time time time time time time 
/// time time time time time time time time time time time time time time time time time time time 
/// time time time time time time time time time time time time time time time time time time time 
function time_elapsed_string($datetime, $full = false) 
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) 
	{
        if ($diff->$k) 
		{
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        }
	  else 
		{
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
///MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
/// get Username from user ID
function get_user_name($f_uID)
{
	if(!empty($f_uID))
	{
		$DB= new ww_db;

		$sql="SELECT CONCAT(`fname`,' ',`lname`) as name FROM `system_user` WHERE `uID` = '$f_uID' ";
		$f_var=$DB->query_first($sql);
		return $f_var['name'];
	}
    return NULL;
}
///MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
/// get Group name from GroupID
function get_group_name($f_gID)
{
	if(!empty($f_gID))
	{
		$DB= new ww_db;

		$sql="SELECT name as name FROM `system_groups` WHERE `id` = '$f_gID' ";
		$f_var=$DB->query_first($sql);
		return $f_var['name'];
	}
    return NULL;
}
///MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
/// Display form options from other
function display_other_options($f_table,$f_type,$f_select="")
{
	///// ToDO check is "other" table
	if(!empty($f_table) && !empty($f_type))
	{
		$DB= new ww_db;

		$sql="SELECT * FROM `$f_table` WHERE `type` = '$f_type' ORDER BY `name` ASC ";
		$res=$DB->query($sql);
		$num=$DB->numrows($res);
		if($num > 0)
		{ 
			for($x_=0;$x_<$num;$x_++)
			{
				$var=$DB->fetch_array($res);
				echo "\n<option value='".$var['value']."' ";
				if($f_select==$var['value']) /// if selected matches
					echo " SELECTED ";
				echo" >".$var['name']."</option>";
			}
			return;
		}
	}
	return;
}
///MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
/// get Username from user ID
function display_options_array($f_array,$f_value,$f_disp,$f_select="")
{
	if(empty($f_array) || !is_array($f_array))
	{
		return NULL;
	}
	foreach($f_array as $row)
	{
		echo "\n<option value='".$row[$f_value]."' ";
		if($f_select==$row[$f_value]) /// if selected matches
			echo " SELECTED ";
		echo" >".$row[$f_disp]."</option>";
	}
	return;
}

///MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
/// will swap out keys within an array
function array_change_key($a_array,$o_oldKey,$o_newKey)
{
///  error trap inputs	
  if( ! array_key_exists( $o_oldKey, $a_array ) && !empty($o_newKey) )
		{
        return $array;
     	}

    $keys = array_keys( $a_array );
    $keys[ array_search( $o_oldKey, $keys ) ] = $o_newKey;

    return array_combine( $keys, $a_array );

}

?>