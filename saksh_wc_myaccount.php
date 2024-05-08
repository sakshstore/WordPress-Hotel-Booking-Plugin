<?php


add_action( 'init', 'saksh_my_booking_tabs');

 
function saksh_my_booking_tabs() {
	add_rewrite_endpoint( 'bookings', EP_ROOT | EP_PAGES );
}


add_filter( 'query_vars', 'saksh_query_vars' );

 
function saksh_query_vars( $vars ) {

	$vars[] = 'bookings';
	return $vars;
}


add_filter( 'woocommerce_account_menu_items', 'saksh_booking_tab' );

 
function saksh_booking_tab( $items ) {

	$items['bookings'] = 'Bookings';
	return $items;
}

add_action( 'woocommerce_account_bookings_endpoint', 'saksh_bookings_content' );

 
function saksh_bookings_content() {
 
	
	
	
	 	global $wpdb;
 
		
		 
	

		$results = $wpdb->get_results( 	$wpdb->prepare(
	"SELECT * FROM {$wpdb->prefix}bookings  WHERE `user_id` =%d",  
get_current_user_id()
) );
		?>
		<div class="   saksh_booking">
 
		    
		    
		  <h1 class="wp-heading-inline">
		      
		      
		     
New bookings</h1>  

 	
		<?php
		
	 echo "<table class=' table wp-list-table widefat    '>";
	 
	  
	  
	  
      echo "<tr>";
      
       echo "<td> Booking ID </td>";
       
   
       
       echo "<td> Date start </td>";
       
       echo "<td> Date end </td>";
       
       echo "<td> Adult </td>";
       
       echo "<td>Kid </td>";
       
       
        echo "<td>No rooms </td>";
         
       
        echo "<td> Total Charge</td>";
        
          
          
       
       echo "<td>Created at </td>";
       
       
       
       echo "<td>Status </td>";
       
       echo "</tr>";
	 
	 
  foreach( $results as $res)
  {
       
      echo "<tr>";
      
       echo "<td>";
      echo  esc_attr( $res->order_id );
       echo "</td>";
      
       
       echo "<td>";
      echo  esc_attr($res->date_start );
       echo "</td>";
       
       echo "<td>";
      echo  esc_attr($res->date_end );
       echo "</td>";
       
       
      
       echo "<td>";
      echo   esc_attr($res->adult );
       echo "</td>";
       
       echo "<td>";
      echo   esc_attr($res->kid );
       echo "</td>";
       
       
        echo "<td>";
      echo  esc_attr($res->no_rooms );
       echo "</td>";
       
  
             
     
       echo "<td>";
      echo wc_price( esc_attr($res->total_charge ));
       echo "</td>";
       

     
    
       echo "<td>";
      echo  esc_attr($res->booking_date );
       echo "</td>";
       
       
       
       echo "<td>";
      echo  esc_attr($res->status );
       echo "</td>";
       
       
       
       
        
      echo "</tr>";
  }
   
 
	 echo "</table>";
 
	 echo "</div>";


 
	
	
}