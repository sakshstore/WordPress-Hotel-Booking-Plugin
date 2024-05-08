<?php

 

  
  function get_amenities($post_id)
  {
  
  

 $amenities_list = get_the_terms( $post_id, 'amenities');
 
 if($amenities_list )
 
 {
     
 
$types ='';
foreach($amenities_list as $term_single) {
    
    if(isset($term_single->slug) )
     $types .=tag_escape( ucfirst($term_single->slug)).', ';
     
     
}
$typesz = rtrim($types, ', ');

return $typesz;
 

}

return "";

}


function saksh_print_room_info_dynamic($post_id,$query_data=array())

 {
  
  
  

$saksh_wp_options=get_option("saksh_wp_options");



  $saksh_theme=array();
    
   
 
            
            
   
    $featured_img_url = get_the_post_thumbnail_url($post_id, 'thumbnail'); 
  
    if(!$featured_img_url)
    $featured_img_url="https://placehold.co/600x400";
    
    
    $saksh_theme["{thumbnail}"] ="<div class='saksh_room_thumbnail'> <img src='". $featured_img_url."' class='img-thumbnail'  /> </div>";
    
    
     $saksh_theme["{title}"]   ="  <div class='saksh_room_title_'>". get_the_title($post_id) ."</div>";
        
      
     
     $saksh_theme["{amenities}"]   = get_amenities($post_id); 
      
          
               
     
 
  
  
  ?>
  
  
  
  
  
        <div class="    ">
  
        <div class="row  mb-5  ">
            
            
        
        <div class="col-md-3  border">
            
        
             
 
        <?php $pageid=  $saksh_wp_options['saksh_room_info_theme'] ; 
            
            
            
            
            $content_post = get_post($pageid);
            
            
                $content = $content_post->post_content;
              
                
                echo strtr($content  , $saksh_theme);
                
                
                ?>
 
            </div>
        <div class="col-md-9   border">
          
      <?php     
             for($id=1;$id <= 5; $id++)
          { 
 $purchase_plan_id=$id;
 
 
   saksh_print_room_purchase_info_dynamic($post_id,$purchase_plan_id,$saksh_wp_options,$query_data) ;
   
   
   
          }
    
    
    ?>
            </div>
            
            </div>
  
            </div>
  
  <?php
  
  
}


function saksh_print_room_purchase_info_dynamic($post_id,$purchase_plan_id,$saksh_wp_options,$query_data)

 {
  
  
  
 
        
        
  $saksh_theme=array();
 
      
          $id=$purchase_plan_id;
               
     
 
 
   $booking_data=$query_data;
   
    
      $saksh_payment_option=  get_post_meta( $post_id, 'saksh_payment_option' , true ) ;
      
       
 
        $value=  get_saksh_payment_option_value($saksh_payment_option,$purchase_plan_id, "plan_name");
        
        if($value=="")
        
        return "";
        
 
   $fields=array( );
    
    $fields = apply_filters( 'saksh_room_payment_options_metabox', $fields );
   
    foreach($fields as $f) 
    {
        
        $field_name = $f['name'] ; 
        
        $field_class= $f['name'];
        
        $query=$f['name_token'] ;
        
       
        
        
        
        $value=  get_saksh_payment_option_value($saksh_payment_option,$purchase_plan_id,$field_name);
        
        if(isset($f['func']))
        $value=$f['func']($value);
        
      $saksh_theme[$query]   =  "<div class='".$field_class."'>  " .$value."  </div>";
  
    
 }
 
 
   $saksh_theme["{saksh_booking_button}"]  =  saksh_booking_form($post_id,$booking_data,$purchase_plan_id);
 
 
  
  ?>
  
  
  
  
  
  
        <div class="sakhs_row   ">
            
             
            
            <?php $pageid=  $saksh_wp_options['saksh_room_info_pricing'] ; 
            
            
            
            
            $content_post = get_post($pageid);
            
            
                $content = $content_post->post_content;
            
                
                echo strtr($content  , $saksh_theme);
                
                
                ?>
                
                
                
       
       
            
         
            
            
            
            
            </div>
  
  <?php
  
  
}

 



function saksh_print_room_info_original($post_id,$query_data=array())

{
    /*
   global $typography_ar;
  // var_dump($typography_ar);
   
       
        ?>
        
        <div class="row  mb-5  ">
            
            
        
        <div class="col-md-2 pt-3 border">
            
            
           <?php 
            
            echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'alignleft  img-thumbnail' ) );
             
 
                
            
            $title=get_the_title($post_id);
             
 $amenities=   get_amenities($post_id);

 
 
   ?>
   
   
   
   <div class="saksh_room_type ">  <?php echo esc_attr($title);  ?> </div>
   
   
   <div class="callapse-ammenities">
       
       <p class="d-inline-flex gap-1">
  <a  data-bs-toggle="collapse" href="#collapseExample"   aria-expanded="false" aria-controls="collapseExample">
       _e('Amenities', 'saksh');
  </a>
  
</p>
<div class="collapse saksh_room_amenities"    id="collapseExample">
  
    <?php  echo esc_attr($amenities); ?>
  
</div>


   </div>
            </div>
            
            
               
        <div class="col-md-10  border">    
          
            
       
          <?php
          
               
       for($id=1;$id <= 5; $id++)
          {
              
  $purchase_plan_id=$id;
 
     
 $plan_name  = get_post_meta( $post_id, 'plan_name_'.$id, true );
  
  $rate_per_night  = get_post_meta( $post_id, 'rate_per_night_'.$id, true );

  
  $saksh_booking_options  = get_post_meta($post_id, 'saksh_booking_options_'.$id, true );
  
  if($rate_per_night <> 0)
  
  {
    ?> <div class="row border">    
        <div class="col-md-9 border p-3">    
 
 
   <div class="saksh_room_title  ">
  
 <?php 
 
 echo esc_attr($plan_name); 
 
 ?>
 </div>
 
 
 <div class="saksh_room_description">
     
     

 <?php
     
 
    
      
 echo esc_attr( $saksh_booking_options);
 
 
 ?>
  
  </div>
  
  
  </div>
  
   <div class="col-md-3 border p-3">    
   
    
   
 
  
   <?php echo wc_price(esc_attr($rate_per_night)); ?>
   
   <?php
   
   
   if(isset($query_data['date_start']))
   {
  // print_r($query_data);
   
   $query_data['room_id']=$post_id;
   
    $available =saksh_check_availability($query_data,$purchase_plan_id);
 
  
 
 
 if($available=="true")
   saksh_booking_form($post_id,$query_data,$purchase_plan_id);
   
 else
  _e('Already Booked', 'saksh');
       
   }
   
   // print booking form 
  // 
    
    
   ?>
   
   
   </div>
     </div>
   
  <?php
  }
 
}

?>

 </div>
     </div>
     
     <?php
     
     */
}



function saksh_booking_form($post_id,$booking_data,$purchase_plan_id)
{
    
  
 ob_start();
 
 
    ?>
    <div class="booking_button" >
                            
     <form action="" method="post">
          
  
   
  <input type="hidden"   value="book_now" name="saksh_case" /> 
  
    
  
   
  <input type="hidden"  value="<?php echo  esc_attr($post_id);?>" name="room_id" /> 
     
   
  <input type="hidden"  value="<?php echo  esc_attr($purchase_plan_id);?>" name="purchase_plan_id" /> 
  
  
  
  <input type="hidden"  value="<?php echo  esc_attr($purchase_plan_id);?>" name="purchase_plan_id" /> 
     
 <?php
  
 
 if(is_array($booking_data))
 {
 foreach ($booking_data as $key => $value) {
 
    echo '<input type="hidden"   value="'.esc_attr($value).'" name="'.esc_attr($key).'" />';
}

}
 
 

?> 
          
    <?php wp_nonce_field( 'saksh_nonce_action', 'saksh_nonce' ); ?>
 
 
   
 <input type="submit" value="Book now"  class="saksh_booking_button" />
     </form>
    </div>
    <?php
  
    
   $content = ob_get_clean();
   // 
    return  $content;
 
     
}


 

function getrate_per_night($room_id,$purchase_plan_id){
    
    
    
    
  $rate_per_night  = get_post_meta( $room_id, 'rate_per_night_'.$purchase_plan_id, true );
  
  
  return $rate_per_night;
  
  
  
  
  
}