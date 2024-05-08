<?php


function saksh_designs_custom_post_type()
{
    // Set UI labels for Custom Post Type
    $labels = [
        'name' => _x('Saksh designs', 'Post Type General Name', 'saksh'),
        'singular_name' => _x('Saksh designs', 'Post Type Singular Name', 'saksh'),
        'menu_name' => __('Saksh designs', 'saksh'),
 
        'all_items' => __('All Saksh designs', 'saksh'),
        'view_item' => __('View Saksh designs', 'saksh'),
        'add_new_item' => __('Add New Saksh designs', 'saksh'),
        'add_new' => __('Add New', 'saksh'),
        'edit_item' => __('Edit Saksh designs', 'saksh'),
        'update_item' => __('Update Saksh designs', 'saksh'),
        'search_items' => __('Search Saksh designs', 'saksh'),
        'not_found' => __('Not Found', 'saksh'),
        'not_found_in_trash' => __('Not found in Trash', 'saksh'),
    ];

    // Set other options for Custom Post Type

    $args = [
        'label' => __('Saksh designs', 'saksh'),
        'description' => __('Saksh designs news and reviews', 'saksh'),
        'labels' => $labels,
        // Features this CPT supports in Post Editor
        'supports' => [
          
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
    register_post_type('Sakshdesigns', $args);
}

/* Hook into the 'init' action so that the function
 * Containing our post type registration is not
 * unnecessarily executed.
 */

add_action('init', 'saksh_designs_custom_post_type', 0);

 

 













