<?php

if ( !is_user_logged_in() ) {

  wp_redirect( get_home_url() );
    exit;
}

get_header(); ?>



<main id="main" class="site-main" role="main">

    <?php // HEADER SECTION ?>

    <div class="container">
      <div class="row">
        <div class="twelve columns">
          <div class="menu-bar">
            <a href="<?php echo get_home_url(); ?>/modules/"><div class="menu-title"><span class="menu-game-name">Sprout's Adventure</span> <span class="menu-module-name"><?php the_title(); ?></span></div></a>
            <div class="menu-sound play">
                <i class="fa fa-volume-up"></i>
                <div class="menu-label">
                    <i class="fa fa-play"></i> Play
                </div>
            </div>
            <div class="menu-sound stop">
                <i class="fa fa-volume-up"></i>
                <div class="menu-label">
                    <i class="fa fa-pause"></i> Pause
                </div>
            </div>
          </div>
          <div class="progress-plate">
            <?php get_template_part( 'partials/progress', 'plate' ); ?>
          </div>
          <div class="menu-tools">
            <div class="menu-tool"><a href="<?php echo get_home_url(); ?>/modules/">View my plate</a></div>
            <div class="menu-tool">
              <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // WELCOME  ?>

    <div class="welcome">
      <div class="container">
        <div class="row">
          <div class="nine columns">
            <div class="module-text">
              <h1>Welcome to <span><?php the_title(); ?>!</span> Add healthy food to your plate today by answering the following questions.</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="six columns offset-by-three">
            <div class="module-section">
              <div class="module-image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/happyman.png" />
              </div>
            </div>
          </div>
          <div class="three columns">
            <div class="module-section">
              <button class="start button-control" style="display: inline-block;">Dig In!<div class="next-arrow button-control-arrow"></div></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // QUESTIONS ?>

    <?php

    if( have_rows('questions') ):

      $i = 0;

      while ( have_rows('questions') ) : the_row();

        $i++;
        $question = get_sub_field('question');

        // GET THE CLASS
        $sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();
        global $wpdb;
        $class_row = $wpdb->get_row( $sql , ARRAY_A );
        $class = (int)$class_row['class_id'];

        ?>

        <audio class="audioDemo" id="audio-<?php echo $i; ?>">
           <source src="<?php echo get_field('audio', $question->ID); ?>" type="audio/mpeg">
        </audio>


        <?php if (get_field('autoplay_audio', $class)) { ?>
          
          <script>
            var autoplay = true;

          </script>

        <?php } else { ?>

          <script>

            var autoplay = false;

          </script>

        <?php } ?>

        <script>
          jQuery(document).ready(function($){
            $('.stop').hide();
          });
        </script>


        <div class="question question-<?php echo $i; ?> <?php echo $question->ID; ?>">
          <div class="container">
            <div class="row">
              <div class="eight columns">
                <div class="module-text">
                  <h3 class="module-number"><?php echo $i; ?>.</h3>
                  <h1><?php echo $question->post_title; ?></h1>
                </div>
              </div>
              <div class="four columns">
                <div class="module-image">
                  <?php
                    $display_image = get_field('display_image', $question->ID);
                    $size = 'large';
                    $thumb = $display_image['sizes'][ $size ];
                  ?>
                  <img src="<?php echo $thumb; ?>" />
                </div>
              </div>
            </div>

            <div class="row">

              <?php // MULTIPLE CHOICE ?>

              <?php if( get_field('question_type', $question->ID) == 'multiple' ):
                $answers_count = count(get_field('answers', $question->ID));
                if( have_rows('answers', $question->ID) ):
                  $n = 0;
                  while ( have_rows('answers', $question->ID) ) : the_row();
                    $n++;
                  ?>
                    <div class="<?php if ($answers_count == 3) { echo "four"; } elseif ($answers_count == 5) { echo "two"; if ($n == 1) { echo " offset-by-one"; } } else { echo "three"; } ?> columns">
                      <div class="answer answer-<?php echo $n; ?> animated">
                          <?php
                            $image = get_sub_field('image', $question->ID);
                            $size = 'large';
                            $thumb = $image['sizes'][ $size ];
                          ?>
                          <?php if (get_sub_field('image', $question->ID)) { ?>
                          <div class="answer-image answer-image-<?php echo $n; ?>">
                            <img src="<?php echo $thumb; ?>" />
                          </div>
                          <?php } ?>
                          <div class="answer-text"><?php echo get_sub_field('answer', $question->ID); ?></div>
                      </div>
                    </div>

                  <?php
                  endwhile;
                endif;
              ?>

              <?php // YES/NO ?>

              <?php else: ?>
                <div class="three columns offset-by-three">
                  <div class="answer answer-2 animated">
                      <?php // echo get_sub_field('b'); ?>
                      <div class="answer-image answer-image-2 bounceIn">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/little.png" />
                      </div>
                      <div class="answer-text">Yes</div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer answer-3 animated">
                      <?php // echo get_sub_field('c'); ?>
                      <div class="answer-image answer-image-3" bounceIn>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/much.png" />
                      </div>
                      <div class="answer-text">No</div>
                  </div>
                </div>
              <?php endif; ?>

            </div>

            <?php // QUESTION CONTROLS ?>

            <div class="row">
              <div class="three columns">
                <div class="module-section">
                  <button class="prev button-control" style="display: inline-block;">
                    <div class="prev-text">Previous Question</div>
                    <div class="prev-arrow button-control-arrow"></div>
                  </button>
                </div>
              </div>
              <div class="three columns offset-by-six">
                <div class="module-section">
                  <button class="next button-control" style="display: inline-block;">
                    <div class="next-text">Next Question</div>
                    <div class="next-arrow button-control-arrow"></div>
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>

        <?php
      endwhile;
    endif;
    ?>

    <?php // REWARDS ?>

    <?php

    $veggies = array(
      "single_name" => "veggie",
      "plural_name" => "veggies",
      "reward1" => "Asparagus",
      "reward1_image" => get_template_directory_uri() . "/img/asparagus.png",
      "reward2" => "Broccoli",
      "reward2_image" => get_template_directory_uri() . "/img/broccoli.png",
      "reward3" => "Carrot",
      "reward3_image" => get_template_directory_uri() . "/img/carrot.png",
      "reward4" => "Green Beans",
      "reward4_image" => get_template_directory_uri() . "/img/beans.png"
    );

    $fruits = array(
      "single_name" => "fruit",
      "plural_name" => "fruits",
      "reward1" => "Banana",
      "reward1_image" => get_template_directory_uri() . "/img/banana.png",
      "reward2" => "Apple",
      "reward2_image" => get_template_directory_uri() . "/img/apple.png",
      "reward3" => "Orange",
      "reward3_image" => get_template_directory_uri() . "/img/orange.png",
      "reward4" => "Pear",
      "reward4_image" => get_template_directory_uri() . "/img/pear.png"
    );

    $proteins = array(
      "single_name" => "protein",
      "plural_name" => "proteins",
      "reward1" => "Ham",
      "reward1_image" => get_template_directory_uri() . "/img/ham.png",
      "reward2" => "Eggs",
      "reward2_image" => get_template_directory_uri() . "/img/eggs.png",
      "reward3" => "Fish",
      "reward3_image" => get_template_directory_uri() . "/img/fish.png",
      "reward4" => "Chicken",
      "reward4_image" => get_template_directory_uri() . "/img/chicken.png"
    );

    $grains = array(
      "single_name" => "grain",
      "plural_name" => "grains",
      "reward1" => "Noodles",
      "reward1_image" => get_template_directory_uri() . "/img/Noodles.png",
      "reward2" => "Bread",
      "reward2_image" => get_template_directory_uri() . "/img/bread.png",
      "reward3" => "Pasta",
      "reward3_image" => get_template_directory_uri() . "/img/pasta.png",
      "reward4" => "Rice",
      "reward4_image" => get_template_directory_uri() . "/img/rice.png"
    );

    $dairy = array(
      "single_name" => "dairy",
      "plural_name" => "dairy",
      "reward1" => "Yogurt",
      "reward1_image" => get_template_directory_uri() . "/img/yogurt.png",
      "reward2" => "Cheese",
      "reward2_image" => get_template_directory_uri() . "/img/cheese.png",
      "reward3" => "Milk",
      "reward3_image" => get_template_directory_uri() . "/img/Milk.png",
      "reward4" => "Ice Cream",
      "reward4_image" => get_template_directory_uri() . "/img/icecream.png"
    );

    $rewards = [ $veggies, $fruits, $proteins, $grains, $dairy ];

    ?>

    <?php
      $i = 0;

      foreach($rewards as $reward) {

        $i++;

      ?>

        <div class="reward reward-<?php echo $i; ?>">
          <div class="container">
            <div class="row">
              <div class="eight columns">
                <div class="module-text">
                  <h1>Congratulations!</h1>
                  <h1>You've completed <span><?php the_title(); ?></span>. You get to add one <span><?php echo $reward['single_name']; ?></span> to your plate.</h1>
                </div>
              </div>
              <div class="four columns">
                <div class="module-image module-image-reward">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/farmer.png" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="three columns">
                <div class="reward-answer reward-answer-1">
                  <div class="reward-image-container">
                    <div class="reward-image">
                      <img src="<?php echo $reward['reward1_image'] ?>" />
                    </div>
                  </div>
                  <div class="reward-text"><?php echo $reward['reward1']; ?></div>
                </div>
              </div>
              <div class="three columns">
                <div class="reward-answer reward-answer-2">
                  <div class="reward-image-container">
                    <div class="reward-image">
                      <img src="<?php echo $reward['reward2_image'] ?>" />
                    </div>
                  </div>
                  <div class="reward-text"><?php echo $reward['reward2']; ?></div>
                </div>
              </div>
              <div class="three columns">
                <div class="reward-answer reward-answer-3">
                  <div class="reward-image-container">
                    <div class="reward-image">
                      <img src="<?php echo $reward['reward3_image'] ?>" />
                    </div>
                  </div>
                  <div class="reward-text"><?php echo $reward['reward3']; ?></div>
                </div>
              </div>
              <div class="three columns">
                <div class="reward-answer reward-answer-4">
                    <?php // echo get_sub_field('a'); ?>
                    <div class="reward-image-container">
                      <div class="reward-image">
                        <img src="<?php echo $reward['reward4_image'] ?>" />
                      </div>
                    </div>
                    <div class="reward-text"><?php echo $reward['reward4']; ?></div>
                </div>
              </div>
            </div>

            <?php // REWARD CONTROLS ?>

            <div class="row">
              <div class="three columns">
                <div class="module-section">
                  <button class="prev button-control" style="display: inline-block;">
                    <div class="prev-text">Previous Question</div>
                    <div class="prev-arrow button-control-arrow"></div>
                  </button>
                </div>
              </div>
              <div class="three columns offset-by-six">
                <div class="module-section">
                  <button class="next button-control" style="display: inline-block;">
                    <div class="next-text">Next</div>
                    <div class="next-arrow button-control-arrow"></div>
                  </button>
                </div>
              </div>
            </div>


          </div>
        </div>

      <?php
      }
    ?>

    <?php // BONUS ?>

    <div class="bonus">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-image">
              <div class="bonus-image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/bonus.png" class="animated" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <button class="next button-control" style="display: inline-block;">
                <div class="next-text">Next</div>
                <div class="next-arrow button-control-arrow"></div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // WOOHOO ?>

    <div class="woohoo">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-image">
              <div class="bonus-image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/woohoo.png" class="animated" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <button class="next button-control" style="display: inline-block;">
                <div class="next-text">Next</div>
                <div class="next-arrow button-control-arrow"></div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // YAY ?>

    <div class="yay">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-image">
              <div class="bonus-image">
                <img src="<?php echo get_template_directory_uri(); ?>/img/yay.png" class="animated" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <button class="next button-control" style="display: inline-block;">
                <div class="next-text">Next</div>
                <div class="next-arrow button-control-arrow"></div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // CONGRATULATIONS ?>

    <div class="congratulations">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>
                You've added one <span class="reward-item"></span> to your plate.
              </h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="six offset-by-three columns">

              <div class="final-image">
              </div>

          </div>
        </div>

        <?php // RETURN CONTROLS ?>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <a href="<?php echo get_home_url(); ?>/modules/"><button class="return button-control" style="display: inline-block;">Return to Home <div class="return-arrow button-control-arrow"></div></button></a>
            </div>
          </div>
        </div>
      </div>
    </div>



    <?php // CONGRATULATIONS ?>

    <div class="congratulations-no-reward">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>
                You're one step closer to completing your plate!
              </h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="six offset-by-three columns">
            <div class="final-image">
            </div>
          </div>
        </div>

        <?php // RETURN CONTROLS ?>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <a href="<?php echo get_home_url(); ?>/modules/"><button class="return button-control" style="display: inline-block;">Return to Home <div class="return-arrow button-control-arrow"></div></button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php // COMPLETE ?>

    <div class="complete">
      <div class="container">
        <div class="row">
          <div class="twelve columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>
                You've completed Sprout's Adventure and filled your plate with healthy food!
              </h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="six offset-by-three columns">
            <div class="final-image">
            </div>
          </div>
        </div>

        <?php // RETURN CONTROLS ?>

        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <a href="<?php echo get_home_url(); ?>/modules/"><button class="return button-control" style="display: inline-block;">Print My Full Healthy Plate <div class="return-arrow button-control-arrow"></div></button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

</main><!-- #main -->

<?php

// GET THE QUESTIONS

$questions = array();
$questions_count = count(get_field('questions'));

for ($x = 1; $x <= $questions_count; $x++) {
  array_push($questions, ".question-" . $x);
}

// GET THE CLASS
$sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();
global $wpdb;
$class_row = $wpdb->get_row( $sql , ARRAY_A );
$class = (int)$class_row['class_id'];

// GET A LIST OF MODULES
$sql = "SELECT * FROM sessions WHERE class_id = " . $class . " AND user_id = " . get_current_user_id();
$results = $wpdb->get_results( $sql , ARRAY_A );

$modules_complete = count($results);
$modules_total = count(get_field('modules', $class));

// IF THERE IS ONLY 1 MODULE, USE THIS TRACK

$mod1_0 = array();
array_push( $mod1_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod1_0, $question);
}
array_push( $mod1_0, ".yay", ".reward-1", ".reward-2", ".reward-3", ".reward-4", ".reward-5", ".complete" );

// IF THERE ARE ONLY 2 MODULES, USE THIS TRACK

$mod2_0 = array();
array_push( $mod2_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod2_0, $question);
}
array_push( $mod2_0, ".woohoo", ".reward-1", ".reward-2", ".congratulations" );

$mod2_1 = array();
array_push( $mod2_1, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod2_1, $question);
}
array_push( $mod2_1, ".yay", ".reward-3", ".reward-4", ".bonus", ".reward-5", ".complete" );

// IF THERE ARE ONLY 3 MODULES, USE THIS TRACK

$mod3_0 = array();
array_push( $mod3_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod3_0, $question);
}
array_push( $mod3_0, ".woohoo", ".reward-1", ".congratulations" );

$mod3_1 = array();
array_push( $mod3_1, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod3_1, $question);
}
array_push( $mod3_1, ".yay", ".reward-2", ".bonus", ".reward-3", ".congratulations" );

$mod3_2 = array();
array_push( $mod3_2, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod3_2, $question);
}
array_push( $mod3_2, ".woohoo", ".reward-4", ".bonus", ".reward-5", ".complete" );

// IF THERE ARE 4 MODULES, USE THIS TRACK

$mod4_0 = array();
array_push( $mod4_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod4_0, $question);
}
array_push( $mod4_0, ".yay", ".reward-1", ".congratulations" );

$mod4_1 = array();
array_push( $mod4_1, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod4_1, $question);
}
array_push( $mod4_1, ".woohoo", ".reward-2", ".congratulations" );

$mod4_2 = array();
array_push( $mod4_2, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod4_2, $question);
}
array_push( $mod4_2, ".yay", ".reward-3", ".congratulations" );

$mod4_3 = array();
array_push( $mod4_3, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod4_3, $question);
}
array_push( $mod4_3, ".woohoo", ".reward-4", ".bonus", ".reward-5", ".complete" );

// IF THERE ARE 5 MODULES, USE THIS TRACK

$mod5_0 = array();
array_push( $mod5_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod5_0, $question);
}
array_push( $mod5_0, ".yay", ".reward-1", ".congratulations" );

$mod5_1 = array();
array_push( $mod5_1, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod5_1, $question);
}
array_push( $mod5_1, ".woohoo", ".reward-2", ".congratulations" );

$mod5_2 = array();
array_push( $mod5_2, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod5_2, $question);
}
array_push( $mod5_2, ".yay", ".reward-3", ".congratulations" );

$mod5_3 = array();
array_push( $mod5_3, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod5_3, $question);
}
array_push( $mod5_3, ".woohoo", ".reward-4", ".congratulations" );

$mod5_4 = array();
array_push( $mod5_4, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod5_4, $question);
}
array_push( $mod5_4, ".yay", ".reward-5", ".complete" );

// IF THERE ARE 6 MODULES, USE THIS TRACK

$mod6_0 = array();
array_push( $mod6_0, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_0, $question);
}
array_push( $mod6_0, ".woohoo", ".congratulations-no-reward" );

$mod6_1 = array();
array_push( $mod6_1, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_1, $question);
}
array_push( $mod6_1, ".yay", ".reward-1", ".congratulations" );

$mod6_2 = array();
array_push( $mod6_2, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_2, $question);
}
array_push( $mod6_2, ".woohoo", ".reward-2", ".congratulations" );

$mod6_3 = array();
array_push( $mod6_3, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_3, $question);
}
array_push( $mod6_3, ".yay", ".reward-3", ".congratulations" );

$mod6_4 = array();
array_push( $mod6_4, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_4, $question);
}
array_push( $mod6_4, ".woohoo", ".reward-4", ".congratulations" );

$mod6_5 = array();
array_push( $mod6_5, ".welcome" );
foreach ($questions as $question) {
  array_push( $mod6_5, $question);
}
array_push( $mod6_5, ".yay", ".reward-5", ".complete" );



// SELECT WHICH TRACK

$track = array();

if (($modules_complete == 0) && ($modules_total == 1)) {
  $track = $mod1_0;
}

if (($modules_complete == 0) && ($modules_total == 2)) {
  $track = $mod2_0;
}
if (($modules_complete == 1) && ($modules_total == 2)) {
  $track = $mod2_1;
}

if (($modules_complete == 0) && ($modules_total == 3)) {
  $track = $mod3_0;
}
if (($modules_complete == 1) && ($modules_total == 3)) {
  $track = $mod3_1;
}
if (($modules_complete == 2) && ($modules_total == 3)) {
  $track = $mod3_2;
}

if (($modules_complete == 0) && ($modules_total == 4)) {
  $track = $mod4_0;
}
if (($modules_complete == 1) && ($modules_total == 4)) {
  $track = $mod4_1;
}
if (($modules_complete == 2) && ($modules_total == 4)) {
  $track = $mod4_2;
}
if (($modules_complete == 3) && ($modules_total == 4)) {
  $track = $mod4_3;
}

if (($modules_complete == 0) && ($modules_total == 5)) {
  $track = $mod5_0;
}
if (($modules_complete == 1) && ($modules_total == 5)) {
  $track = $mod5_1;
}
if (($modules_complete == 2) && ($modules_total == 5)) {
  $track = $mod5_2;
}
if (($modules_complete == 3) && ($modules_total == 5)) {
  $track = $mod5_3;
}
if (($modules_complete == 4) && ($modules_total == 5)) {
  $track = $mod5_4;
}

if (($modules_complete == 0) && ($modules_total == 6)) {
  $track = $mod6_0;
}
if (($modules_complete == 1) && ($modules_total == 6)) {
  $track = $mod6_1;
}
if (($modules_complete == 2) && ($modules_total == 6)) {
  $track = $mod6_2;
}
if (($modules_complete == 3) && ($modules_total == 6)) {
  $track = $mod6_3;
}
if (($modules_complete == 4) && ($modules_total == 6)) {
  $track = $mod6_4;
}
if (($modules_complete == 5) && ($modules_total == 6)) {
  $track = $mod6_5;
}


?>

<?php // PROGRESS FARMER ?>

<div class="progress-farm">
  <div class="container">
    <div class="twelve columns">

      <div class="progress-farmer"></div>

        <?php

          for ($x = 0; $x < $questions_count; $x++) {
            ?>
            <div class="progress-farm-point" style="width: <?php echo (100/$questions_count); ?>%">
              <div class="progress-farm-point-sprout">
              </div>
              <div class="progress-farm-point-plant">
              </div>
            </div>
            <?php
          }
        ?>

    </div>
  </div>
</div>

<script type="text/javascript">

jQuery(document).ready(function($){

  jQuery('.play').hide();

	jQuery('.welcome').show();
  var step = 1;

  var track = <?php echo json_encode($track); ?>

  var distanceTraveled = 0;
  var interval = parseInt('<?php echo (100/$questions_count); ?>');
  var totalQuestions = parseInt('<?php echo $questions_count; ?>');

  function stopTheRain(){
    $('#page').snowfall('clear');
  }

  function makeItRain(){

    var rn = Math.floor(Math.random() * 4) + 1;
    var color = "#7f3198";
    var dark_color = "#5c007a";

    if (rn == 1) {
     color = "#7f3198";
     dark_color = "#5c007a";
    }
    else if (rn == 2) {
     color = "#f65163";
     dark_color = "#c04451";
    }
    else if (rn == 3) {
     color = "#0ed59c";
     dark_color = "#0bac7e";
    }
    else if (rn == 4) {
     color = "#0072bc";
     dark_color = "#005a94";
    }
    else {
     color = "#ffcd2b";
     dark_color = "#de9f27";
    }

    $('.page-template-login').css('background-color', color);
    $('.login-button').css('color', color);
    $('.login-button').hover(function() {
     $(this).css('background-color', dark_color);
     $(this).css('color', 'white');
    }, function() {
     $(this).css('background-color', 'white');
     $(this).css('color', color);
    });

    $('#page').snowfall({
     image :"http://gardens.bkfk-t5yk.accessdomain.com/wp-content/themes/WV-Gardens/img/fish.png", minSize: 10, maxSize:10, maxSpeed: 1, flakeCount: 10
    });


    $('.snowfall-flakes').each(function(i, el){
     var randomNumber = Math.floor(Math.random() * 21) + 1;

     var newSrc = "";

     if (randomNumber == 1) {
       newSrc = 'apple.png';
     }
     else if (randomNumber == 2) {
       newSrc = 'asparagus.png';
     }
     else if (randomNumber == 3) {
       newSrc = 'banana.png';
     }
     else if (randomNumber == 4) {
       newSrc = 'beans.png';
     }
     else if (randomNumber == 5) {
       newSrc = 'bread.png';
     }
     else if (randomNumber == 6) {
       newSrc = 'broccoli.png';
     }
     else if (randomNumber == 7) {
       newSrc = 'carrot.png';
     }
     else if (randomNumber == 8) {
       newSrc = 'cheese.png';
     }
     else if (randomNumber == 9) {
       newSrc = 'chicken.png';
     }
     else if (randomNumber == 10) {
       newSrc = 'eggs.png';
     }
     else if (randomNumber == 11) {
       newSrc = 'fish.png';
     }
     else if (randomNumber == 12) {
       newSrc = 'ham.png';
     }
     else if (randomNumber == 13) {
       newSrc = 'icecream.png';
     }
     else if (randomNumber == 14) {
       newSrc = 'Milk.png';
     }
     else if (randomNumber == 15) {
       newSrc = 'Noodles.png';
     }
     else if (randomNumber == 16) {
       newSrc = 'orange.png';
     }
     else if (randomNumber == 17) {
       newSrc = 'pasta.png';
     }
     else if (randomNumber == 18) {
       newSrc = 'pear.png';
     }
     else if (randomNumber == 19) {
       newSrc = 'pear.png';
     }
     else if (randomNumber == 20) {
       newSrc = 'rice.png';
     }
     else if (randomNumber == 21) {
       newSrc = 'yogurt.png';
     }
     else {

     }

     $(this).attr("src", "http://gardens.bkfk-t5yk.accessdomain.com/wp-content/themes/WV-Gardens/img/" + newSrc);
    });

  }

  jQuery('.start').click(function(){

    jQuery('.play').show();

    jQuery('.welcome').hide();
    jQuery('.question-1').show();

    jQuery(track[step]).find('.answer').addClass('bounceIn');

    step = step + 1;

    jQuery('.play').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).play();
      $(this).toggle();
      $('.stop').toggle();
    });

    jQuery('.stop').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).pause();
      document.getElementById(res).load();

      $('.play').toggle();
      $(this).toggle();
    });

  });

  jQuery('.next').click(function(){

    jQuery(track[step - 1]).hide();
    jQuery(track[step]).show();

    if (track[step] == ".yay" || track[step] == ".woohoo") {
      makeItRain();
    } else {
      stopTheRain();
    }

    jQuery(track[step]).find('.answer').addClass('bounceIn');
    jQuery(track[step]).find('.bonus-image img').addClass('bounceIn');

    if (track[step] == ".congratulations" || track[step] == ".complete") {
      jQuery('.progress-plate').hide();

      var data = JSON.stringify(answers);
      var rewardData = JSON.stringify(rewards);

      var rewardText = "";
      var len = Object.keys(rewards).length;
      var i = 1;
      jQuery.each( rewards, function( key, value ) {

        if (i == len) {
          rewardText = rewardText.concat(value);
        } else {
          rewardText = rewardText.concat(value + " and one ");
        }

        i = i + 1;

      });

      jQuery('.reward-item').text(rewardText);

      // Add rest of data to string
      jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=save_answer&answers=' + data + '&module=<?php echo $post->ID; ?>&user=<?php echo get_current_user_id(); ?>&class=<?php echo $class; ?>&reward=' + rewardData, success: function(result) {
        jQuery('.final-image').html(result);
      }});
    }

    step = step + 1;

    distanceTraveled = distanceTraveled + interval;

    if ((step - 2) < totalQuestions) {
      jQuery('.progress-farmer').css('left', distanceTraveled + '%');
    }

    var stop = 'audio-' + (step - 2);
    document.getElementById(stop).pause();
    document.getElementById(stop).load();

    $('.play').show();
    $('.stop').hide();

    jQuery('.play').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).play();

      $(this).hide();
      $('.stop').show();
    });

    jQuery('.stop').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).pause();
      document.getElementById(res).load();

      $(this).hide();
      $('.play').show();
    });


    //play on click (autoplay)
    console.log(autoplay);
    var res = 'audio-' + (step - 1);
    document.getElementById(res).play();

    jQuery('.play').hide();
    $('.stop').show();



  });

  jQuery('.prev').click(function(){

    if (step != 2) {
      step = step - 1;
      jQuery(track[step]).hide();
      jQuery(track[step - 1]).show();

      distanceTraveled = distanceTraveled - interval;

      if ((step - 2) >= 0) {
        jQuery('.progress-farmer').css('left', distanceTraveled + '%');
      }
    }

    var stop = 'audio-' + (step);
    document.getElementById(stop).pause();
    document.getElementById(stop).load();

    $('.play').show();
    $('.stop').hide();

    jQuery('.play').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).play();

      $('.stop').show();
      $(this).hide();
    });

    jQuery('.stop').click(function(){
      var res = 'audio-' + (step - 1);
      document.getElementById(res).pause();
      document.getElementById(res).load();

      $('.play').show();
      $(this).hide();
    });

  });




  var answers = {};
  var rewards = {};

  jQuery(".question").each(function() {

    var question = jQuery(this);
    var questionClass = '.' + jQuery(this).attr('class').split(' ')[1];
    var questionNum = jQuery(this).attr('class').split(' ')[2];

    question.find('.next').hide();

    jQuery(this).find(".answer").each(function() {
      jQuery(this).click(function() {

        // Make next button active
        question.find('.next').show();

        // First remove the current hovers
        for (var i = 1; i <= 4; i++) {
          question.find(".answer-image").removeClass('answer-image-' + i + '-hover');
          question.find(".answer-image").removeClass('answer-image-hover');
        }
        question.find('.answer').removeClass('answer-hover');

        // Next, add the new hover
        var answerClass = jQuery(this).attr('class').split(' ')[1];
        answerNum = answerClass.substr(answerClass.length - 1);

        jQuery(this).find('.answer-image').addClass('answer-image-' + answerNum + '-hover');
        jQuery(this).find('.answer-image').addClass('answer-image-hover');
        jQuery(this).addClass('answer-hover');

        answers[questionNum] = jQuery(this).find('.answer-text').text();

        // Next, update the progress bar
        jQuery('.progress-farm-point:eq(' + (step - 2) + ')').find('.progress-farm-point-plant').show();
        jQuery('.progress-farm-point:eq(' + (step - 2) + ')').find('.progress-farm-point-sprout').hide();

      });
    });
  });

  jQuery(".reward").each(function() {

    var rewardClass = jQuery(this).attr('class').split(' ')[1];
    var rewardNum = rewardClass.substr(rewardClass.length - 1);

    var reward = jQuery(this);

    reward.find('.next').hide();

    jQuery(this).find(".reward-answer").each(function() {

      jQuery(this).click(function() {

        reward.find('.next').show();

        // First, remove the other hovers
        jQuery(this).find(".reward-image").removeClass('reward-image-hover');
        jQuery('.reward-answer').removeClass('reward-hover');
        jQuery(".reward-image").removeClass('reward-image-hover');

        // Next, add the new hovers
        jQuery(this).find('.reward-image').addClass('reward-image-hover');
        jQuery(this).addClass('reward-hover');

        rewards[rewardNum] = jQuery(this).find('.reward-text').text();

        // Assign it to span on next page
        jQuery('.reward-item').text(jQuery(this).find('.reward-text').text());

      });

    });


  });

  // SEND IT TO THE DATABASE

  jQuery(".print").click(function() {

    if ((jQuery('.question').length - 1) == index) {

    } else {

      var currentQuestion = ('.question-').concat(index);
      index = index + 1;

      var nextQuestion = ('.question-').concat(index);

      jQuery(currentQuestion).hide();
      jQuery(nextQuestion).show();

    }

    jQuery('.progress-plate').hide();

    var data = JSON.stringify(answers);
    var rewardData = JSON.stringify(rewards);

    // // Add rest of data to string
    jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=save_answer&answers=' + data + '&module=<?php echo $post->ID; ?>&user=<?php echo get_current_user_id(); ?>&class=<?php echo $class; ?>&reward=' + rewardData, success: function(result) {
      jQuery('.final-image').html(result);
    }});

  });

  // jQuery(".menu-sound").mouseenter(function() {
  //     jQuery(this).find('i').toggleClass('fa-volume-up fa-volume-off');
  // }).mouseleave(function() {
  //     jQuery(this).find('i').toggleClass('fa-volume-up fa-volume-off');
  // });


});

</script>

<?php get_footer(); ?>
