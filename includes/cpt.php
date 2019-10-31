<?php 
function sms_content_init() {
    $labels = array(
        'name'                  => _x( 'SMS', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'SMS', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'SMS content', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'SMS', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New SMS', 'textdomain' ),
        'new_item'              => __( 'New SMS', 'textdomain' ),
        'edit_item'             => __( 'Edit SMS', 'textdomain' ),
        'view_item'             => __( 'View SMS', 'textdomain' ),
        'all_items'             => __( 'All SMSs', 'textdomain' ),
        'search_items'          => __( 'Search SMSs', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent SMSs:', 'textdomain' ),
        'not_found'             => __( 'No SMSs found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No SMSs found in Trash.', 'textdomain' ),
        'archives'              => _x( 'SMS archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into SMS', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter SMSs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'SMSs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'SMSs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-megaphone',
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'SMS' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor'),
    );
 
    register_post_type( 'SMS', $args );
}
add_action( 'init', 'sms_content_init' );