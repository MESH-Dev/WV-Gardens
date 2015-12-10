<?php

include('functions/start.php');

include('functions/clean.php');

//Custon wp-admin logo
function my_custom_login_logo() {
  echo '<style type="text/css">
		        h1 a {
		          background-size: 227px 85px !important;
		          margin-bottom: 20px !important;
		          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
		    </style>';
}

function get_classes() {

  if (isset($_REQUEST['school'])) {
    $school = $_REQUEST['school'];
  }

  $class_array = array();

  $args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();

    $s = get_the_terms( get_the_id(), 'school' );

    if ($s[0]->name == $school) {
      array_push($class_array, array(get_the_title(), get_the_id()));
    }

  endwhile;

  echo json_encode($class_array);

  die();
}

add_action('wp_ajax_get_classes', 'get_classes');
add_action('wp_ajax_nopriv_get_classes', 'get_classes');

function get_password() {

  if (isset($_REQUEST['class'])) {
    $class = $_REQUEST['class'];
  }

  $args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();

    $t = (string)get_the_id();

    if ($t == $class) {
      echo get_field('password');
    }

  endwhile;

  // echo json_encode($class_array);

  die();

}

add_action('wp_ajax_get_password', 'get_password');
add_action('wp_ajax_nopriv_get_password', 'get_password');

function get_students() {

  if (isset($_REQUEST['class'])) {
    $class = $_REQUEST['class'];
  }

  $args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();

    $t = (string)get_the_id();

    if ($t == $class) {

      $student_array = array();

      // check if the repeater field has rows of data
      if( have_rows('students') ):

       	// loop through the rows of data
          while ( have_rows('students') ) : the_row();

              // display a sub field value
              array_push($student_array, array(get_sub_field('student')['display_name'], get_sub_field('student')['ID']));

          endwhile;

      else :

          // no rows found

      endif;

    }

  endwhile;

  echo json_encode($student_array);

  die();

}

add_action('wp_ajax_get_students', 'get_students');
add_action('wp_ajax_nopriv_get_students', 'get_students');


function check_login() {

    if ( is_user_logged_in() ) {
      echo json_encode( array( 'success' => true, 'message' => 'You are already logged in' ) );
      die;
    }

    if (isset($_REQUEST['user'])) {
      $username = $_REQUEST['user'];
    }

    if (programmatic_login($username)) {
      echo "success";
    } else {
      echo "failure";
    }

    die;
}

function programmatic_login( $username ) {

	if ( is_user_logged_in() ) {
		wp_logout();
	}

	add_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );	// hook in earlier than other callbacks to short-circuit them
	$user = wp_signon( array( 'user_login' => $username ) );
	remove_filter( 'authenticate', 'allow_programmatic_login', 10, 3 );

	if ( is_a( $user, 'WP_User' ) ) {
		wp_set_current_user( $user->ID, $user->user_login );

		if ( is_user_logged_in() ) {
			return true;
		}
	}

	return false;
}

function allow_programmatic_login( $user, $username, $password ) {
	return get_user_by( 'login', $username );
}

add_action( 'wp_ajax_nopriv_check_login', 'check_login' );
add_action( 'wp_ajax_check_login', 'check_login' );

function save_answer() {

  if (isset($_REQUEST['answers'])) {
    $answers = $_REQUEST['answers'];
  }

  if (isset($_REQUEST['module'])) {
    $module = $_REQUEST['module'];
  }

  if (isset($_REQUEST['user'])) {
    $user = $_REQUEST['user'];
  }

  if (isset($_REQUEST['class'])) {
    $class = $_REQUEST['class'];
  }

  if (isset($_REQUEST['reward'])) {
    $reward = $_REQUEST['reward'];
  }

  global $wpdb;
  $wpdb->insert(
    'sessions',
    array(
      'answers' => $answers,
      'module_id' => $module,
      'user_id' => $user,
      'class_id' => $class,
      'reward' => $reward
	  )
  );

  die;

}

add_action('wp_ajax_save_answer', 'save_answer');
add_action('wp_ajax_nopriv_save_answer', 'save_answer');


?>
