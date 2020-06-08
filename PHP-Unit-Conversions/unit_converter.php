<!DOCTYPE html>
<html>
    <head>
        <title>PHP Unit Converter</title>
    </head>
    <body>
        <?php //echo "GET: "; print_r($_GET); echo "\n"; ?>
        <?php // echo "POST: "; print_r($_POST); ?>

        <?php
            function to_celsius($f) {
                //echo $f;
                return ($f - 32.0) * (5.0/9);
            }

            function to_fahrenheit($c) {
                //echo $c;
                return  ($c * (9.0/5)) + 32.0;
            }
        ?>


        <form action="unit_converter.php" method="post">
            <span>
                Temperature:  <input type="number" name="temperature" value="<?php 
                    if (isset($_POST["temperature"])) {
                        echo $_POST["temperature"]; 
                    }
                ?>"> 
                Converted:  <input type="number" name="converted"
                    value="<?php 
                        if (isset($_POST["temperature"])) {
                            if (isset($_POST["direction"])) {
                                if ($_POST["direction"] == "to_celsius") {
                                    echo to_celsius(floatval($_POST["temperature"]));
                                } else {
                                    // to_fahrenheit
                                    echo to_fahrenheit(floatval($_POST["temperature"]));
                                }
                            }
                        }
                    ?>"
                > 
                <select name="direction">
                    <option value="to_celsius">Celsius</option>
                    <option value="to_fahrenheit">Fahrenheit</option>
                </select>
                <input type="submit" value="Convert">
                
            </span>
        </form>
    </body>
</html>
