<?php

  $school = $_REQUEST['school'];

  $field = array();

  $args = array( 'post_type' => 'user', 'role' => 'Student', 'posts_per_page' => -1 );
  $user_query = new WP_User_Query( $args );

  // User Loop
  if ( ! empty( $user_query->results ) ) {
    foreach ( $user_query->results as $user ) {

      $field['choices'][$user->display_name] = $user->display_name;

    }
  }

?>
