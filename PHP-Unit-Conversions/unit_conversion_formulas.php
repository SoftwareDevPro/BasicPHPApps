<?php

    // Fahrenheit --> Celsius
    function fahrenheit_to_celsius($f) {
        return ($f - 32.0) * (5.0/9);
    }

    // Celsius --> Fahrenheit
    function celsius_to_fahrenheit($c) {
        return  ($c * (9.0/5)) + 32.0;
    }
    
    // Fahrenheit --> Kelvin
    function fahrenheit_to_kelvin($f) {
        return  ($f + 459.67) * (5.0/9.0);
    }
    
    // Celsius --> Kelvin
    function celsius_to_kelvin($c) {
        return $c + 273.15;
    }
    
    // Kelvin --> Fahrenheit
    function kelvin_to_fahrenheit($k) {
        return  $k * (5.0/9.0) - 459.67;
    }
    
    // Kelvin --> Celsius
    function kelvin_to_celsius($k) {
        return $k - 273.15;
    }

    // Kilos --> Pounds
    function kilos_to_pounds($k) {
        return $k * 2.2046;
    }

    // Pounds --> Kilos
    function pounds_to_kilos($p) {
        return $p / 2.205;
    }

    // Meters --> Yards
    function meters_to_yards($m) {
        return $m * 1.094;
    }

    // Yards --> Meters
    function yards_to_meters($y) {
        return $y / 1.094;   
    }


