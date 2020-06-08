
<?php
    include("unit_conversion_formulas.php");

    use function fahrenheit_to_celsius as f_to_c;
    use function celsius_to_fahrenheit as c_to_f;
    use function fahrenheit_to_kelvin as f_to_k;
    use function celsius_to_kelvin as c_to_k;
    use function kelvin_to_fahrenheit as k_to_f;
    use function kelvin_to_celsius as k_to_c;

    use function pounds_to_kilos as p_to_k;
    use function kilos_to_pounds as k_to_p;

    use function meters_to_yards as m_to_y;
    use function yards_to_meters as y_to_m;

    class ConvertedValue {
        function __construct($v = 0) {
            $this->value = $v;
        }
    }

    if (isset($_GET["temperature"])) {
        if (isset($_GET["direction"])) {
            if ($_GET["direction"] == "f_to_c") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=32&direction=f_to_c: {"value":0} 
                $my_converted_obj = new ConvertedValue(f_to_c(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "c_to_f") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=0&direction=c_to_f : {"value":32} 
                $my_converted_obj = new ConvertedValue(c_to_f(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "f_to_k") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=32&direction=f_to_k: {"value":273.15000000000003} 
                $my_converted_obj = new ConvertedValue(f_to_k(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "c_to_k") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=0&direction=c_to_k: {"value":273.15} 
                $my_converted_obj = new ConvertedValue(c_to_k(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "k_to_f") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=0&direction=k_to_f : {"value":-459.67} 
                $my_converted_obj = new ConvertedValue(k_to_f(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "k_to_c") {
                // http://localhost/unit_converter_v2_webservice.php?temperature=0&direction=k_to_c: {"value":-273.15} 
                $my_converted_obj = new ConvertedValue(k_to_c(floatval($_GET["temperature"])));
                echo json_encode($my_converted_obj);
            }
        }
    }

    if (isset($_GET["mass"])) {
        if (isset($_GET["direction"])) {
            if ($_GET["direction"] == "p_to_k") {
                // http://localhost/unit_converter_v2_webservice.php?mass=1&direction=p_to_k : {"value":0.4535147392290249} 
                $my_converted_obj = new ConvertedValue(p_to_k(floatval($_GET["mass"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "k_to_p") {
                // http://localhost/unit_converter_v2_webservice.php?mass=1&direction=k_to_p : {"value":2.2046} 
                $my_converted_obj = new ConvertedValue(k_to_p(floatval($_GET["mass"])));
                echo json_encode($my_converted_obj);
            }
        }
    }

    if (isset($_GET["distance"])) {
        if (isset($_GET["direction"])) {
            if ($_GET["direction"] == "m_to_y") {
                // http://localhost/unit_converter_v2_webservice.php?distance=1&direction=m_to_y : {"value":1.094} 
                $my_converted_obj = new ConvertedValue(m_to_y(floatval($_GET["distance"])));
                echo json_encode($my_converted_obj);
            } else if ($_GET["direction"] == "y_to_m") {
                // http://localhost/unit_converter_v2_webservice.php?distance=1&direction=y_to_m : {"value":0.9140767824497257} 
                $my_converted_obj = new ConvertedValue(y_to_m(floatval($_GET["distance"])));
                echo json_encode($my_converted_obj);
            }
        }
    }

?>

