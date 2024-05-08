<?php


add_action("wp_ajax_saksh_booking_history", "saksh_get_booking_history"); 


function saksh_get_booking_history() {
    
    
 global $wpdb;
 
 //$table_name= $wpdb->prefix ."bookings";
 
 
 
  
		
 
    $results= $wpdb->get_results( "SELECT booking_date as start ,booking_date as end  , count(*) as title  FROM  {$wpdb->prefix}bookings GROUP by booking_date  ");




echo wp_json_encode($results); 

 
        wp_die();

}