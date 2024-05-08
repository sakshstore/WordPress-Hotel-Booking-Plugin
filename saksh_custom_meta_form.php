<?php


function get_saksh_payment_option_value($saksh_payment_option,$tab,$field_name){
 
 if(isset( $saksh_payment_option[$tab][$field_name]))
      return  $saksh_payment_option[$tab][$field_name]  ;
    else 
    return  "";
     
    
    
}


function saksh_print_form($post_id,$fields,$saksh_payment_option,$tab){
     
     
    foreach($fields as $f)
    {
        
        
      
    if($f['type']=="text"){
        
        
       
        
        
        $field_name =$f['name'] ;
        
        
        $field_class = $f['class'] ;
        
        
    $value  =  get_saksh_payment_option_value($saksh_payment_option,$tab,$field_name); 
      
      
      
         ?>
         
         
          <label for="<?php echo $f['id']; ?>"><?php echo $f['title']; ?></label><br>
  
  
  
  <input  class="input"
  type="text"
   rows="10"
   style="width:100%"
  class="<?php  echo  $field_class; ?>" 
  name="saksh_payment_option[<?php  echo  $tab; ?>][<?php  echo  $field_name; ?>] "
   value="<?php echo  $value; ?>"
   > </input >
       
       
         <?php
    }
       
    if($f['type']=="checkbox"){
        
          echo $f['title'] ;
          
          
        
        foreach( $f['value'] as $v)
        {
        $name = $v['name'];
       
        if(isset($v['value']))
        {
             $value = $v['value'];
        }
        else
        {
          $value = $v['default'];
        }
        
     
        ?>
        
 
  <input  class="input"
  type="checkbox"
    
  class="<?php  echo  $field_class; ?>" 
  name="saksh_payment_option[<?php  echo  $tab; ?>][<?php  echo  $name; ?>][] "
   value="<?php echo  $value; ?>"
   > </input >
 
   <?php
   
     echo  $value; 
   
   
   

}
        
    }
    
    
    if($f['type']=="textarea"){
        
        
       
        
        
        $field_name =$f['name'] ;
        
        
        $field_class = $f['class'] ;
        
        
    $value  =  get_saksh_payment_option_value($saksh_payment_option,$tab,$field_name); 
      
      
      
         ?>
         
         
          <label for="<?php echo $f['id']; ?>"><?php echo $f['title']; ?></label><br>
  
 
 
  <textarea  
  type="text"
   rows="10" 
   id="editor<?php  echo  $tab; ?>" 
     style="width:100%"
  class="editor   <?php  echo  $field_class; ?>" 
  name="saksh_payment_option[<?php  echo  $tab; ?>][<?php  echo  $field_name; ?>] "
   
   ><?php echo  $value; ?>    </textarea >
       
       
         <?php
    } echo '<hr />';
    }
    
   
}


function saksh_payment_option_form_fields($fields) {
         
         
         
         
         
          
         
         
         
     $object= array(
    'id' => 'total_rooms_',
     'class' => 'total_rooms_',
      'name' => 'total_rooms_',
      'name_token' => '{total_rooms}',
    'type' => 'text',
    'title' => 'total_rooms_',
    'desc' => 'total_rooms',
    
      'layout' => 'Column_1',
      
    'value' => "" 
    ) ;
     
     
     
    
    $fields[]=$object; 
    
    
    
  $object= array(
    'id' => 'plan_name',
     'class' => 'plan_name',
      'name' => 'plan_name',
      'name_token' => '{plan_name}',
    'type' => 'text',
    'title' => 'Plan name',
    'desc' => 'Plan name',
    
      'layout' => 'Column_1',
      
    'value' => "" 
    ) ;
     
    
  
    
  
    $fields[]=$object; 
    
    
  $object= array(
    'id' => 'rate_per_night',
      'class' => 'rate_per_night',
        'name' => 'rate_per_night',
          'name_token' => '{rate_per_night}',
    'type' => 'text',
    'title' =>  'Rate per night' ,
    'desc' =>'rate_per_night' ,
    
    'func' =>'wc_price' ,
    
      'layout' => 'Column_5',
    'value' => "" 
    ) ;
     
    
    $fields[]=$object;
  
    
    
    
    
         
      $object= array(
    'id' => 'saksh_booking_button',
      'class' => 'saksh_booking_button', 
      
    
          'name_token' => '{saksh_booking_button}',
       'layout' => 'Column_4',
      'name' => 'saksh_booking_button',
        'title'=> "Booking Button",
    'type' => 'checkbox',
     
     'value' => "" 
    ) ;
     
       $fields[]=$object;
       
       
       
  $object= array(
    'id' => 'saksh_booking_options',
       'class' => 'saksh_booking_options',
         'name' => 'saksh_booking_options',
         
          'name_token' => '{saksh_booking_options}',
    'type' => 'textarea',
    'title' =>'Booking details' ,
    'desc' =>'saksh_booking_options'  ,
    
      'layout' => 'Column_3',
    'value' => "" 
    ) ;
     
    
    $fields[]=$object;
    
    
    
    
    
      $object= array(
    'id' => 'sleeps',
     'class' => 'sleeps',
     
          'name_token' => '{sleeps}',
      'name' => 'sleeps',
    'type' => 'text',
    'title' => 'Total capacity [ 1/2 adults ]',
    
      'layout' => 'Column_4',
    'desc' =>  'sleeps'  ,
    'value' => "" 
    ) ;
     
      
      
    $fields[]=$object; 
    
    
    
      $object= array(
    'id' => 'saksh_payment_conditions',
       'class' => 'saksh_payment_conditions',
       'name' => 'saksh_payment_conditions',
    'type' => 'text',
    
    
          'name_token' => '{saksh_payment_conditions}',
          
          
    
      'layout' => 'Column_4',
    'title' => 'Payment Conditions',
    'desc' =>  'saksh_payment_conditions'  ,
    'value' => "" 
    ) ;
     
    $fields[]=$object;
    
    
    $checkbox=array();
    
    $checkbox[]=array(
        "name"=> "include",
        "value" => "Breakfast"
      );
        
        
        
    $checkbox[]=array(
        "name"=> "include",
        "value" => "Lunch" 
        );
        
        
    $checkbox[]=array(
        "name"=> "include",
        "value" => "Dinner" 
        );
        
        
    
      $object= array(
    'id' => 'saksh_included',
      'class' => 'saksh_included', 
      
    
          'name_token' => '{saksh_included}',
      'layout' => 'Column_2',
      'name' => 'saksh_included',
        'title'=> "What is included",
    'type' => 'checkbox',
     
    'value' => $checkbox
    ) ;
     
       $fields[]=$object;
       
       
       
       
       
       
       
   
       
       
       
    return $fields;
}
add_filter( 'saksh_room_payment_options_metabox', 'saksh_payment_option_form_fields' );