<?php



  $field = array();

  $args = array( 'post_type' => 'user', 'role' => 'Student', 'posts_per_page' => -1 );
  $user_query = new WP_User_Query( $args );

  // User Loop
  if ( ! empty( $user_query->results ) ) {
    foreach ( $user_query->results as $user ) {

      $field['choices'][$user->display_name] = $user->display_name;

    }
  }

  echo 'test';

  // Determine the class that the current user is in


  //
  // $args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
  // $loop = new WP_Query( $args );
  //
  // echo "test";
  //
  // while ( $loop->have_posts() ) : $loop->the_post();
  //
  //   $tax = get_terms ( 'school' );
  //
  //   if ( ! empty( $tax ) && ! is_wp_error( $tax ) ){
  //      foreach ( $tax as $t ) {
  //        echo $t;
  //      }
  //   }
  //
  //   $students = get_field('students');
  //
  //     foreach ($students as $student) {
  //         if ( $student['student']['ID'] == get_current_user_id() ) {
  //             $class = get_the_id();
  //         }
  //     }
  //
  // endwhile;



?>
