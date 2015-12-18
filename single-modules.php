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
            <?php get_template_part( 'partials/progress', 'plate' ); ?>
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
              <button class="next" style="display: inline-block;">Dig In!<div class="next-arrow"></div></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php

    if( have_rows('questions') ):

      $i = 0;
      $q = 0;

      while ( have_rows('questions') ) : the_row();

        $i++;
        $q++;
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

                <?php

                  if( have_rows('answers', $question->ID) ):

                      $n = 0;

                      while ( have_rows('answers', $question->ID) ) : the_row();

                        $n++;

                      ?>

                          <div class="three columns">
                            <div class="answer answer-<?php echo $n; ?>">
                                <div class="answer-image answer-image-<?php echo $n; ?>">

                                  <?php

                                    $image = get_sub_field('image', $question->ID);
                                    $size = 'large';
                                    $thumb = $image['sizes'][ $size ];

                                  ?>

                                  <img src="<?php echo $thumb; ?>" />

                                </div>
                                <div class="answer-text"><?php echo get_sub_field('answer', $question->ID); ?></div>
                            </div>
                          </div>

                      <?php

                      endwhile;

                  else :

                      // no rows found

                  endif;

                ?>


              <?php else: ?>

                <div class="three columns offset-by-three">
                  <div class="answer answer-2">
                      <?php // echo get_sub_field('b'); ?>
                      <div class="answer-image answer-image-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/little.png" />
                      </div>
                      <div class="answer-text">Yes</div>
                  </div>
                </div>
                <div class="three columns">
                  <div class="answer answer-3">
                      <?php // echo get_sub_field('c'); ?>
                      <div class="answer-image answer-image-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/much.png" />
                      </div>
                      <div class="answer-text">No</div>
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
      elseif($post->post_name == "module-6") {
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
            <div class="reward reward-1">
              <div class="reward-image-container">
                <div class="reward-image reward-image-1">
                </div>
              </div>
              <div class="reward-text"><?php echo $reward1; ?></div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward reward-2">
              <div class="reward-image-container">
                <div class="reward-image reward-image-2">
                </div>
              </div>
              <div class="reward-text"><?php echo $reward2; ?></div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward reward-3">
              <div class="reward-image-container">
                <div class="reward-image reward-image-3">
                </div>
              </div>
              <div class="reward-text"><?php echo $reward3; ?></div>
            </div>
          </div>
          <div class="three columns">
            <div class="reward reward-4">
                <?php // echo get_sub_field('a'); ?>
                <div class="reward-image-container">
                  <div class="reward-image reward-image-4">
                  </div>
                </div>
                <div class="reward-text"><?php echo $reward4; ?></div>
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
              <button class="print" style="display: inline-block;">Print My Full Healthy Plate</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $i++; ?>

    <div class="question question-<?php echo $i; ?>">
      <div class="container">
        <div class="row">
          <div class="six columns">
            <div class="module-text">
              <h1>Congratulations!</h1>
              <h1>You've added one <span class="reward-item"></span> to your plate.</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <div class="module-image">
              <?php get_template_part( 'partials/progress', 'plate' ); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="three columns offset-by-nine">
            <div class="module-section">
              <a href="<?php echo get_home_url(); ?>/modules/"><button class="return" style="display: inline-block;">Return to Home <div class="return-arrow"></div></button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

</main><!-- #main -->

<div class="progress-farm">
  <div class="container">
    <div class="twelve columns">

      <div class="progress-farmer">

      </div>


      <?php

        for ($x = 0; $x < $q; $x++) {

          ?>

          <div class="progress-farm-point" style="width: <?php echo (100/$q); ?>%">
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

<?php

  $m = $post->ID;

  $sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();

  global $wpdb;
  $class_row = $wpdb->get_row( $sql , ARRAY_A );

  $class = (int)$class_row['class_id'];

?>



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

    // Store all the answers in an array

  });

  jQuery('.prev').click(function(){

    var currentQuestion = ('.question-').concat(index);
    index = index - 1;
    var prevQuestion = ('.question-').concat(index);

    jQuery(currentQuestion).hide();
    jQuery(prevQuestion).show();

  });


  var answers = {};

  var t = 0;
  var p = parseInt('<?php echo (100/$q); ?>');
  var q = parseInt('<?php echo $q; ?>');

  var questions = [];

  jQuery(".question").each(function() {

    var questionId = jQuery(this).attr('class').split(' ')[1];

    var question = jQuery(this);

    if (questionId != 'question-0') {
      jQuery(this).find('.next').hide();
    }

    questions.push(0);

    jQuery(this).find(".answer").each(function() {

      jQuery(this).click(function() {

        // Make next button active

        var questionClass = '.' + questionId;

        // First remove the current hovers

        for (var i = 1; i <= 4; i++) {
          jQuery(questionClass + " .answer-image").removeClass('answer-image-' + i + '-hover');
        }

        jQuery(questionClass + ' .answer').removeClass('answer-hover');

        // Next, add the new hover

        var answerId = jQuery(this).attr('class').split(' ')[1];
        answerNum = answerId.substr(answerId.length - 1);

        jQuery('.question-' + questionId.substr(questionId.length - 1) + ' .next').show();

        jQuery(this).find('.answer-image').addClass('answer-image-' + answerNum + '-hover');
        jQuery(this).addClass('answer-hover');

        answers[questionId.substr(questionId.length - 1)] = jQuery(this).find('.answer-text').text();

        // Next, update the progress bar

        jQuery('.progress-farm-point:eq(' + (questionId.substr(questionId.length - 1) - 1) + ')').find('.progress-farm-point-plant').show();
        jQuery('.progress-farm-point:eq(' + (questionId.substr(questionId.length - 1) - 1) + ')').find('.progress-farm-point-sprout').hide();

        if ((questions[questionId.substr(questionId.length - 1)] == 0) && (q != (questionId.substr(questionId.length - 1)))) {
          t = t + p;

          jQuery('.progress-farmer').css('left', t + '%');
          questions[questionId.substr(questionId.length - 1)] = 1;
        }

      });

    });


    jQuery(this).find(".reward").each(function() {

      jQuery(this).click(function() {

        jQuery(".reward-image").removeClass('reward-image-hover');
        jQuery('.reward').removeClass('reward-hover');

        // Next, add the new hover

        var rewardId = jQuery(this).attr('class').split(' ')[1];
        rewardNum = rewardId.substr(rewardId.length - 1);

        jQuery(this).find('.reward-image').addClass('reward-image-hover');
        jQuery(this).addClass('reward-hover');

        jQuery('.reward-item').text(jQuery(this).find('.reward-text').text());

      });

    });


  });


  jQuery(".print").click(function() {

    if ((jQuery('.question').length - 1) == index) {

    } else {

      var currentQuestion = ('.question-').concat(index);
      index = index + 1;

      var nextQuestion = ('.question-').concat(index);

      jQuery(currentQuestion).hide();
      jQuery(nextQuestion).show();

    }


    var data = JSON.stringify(answers);

    // Add rest of data to string
    jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=save_answer&answers=' + data + '&module=<?php echo $m; ?>&user=<?php echo get_current_user_id(); ?>&class=<?php echo $class; ?>&reward=' + jQuery('.reward-hover').find('.reward-text').text(), success: function(result) {
      alert(result);
    }});

  });


</script>

<?php get_footer(); ?>
