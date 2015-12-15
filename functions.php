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

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function students_add_meta_box() {

	$screens = array( 'classes' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'students_sectionid',
			__( 'Students', 'students_textdomain' ),
			'students_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'students_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function students_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'students_save_meta_box_data', 'students_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */

  echo '<div class="row">';
    echo '<div class="column">';
    	echo '<label for="students_new_field">';
    	_e( 'First name', 'students_textdomain' );
    	echo '</label>';
    echo '</div>';
    echo '<div class="column">';
  	  echo '<input type="text" id="students-first-name" name="students_first_name" value="' . esc_attr( $value ) . '" /><br/>';
    echo '</div>';
  echo '</div>';

  echo '<div class="row">';
    echo '<div class="column">';
      echo '<label for="students_new_field">';
    	_e( 'Last name', 'students_textdomain' );
    	echo '</label>';
    echo '</div>';
    echo '<div class="column">';
     echo '<input type="text" id="students-last-name" name="students_last_name" value="' . esc_attr( $value ) . '" />';
    echo '</div>';
  echo '</div>';

  echo '<br/>';

  echo '<div class="row">';
    echo '<div class="column">';
      echo '<div class="acf-button" id="add-student" data-class=' . $post->ID . ' style="">Add Student</div>';
    echo '</div>';
  echo '</div>';

  echo '<hr/>';

  echo '<h1 id="tester-div"></h1>';

  // CREATE A LIST OF STUDENTS

  echo '<table class="widefat fixed" cellspacing="0">
          <thead>
            <tr>
              <th id="cb" class="manage-column column-cb" scope="col">First Name</th>
              <th id="columnname" class="manage-column column-columnname" scope="col">Last Name</th>
              <th id="columnname" class="manage-column column-columnname" scope="col">Remove Student</th>
            </tr>
          </thead>';

          echo '<tbody>';

          //   <tr class="alternate">
          //     <td class="column-columnname"></td>
          //     <td class="column-columnname"></td>
          //     <td class="column-columnname"></td>
          //   </tr>

          echo '</tbody>';

  echo '</table>';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function students_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['students_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['students_meta_box_nonce'], 'students_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['students_first_name'] ) ) {
		return;
	}

	// Sanitize user input.
	$first_name = sanitize_text_field( $_POST['students_first_name'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $first_name );
}
add_action( 'save_post', 'students_save_meta_box_data' );



add_action( 'wp_ajax_add_student', 'add_student' );
add_action( 'wp_ajax_nopriv_add_student', 'add_student' );

function add_student() {
    // Handle request then generate response using WP_Ajax_Response

  if (isset($_POST['first_name'])) {
    $first_name = $_POST['first_name'];
  }

  if (isset($_POST['last_name'])) {
    $last_name = $_POST['last_name'];
  }

  if (isset($_POST['class'])) {
    $class = $_POST['class'];
  }

  // create a wordpress user

  // add wordpress id to the students array for the class

  // create this students array

  echo $first_name . " " . $last_name;

  die;

}

?>
