<?php



get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	

 
 
?>





<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php  echo get_the_post_thumbnail(); ?>
	</header>

	<div class="entry-content">
		 
 
 	<?php
 	
 	
 	the_content( ); 
 	
 	$post_id= get_the_ID();
 	
  
 	 

 
     $other_room_details  = get_post_meta( $post_id, 'other_room_details', true );
       $room_short_intro = get_post_meta( $post_id, 'room_short_intro', true );
     
     
 
 	
 	
 	
 	?>
 	 <h2>Room short intro</h2>
 <?php
 


 echo esc_html_e($room_short_intro , "saksh"); 
 
 
   ?>
 <h2>Amenities</h2>
 <?php
 
  
 
 $amenities_list = get_the_terms( $post_id, 'amenities');
 
 
$types ='';
foreach($amenities_list as $term_single) {
     $types .= ucfirst($term_single->slug).', ';
}
$typesz = rtrim($types, ', ');
 

 echo esc_attr($typesz ); 

   ?>
 <h2> Other details</h2>
 <?php
 



 echo esc_html_e($other_room_details , "saksh"); 
 
   ?>
 
      	
 
     
 
 
 
 
 
 
 

</div>
</article>






<?php
	
	
  
  
endwhile; // End of the loop.

get_footer();
