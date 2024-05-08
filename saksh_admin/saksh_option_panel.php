<?php
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = 'saksh_wp_options';

  Redux::disable_demo();


    $args = array(
        'display_name'         =>  "Saksh WP lite Hotel Booking",
        'display_version'      => "1.0.0",
        'menu_title'           => esc_html__( 'Saksh WP lite Hotel Booking', 'your-textdomain-here' ),
        'customizer'           => false,
        
        	'page_priority'             => 90,
        	
        	
    );

    Redux::set_args( $opt_name, $args );

    
  

    Redux::set_section( 
        $opt_name, 
        array(
            'title'  => esc_html__( 'Display Layout', 'your-textdomain-here' ),
            'id'     => 'saksh_display_layout',
            'desc'   => esc_html__( 'Basic field with no subsections.', 'your-textdomain-here' ),
            'icon'   => 'el el-home',
         
        ) 
    );
    
    $posts=array();
      $posts_array = get_posts(array("post_type"=> "sakshdesigns")); 
      foreach($posts_array as $p)
      
      {
        $posts[$p->ID]=    $p->post_title;
     
          
      }
   
 
     
     
      Redux::set_field( $opt_name, 'saksh_display_layout', array(
    'id' => 'saksh_room_info_theme',
   
    'title' => __( 'Select pre-defined theme'  ) ,
     
     'type'            => 'select',
			 
			 
			 
				'options'         =>$posts,
				'default'         => 'theme_2',
	 
 
		
		
		

) );  
     
 
     
     
     
      

     

      
     
     
      Redux::set_field( $opt_name, 'saksh_display_layout', array(
    'id' => 'saksh_room_info_pricing',
   
    'title' => __( 'Select pre-defined room info pricing '  ) ,
     
     'type'            => 'select',
			 
			 
			 
				'options'         =>$posts,
				'default'         => 'theme_2',
	 
 
		
		
		

) );  
     
 
     
      
			 
     

			 
			  

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// PLEASE CHANGE THESE SETTINGS IN YOUR THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
/*$args['admin_bar_links'][] = array(
	'id'    => 'saksh-docs',
	'href'  => '//devs.redux.io/',
	'title' => __( 'cDocumentation', 'your-textdomain-here' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'saksh-support',
	'href'  => '//sakshamapp.com',
	'title' => __( 'Support', 'your-textdomain-here' ),
);
*/
 $path= SAKSHDIR . '/readme.txt'; 

  Redux::set_args( $opt_name, $args );
    
 if ( file_exists(  $path ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'your-textdomain-here' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' =>$path, // FULL PATH, not relative, please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
 }
   