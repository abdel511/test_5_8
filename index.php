<?php

    // Receiver Email Address (where to send email notification)
    $email_address = "nnone1723@gmail.com";

    // Keep this API Key value to be compatible with the ESP code provided in the project page. If you change this value, the ESP sketch needs to match
    $api_key_value = "tPmAT5Ab3j7F9";

    $api_key = $value1 = $value2 = $value3 = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = test_input($_POST["api_key"]);
        if($api_key == $api_key_value) {
            $value1 = test_input($_POST["humidite_actuelle"]);
            $value2 = test_input($_POST["humidite_souhaitee"]);
            $value3 = NOW();
            
            // Email message
            $email_msg = "Humidite actuelle: " . $value1 . "%\nHumidite souhaitee: " . $value2 . "%\nDate de mesure: " . $value3;
            
            // Use wordwrap() if lines are longer than 70 characters
            $email_msg = wordwrap($email_msg, 70);
            
            // Uncomment the next if statement to set a threshold 
            // ($value1 = temperature, $value2 = humidity, $value3 = pressure)
            /*if($value1 < 24.0){
                echo "Temperature below threshold, don't send email";
                exit;
            }*/
            
            // send email with mail(receiver email address, email subject, email message)
            mail($email_address, "[NEW] ESP sensors readings", $email_msg);
            
            echo "Email envoye.";
        }
        else {
            echo "API Key incorrect!";
        }

    }else {
        echo "No data posted with HTTP POST.";
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
