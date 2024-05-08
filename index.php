<?php

/*
Plugin Name: Saksh WP Hotel Booking Lite
Version:  1.0
Plugin URI: #
Author: susheelhbti
Author URI: http://www.sakshamapp.com/
Description: Saksh WP Hotel Booking Lite
Tags: hotel booking, booking engine, channel manager, hotel, reservations, vik, B&B, apartments, villa, hostel, CRS, IBE, reservation system
Requires at least: 4.7
Tested up to: 6.4
Stable tag: 1.0
Requires PHP: 5.4.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
/home1/ukbestde/public_html/bhagvadgita-ukbestdeal-com/wp-content/plugins/saksh-hotel-booking/.php
*/

define("SAKSHDIR",  __DIR__);



include "saksh_custom_meta_form.php";
include "saksh_send_notifications.php";


include "saksh_theme_functions.php";
include "saksh_design.php";

 include "saksh_enqueue.php";
 
 include "saksh_ajax.php";

 include "saksh_util.php";

 include "saksh_rooms_custom_post.php";
 include "saksh_wchook.php";
 include "saksh_meta_box.php";
  

 include "saksh_admin/saksh_booking_report.php";

 
include "saksh_admin/saksh_option_panel.php";
 

include "saksh_wc_myaccount.php";


add_action('wp_init', 'saksh_book_room'); 
add_action('wp_footer', 'saksh_book_room'); 
function saksh_book_room() { 
 
 
 
?>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> 
 
<script>
 
 
 
        
jQuery(function ($) {  

        
        
        
        
      $('input[name="booking_date"]').daterangepicker( );
      
      
   $('input[name="booking_date"]').on('apply.daterangepicker', function(ev, picker) {
 
  
  $('input[name="date_start"]').val(picker.startDate.format('YYYY-MM-DD'));
  $('input[name="date_end"]').val(picker.endDate.format('YYYY-MM-DD'));
   
  
  
});



 });

</script>
  
  
<?php


//var_dump($_POST);



   if (!empty($_REQUEST['saksh_case'])   )  
    
  {
      
       if ( ! isset( $_POST['saksh_nonce'] ) 
    || ! wp_verify_nonce( $_POST['saksh_nonce'], 'saksh_nonce_action' ) 
) {
   return  _e( 'Sorry, your nonce did not verify.', 'aistore' );

   exit;
}




   if (sanitize_text_field( $_REQUEST['saksh_case']) == "book_now" )    
   {
   
   
   
    
     $date_start = sanitize_text_field($_POST['date_start']);
     
     
   if(!isset($date_start))

{   return "";
}
 
 
 
    
     $room_id = sanitize_text_field($_POST['room_id']);
    
    
    
     $purchase_plan_id = sanitize_text_field($_POST['purchase_plan_id']);
    $date_end =sanitize_text_field($_POST['date_end']);  
    
    
    $adult  =sanitize_text_field($_POST['adult']);   
    $kid  =sanitize_text_field($_POST['kid']);   
  $no_rooms=sanitize_text_field($_POST['no_rooms']);  
 
 
 
    $saksh_payment_option=  get_post_meta(  $room_id, 'saksh_payment_option' , true ) ;  
 
  $rate_per_night  =    $saksh_payment_option[$purchase_plan_id]['rate_per_night'];
    
   
  
  
  $startdate = strtotime($date_start);
$enddate = strtotime($date_end);

$days =saksh_date_diff_in_days($date_start, $date_end);

 
 
  $total_charge= (float)  $no_rooms * (float)  $rate_per_night  *  (float) $days;
  
  
   
   
    
   
 //$product_id =137258 ;// get_saksh_hotel_booking_product() ; // product ID to add to cart
    
  $product_id =  get_saksh_hotel_booking_product() ; // product ID to add to cart
     $product = wc_get_product( $product_id );
  
    // var_dump($product  );
    // var_dump($product->get_price() );
     
       $cart_item_data = array( 'date_start' => $date_start ,
       "date_end"=>$date_end ,
       'adult'=>$adult,
       "kid"=>$kid ,
       "no_rooms"=>$no_rooms ,
       'room_id'=> $room_id , 
       "purchase_plan_id"=>$purchase_plan_id,
       "rate_per_night"=>$rate_per_night,
       'total_charge'=>$total_charge);
       
       
   
 
     
    
    
    
 
 $available=saksh_check_availability($cart_item_data,$purchase_plan_id);
 	WC()->cart->empty_cart();

 
 if($available=="true")
 {
     
 

	
 WC()->cart->add_to_cart( $product_id , 1, '', array(), $cart_item_data);
	 
		 
     $product = wc_get_product( $product_id );
  
      var_dump($product  );
     var_dump($product->get_price() );
 $cart_page = wc_get_cart_url();

  var_dump($cart_page);
 //	echo '<meta http-equiv="refresh" content="0; URL= '.esc_url($cart_page ).'" />';
	 
		
						
					 
  }}
  
  
}
}

 
function saksh_rate_per_night($saksh_payment_option ,$purchase_plan_id ){
    
  //  $saksh_payment_option=  get_post_meta(  $room_id, 'saksh_payment_option' , true ) ; // $purchase_plan_id
    
    if(isset($saksh_payment_option[$purchase_plan_id]['rate_per_night']  ))
    
    return $saksh_payment_option[$purchase_plan_id]['rate_per_night'];
    
    else 1;
    
}

function saksh_room_search_func(){
    
	ob_start();
	
	include "saksh_room_search_v2.php" ;
    
$content = ob_get_clean();
return $content;
    
}




add_shortcode( 'SakshRoomSearch', 'saksh_room_search_func' );







function saksh_room_booking_func(){
    
	ob_start();
	
	include "saksh-room-booking.php" ;
    
$content = ob_get_clean();
return $content;
    
}




add_shortcode( 'SakshRoomBooking', 'saksh_room_booking_func' );



function saksh_get_rooms_which_r_available( $query_data)
{
    
    
	 
$rooms =   get_posts(array(
    'post_type' => 'rooms',
    'post_status' => 'publish'
));


$room_data=array();

$room_id=array();
 
foreach($rooms as  $room)
{
    
$room_d=array();
  $row=array();
  
  $row=$query_data;
  
  
    
    $row['room_id']=$room->ID;
    
  //$row['room']=$room;
    
   
   for($i=1;$i<=5;$i++){
       
       $purchase_plan_id=$i;
   
 $available =saksh_check_availability($row,$purchase_plan_id);
 
 
 
 
  $ar=array();
            
     //       $ar['room_id']=$room->ID;
            
            $ar['purchase_plan_id']=$i;
            
            $ar['available']=$available;
             
            
            
            
            
   $room_d[]=$ar;
 
 
   
   
   }    
   
     $row['room_data']=$room_d;
    
    
    $room_data[]=$row; 
}


return $room_data;

 
}


function saksh_check_availability($query_data,$purchase_plan_id)
{
    
    // it will check availability based on the room id and purchase plan id 
    
    
     $available="true";
     
     $room_id=  $query_data['room_id'];
     
      
     
     
    
  // this has been changed as data captured in the form of json database
  $total_rooms  = 12;//get_post_meta( $room_id, 'total_rooms_'.$purchase_plan_id, true );
      
     
   $total_rooms=intval($total_rooms);
     
    
	 $required_room=intval($query_data['no_rooms']) ;
	 
    
    $startdate = strtotime($query_data['date_start']);
$enddate = strtotime($query_data['date_end']);

while ($startdate <= $enddate) {
 
  
  
 $total_booking=saksh_get_total_booking_for_a_given_date($startdate, $room_id,$purchase_plan_id);
  
  
  
  
    $remaining= $total_rooms - $total_booking ;
   
    
 if( $remaining  > $required_room )
 {
    $available="true";
   
   

}
else
{
    $available="false";
   
   
   return $available;
   
}
 


  $startdate = strtotime("+1 day", $startdate); 
  
}

return $available;



}







 
  
  function saksh_get_total_booking_for_a_given_date($booking_date,$room_id, $purchase_plan_id)
  {
      
    
 
       global $wpdb;
		
	 
 
   $res = $wpdb->get_row( $wpdb->prepare( "SELECT  count(*) total_booking FROM  {$wpdb->prefix}bookings  WHERE room_id= %d and purchase_plan_id=%d and    booking_date =date(%s)", $room_id ,$purchase_plan_id, $booking_date  ) );
     
     
     if($res)
     {
     $total_booking=$res->total_booking;
     
     
	return  intval($total_booking);
     }
     else
     
     return  0;
	
      
  }
  




 
 
 function saksh_capture_log($line_number ,  $query_data )
{
    
     
$my_post = array(
'post_title'    => $line_number,
'post_content'  =>  print_r($query_data,true),
'post_status'   => 'draft' 
);



wp_insert_post( $my_post );


}


