<?php
/**
 * Registered new custom post types
 * User: Systango
 * Date: 26/4/17
 * Time: 5:48 PM
 */

function cptui_register_my_cpts_review() {

    /**
     * Post Type: Review.
     */

    $labels = array(
        "name" => __( 'Browse Complaints and Reviews', 'ihpc' ),
        "singular_name" => __( 'Review', 'ihpc' ),
        "menu_name" => __( 'Review', 'ihpc' ),
        "all_items" => __( 'All Reviews', 'ihpc' ),
        "add_new" => __( 'Add New Review', 'ihpc' ),
        "add_new_item" => __( 'Add New Review', 'ihpc' ),
        "edit_item" => __( 'Edit Review', 'ihpc' ),
        "new_item" => __( 'New Review', 'ihpc' ),
        "view_item" => __( 'View Review', 'ihpc' ),
        "view_items" => __( 'View Reviews', 'ihpc' ),
        "search_items" => __( 'Search Reviews', 'ihpc' ),
        "not_found" => __( 'No Reviews Found', 'ihpc' ),
        "not_found_in_trash" => __( 'No Reviews found in trash', 'ihpc' ),
        "parent_item_colon" => __( 'Review', 'ihpc' ),
        "featured_image" => __( 'Featured image for review', 'ihpc' ),
        "set_featured_image" => __( 'Set featured image', 'ihpc' ),
        "remove_featured_image" => __( 'Remove featured image', 'ihpc' ),
        "use_featured_image" => __( 'Use featured image', 'ihpc' ),
        "Archives" => __( 'Review Archives', 'ihpc' ),
        "insert_into_item" => __( 'Insert into review', 'ihpc' ),
        "uploaded_to_this_item" => __( 'Uploaded to this review', 'ihpc' ),
        "filter_items_list" => __( 'Filter review list', 'ihpc' ),
        "items_list_navigation" => __( 'Review list navigation', 'ihpc' ),
        "items_list" => __( 'Reviews list', 'ihpc' ),
        "attributes" => __( 'Review Attributes', 'ihpc' ),
        "parent_item_colon" => __( 'Review', 'ihpc' ),
    );
    //Labels post type companies
    $labelsc = array(
        "name" => __( 'Companies', 'ihpc' ),
        "singular_name" => __( 'Companies', 'ihpc' ),
        "menu_name" => __( 'Companies', 'ihpc' ),
        "all_items" => __( 'All Companies', 'ihpc' ),
        "add_new" => __( 'Add New Company', 'ihpc' ),
        "add_new_item" => __( 'Add New Company', 'ihpc' ),
        "edit_item" => __( 'Edit Company', 'ihpc' ),
        "new_item" => __( 'New Company', 'ihpc' ),
        "view_item" => __( 'View Company', 'ihpc' ),
        "view_items" => __( 'View Companies', 'ihpc' ),
        "search_items" => __( 'Search Companies', 'ihpc' ),
        "not_found" => __( 'No Companies Found', 'ihpc' ),
        "not_found_in_trash" => __( 'No Companies found in trash', 'ihpc' ),
        "parent_item_colon" => __( 'Companies', 'ihpc' ),
        "featured_image" => __( 'Featured image for company', 'ihpc' ),
        "set_featured_image" => __( 'Set featured image', 'ihpc' ),
        "remove_featured_image" => __( 'Remove featured image', 'ihpc' ),
        "use_featured_image" => __( 'Use featured image', 'ihpc' ),
        "Archives" => __( 'Review Archives', 'ihpc' ),
        "insert_into_item" => __( 'Insert into companies', 'ihpc' ),
        "uploaded_to_this_item" => __( 'Uploaded to this company', 'ihpc' ),
        "filter_items_list" => __( 'Filter companies list', 'ihpc' ),
        "items_list_navigation" => __( 'Companies list navigation', 'ihpc' ),
        "items_list" => __( 'Companies list', 'ihpc' ),
        "attributes" => __( 'Companies Attributes', 'ihpc' ),
        "parent_item_colon" => __( 'Companies', 'ihpc' ),
    );
    //Post type review args
    $args = array(
        "label" => __( 'Review', 'ihpc' ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "review", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ),
        "taxonomies" => array( "review", "post_tag" ),
    );

    // Add new taxonomy for Review post type, make it hierarchical (like categories)
    $labeltaxarg = array(
        'name'              => _x( 'Review Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Review Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Review Category', 'textdomain' ),
        'all_items'         => __( 'All Review Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Review Category', 'textdomain' ),
        'new_item_name'     => __( 'New Review Category Name', 'textdomain' ),
        'menu_name'         => __( 'Review Category', 'textdomain' ),
    );
    $taxargs_r = array(
        'hierarchical'      => true,
        'labels'            => $labeltaxarg,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'reviewtax' ),
    );
    register_taxonomy( 'reviewtax', array( 'review' ), $taxargs_r );


    //Post type companies Register args
    $argsc = array(
        "label" => __( 'Companies', 'ihpc' ),
        "labels" => $labelsc,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "companies", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ),
        "taxonomies" => array( "companies", "post_tag" ),
    );
    //Post Type review
    register_post_type( "review", $args );
    //Post Type Company
    register_post_type( "companies", $argsc );

    // Add new taxonomy for Company post type, make it hierarchical (like categories)
    $labelcompanyarg = array(
        'name'              => _x( 'Company Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Company Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Company Category', 'textdomain' ),
        'all_items'         => __( 'All Company Categories', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Company Category', 'textdomain' ),
        'new_item_name'     => __( 'New Company Category Name', 'textdomain' ),
        'menu_name'         => __( 'Company Category', 'textdomain' ),
    );
    $taxargs_c = array(
        'hierarchical'      => true,
        'labels'            => $labelcompanyarg,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'companiestax' ),
    );
    register_taxonomy( 'companiestax', array( 'companies' ), $taxargs_c );

}

add_action( 'init', 'cptui_register_my_cpts_review' );
