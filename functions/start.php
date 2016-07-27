<?php

//enqueue scripts and styles *use production assets. Dev assets are located in  /css and /js
function loadup_scripts() {
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'height-js', get_template_directory_uri().'/js/jquery.matchHeight-min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'snowfall-js', get_template_directory_uri().'/js/snowfall.jquery.js', array('jquery'), '1.0.0', true );
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


add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {

    global $user_ID;

    if ( current_user_can( 'teacher' ) ) {
			remove_menu_page( 'edit-comments.php' );
			remove_menu_page( 'edit.php' );
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'edit.php?post_type=questions' );
			remove_menu_page( 'edit.php?post_type=modules' );
    }
}

// $teacher_permissions = array (
//         'read'         => true,  // true allows this capability
//         'edit_posts'   => true,
//         'delete_posts' => false, // Use false to explicitly deny
//         'edit_others_posts' => true, // Allows user to edit others posts not just their own
//         'delete_others_posts' => false, // Allows user to edit others posts not just their own
//         'manage_categories' => false, // Allows user to edit others posts not just their own
        
// );

// add_role( 'facilitator', 'Garden Facilitator', $teacher_permissions);
// add_role( 'teacher', 'Teacher', $teacher_permissions);

 

// $teacher = get_role( 'teacher' );
// $teacher->add_cap( 'edit_class' );
// $teacher->add_cap( 'publish_classes' );
 

remove_role( 'subscriber' );
//remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );


//---------NEW ROLES -----------//
add_role( 'student', __('Student' ),array(	'read' => true, ) );

function add_custom_roles() {
 	add_role('teacher',
        'Teacher',
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
            'upload_files' => false,
        )
    );
 
 
    // add_role( 'facilitator', 'Garden Facilitator',
    //     array(
    //         'read' => true,
    //         'edit_posts' => true,
    //         'delete_posts' => true,
    //         'publish_posts' => true,
    //         'edit_others_posts' => true,
    //         'delete_others_posts' => true,
    //         'edit_published_posts' => true,
    //         'delete_published_posts' => true,
    //         'upload_files' => false,
    //         'manage_categories' => true,
            
            

    //     )
    // );
}
add_action('init', 'add_custom_roles' );



add_action('admin_init','add_custom_role_caps',999);
function add_custom_role_caps() {

	// Add the roles you'd like to administer the custom post types
	$roles = array('facilitator','administrator');

	// Loop through each role and assign class capabilities for 
	foreach($roles as $the_role) { 

	     $role = get_role($the_role);
		
	     $role->add_cap( 'read' );
	     $role->add_cap( 'read_class');
	     $role->add_cap( 'read_private_classes' );
	     $role->add_cap( 'edit_class' );
	     $role->add_cap( 'edit_classes' );
	     $role->add_cap( 'edit_others_classes' );
	     $role->add_cap( 'edit_published_classes' );
	     $role->add_cap( 'publish_classes' );
	     $role->add_cap( 'delete_others_classes' );
	     $role->add_cap( 'delete_private_classes' );
	     $role->add_cap( 'delete_published_classes' );

	}

	$role = get_role('teacher');	
	$role->add_cap( 'read' );
	$role->add_cap( 'read_class');
	$role->add_cap( 'edit_class' );
	$role->add_cap( 'edit_classes' );
	$role->add_cap( 'edit_published_classes' );
	$role->add_cap( 'publish_classes' );
	$role->add_cap( 'delete_published_classes' );
	$role->add_cap( 'delete_classes' );





}



//block users from admin
add_action( 'init', 'blockusers_init' );
function blockusers_init() {

	// show admin bar only for admins
    if (current_user_can('teacher')) {
        add_filter('show_admin_bar', '__return_false');
    }

	if ( is_admin() && !current_user_can( 'edit_class' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}

// //teacher redirect
// add_action( 'wp_login', 'teacher_redirect' );
// function teacher_redirect(){
// 	$user = wp_get_current_user();
// 	if ( in_array( 'teacher', (array) $user->roles ) ) {
// 	   wp_redirect( home_url() ."/wp-admin/edit.php?post_type=classes" );
// 	   exit;

// 	}
// }






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
			$grade = get_the_terms( $post_id, 'grade' );

			$teacher = get_field('teacher', $post_id);


			// This is the list of students previously on the CMS

			$prev_students = $_POST['acf']['field_5660aa950d6a2'];

			// for ($i = 0; $i < $prev_students; $i++) {
			//
			// }



			// This is the list of students currently on the CMS

			$students = array();
			$i = 0;

			// check if the repeater field has rows of data
			if( have_rows('students') ):

			 	// loop through the rows of data
		    while ( have_rows('students') ) : the_row();

	        // display a sub field value
	        $first_name = get_sub_field('first_name');
					$last_name = get_sub_field('last_name');

					$student = array (
						'first_name' => $first_name,
						'last_name' => $last_name
					);

					$students[$i][] = $student;
					$i++;

		    endwhile;

			else :

			    // no rows found

			endif;

			update_post_meta($post_id, 'post', get_field('students', $post_id));


			// Check the current list of students against the list of previous students

			if (!empty($prev_students)) {
				foreach($students as $student) {

					$j = 0;

					$is_new_student = true;

					foreach($prev_students as $prev_student) {
						if (($student['first_name'] == $prev_student['first_name']) && ($student['last_name'] == $prev_student['last_name'])) {
							$is_new_student = false;
						}
					}

					if ($is_new_student == true) {
						update_post_meta( $post_id, 'studentnew1', $student['first_name']);
					}

					$j++;

				}
			}


			// for ($x = 0; $x < $prev_students_count[0]; $x++) {
		  //   array_push($prev_students, $students);
			// }


	  	$my_post = array(
	      'ID'           => $post_id,
	      'post_title'   => $teacher['display_name'] . " - " . $semester[0]->name . " " . $year[0]->name . " - " . $grade[0]->name,
	      'post_author'  => $teacher['ID']
	  	);

			// Update the post into the database
			wp_update_post( $my_post );
			// update_post_meta( $post_id, 'studentlist', $students );

			// re-hook this function
			add_action('save_post', 'create_post_name', 10);

		}
	}
}
add_action('save_post', 'create_post_name');


function update_students_array( $post_id ) {

    // bail early if no ACF data
    // if( empty($_POST['acf']) ) {
		//
    //     return;
		//
    // }

		global $wpdb;

		$wpdb->insert(
	    'students',
	    array(
	      'class_id' => $post_id,
	      'students' => 'test'
		  )
	  );


    // array of field values
    // $fields = get_field('students', $post_id);
		//
		// $sql = "SELECT * FROM students WHERE class_id = " . $post_id;
		//
		//
		// $results = $wpdb->get_results( $sql , ARRAY_A );
		//
		// foreach ( $results as $result ) {
		//
		// }
		//
    // update_post_meta( $post_id, 'pre', 'testinggg' );





}

// run before ACF saves the $_POST['acf'] data
add_action('save_post', 'update_students_array');


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

function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

?>
