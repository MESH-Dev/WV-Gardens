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

  $modules = array();
  $rewards = array();

  foreach ( $results as $result ) {
    array_push($modules, $result['module_id']);
    array_push($rewards, json_decode(str_replace('\\', '', $result["reward"]), true));
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
          elseif ($r == "Oatmeal") {
            $r_image = get_template_directory_uri() . '/img/oatmeal.png';
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
            $r_image = get_template_directory_uri() . '/img/milk.png';
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

  ?>
