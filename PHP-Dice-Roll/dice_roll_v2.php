<!DOCTYPE html>
<html>
    <head>
        <title>PHP Dice Roll Simulator</title>
        <link rel="stylesheet" type="text/css" href="dice_roll.css" />
        <link rel="icon" href="dice_roll_favicon.ico" type="image/x-icon" />
    </head>
    <body>

        <script>
            function getRandomInt(max) {
                return Math.floor(Math.random() * Math.floor(max));
            }

            function baseName(str) {
                let base = new String(str).substring(str.lastIndexOf('/') + 1); 
                if (base.lastIndexOf(".") != -1) {
                    base = base.substring(0, base.lastIndexOf("."));
                }       
                return base;
            }                
        </script>

        <?php //echo "GET: "; print_r($_GET); echo "\n"; ?>
        <?php //echo "POST: "; print_r($_POST); ?>

        <!--
            Simple game of Dice Roll.
            
            Build a guessing game where you enter a number from 1 to 6 
            and then roll the dice to see if you were correct.
        -->

        <?php

            // allow for easy switch to/from _GET / _POST
            $method = $_POST;
            
        ?>

        <form class="dice-input" action="dice_roll_v2.php" method="post">
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

        <table align="center">
            <tr>
                <td>
                    <img id="die1" class=".die" />
                </td>
                <td>
                    <img id="die2" class=".die" /> 
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <div id="result" class='result'></div>
                </td
            </tr>
        </table>


        <script>

            let dice_roll_images = [
                "dice_images/01.jpg",
                "dice_images/02.jpg",
                "dice_images/03.jpg",
                "dice_images/04.jpg",
                "dice_images/05.jpg",
                "dice_images/06.jpg"
            ];

            let num_seconds = 3;

            document.getElementById("die1").src = 
                dice_roll_images[getRandomInt(5)];

            document.getElementById("die2").src = 
                dice_roll_images[getRandomInt(5)];

            let interval = setInterval(function() {
                
                document.getElementById("die1").src = 
                    dice_roll_images[getRandomInt(5)];

                document.getElementById("die2").src = 
                    dice_roll_images[getRandomInt(5)];

            }, 100);

            setTimeout(function() {
                
                clearInterval(interval);
                
                console.log("die1: " + parseInt(baseName(document.getElementById("die1").src)));
                console.log("die2: " + parseInt(baseName(document.getElementById("die2").src)));

                const urlParams = new URLSearchParams(window.location.search);
                const numberGuess = urlParams.get('number_guess');          

                console.log("numberGuess := " + numberGuess);

                let num1 = parseInt(baseName(document.getElementById("die1").src));
                let num2 = parseInt(baseName(document.getElementById("die2").src));

                if (parseInt(numberGuess) == (num1 + num2)) {
                    document.getElementById("result").innerHTML = "You Guessed Correctly";
                } else {
                    document.getElementById("result").innerHTML = "Try Again!";
                }

            }, num_seconds * 1000);

                                                        
        </script>

    </body>
</html>
