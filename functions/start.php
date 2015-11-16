<?php

//enqueue scripts and styles *use production assets. Dev assets are located in  /css and /js
function loadup_scripts() {
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('background-fullscreen', 1800, 1200, true);
add_image_size('short-banner', 1800, 800, true);

add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');


$teacher_permissions = array (
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
	);

add_role( 'facilitator', 'Garden Facilitator', $teacher_permissions);
add_role( 'teacher', 'Teacher', $teacher_permissions);
add_role( 'student', 'Student', $teacher_permissions);

remove_role( 'subscriber' );
remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );

//Name the post

function create_post_name( $post_id ){
	if ( ! wp_is_post_revision( $post_id ) ){
		if ( get_post_type( get_the_ID() ) == 'classes' ) {

			// unhook this function so it doesn't loop infinitely
			remove_action('save_post', 'create_post_name');

			// If this is just a revision, don't send the email.

			$semester = get_the_terms( $post_id , 'semester' );
			$year = get_the_terms( $post_id, 'theyear' );
			$school = get_the_terms( $post_id, 'school' );

		  	$my_post = array(
		      'ID'           => $post_id,
		      'post_title'   => $school[0]->name . " - " . $semester[0]->name . " - " . $year[0]->name,
		  	);

			// Update the post into the database
			wp_update_post( $my_post );

			// re-hook this function
			add_action('save_post', 'create_post_name');

		}
	}
}
add_action('save_post', 'create_post_name');


//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Header and breadcrumb trail heirarchy',
        'social_nav' => 'Social menu used throughout'
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );









?>
