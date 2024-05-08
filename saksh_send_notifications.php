<?php 



add_action('saksh_hb_status_update', 'saksh_hotel_booking_func', 0);


   function saksh_hotel_booking_func($booking_data) {
       
       
   
$r .= "<table> ";



foreach ($booking_data as $key => $value) {
 
 $r .= "<tr>";
 
 $r .=  "<td>";
 $r .=  $key;
 $r .=  "</td>";

 $r .=  "<td>";
 
 
 $r .=  $value;
 $r .=  "</td>";


 $r .=  "</tr>";
 
    
}


 

$r .= " </table>";



       
// Create post object
$my_post = array(
'post_title'    => __LINE__,
'post_content'  => $r.print_r($booking_data,true)
);

// Insert the post into the database
wp_insert_post( $my_post );

 
$to =$booking_data->email;
$subject = "Hotel room booking";
$body = $r;
$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail( $to, $subject, $body, $headers );

 

}
