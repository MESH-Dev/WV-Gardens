jQuery(document).ready(function($){

  $snowfall = false;

  if ($("#login-flag").length > 0) {

      var rn = Math.floor(Math.random() * 4) + 1;
      var color = "#7f3198";

      if (rn == 1) {
        color = "#7f3198";
      }
      else if (rn == 2) {
        color = "#f65163";
      }
      else if (rn == 3) {
        color = "#0ed59c";
      }
      else if (rn == 4) {
        color = "#0072bc";
      }
      else {
        color = "#ffcd2b";
      }

      $('.page-template-login').css('background-color', color);
      $('.login-button').css('color', color);

      $(document).snowfall({
        image :"http://localhost/gardens/wp-content/themes/WV-Gardens/img/fish.png", minSize: 10, maxSize:10, maxSpeed: 1, flakeCount: 10
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
          newSrc = 'noodles.png';
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

        $(this).attr("src", "http://localhost/gardens/wp-content/themes/WV-Gardens/img/" + newSrc);
      });




  }

});
