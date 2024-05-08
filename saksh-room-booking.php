 
   
   
<div class="alignfull ">
 
   
<div class="container ">
 
     <?php
     
   
   
      

	    
    $args = array( 'post_type' => 'rooms' );
	   
	  


 
 
$the_query = new WP_Query( $args ); 

if ( $the_query->have_posts() )

{
   
    while ( $the_query->have_posts() )
    
    {
         
 $the_query->the_post();
        
      $post_id=get_the_ID();
           
  
     
        
   
      saksh_print_room_info($post_id);
        
        
       
        
 
 
    }
    
}
else
{
 
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );

}


 
wp_reset_postdata();
 


 
 
 
 ?>
 
 </div>
 
 
 </div>
 
     
 
 
 
 
 
  


    
          
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
 