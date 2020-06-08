<!DOCTYPE html>
<html>
    <head>
        <title>PHP Dice Roll Simulator</title>
        <link rel="stylesheet" type="text/css" href="dice_roll.css" />
        <link rel="icon" href="dice_roll_favicon.ico" type="image/x-icon" />
    </head>
    <body>
        <?php //echo "GET: "; print_r($_GET); echo "\n"; ?>
        <?php //echo "POST: "; print_r($_POST); ?>

        <!--
            Simple game of Dice Roll.
            
            Build a guessing game where you enter a number from 1 to 6 
            and then roll the dice to see if you were correct.
        -->

        <?php
            $dice_roll_images = [
                "dice_images/01.jpg",
                "dice_images/02.jpg",
                "dice_images/03.jpg",
                "dice_images/04.jpg",
                "dice_images/05.jpg",
                "dice_images/06.jpg"
            ];

            $one_die_image = $dice_roll_images[0];
            $two_die_image = $dice_roll_images[1];
            $three_die_image = $dice_roll_images[2];
            $four_die_image = $dice_roll_images[3];
            $five_die_image = $dice_roll_images[4];
            $six_die_image = $dice_roll_images[5];

            // The maximum number of seconds to roll the die
            define("MAX_TIME_ROLL", 6);

            // allow for easy switch to/from _GET / _POST
            $method = $_GET;
            
        ?>

        <form class="dice-input" action="dice_roll.php" method="get">
            <div>
                <label class="number-guess-label" for="number_guess">
                    Number Guess:
                </label>
                <input class="number-guess-input" type="number" name="number_guess" value="<?php
                    // Put the number back in when it POSTS back
                    if (isset($method["number_guess"])) {
                        echo $method["number_guess"]; 
                    }
                ?>"> 
                <input class="number-guess-submit" type="submit" value="Roll The Dice">
            </div>
        </form>

        <?php
            $num1 = mt_rand(1, 6);
            $num2 = mt_rand(1, 6);
            $style = "display: block; margin: 20px auto; width: 100px; height: 100px;";

            switch($num1) {
                case 1:
                    echo "<img style='" . $style . "' src='" . $one_die_image . "'/>";
                    break;
                case 2:
                    echo "<img style='" . $style . "' src='" . $two_die_image . "'/>";
                    break;
                case 3:
                    echo "<img style='" . $style . "' src='" . $three_die_image . "'/>";
                    break;
                case 4:
                    echo "<img style='" . $style . "' src='" . $four_die_image . "'/>";
                    break;
                case 5:
                    echo "<img style='" . $style . "' src='" . $five_die_image . "'/>";
                    break;
                case 6:
                    echo "<img style='" . $style . "' src='" . $six_die_image . "'/>";
            }

            switch($num2) {
                case 1:
                    echo "<img style='" . $style . "' src='" . $one_die_image . "'/>";
                    break;
                case 2:
                    echo "<img style='" . $style . "' src='" . $two_die_image . "'/>";
                    break;
                case 3:
                    echo "<img style='" . $style . "' src='" . $three_die_image . "'/>";
                    break;
                case 4:
                    echo "<img style='" . $style . "' src='" . $four_die_image . "'/>";
                    break;
                case 5:
                    echo "<img style='" . $style . "' src='" . $five_die_image . "'/>";
                    break;
                case 6:
                    echo "<img style='" . $style . "' src='" . $six_die_image . "'/>";
            }

            if (isset($method["number_guess"])) {
                if ($method["number_guess"] == ($num1 + $num2)) {
                    echo "<div class='result'>You Guessed Correctly</div>";
                } else {
                    echo "<div class='result'>Try Again!</div>";
                }
            }
        ?>

    </body>
</html>
