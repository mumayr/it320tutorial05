<?php
/*
*   Plugin Name: Users Reader
*   Description: plugin to read the MySQL DB Users table - GUTENBERG COMPATIBLE
*   Version: 1.0 
*   Author: Mohammed Umayr
*   File: wp-users-reader.php
*   Folder to create: posts-tbl-reader
*   Short code: [wp-users-reader-shortcode]
*/
   
  add_shortcode( 'wp-users-reader-shortcode', 'wp_users_reader_entry_point' );


function wp_users_reader_entry_point ( $attributes ) {
	
	global $wpdb;
 
 	$output = "";

	//Use the concatinaiton operator to join the table prefix to the word comments
	// to create the correct db prefix + table name
	//
	$tableName =   $wpdb->prefix . "users"; 

	//Echo out the $tablename varaible, which is the db prefix + table name
	//
	//$output .= "$tableName" . "<br>";
	  
	//Query the vomments table and assign the returned array of table row objects
	// to the $result variable
	//
	$result = $wpdb->get_results( "SELECT * FROM $tableName");

    //Echo out a table header using start string values
    //
	$output .= "<table border=\"1\">";
	$output .= "<tr>";
	$output .= "<th>" . "ID"        . "</th>" 
		    . "<th>"  . "Login"    . "</th>" 
		    . "<th>"  . "Nicename" . "</th>"
            . "<th>"  . "Email" . "</th>" 
            . "<th>"  . "Status" . "</th>" 
		    . "<th>"  . "DisplayName"     . "</th>";
		    
	$output .= "</tr>";

	//Iterate the array of DB row objects and put them in HTML table cells
	// 
	foreach($result as $row)  {
	 $output .= "<tr>";
	
	 //Each table row column data item is accessed using it's column name 
	 // 
	   $output .=   "<td>" . $row->ID . "</td>"
		  . "<td>" . $row->user_login . "</td>"
		  . "<td>" . $row->user_nicename   . "</td>"
            . "<td>" . $row->user_email   . "</td>"
           . "<td>" . $row->user_status   . "</td>"
		  . "<td>" . $row->display_name  . "</td>";
		  
	   $output .= "</tr>";
	}

	$output .= "</table>";
	
	return $output;
}
?>