jQuery(document).ready(function($){

  $snowfall = false;

  if ($("#login-flag").length > 0) {
    if ($snowfall == false) {
      $(document).snowfall({
        image :"http://localhost/gardens/wp-content/themes/WV-Gardens/img/apple.png", minSize: 70, maxSize:100, maxSpeed: 1, flakeCount: 20
      });
      $snowfall = true;

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
          newSrc = 'milk.png';
        }
        else if (randomNumber == 15) {
          newSrc = 'oatmeal.png';
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


    } else {
      $(document).snowfall('clear');
      $snowfall = false;
    }

  }

});
