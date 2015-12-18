<?php

// Determine the class that the current user is in

  $sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();

  global $wpdb;
  $class_row = $wpdb->get_row( $sql , ARRAY_A );

  $class = (int)$class_row['class_id'];

  // Get a list of completed modules

  $sql = "SELECT * FROM sessions WHERE class_id = " . $class . " AND user_id = " . get_current_user_id();

  global $wpdb;
  $results = $wpdb->get_results( $sql , ARRAY_A );

  // var_dump(get_current_user_id());

  $modules = array();

  foreach ( $results as $result ) {
    array_push($modules, $result['module_id']);
  }

?>

<?php

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

?>



  <?php

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
        echo '<img src="' . get_template_directory_uri() . '/img/MyPlate_4Reward.png" />';
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

  ?>
