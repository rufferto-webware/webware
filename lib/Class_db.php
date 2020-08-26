<?php


/// ////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////
/// ////////  Database classes
/// ///////////////////////////////////////////////////////////////////////////////

class ww_db
{
	function __construct() 
	{
		$this->host="localhost";
		$this->database="webware3";
		$this->show_error=1;
//		$this->database="ems";
		$this->user="webware30";
		$this->pass="Macksucks5";
		$this->appname="EMSproduction";
		$this->record="";
		$this->link = mysqli_connect($this->host,$this->user,$this->pass,$this->database);

		if (!$this->link) {
		    $this->print_error("LinkID=FALSE, connection failed!".mysqli_connect_error());
		}
/*    function __destruct() 
	{
		//echo "Destruct";
		$this->free_result();
		$this->close();
    }		
	*/

	}

/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// QUERY   FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function query($query) 
	{
		$this->query_id=mysqli_query($this->link,$query);
		if (!$this->query_id) {
		    $this->print_error("Invalid QUERY: " . $query);
		}
		return $this->query_id;
	} // End query

/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// change DB      FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function databaseChange($q_database)
	{
		$this->database=$q_database;
		if (!@mysqli_select_db($this->database)) {
			$this->print_error("Impossible to open the database: " . $this->database);
		}
	} // End change database

/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// query DB  and retrun first row FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function query_first($query) 
	{
		$this->query($query);	// Call query function
		$returnarray = $this->fetch_array($this->query_id);
//		$this->free_result($this->query_id);
		return $returnarray;
	}
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// query DB  and retrun first row FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function query_all($query) 
	{
		$returnarray=array();
		$row_count=0;
		$this->query($query);	// Call query function
		$row_count=$this->numrows();
		 for($_x=0;$_x<$row_count;$_x++)
			$returnarray[] = $this->fetch_array($this->query_id);
//		$this->free_result($this->query_id);
		return $returnarray;
	}
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// insert into  DB and return index used FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function insert($query) 
	{ //// ToDO: maybe check if query is an insert
		$this->query($query);	// Call query function
		$returnarray = mysqli_insert_id($this->link); /// get last auto id number
		return $returnarray;
	}

/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Fetch  row     FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function fetch_all($query_id='-1') 
	{
		if ($query_id!='-1') 
		{
		    $this->query_id=$query_id;
		}
		if ($this->query_id) 
		{
			$row_count=$this->numrows();
			for($_x=0;$_x<$row_count;$_x++)
				$returnarray[] = $this->fetch_array($this->query_id);
			return $returnarray;
		} 
		else 
		{
			$this->record = FALSE;
		}
		return $this->record;
	} // End fetch_array
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Fetch  all     FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function fetch_array($query_id='-1') 
	{
		if ($query_id!='-1') {
		    $this->query_id=$query_id;
			}
		if ($this->query_id) {
		    $this->record = mysqli_fetch_array($this->query_id);
		} else {
			$this->record = FALSE;
			}
		return $this->record;
	} // End fetch_array
	
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Get Row Number FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function numrows($query_id='-1') 
	{
		if ($query_id != '-1') {
		    $this->query_id=$query_id;
		}
		return @mysqli_num_rows($this->query_id);
	} // End numrows
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Close connection FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function close() 
	{
		mysqli_close($this->link);
	} // End close
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Free Results FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function free_result($query_id='-1')
	{
		if ($query_id != '-1') {
		    $this->query_id=$query_id;
		}
		return @mysqli_free_result($this->query_id);
	} // End free_result
/// FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
/// Print Error FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
	function print_error($msg)
	{
		$this->errdesc = mysqli_error($this->link);
		$this->errno = mysqli_errno($this->link);

		$messagehtml = "Error in the DB in $this->appname: $msg\n<BR/>";
		$messagehtml.= "error mySQL	        : $this->errdesc\n<BR/>";
		$messagehtml.= "error number mySQL	: $this->errno\n<BR/>";
		$messagehtml.= "Date     	        : " .date("d.m.Y @ H:i") . "\n<BR/>";
		$messagehtml.= "Page     	        : " .getenv("REQUEST_URI") . "\n<BR/>";
		$messagehtml.= "Referer    	        : " .getenv("HTTP_REFERER") . "\n<BR/>";
		$messagehtml.= "USER IP    	        : " .getenv("REMOTE_ADDR") . "\n<BR/>";

		if ($this->show_error == 1) {
		    echo $messagehtml;
		}
	} // End print_error


}


?>