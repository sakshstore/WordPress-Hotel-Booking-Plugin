<?php


	function get_saksh_hotel_booking_product() {
	    
	    
 return  saksh_create_product_if_not_exist();
		
		
  
	}
 

//add_action('init', 'saksh_create_product_if_not_exist', 0);


  function saksh_create_product_if_not_exist() {


		if ( get_option( '_saksh_booking_product_v3' )   ) {
		 
		
$product_id=  get_option( '_saksh_booking_product_v3' )  ;
$product = wc_get_product( $product_id );

$status=$product->get_status();


if($status=="public")
return $product_id;
else

return	saksh_create_product();

}

else

return	saksh_create_product();


 
		
	  
	}

  function saksh_create_product() {
		$product_args = array(
			'post_title'   => wc_clean( 'Room Booking' ),
			'post_status'  => 'public',
			'post_type'    => 'product',
			'post_excerpt' => '',
		//	'post_content' => stripslashes( html_entity_decode( 'Auto generated product for room booking please do not delete or update.', ENT_QUOTES, 'UTF-8' ) ),
			'post_author'  => get_current_user_id(),
		);
		$product_id   = wp_insert_post( $product_args );
		if ( ! is_wp_error( $product_id ) ) {
			$product = wc_get_product( $product_id );
			wp_set_object_terms( $product_id, 'simple', 'product_type' );
			update_post_meta( $product_id, '_stock_status', 'instock' );
			update_post_meta( $product_id, 'total_sales', '0' );
			update_post_meta( $product_id, '_downloadable', 'no' );
			update_post_meta( $product_id, '_virtual', 'yes' );
			update_post_meta( $product_id, '_regular_price', '10' );
			update_post_meta( $product_id, '_sale_price', '10' );
			update_post_meta( $product_id, '_purchase_note', '' );
			update_post_meta( $product_id, '_featured', 'no' );
			update_post_meta( $product_id, '_weight', '' );
			update_post_meta( $product_id, '_length', '' );
			update_post_meta( $product_id, '_width', '' );
			update_post_meta( $product_id, '_height', '' );
			update_post_meta( $product_id, '_sku', '' );
			update_post_meta( $product_id, '_product_attributes', array() );
			update_post_meta( $product_id, '_sale_price_dates_from', '' );
			update_post_meta( $product_id, '_sale_price_dates_to', '' );
		 	update_post_meta( $product_id, '_price', '10' );
			update_post_meta( $product_id, '_sold_individually', 'yes' );
			update_post_meta( $product_id, '_manage_stock', 'no' );
			update_post_meta( $product_id, '_backorders', 'no' );
			update_post_meta( $product_id, '_stock', '' );
			if ( version_compare( WC_VERSION, '3.0', '>=' ) ) {
				$product->set_reviews_allowed( false );
	 	$product->set_catalog_visibility( 'hidden' );
				$product->save();
			}

			update_option( '_saksh_booking_product_v3', $product_id );
		}
		
		return $product_id;
		
		
	}






add_action('init', 'saksh_check_wc', 0);
   function saksh_check_wc() {
       
       $r=array(print_r($_REQUEST,true));
       
          do_action('saksh_hotel_booking',$r);
          
          
          
          
          
      $active_plugins= (array) get_option( 'active_plugins', array() );
      
      
      if(!in_array( "woocommerce/woocommerce.php",   $active_plugins))    
       {
           add_action( 'admin_notices',  'saksh_admin_notices'  );
       }
      
      
       
	}
	
	  function saksh_admin_notices() {
		?>
		<div class="error">
			<p>
				<?php echo esc_html_e( 'Saksh Hotel booking plugin requires', 'saksh_booking' ); ?> 
				<a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a> <?php echo esc_html_e( 'plugins to be active!', 'saksh_booking' ); ?>
			</p>
		</div>
		<?php
	}
	
function saksh_display_engraving_text_cart( $item_data, $cart_item ) {
  
	
		$item_data[] = array(
		'key'     => __( 'Date start', 'aistore' ),
		'value'   => wc_clean( $cart_item['date_start'] ),
		'display' => '',
	);
	
		$item_data[] = array(
		'key'     => __( 'Date end', 'aistore' ),
		'value'   => wc_clean( $cart_item['date_end'] ),
		'display' => '',
	);
	
	
		$item_data[] = array(
		'key'     => __( 'Adult', 'aistore' ),
		'value'   => wc_clean( $cart_item['adult'] ),
		'display' => '',
	);
	
		$item_data[] = array(
		'key'     => __( 'Kid', 'aistore' ),
		'value'   => wc_clean( $cart_item['kid'] ),
		'display' => '',
	);
		$item_data[] = array(
		'key'     => __( 'No of rooms', 'aistore' ),
		'value'   => wc_clean( $cart_item['no_rooms'] ),
		'display' => '',
	);
	 
	
	return $item_data;
	
	 
}

 add_filter( 'woocommerce_get_item_data', 'saksh_display_engraving_text_cart', 10, 2 );



function saksh_add_text_to_order_items( $item, $cart_item_key, $values, $order ) {
   
  
	if ( empty( $values['date_start'] ) ) {
		return;
	}
	
	if ( empty( $values['date_end'] ) ) {
		return;
	}
	
	if ( empty( $values['adult'] ) ) {
		return;
	}
	
	if ( empty( $values['kid'] ) ) {
		return;
	}
		
	if ( empty( $values['no_rooms'] ) ) {
		return;
	}
	
		if ( empty( $values['purchase_plan_id'] ) ) {
		return;
	}
 
	
 
 
$item->add_meta_data( __( 'date_start', 'saksh' ), $values['date_start'] );
	
	$item->add_meta_data( __( 'date_end', 'saksh' ), $values['date_end'] );
$item->add_meta_data( __( 'adult', 'saksh' ), $values['adult'] );
 
$item->add_meta_data( __( 'kid', 'saksh' ), $values['kid'] ); 
 
$item->add_meta_data( __( 'no_rooms', 'saksh' ), $values['no_rooms'] ); 
 

$item->add_meta_data( __( 'room_id', 'saksh' ), $values['room_id'] ); 
 

$item->add_meta_data( __( 'purchase_plan_id', 'saksh' ), $values['purchase_plan_id'] ); 
 


saksh_capture_log(__LINE__,  $values);

   
 
}

add_action( 'woocommerce_checkout_create_order_line_item', 'saksh_add_text_to_order_items', 10, 4 );

 

 add_filter('woocommerce_thankyou_order_received_text', 'saksh_woo_change_order_received_text', 10, 2 );
 
 
 
function saksh_woo_change_order_received_text( $str, $order ) {
	


	$saksh_event_time="";
	
 foreach ( $order->get_items() as $key => $item ) {
	 
 
         
		

				
				
   $kid = wc_get_order_item_meta( $key, 'kid' );
   
				
   $adult = wc_get_order_item_meta( $key, 'adult' );
   
   
   $date_start = wc_get_order_item_meta( $key, 'date_start' );
   
   $date_end = wc_get_order_item_meta( $key, 'date_end' );
   
   $no_rooms = wc_get_order_item_meta( $key, 'no_rooms' );
   
      
    
    
 
   
}  


    $str =  " Date ".$date_start ." to ". $date_end. ' Adult  '.$adult . " Kid " .$kid    ;
    return $str;
}



 
 add_action( 'woocommerce_order_status_pending', 'saksh_hb_order_status_update_pending', 10, 1);
 add_action( 'woocommerce_order_status_failed', 'saksh_hb_order_status_update_failed', 10, 1);
 add_action( 'woocommerce_order_status_on-hold', 'saksh_hb_order_status_update_on_hold', 10, 1);
// Note that it's woocommerce_order_status_on-hold, and NOT on_hold.
 add_action( 'woocommerce_order_status_processing', 'saksh_hb_order_status_update_processing', 10, 1);
 add_action( 'woocommerce_order_status_completed', 'saksh_hb_order_status_update_completed', 10, 1);
 add_action( 'woocommerce_order_status_refunded', 'saksh_hb_order_status_update_refunded', 10, 1);
 add_action( 'woocommerce_order_status_cancelled', 'saksh_hb_order_status_update_cancelled', 10, 1);	
  
 
 

 
 function saksh_hb_order_status_update_pending($order_id){
      saksh_hb_order_status_update($order_id,"Pending");
 }
 function saksh_hb_order_status_update_failed($order_id){
      saksh_hb_order_status_update($order_id,"Failed");
 }
 function saksh_hb_order_status_update_on_hold($order_id){
      saksh_hb_order_status_update($order_id,"On-hold");
 }
 function saksh_hb_order_status_update_processing($order_id){
      saksh_hb_order_status_update($order_id,"Processing");
 }
 function saksh_hb_order_status_update_completed($order_id){
      saksh_hb_order_status_update($order_id,"Completed");
 }
 function saksh_hb_order_status_update_refunded($order_id){
      saksh_hb_order_status_update($order_id,"Refunded");
 }

 function saksh_hb_order_status_update_cancelled($order_id){
      saksh_hb_order_status_update($order_id,"Cancelled");
 } 
 
     
 
 function saksh_hb_order_status_update($order_id,$status){




    $user = wp_get_current_user();
    
    $user_id = $user->ID;
    
    
     $user_info = get_userdata( $user_id  );
     
      
      $first_name = $user_info->first_name;
      $last_name = $user_info->last_name;
      
        
     
   
   
    $data  = array('order_id' => $order_id ,'user_id' => $user_id , 'first_name' => $first_name  ,'last_name' => $last_name , 'email' => $user_info->user_email  );
    
    
    
	   global $wpdb;
 
 
    $order = wc_get_order( $order_id );
	
		$order_data = $order->get_data();
	 $data['total_charge']   =$order_data['total'] ;
     
     
     
     
 foreach ( $order->get_items() as $key => $item ) {
    
$product_id = $item->get_product_id();
 
        
        
         
				
   $kid = wc_get_order_item_meta( $key, 'kid' );
   
				
   $adult = wc_get_order_item_meta( $key, 'adult' );
   
   
   $date_start = wc_get_order_item_meta( $key, 'date_start' );
   
   $date_end = wc_get_order_item_meta( $key, 'date_end' );
   


   
 $no_rooms = wc_get_order_item_meta( $key, 'no_rooms' );
 $purchase_plan_id = wc_get_order_item_meta( $key, 'purchase_plan_id' );
   
    
     $room_id = wc_get_order_item_meta( $key, 'room_id' );
          $purchase_plan_id = wc_get_order_item_meta( $key, 'purchase_plan_id' );
   
    
    $table_name = $wpdb->prefix . 'bookings';
    
  
  




 

 $data['no_rooms']= $no_rooms;
 
 $data['room_id']= $room_id;
 $data['date_start']= $date_start;
 $data['date_end']= $date_end;
 $data['adult']= $adult;
 $data['kid']= $kid;
   $data['purchase_plan_id']= $purchase_plan_id;
  
    
    
 $data['phone']   =$order_data['billing']['phone'];
     
     
 
saksh_capture_log(__LINE__,  $data);

    

     
    
     $checkIfExists = $wpdb->get_var($wpdb->prepare(  "SELECT  order_id FROM   $wpdb->prefix . 'bookings'  WHERE order_id = %d",$order_id ) );

    if ($checkIfExists == NULL) {

      saksh_capture_data($data);
        
    }
    
    
    
    
  

$wpdb->query( $wpdb->prepare( "UPDATE   $wpdb->prefix . 'bookings'   SET `status` = %s  WHERE  order_id  = %d", $status,  $order_id   ) );


 
   do_action('saksh_hb_status_update',$data);

        
       
		
 	}
	
 
}  

 
 function saksh_capture_data($query_data)
  {
  
   
    
      
      global $wpdb;
      
    
     
     
 
  
 
 $query_data['booking_date']=gmdate('Y-m-d', $startdate) ;

       
 $table_name= $wpdb->prefix ."bookings";
 
       $startdate = strtotime($query_data['date_start']);
$enddate = strtotime($query_data['date_end']);

while ($startdate <= $enddate) {
  
  
  
  
  
 $query_data['booking_date']=gmdate('Y-m-d', $startdate) ;



saksh_capture_log(__LINE__,  $query_data);



 

  $wpdb->insert( $table_name, $query_data );
 



  $startdate = strtotime("+1 day", $startdate); 
  
}
      
  }
 
 
 



 add_action( 'woocommerce_before_calculate_totals', 'saksh_add_custom_price', 1000, 1);
function saksh_add_custom_price( $cart ) {
    
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

   
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

 

    foreach ( $cart->get_cart() as $cart_item ) {
        
      if(isset($cart_item['total_charge']))
        $cart_item['data']->set_price(  $cart_item['total_charge']  );
 }
}



