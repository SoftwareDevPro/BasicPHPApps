<!DOCTYPE html>
<html>
    <head>
        <title>PHP Unit Converter</title>
    </head>
    <body>
        <?php //echo "GET: "; print_r($_GET); echo "\n"; ?>
        <?php // echo "POST: "; print_r($_POST); ?>

        <?php
            include("unit_conversion_formulas.php");
        ?>
   
        <br><br>
        
        <!-- Unit Conversions for Temperature -->
        <form action="unit_converter_v2.php" method="post">
            <span id="temperature_conversion">
                Temperature:  <input type="number" name="temperature" value="<?php 
                    if (isset($_POST["temperature"])) {
                        echo $_POST["temperature"]; 
                    }
                ?>"> 
                Converted:  <input type="number" name="converted"
                    value="<?php 
                        if (isset($_POST["temperature"])) {
                            if (isset($_POST["direction"])) {
                                if ($_POST["direction"] == "fahrenheit_to_celsius") {
                                    echo fahrenheit_to_celsius(floatval($_POST["temperature"]));
                                } else if ($_POST["direction"] == "celsius_to_fahrenheit") {
                                    echo celsius_to_fahrenheit(floatval($_POST["temperature"]));
                                } else if ($_POST["direction"] == "fahrenheit_to_kelvin") {
                                    echo fahrenheit_to_kelvin(floatval($_POST["temperature"]));
                                } else if ($_POST["direction"] == "celsius_to_kelvin") {
                                    echo celsius_to_kelvin(floatval($_POST["temperature"]));
                                } else if ($_POST["direction"] == "kelvin_to_fahrenheit") {
                                    echo kelvin_to_fahrenheit(floatval($_POST["temperature"]));
                                } else if ($_POST["direction"] == "kelvin_to_celsius") {
                                    echo kelvin_to_celsius(floatval($_POST["temperature"]));
                                }
                            }
                        }
                    ?>"
                > 
                <select name="direction">
                    <option value="fahrenheit_to_celsius">Fahrenheit -> Celsius</option>
                    <option value="celsius_to_fahrenheit">Celsius -> Fahrenheit</option>
                    <option value="fahrenheit_to_kelvin">Fahrenheit -> Kelvin</option>
                    <option value="celsius_to_kelvin">Celsius -> Kelvin</option>
                    <option value="kelvin_to_fahrenheit">Kelvin -> Fahrenheit</option>
                    <option value="kelvin_to_celsius">Kelvin -> Celsius</option>
                </select>
                <input type="submit" value="Convert">
            </span> <!-- temperature_conversion -->
        </form>

        <br><br>    <hr>       <br><br>

        <!-- Unit Conversions for Mass -->
        <form action="unit_converter_v2.php" method="post">
            <span id="mass_conversion">
                Mass:  <input type="number" name="mass" value="<?php 
                    if (isset($_POST["mass"])) {
                        echo $_POST["mass"]; 
                    }
                ?>"> 
                Converted:  <input type="number" name="converted"
                    value="<?php 
                        if (isset($_POST["mass"])) {
                            if (isset($_POST["direction"])) {
                                if ($_POST["direction"] == "pounds_to_kilos") {
                                    echo pounds_to_kilos(floatval($_POST["mass"]));
                                } else if ($_POST["direction"] == "kilos_to_pounds") {
                                    echo kilos_to_pounds(floatval($_POST["mass"]));
                                }
                            }
                        }
                    ?>"
                > 
                <select name="direction">
                    <option value="kilos_to_pounds">Kilos -> Pounds</option>
                    <option value="pounds_to_kilos">Pounds -> Kilos</option>
                </select>
                <input type="submit" value="Convert">
            </span> <!-- mass_conversion -->
        </form>
        
        <br><br>    <hr>       <br><br>


        <!-- Unit Conversions for Distance -->
        <form action="unit_converter_v2.php" method="post">
            <span id="distance_conversion">
                Distance:  <input type="number" name="distance" value="<?php 
                    if (isset($_POST["distance"])) {
                        echo $_POST["distance"]; 
                    }
                ?>"> 
                Converted:  <input type="number" name="converted"
                    value="<?php 
                        if (isset($_POST["distance"])) {
                            if (isset($_POST["direction"])) {
                                if ($_POST["direction"] == "meters_to_yards") {
                                    echo meters_to_yards(floatval($_POST["distance"]));
                                } else if ($_POST["direction"] == "yards_to_meters") {
                                    echo yards_to_meters(floatval($_POST["distance"]));
                                }
                            }
                        }
                    ?>"
                > 
                <select name="direction">
                    <option value="meters_to_yards">Meters -> Yards</option>
                    <option value="yards_to_meters">Yards -> Meters</option>
                </select>
                <input type="submit" value="Convert">
            </span> <!-- distance_conversion -->
        </form>

    </body>

</html>
