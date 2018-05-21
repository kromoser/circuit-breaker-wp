<?php
function convert_date_to_sql($date) {
 return date('Y-m-d', strtotime($date) );
}
	  
?>