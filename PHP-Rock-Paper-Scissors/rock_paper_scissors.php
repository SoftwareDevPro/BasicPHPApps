<!DOCTYPE html>
<html>
    <!--
    Simple game of Rock / Paper / Scissors with user interface and game statistics.
    -->

    <head>
        <title>PHP Rock Paper Scissors</title>
        <link rel="stylesheet" href="rock_paper_scissors.css">
        <script src="js/jquery-3.4.1.js"></script>

        <?php
            session_start();

            if (!isset($_SESSION["wins"])) {
                $_SESSION["wins"] = 0;
            }
            if (!isset($_SESSION["losses"])) {
                $_SESSION["losses"] = 0;
            }
        ?>

        <?php //echo "GET: "; print_r($_GET); ?>
        <?php //echo "POST: "; print_r($_POST); ?>
        <?php //echo "SESSION: "; print_r($_SESSION); ?>

        <?php

            $dice_roll_images = [
                "rock_paper_scissors_images/rock.jpg",
                "rock_paper_scissors_images/paper.jpg",
                "rock_paper_scissors_images/scissors.jpg"
            ];

            $rock_image = $dice_roll_images[0];
            $paper_image = $dice_roll_images[1];
            $scissors_image = $dice_roll_images[2];

            if (!isset($_SESSION["wins"])) {
                $wins = 0;
            } else {
                $wins = $_SESSION["wins"];
            }
            if (!isset($_SESSION["losses"])) {
                $losses = 0;
            } else {
                $losses = $_SESSION["losses"];
            }

            if (isset($_POST["reset"])) {
                $_SESSION["wins"] = 0;
                $_SESSION["losses"] = 0;
            }
        ?>
   
        <br><br>
        
        <form action="rock_paper_scissors.php" method="get">
            <span>
                Select a Move:<br>
                <input type="image" name="rock" id="rock" class="move_image" src="<?php echo $rock_image ?>" alt="rock">
                <input type="image" name="paper" id="paper" class="move_image"src="<?php echo $paper_image ?>" alt="paper">
                <input type="image" name="scissors" id="scissors" class="move_image"src="<?php echo $scissors_image ?>" alt="scissors">
                <br><br>
                Wins: <input type="text" name="wins" id="wins" value="<?php
                    if (isset($_SESSION["wins"])) {
                        echo $_SESSION["wins"];
                    } else {
                        echo "0";
                    }
                ?>">
                Losses: <input type="text" name="losses" id="losses" value="<?php
                    if (isset($_SESSION["losses"])) {
                        echo $_SESSION["losses"];
                    } else {
                        echo "0";
                    }
                ?>">
                Percentage Wins: <input type="text" name="percentage_wins" value="<?php
                    $num_losses = 0;
                    $num_wins = 0;

                    if (isset($_SESSION["losses"])) {
                        $num_losses = $_SESSION["losses"];
                    }
                    if (isset($_SESSION["wins"])) {
                        $num_wins = $_SESSION["wins"];
                    }

                    if ($num_wins + $num_losses == 0) {
                        echo "0%";
                    } else {
                        echo round(($num_wins / ($num_wins + $num_losses))*100.0, 2);
                        echo "%";
                    }
                ?>">

                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" id="reset" name="reset" value="reset" formmethod="post" formaction="rock_paper_scissors.php">
            </span>                        
        </form>


        <span>
            <?php 
                if (isset($_GET["rock_x"]) || isset($_GET["scissors_x"]) || isset($_GET["paper_x"])) {
                    echo "<br><br>Computer Selected Move<br><br>";

                    $computer_move = mt_rand(1, 3);
                    $selected = "";

                    if (isset($_GET["rock_x"])) {
                        $selected = "rock";
                    }
                    if (isset($_GET["paper_x"])) {
                        $selected = "paper";
                    }
                    if (isset($_GET["scissors_x"])) {
                        $selected = "scissors";
                    }

                    if ($selected != "") {
                        if ($computer_move == 1) {
                            // rock
                            echo "<img id='computer_image' src='$rock_image'>";

                            if ($selected == "rock") {
                                echo "<br>Its a tie!";
                            } else if ($selected == "paper") { 
                                echo "<br>Player Wins!";
                                $_SESSION["wins"] += 1;
                            } else if ($selected == "scissors") {
                                echo "<br>Computer Wins!";
                                $_SESSION["losses"] += 1;                            
                            }
                        } else if ($computer_move == 2) {
                            // paper
                            echo "<img id='computer_image' src='$paper_image'>";

                            if ($selected == "rock") {
                                echo "<br>Computer Wins!";
                                $_SESSION["losses"] += 1;                            
                            } else if ($selected == "paper") { 
                                echo "<br>Its a tie!";
                            } else if ($selected == "scissors") {
                                echo "<br>Player Wins!";
                                $_SESSION["wins"] += 1;                            
                            }   
                        } else if ($computer_move == 3) {
                            // scissors
                            echo "<img id='computer_image' src='$scissors_image'>";

                            if ($selected == "rock") {
                                echo "<br>Player Wins!";
                                $_SESSION["wins"] += 1;                            
                            } else if ($selected == "paper") { 
                                echo "<br>Computer Wins!";
                                $_SESSION["losses"] += 1;                            
                            } else if ($selected == "scissors") {
                                echo "<br>Its a tie!";
                            }
                        }
                    }
                }

            ?>
        </span>
    </body>
</html>

