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

function implement_ajax() {



  $field = array();

  if (isset($_REQUEST['school'])) {
    $school = $_REQUEST['school'];
  }

  $class_array = array();

  $args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post();

    $s = get_the_terms( get_the_id(), 'school' );

    if ($s[0]->name == $school) {

      $teacher = get_field('teacher', get_the_id());
      $class_array[ get_the_title() ] = get_the_title();


      // $students = get_field('students', get_the_id());
      //
      // foreach ($students as $student) {
      //   $field[$student['student']['display_name']] = $student['student']['display_name'];
      // }

    }

  endwhile;

  // echo json_encode($field);

  echo json_encode($class_array);

  // $teachers = array();
  //
  // $args = array( 'post_type' => 'user', 'role' => 'Teacher', 'posts_per_page' => -1 );
  // $user_query = new WP_User_Query( $args );
  //
  // // User Loop
  // if ( ! empty( $user_query->results ) ) {
  //   foreach ( $user_query->results as $user ) {
  //
  //
  //
  //     $teachers[$user->display_name] = $user->display_name;
  //
  //   }
  // }
  //
  // echo json_encode($teachers);

  die();
}
add_action('wp_ajax_my_special_ajax_call', 'implement_ajax');
add_action('wp_ajax_nopriv_my_special_ajax_call', 'implement_ajax');

?>
