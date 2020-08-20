<?php


/// ////////////////////////////////////////////////////////////////////////////////
/// /////////////////////////////////////////////////////////////////////////////
/// ////////  Table classes
/// ///////////////////////////////////////////////////////////////////////////////

class cTable
{
	function __construct() 
	{
		$this->footer = 0;
		$this->HEADER_array = array();
		$this->DATA_array = "";
		$this->path = "/webware";

	}
	function head($hvar)
	{
		if(is_array($hvar))
			$this->HEADER_array = $hvar;
		else
			echo"\n\n\n<br> !!!!!! setting Header error !! [$hvar]\n\n\n";
	}
	function data($hvar)
	{
		if(is_array($hvar))
			$this->DATA_array = $hvar;
		else
			echo"\n\n\n<br> !!!!!! setting DATA error !! [$hvar] \n\n\n";
	}
	function ini()
	{
		echo		"\n     <link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->path."/lib/datatables/DataTables-1.10.20/css/jquery.dataTables.min.css\">";
		echo		"\n     <link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->path."/lib/datatables/FixedHeader-3.1.6/css/fixedHeader.dataTables.min.css\">";
		echo		"\n	    <style type=\"text/css\" class=\"init\">";
		echo		"\n     thead input { ";
		echo		"\n          width: 100%; ";
		echo		"\n		     } ";
		echo		"\n		</style>";
		echo		"\n		<script type=\"text/javascript\" language=\"javascript\" src=\"".$this->path."/lib/datatables/jquery-3.3.1.js\"></script>";
		echo		"\n		<script type=\"text/javascript\" language=\"javascript\" src=\"".$this->path."/lib/datatables/DataTables-1.10.20/js/jquery.dataTables.min.js\"></script>";
		echo		"\n		<script type=\"text/javascript\" language=\"javascript\" src=\"".$this->path."/lib/datatables/FixedHeader-3.1.6/js/dataTables.fixedHeader.min.js\"></script>";
		echo		"\n		<script type=\"text/javascript\" class=\"init\">";

		echo		"\n\n	    $(document).ready(function() { ";
		echo		"\n		// Setup - add a text input to each footer cell \n";
				
		echo		"\n		$('#Rtable thead tr').clone(true).appendTo( '#Rtable thead' ); ";
		echo		"\n		$('#Rtable thead tr:eq(1) th').each( function (i) { ";
		echo		"\n			var title = $(this).text(); ";
		echo		"\n			$(this).html( '<input type=\"text\" placeholder=\"Search '+title+'\" />' ); ";

		echo		"\n\n			$( 'input', this ).on( 'keyup change', function () { ";
		echo		"\n				if ( table.column(i).search() !== this.value ) { ";
		echo		"\n					table ";
		echo		"\n						.column(i) ";
		echo		"\n						.search( this.value )";
		echo		"\n						.draw();";
		echo		"\n				} ";
		echo		"\n			} ); ";
		echo		"\n		} ); ";

		echo		"\n\n		var table = $('#Rtable').DataTable( { ";
		echo		"\n			paging: false, ";
		echo		"\n			\"searching\": true, ";
		echo		"\n			orderCellsTop: true, ";
		echo		"\n			fixedHeader: { ";
		echo		"\n				headerOffset: 0, ";
		echo		"\n				header: true, ";
		echo		"\n				footer: false ";
		echo		"\n			}";
		echo		"\n		} );";
		echo		"\n	} );";


		echo		"\n\n\n		</script>	";
	}
	function display()
	{
		/// check both header and data for data ( ??? and same column count)
		
		if((!is_array($this->HEADER_array) || count($this->HEADER_array) == 0 ) || !is_array($this->DATA_array) )
		{
			echo "\n\n\n <h1>!!!! Error in Table data set {HEADER} !!!!!!!</h1>\n\n\n\n";
			return;
		}
		$h_count=count($this->HEADER_array); /// echo "<br> header cnt: $h_count";
				foreach($this->DATA_array as $datad)
					if($h_count!=count($datad))
					{
						echo "\n\n\n <h1>!!!! Error in Table data set {DATA col count} !!!!!!!</h1>\n\n\n\n";
						echo"<pre>";
						var_dump($datad);
						echo"</pre>";
						return;
					}
		
		
		echo"\n	<div class=\"fw-body\"> ";
		echo"\n	<div class=\"content\"> ";
		echo"\n		<table id=\"Rtable\" class=\"display\" style=\"width:100%\"> ";
		echo"\n			<thead> ";
		echo"\n				<tr> ";
		foreach($this->HEADER_array as $headd)
			echo"\n					<th>$headd</th> ";
		echo"\n				</tr>";
		echo"\n			</thead>"; 
		echo"\n					<tbody> ";
		foreach($this->DATA_array as $datad)
		{
			echo"\n				<tr> ";
			
				foreach($datad as $datat)
			echo"\n					<td>$datat</td> ";
			echo"\n				</tr> ";
		}

		echo"\n			</tbody>";
		if($this->footer!=0)
		{
			echo"\n				<tfoot> ";
			echo"\n				<tr> ";
			foreach($this->HEADER_array as $headd)
				echo"\n					<th>$headd</th> ";
			echo"\n				</tr> ";
			echo"\n			</tfoot> ";
		}

		echo"\n		</table>";
		echo"\n	</div>";
		echo"\n</div>";

	}	
}


?>