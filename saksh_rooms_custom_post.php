<?php


function saksh_rooms_custom_post_type()
{
    // Set UI labels for Custom Post Type
    $labels = [
        'name' => _x('Room', 'Post Type General Name', 'saksh'),
        'singular_name' => _x('Room', 'Post Type Singular Name', 'saksh'),
        'menu_name' => __('Rooms', 'saksh'),
        'parent_item_colon' => __('Parent Room', 'saksh'),
        'all_items' => __('All Rooms', 'saksh'),
        'view_item' => __('View Room', 'saksh'),
        'add_new_item' => __('Add New Room', 'saksh'),
        'add_new' => __('Add New', 'saksh'),
        'edit_item' => __('Edit Room', 'saksh'),
        'update_item' => __('Update Room', 'saksh'),
        'search_items' => __('Search Room', 'saksh'),
        'not_found' => __('Not Found', 'saksh'),
        'not_found_in_trash' => __('Not found in Trash', 'saksh'),
    ];

    // Set other options for Custom Post Type

    $args = [
        'label' => __('Rooms', 'saksh'),
        'description' => __('Room news and reviews', 'saksh'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => [
            'title', 
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'revisions',
           'taxonomies' => array( 'tags' ,  'amenities' ,'room_type'  ),
        ],

        /* A hierarchical CPT is like Pages and can have
         * Parent and child items. A non-hierarchical CPT
         * is like Posts.
         */
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => false,
    ];

    // Registering your Custom Post Type
    register_post_type('Rooms', $args);
}

/* Hook into the 'init' action so that the function
 * Containing our post type registration is not
 * unnecessarily executed.
 */

add_action('init', 'saksh_rooms_custom_post_type', 0);


 
add_filter('single_template', 'saksh_room_template');

function saksh_room_template($single)
{
    global $post;

    $dir = plugin_dir_path(__FILE__);
  
    if ($post->post_type == 'rooms') {
        return $dir . 'saksh_room_template.php';
    }
}



 













