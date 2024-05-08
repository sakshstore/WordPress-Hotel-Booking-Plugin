<?php
 

function saksh_add_room_type_taxonomies() {
 
 
  register_taxonomy('room_type', 'rooms', array(
   
   
    'hierarchical' => true,
   
   
    'labels' => array(
      'name' => _x( 'Room type', 'taxonomy general name' ),
      'singular_name' => _x( 'Room type', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Room type' ),
      'all_items' => __( 'All Room type' ),
     
      'edit_item' => __( 'Edit Room type' ),
      'update_item' => __( 'Update Room type' ),
      'add_new_item' => __( 'Add New Room type' ),
      'new_item_name' => __( 'New Room type Name' ),
      'menu_name' => __( 'Room type' ),
    ),
    
    
    'rewrite' => array(
      'slug' => 'room_type',
      
      'with_front' => false,
      
      'hierarchical' => false 
      
    ),
  ));
}
add_action( 'init', 'saksh_add_room_type_taxonomies', 0 );




function saksh_add_amenity_taxonomies() {
 
 
  register_taxonomy('amenities', 'rooms', array(
   
   
    'hierarchical' => true,
   
   
    'labels' => array(
      'name' => _x( 'Amenities', 'taxonomy general name' ),
      'singular_name' => _x( 'Amenity', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Amenities' ),
      'all_items' => __( 'All Amenities' ),
      'parent_item' => __( 'Parent Amenity' ),
      'parent_item_colon' => __( 'Parent Amenity:' ),
      'edit_item' => __( 'Edit Amenity' ),
      'update_item' => __( 'Update Amenity' ),
      'add_new_item' => __( 'Add New Amenity' ),
      'new_item_name' => __( 'New Amenity Name' ),
      'menu_name' => __( 'Amenities' ),
    ),
    
    
    'rewrite' => array(
      'slug' => 'amenities',
      
      'with_front' => false,
      
      'hierarchical' => true 
      
    ),
  ));
}
add_action( 'init', 'saksh_add_amenity_taxonomies', 0 );








function saksh_save_meta_box_data($post_id)
{
   
 

    // Check if our nonce is set.
    if (!isset($_POST['saksh_nonce'])) {
        return;
    }
    
  

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['saksh_nonce'], 'saksh_nonce')) {
        return;
    }
 
 
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

 
 
   /*
      
    
    for($id=1;$id <= 5; $id++)
    {
         
   
            $fields=array( );
    
    $fields = apply_filters( 'saksh_room_payment_options_metabox', $fields );
   
    foreach($fields as $f) 
    
        
        $field_name = $f['id']."_".$id; 
        
    
 $value  = sanitize_text_field( $_POST[$field_name] );
    
    
    if ( ! $value ) {
      $value =  "";
    }
    $value=$field_name .$value;
  
    update_post_meta($post_id,$field_name , $value);
        
    }
    
    */
 
     
    $saksh_payment_option =  $_POST['saksh_payment_option']  ;
    
  
    update_post_meta($post_id, 'saksh_payment_option', $saksh_payment_option);
    
    $other_room_details = sanitize_text_field(  $_POST['other_room_details']);
    
  
    update_post_meta($post_id, 'other_room_details', $other_room_details);
    
    $room_short_intro = sanitize_text_field( $_POST['room_short_intro']);
    
  
    update_post_meta($post_id, 'room_short_intro', $room_short_intro);
    
     
    
    
}

add_action('save_post', 'saksh_save_meta_box_data');

add_action('update_post', 'saksh_save_meta_box_data');

 
function saksh_meta_box_callback_short_intro($post)
{
    $room_short_intro = html_entity_decode(
        get_post_meta($post->ID, 'room_short_intro', true)
    );

    $content = $room_short_intro;
    $editor_id = 'room_short_intro';

   global $settings;


    wp_editor($content, $editor_id );
}





function saksh_booking_option_form($post,$saksh_payment_option , $id)
{
    
 
      $post_id= $post->ID;
      
//  $plan_name  = get_post_meta( $post->ID, 'plan_name_'.$id, true );
  
 // $rate_per_night  = get_post_meta( $post->ID, 'rate_per_night_'.$id, true );

 
   
    
    $fields=array( );
    
   $fields = apply_filters( 'saksh_room_payment_options_metabox', $fields );
  // 
    
     echo "<hr />";
     
   //  print_r($value);
     
 saksh_print_form($post_id, $fields,$saksh_payment_option ,$id);
    echo "<hr />";
    
    
    
}




function saksh_meta_box_callback_rate_per_night($post)
{
   wp_nonce_field('saksh_nonce', 'saksh_nonce'); 
   
    
      
     $saksh_payment_option=  get_post_meta( $post->ID, 'saksh_payment_option' , true ) ;
 
 
  
 
   echo "<pre>";
  //   print_r( $saksh_payment_option);    
 
 
 $product_id= get_saksh_hotel_booking_product() ; 
  $product = wc_get_product( $product_id );
  
    // var_dump($product  );
     var_dump($product->get_price() );
echo "</pre>";
 ?>
    <hr />
      
    
    <div id="tabs">
  <ul>
    <li><a href="#tabs-1"><?php _e('Booking option 1', 'saksh'); ?>  </a></li>
    
    <li><a href="#tabs-2"><?php _e('Booking option 2', 'saksh'); ?>  </a></li>
     
    
    <li><a href="#tabs-3"><?php _e('Booking option 3', 'saksh'); ?>  </a></li>
    
    <li><a href="#tabs-4"><?php _e('Booking option 4', 'saksh'); ?>  </a></li>
    
    <li><a href="#tabs-5"><?php _e('Booking option 5', 'saksh'); ?>  </a></li>
    
  </ul>
 
  
  
    
  <div id="tabs-1">
    <?php   saksh_booking_option_form($post,$saksh_payment_option,"1"); ?>
    
    
  </div>
  
    
  <div id="tabs-2">
    <?php   saksh_booking_option_form($post,$saksh_payment_option,"2"); ?>
    
    
  </div>    
  <div id="tabs-3">
    <?php   saksh_booking_option_form($post,$saksh_payment_option,"3"); ?>
    
    
  </div>  <div id="tabs-4">
    <?php   saksh_booking_option_form($post,$saksh_payment_option,"4"); ?>
    
    
  </div> <div id="tabs-5">
    <?php   saksh_booking_option_form($post,$saksh_payment_option,"5"); ?>
    
    
  </div>
</div>
 
 
    
 
   
        
  
        
  <?php 
  
  echo "<pre>";
     print_r( $saksh_payment_option);    
 

echo "</pre>";
}
function saksh_meta_box_callback_other_details($post)
{
    $other_room_details = html_entity_decode(
        get_post_meta($post->ID, 'other_room_details', true)
    );

    $content = $other_room_details;
    $editor_id = 'other_room_details';

   global $settings;
	

    wp_editor($content, $editor_id );
}


function saksh_meta_box()
{
    
     

  add_meta_box(
            'short_intro',
            __('Short intro', 'saksh'),
            'saksh_meta_box_callback_short_intro',
            'rooms'
        );
        
        
            add_meta_box(
            'saksh_rate_per_night',
            __('Booking data', 'saksh'),
            'saksh_meta_box_callback_rate_per_night',
           'rooms'
        );

       

  add_meta_box(
            'other_details',
            __('Other details', 'saksh'),
            'saksh_meta_box_callback_other_details',
            'rooms'
        );
        
        
   
}

add_action('add_meta_boxes', 'saksh_meta_box');

