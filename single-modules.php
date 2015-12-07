<?php

if ( !is_user_logged_in() ) {

  wp_redirect( get_home_url() );
    exit;
}

get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">
      <div class="row">
        <div class="twelve columns">
          <div class="menu-bar">
            <a href="<?php echo get_home_url(); ?>/modules/"><div class="menu-title"><span class="menu-game-name">Game Name</span> <span class="menu-module-name"><?php the_title(); ?></span></div></a>
            <div class="menu-sound"><i class="fa fa-volume-up"></i></div>
          </div>

          <div class="progress-plate">
            <img src="<?php echo get_template_directory_uri(); ?>/img/plate.png" />
          </div>
        </div>
      </div>
    </div>


    <div class="question question-0">
      <div class="container">
        <div class="row">
          <div class="six columns">
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
              <button class="next" style="display: inline-block;">
                Dig In!
                <div class="next-arrow"></div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    if( have_rows('questions') ):

      $i = 0;

      while ( have_rows('questions') ) : the_row();

        $i++;
        // Your loop code
        $question = get_sub_field('question');

        ?>

        <div class="question question-<?php echo $i; ?>">
          <div class="container">
            <div class="row">
              <div class="six columns">
                <div class="module-text">
                  <h3 class="module-number"><?php echo $i; ?>.</h3>
                  <h1><?php echo $question->post_title; ?></h1>
                </div>
              </div>
              <div class="six columns">
                <div class="module-image">
                  <?php

                  // vars

                    $display_image = get_field('display_image', $question->ID);

                    $size = 'large';
                    $thumb = $display_image['sizes'][ $size ];

                  ?>

                  <img src="<?php echo $thumb; ?>" />
                </div>
              </div>
            </div>
            <div class="row">

              <?php if( get_field('question_type', $question->ID) == 'multiple' ): ?>

                <div class="three columns">
                  <div class="answer">
                      <?php // echo get_sub_field('a'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/star.png)" class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/lot.png" />
                      </div>
                      <div class="answer-text">
                        A lot
                      </div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer">
                      <?php // echo get_sub_field('b'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/circle.png") class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/little.png" />
                      </div>
                      <div class="answer-text">
                        A little
                      </div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer">
                      <?php // echo get_sub_field('c'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/cloud.png") class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/much.png" />
                      </div>
                      <div class="answer-text">
                        Not very much
                      </div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer">
                      <?php // echo get_sub_field('d'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/x.png") class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/all.png" />
                      </div>
                      <div class="answer-text">
                        Not at all
                      </div>
                  </div>
                </div>

              <?php else: ?>

                <div class="three columns offset-by-three">
                  <div class="answer">
                      <?php // echo get_sub_field('b'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/circle.png") class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/little.png" />
                      </div>
                      <div class="answer-text">
                        Yes
                      </div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer">
                      <?php // echo get_sub_field('c'); ?>
                      <div style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/cloud.png") class="answer-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/much.png" />
                      </div>
                      <div class="answer-text">
                        No
                      </div>
                  </div>
                </div>

              <?php endif; ?>

            </div>
            <div class="row">
              <div class="three columns">
                <div class="module-section">
                  <button class="prev" style="display: inline-block;">
                    <div class="prev-text">Previous Question</div>
                    <div class="prev-arrow"></div>
                  </button>
                </div>
              </div>
              <div class="three columns offset-by-six">
                <div class="module-section">
                  <button class="next" style="display: inline-block;">
                    <div class="next-text">Next Question</div>
                    <div class="next-arrow"></div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php

      endwhile;

    else :

        // no rows found

    endif;

    ?>

    <?php

    $i++;



    ?>

    <?php

      if ($post->post_name == "module-1") {
        $reward1 = "Asparagus";
        $reward2 = "Broccoli";
        $reward3 = "Carrot";
        $reward4 = "Green Beans";
      }
      elseif ($post->post_name == "module-2") {
        $reward1 = "Banana";
        $reward2 = "Apple";
        $reward3 = "Orange";
        $reward4 = "Pear";
      }
      elseif ($post->post_name == "module-3") {
        $reward1 = "Oatmeal";
        $reward2 = "Bread";
        $reward3 = "Pasta";
        $reward4 = "Rice";
      }
      elseif($post->post_name == "module-4") {
        $reward1 = "Ham";
        $reward2 = "Eggs";
        $reward3 = "Fish";
        $reward4 = "Chicken";
      }
      elseif($post->post_name == "module-5") {
        $reward1 = "Yogurt";
        $reward2 = "Cheese";
        $reward3 = "Milk";
        $reward4 = "Ice Cream";
      }
      else {

      }

    ?>

    <div class="question question-<?php echo $i; ?>">
      <div class="container">
        <div class="row">
          <div class="six columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>You've completed <span><?php the_title(); ?></span>. You get to add one <span>veggie</span> to your plate.</h1>
            </div>
          </div>
          <div class="six columns">
            <div class="module-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/farmer.png" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="three columns">
            <div class="reward">
              <div class="reward-image-container">
                <div class="reward-image reward-image-1">
                </div>
              </div>
              <div class="answer-text">
                <?php echo $reward1; ?>
              </div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward">
              <div class="reward-image-container">
                <div class="reward-image reward-image-2">
                </div>
              </div>
              <div class="answer-text">
                <?php echo $reward2; ?>
              </div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward">
              <div class="reward-image-container">
                <div class="reward-image reward-image-3">
                </div>
              </div>
              <div class="answer-text">
                <?php echo $reward3; ?>
              </div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward">
                <?php // echo get_sub_field('a'); ?>
                <div class="reward-image-container">
                  <div class="reward-image reward-image-4">
                  </div>
                </div>
                <div class="answer-text">
                  <?php echo $reward4; ?>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="three columns">
            <div class="module-section">
              <button class="prev" style="display: inline-block;">
                <div class="prev-text">Previous Question</div>
                <div class="prev-arrow"></div>
              </button>
            </div>
          </div>
          <div class="three columns offset-by-six">
            <div class="module-section">
              <button class="next" style="display: inline-block;">Print My Full Healthy Plate</button>
            </div>
          </div>
        </div>
      </div>
    </div>

</main><!-- #main -->

<div class="progress-farm">
  <div class="container">
    <div class="twelve columns">

      <?php

        for ($x = 0; $x < $i; $x++) {

          ?>

          <div class="progress-farm-point" style="width: <?php echo (100/$i); ?>%">
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

	jQuery('.question-0').show();
  var index = 0;

  jQuery('.next').click(function(){

    if ((jQuery('.question').length - 1) == index) {

    } else {
      var currentQuestion = ('.question-').concat(index);
      index = index + 1;
      var nextQuestion = ('.question-').concat(index);

      jQuery(currentQuestion).hide();
      jQuery(nextQuestion).show();
    }

  });

  jQuery('.prev').click(function(){

    var currentQuestion = ('.question-').concat(index);
    index = index - 1;
    var prevQuestion = ('.question-').concat(index);

    jQuery(currentQuestion).hide();
    jQuery(prevQuestion).show();

  });


</script>

<?php get_footer(); ?>
