<?php

get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">
      <div class="row">
        <div class="twelve columns">
          <div class="menu-bar">
            <div class="menu-title"><span class="menu-game-name">Game Name</span> <span class="menu-module-name"><?php the_title(); ?></span></div>
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
              <button class="next" style="display: inline-block;">Dig In!</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    if( have_rows('questions', $class) ):

      $i = 0;

      while ( have_rows('questions', $class) ) : the_row();

        $i++;
        // Your loop code
        $question = get_sub_field('question', $class);

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

                <?php

                if( have_rows('answers', $question->ID) ):
                  while ( have_rows('answers', $question->ID) ) : the_row();

                    ?>

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

                    <?php

                  endwhile;
                else:

                endif;

                ?>

            </div>
            <div class="row">
              <div class="three columns">
                <div class="module-section">
                  <button class="prev" style="display: inline-block;">Previous Question</button>
                </div>
              </div>
              <div class="three columns offset-by-six">
                <div class="module-section">
                  <button class="next" style="display: inline-block;">Next Question</button>
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

    <div class="question question-<?php echo $i; ?>">
      <div class="container">
        <div class="row">
          <div class="six columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>You've completed <span>GAME NAME</span> and filled your plate with healthy food!</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="module-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/foodplate.png" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <button class="next" style="display: inline-block;">Print My Full Healthy Plate</button>
            </div>
          </div>
        </div>
      </div>
    </div>

</main><!-- #main -->

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


</script>

<?php get_footer(); ?>
