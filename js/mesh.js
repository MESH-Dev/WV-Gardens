jQuery(document).ready(function($){

  $snowfall = false;

  if ($("#login-flag").length > 0) {

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

});
