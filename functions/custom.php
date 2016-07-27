<?php

// registration code for modules post type
function register_modules_posttype() {
	$labels = array(
		'name' 				=> _x( 'Modules', 'post type general name' ),
		'singular_name'		=> _x( 'Module', 'post type singular name' ),
		'add_new' 			=> __( 'Add New' ),
		'add_new_item' 		=> __( 'Module' ),
		'edit_item' 		=> __( 'Module' ),
		'new_item' 			=> __( 'Module' ),
		'view_item' 		=> __( 'Module' ),
		'search_items' 		=> __( 'Module' ),
		'not_found' 		=> __( 'Module' ),
		'not_found_in_trash'=> __( 'Module' ),
		'parent_item_colon' => __( 'Module' ),
		'menu_name'			=> __( 'Modules' )
	);

	$taxonomies = array();

	$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Module'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'modules', 'with_front' => false ),
		'supports' 			=> $supports,
		'menu_position' 	=> 5,
		'taxonomies'		=> $taxonomies
	 );
	 register_post_type('modules',$post_type_args);
}
add_action('init', 'register_modules_posttype');// registration code for questions post type
function register_questions_posttype() {
	$labels = array(
		'name' 				=> _x( 'Questions', 'post type general name' ),
		'singular_name'		=> _x( 'Question', 'post type singular name' ),
		'add_new' 			=> __( 'Add New' ),
		'add_new_item' 		=> __( 'Question' ),
		'edit_item' 		=> __( 'Question' ),
		'new_item' 			=> __( 'Question' ),
		'view_item' 		=> __( 'Question' ),
		'search_items' 		=> __( 'Question' ),
		'not_found' 		=> __( 'Question' ),
		'not_found_in_trash'=> __( 'Question' ),
		'parent_item_colon' => __( 'Question' ),
		'menu_name'			=> __( 'Questions' )
	);

	$taxonomies = array();

	$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Question'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'questions', 'with_front' => false ),
		'supports' 			=> $supports,
		'menu_position' 	=> 5,
		'taxonomies'		=> $taxonomies
	 );
	 register_post_type('questions',$post_type_args);
}
add_action('init', 'register_questions_posttype');// registration code for classes post type

function register_classes_posttype() {
	$labels = array(
		'name' 				=> _x( 'Classes', 'post type general name' ),
		'singular_name'		=> _x( 'Class', 'post type singular name' ),
		'add_new' 			=> __( 'Add New' ),
		'add_new_item' 		=> __( 'Class' ),
		'edit_item' 		=> __( 'Class' ),
		'new_item' 			=> __( 'Class' ),
		'view_item' 		=> __( 'Class' ),
		'search_items' 		=> __( 'Class' ),
		'not_found' 		=> __( 'Class' ),
		'not_found_in_trash'=> __( 'Class' ),
		'parent_item_colon' => __( 'Class' ),
		'menu_name'			=> __( 'Classes' )
	);

	$taxonomies = array();

	$supports = array('title','editor','author','custom-fields','comments','revisions');

	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Class'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'rewrite' 			=> array('slug' => 'classes', 'with_front' => false ),
		'supports' 			=> $supports,
		'menu_position' 	=> 5,
		'taxonomies'		=> $taxonomies,
	    'capabilities' => array(
	        'edit_post' => 'edit_class',
	        'edit_posts' => 'edit_classes',
	        'publish_posts' => 'publish_classes',
	        'delete_post' => 'delete_class'
	    )
	 );
	 register_post_type('classes',$post_type_args);
}
add_action('init', 'register_classes_posttype');


// registration code for semester taxonomy
function register_semester_tax() {
	$labels = array(
		'name' 					=> _x( 'Semesters', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Semester', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Semester', 'Semester'),
		'add_new_item' 			=> __( 'Add New Semester' ),
		'edit_item' 			=> __( 'Edit Semester' ),
		'new_item' 				=> __( 'New Semester' ),
		'view_item' 			=> __( 'View Semester' ),
		'search_items' 			=> __( 'Search Semesters' ),
		'not_found' 			=> __( 'No Semester found' ),
		'not_found_in_trash' 	=> __( 'No Semester found in Trash' ),
	);

	$pages = array('classes');

	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Semester'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> false,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => true,
		'rewrite' 			=> array('slug' => 'semester', 'with_front' => false ),
	 );
	register_taxonomy('semester', $pages, $args);
}
add_action('init', 'register_semester_tax');

// registration code for school taxonomy
function register_school_tax() {
	$labels = array(
		'name' 					=> _x( 'Schools', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'School', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New School', 'School'),
		'add_new_item' 			=> __( 'Add New School' ),
		'edit_item' 			=> __( 'Edit School' ),
		'new_item' 				=> __( 'New School' ),
		'view_item' 			=> __( 'View School' ),
		'search_items' 			=> __( 'Search Schools' ),
		'not_found' 			=> __( 'No School found' ),
		'not_found_in_trash' 	=> __( 'No School found in Trash' ),
	);

	$pages = array('classes');

	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('School'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> false,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => true,
		'rewrite' 			=> array('slug' => 'school', 'with_front' => false ),
	 );
	register_taxonomy('school', $pages, $args);
}
add_action('init', 'register_school_tax');

// registration code for theyear taxonomy
function register_theyear_tax() {
	$labels = array(
		'name' 					=> _x( 'The Years', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'The Year', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New The Year', 'The Year'),
		'add_new_item' 			=> __( 'Add New The Year' ),
		'edit_item' 			=> __( 'Edit The Year' ),
		'new_item' 				=> __( 'New The Year' ),
		'view_item' 			=> __( 'View The Year' ),
		'search_items' 			=> __( 'Search The Years' ),
		'not_found' 			=> __( 'No The Year found' ),
		'not_found_in_trash' 	=> __( 'No The Year found in Trash' ),
	);

	$pages = array('classes');

	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('The Year'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> false,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => true,
		'rewrite' 			=> array('slug' => 'theyear', 'with_front' => false ),
	 );
	register_taxonomy('theyear', $pages, $args);
}
add_action('init', 'register_theyear_tax');

// registration code for grade taxonomy
function register_grade_tax() {
	$labels = array(
		'name' 					=> _x( 'Grades', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Grade', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Grade', 'Grade'),
		'add_new_item' 			=> __( 'Add New Grade' ),
		'edit_item' 			=> __( 'Edit Grade' ),
		'new_item' 				=> __( 'New Grade' ),
		'view_item' 			=> __( 'View Grade' ),
		'search_items' 			=> __( 'Search Grades' ),
		'not_found' 			=> __( 'No Grade found' ),
		'not_found_in_trash' 	=> __( 'No Grade found in Trash' ),
	);

	$pages = array('classes');

	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Grade'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> false,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => true,
		'rewrite' 			=> array('slug' => 'grade', 'with_front' => false ),
	 );
	register_taxonomy('grade', $pages, $args);
}
add_action('init', 'register_grade_tax');

function ecpt_export_ui_scripts() {

	global $ecpt_options, $post;
	?>
	<script type="text/javascript">
			jQuery(document).ready(function($)
			{

				if($('.form-table .ecpt_upload_field').length > 0 ) {
					// Media Uploader
					window.formfield = '';

					$('.ecpt_upload_image_button').live('click', function() {
					window.formfield = $('.ecpt_upload_field',$(this).parent());
						tb_show('', 'media-upload.php?type=file&post_id=<?php echo $post->ID; ?>&TB_iframe=true');
										return false;
						});

						window.original_send_to_editor = window.send_to_editor;
						window.send_to_editor = function(html) {
							if (window.formfield) {
								imgurl = $('a','<div>'+html+'</div>').attr('href');
								window.formfield.val(imgurl);
								tb_remove();
							}
							else {
								window.original_send_to_editor(html);
							}
							window.formfield = '';
							window.imagefield = false;
						}
				}
				if($('.form-table .ecpt-slider').length > 0 ) {
					$('.ecpt-slider').each(function(){
						var $this = $(this);
						var id = $this.attr('rel');
						var val = $('#' + id).val();
						var max = $('#' + id).attr('rel');
						max = parseInt(max);
						//var step = $('#' + id).closest('input').attr('rel');
						$this.slider({
							value: val,
							max: max,
							step: 1,
							slide: function(event, ui) {
								$('#' + id).val(ui.value);
							}
						});
					});
				}

				if($('.form-table .ecpt_datepicker').length > 0 ) {
					var dateFormat = 'mm/dd/yy';
					$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
				}

				// add new repeatable field
				$(".ecpt_add_new_field").on('click', function() {
					var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
					// set the new field val to blank
					$('input', field).val("");
					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// add new repeatable upload field
				$(".ecpt_add_new_upload_field").on('click', function() {
					var container = $(this).closest('tr');
					var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
					// set the new field val to blank
					$('input[type="text"]', field).val("");

					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// remove repeatable field
				$('.ecpt_remove_repeatable').on('click', function(e) {
					e.preventDefault();
					var field = $(this).parent();
					$('input', field).val("");
					field.remove();
					return false;
				});

			});
	  </script>
	<?php
}

function ecpt_export_datepicker_ui_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}
function ecpt_export_datepicker_ui_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
{
	add_action('admin_head', 'ecpt_export_ui_scripts');
}

// converts a time stamp to date string for meta fields
if(!function_exists('ecpt_timestamp_to_date')) {
	function ecpt_timestamp_to_date($date) {

		return date('m/d/Y', $date);
	}
}
if(!function_exists('ecpt_format_date')) {
	function ecpt_format_date($date) {

		$date = strtotime($date);

		return $date;
	}
}

add_action( 'load-edit.php', 'posts_for_current_contributor' );
function posts_for_current_contributor() {
    global $user_ID;

    if ( current_user_can( 'teacher' ) ) {
       if ( ! isset( $_GET['author'] ) ) {
          wp_redirect( add_query_arg( 'author', $user_ID ) );
          exit;
       }
   }

}

?>
