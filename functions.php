<?php

include('functions/start.php');

include('functions/clean.php');

// Hide admin bar
show_admin_bar( false );

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

  global $wpdb;
  $students = $wpdb->get_results( "SELECT * FROM students where class_id = '" . $class . "'", ARRAY_A );

  $student_array = array();

  foreach( $students as $student ) {
    $user = get_user_by( 'id', $student['user_id'] );
    array_push($student_array, array($user->first_name . " " . $user->last_name, $user->user_login));
  }

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

    $user_id = get_user_by('login', $username)->ID;

    if (programmatic_login($username)) {
      if (get_user_meta($user_id, 'first_time', true) == 0) {
        echo 'first';
      }
      else {
        echo "not";
      }
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


    // Get a list of completed modules

    $sql = "SELECT * FROM sessions WHERE class_id = " . $class . " AND user_id = " . get_current_user_id();

    global $wpdb;
    $results = $wpdb->get_results( $sql , ARRAY_A );

    // var_dump(get_current_user_id());

    $modules = array();
    $rewards = array();

    foreach ( $results as $result ) {
      array_push($modules, $result['module_id']);
      array_push($rewards, json_decode(str_replace('\\', '', $result["reward"]), true));
    }


    $modules_count = count(get_field('modules', $class));
    $modules_complete = 0;

    if( have_rows('modules', $class) ):

        while ( have_rows('modules', $class) ) : the_row();

            // Your loop code
            $module = get_sub_field('module', $class);



            if (in_array($module->ID, $modules)) {
              $modules_complete++;
            }

            // Do the plate logic here

        endwhile;

    else :

        // no rows found

    endif;


    if ($modules_count == 1) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    elseif ($modules_count == 2) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_2Reward.png"  />';
      }
      elseif ($modules_complete == 2) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    elseif ($modules_count == 3) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_1Reward.png" />';
      }
      elseif ($modules_complete == 2) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_3Reward.png" />';
      }
      elseif ($modules_complete == 3) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    elseif ($modules_count == 4) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_1Reward.png" />';
      }
      elseif ($modules_complete == 2) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_2Reward.png" />';
      }
      elseif ($modules_complete == 3) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_3Reward.png" />';
      }
      elseif ($modules_complete == 4) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    elseif ($modules_count == 5) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_1Reward.png" />';
      }
      elseif ($modules_complete == 2) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_2Reward.png" />';
      }
      elseif ($modules_complete == 3) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_3Reward.png" />';
      }
      elseif ($modules_complete == 4) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_4Reward.png" />';
      }
      elseif ($modules_complete == 5) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    elseif ($modules_count == 6) {
      if ($modules_complete == 0) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 1) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_0Reward.png" />';
      }
      elseif ($modules_complete == 2) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_1Reward.png" />';
      }
      elseif ($modules_complete == 3) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_2Reward.png" />';
      }
      elseif ($modules_complete == 4) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_3Reward.png" />';
      }
      elseif ($modules_complete == 5) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_4Reward.png" />';
      }
      elseif ($modules_complete == 6) {
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_5Reward.png" />';
      }
      else {

      }
    }
    else {

    }


    echo '<div class="reward-images">';

      // FOR EACH REWARDS AS REWARD, CREATE AN HTML ELEMENT AND RETURN IT

      $i = 0;

      foreach( $rewards as $reward ) {
        foreach ($reward as $r) {

          $r_image = '';

          if ($r == "Asparagus") {
            $r_image = get_template_directory_uri() . '/img/asparagus.png';
          }
          elseif ($r == "Broccoli") {
            $r_image = get_template_directory_uri() . '/img/broccoli.png';
          }
          elseif ($r == "Carrot") {
            $r_image = get_template_directory_uri() . '/img/carrot.png';
          }
          elseif ($r == "Green Beans") {
            $r_image = get_template_directory_uri() . '/img/beans.png';
          }
          elseif ($r == "Banana") {
            $r_image = get_template_directory_uri() . '/img/banana.png';
          }
          elseif ($r == "Apple") {
            $r_image = get_template_directory_uri() . '/img/apple.png';
          }
          elseif ($r == "Orange") {
            $r_image = get_template_directory_uri() . '/img/orange.png';
          }
          elseif ($r == "Pear") {
            $r_image = get_template_directory_uri() . '/img/pear.png';
          }
          elseif ($r == "Ham") {
            $r_image = get_template_directory_uri() . '/img/ham.png';
          }
          elseif ($r == "Eggs") {
            $r_image = get_template_directory_uri() . '/img/eggs.png';
          }
          elseif ($r == "Fish") {
            $r_image = get_template_directory_uri() . '/img/fish.png';
          }
          elseif ($r == "Chicken") {
            $r_image = get_template_directory_uri() . '/img/chicken.png';
          }
          elseif ($r == "Noodles") {
            $r_image = get_template_directory_uri() . '/img/noodles.png';
          }
          elseif ($r == "Bread") {
            $r_image = get_template_directory_uri() . '/img/bread.png';
          }
          elseif ($r == "Pasta") {
            $r_image = get_template_directory_uri() . '/img/pasta.png';
          }
          elseif ($r == "Rice") {
            $r_image = get_template_directory_uri() . '/img/rice.png';
          }
          elseif ($r == "Yogurt") {
            $r_image = get_template_directory_uri() . '/img/yogurt.png';
          }
          elseif ($r == "Cheese") {
            $r_image = get_template_directory_uri() . '/img/cheese.png';
          }
          elseif ($r == "Milk") {
            $r_image = get_template_directory_uri() . '/img/Milk.png';
          }
          elseif ($r == "Ice Cream") {
            $r_image = get_template_directory_uri() . '/img/icecream.png';
          }
          else {

          }

          echo '<div class="reward-image-final-' . $i . ' reward-image-final">';
          echo '<img src="' . $r_image . '" />';
          echo '</div>';

          $i++;
        }
      }

    echo '</div>';


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

          echo '<tbody class="table-body">';

            global $wpdb;
            $results = $wpdb->get_results( 'SELECT * FROM students WHERE class_id =' . $post->ID, ARRAY_A );

            foreach ( $results as $result ) {

              $u = get_user_by( 'ID', $result['user_id'] );

              echo "<tr class='row-" . $result['user_id'] . "'>";

                echo "<td class='column-columnname'>" . $u->first_name . "</td>";
                echo "<td class='column-columnname'>" . $u->last_name . "</td>";
                echo "<td class='column-columnname'><div class='remove-student dashicons dashicons-no-alt' data-id='" . $result['user_id'] . "' data-class='" . $post->ID . "'></div></td>";

              echo "</tr>";

            }

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
    $class_id = $_POST['class'];
  }

  // create a wordpress user
  $user_name = $first_name . "_" . $last_name . "_" . bin2hex(random_bytes(5));
	$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
	$user_id = wp_create_user( $user_name, $random_password );

  wp_update_user(array(
    'ID' => $user_id,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'role' => 'student'
  ));

  update_user_meta($user_id, 'first_time', 0);

  // add wordpress id to the students array for the class
  global $wpdb;
  $wpdb->insert(
    'students',
    array(
      'class_id' => $class_id,
      'user_id' => $user_id
	  )
  );

  echo $user_id;
  // create this students array

  die;

}

function get_order( $post ) {
  $sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();

  global $wpdb;
  $class_row = $wpdb->get_row( $sql , ARRAY_A );

  $class = (int)$class_row['class_id'];

  if( have_rows('modules', $class) ):

    $num = 0;
    $i = 1;

      while ( have_rows('modules', $class) ) : the_row();

          $module = get_sub_field('module', $class);

          if ($module->ID == $post->ID) {
            $num = $i;
          }

          ?>

          <?php

          $i++;

      endwhile;

  else :

      // no rows found

  endif;

  return $num;
}

add_action( 'wp_ajax_remove_student', 'remove_student' );
add_action( 'wp_ajax_nopriv_remove_student', 'remove_student' );

function remove_student() {

  if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
  }

  if (isset($_POST['class'])) {
    $class_id = $_POST['class'];
  }

  // remove student from the students array for the class
  global $wpdb;
  $wpdb->delete(
    'students',
    array(
      'class_id' => $class_id,
      'user_id' => $user_id
	  )
  );

  wp_delete_user( $user_id );

  echo $user_id;
  // create this students array

  die;

}


add_action( 'admin_footer', 'my_action_javascript' );

function my_action_javascript() { ?>

  <script type="text/javascript">

  jQuery(document).ready(function($){
   //Registration metabox

   $('#add-student').click(function(){

     $class_name = $(this).attr('data-class');

     $.ajax({
       type: "POST",
       url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php',
       data: {class:$class_name,
              first_name: jQuery('#students-first-name').val(),
              last_name: jQuery('#students-last-name').val(),
              action:'add_student'}
     }).done(function(response){

       if(response){

         // respond and append to table
         $('.table-body').append("<tr class='row-" + response + "'><td class='column-columnname'>" + jQuery('#students-first-name').val() + "</td><td class='column-columnname'>" + jQuery('#students-last-name').val() + "</td><td class='column-columnname'><div class='remove-student dashicons dashicons-no-alt' data-id='" + response + "' data-class='" + $class_name + "'></div></td></tr>");

         $('.row-' + response + ' .remove-student').click(function(){

           $.ajax({
             type: "POST",
             url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php',
             data: {class:$class_name,
                    user_id:response,
                    action:'remove_student'}
           }).done(function(response){

             if(response){

               // respond and append to table

               $(".row-" + response).hide();

             }
           })

         });
       }
     })

   });

   $('.remove-student').click(function(){

     $class_name = $(this).attr('data-class');
     $user_id = $(this).attr('data-id');

     $.ajax({
       type: "POST",
       url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php',
       data: {class:$class_name,
              user_id:$user_id,
              action:'remove_student'}
     }).done(function(response){

       if(response){

         // respond and append to table

         $(".row-" + response).hide();

       }
     })

   });

  })

  </script>

<? }

?>
