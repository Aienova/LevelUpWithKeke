<?php

header("Access-Control-Allow-Origin: https://127.0.0.1:8000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


header("Access-Control-Allow-Origin: http://localhost:3001");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$newversion = "777";

// Define the path to the JSON file

if(isset($_GET["style_name"])){

    $styleNameFile = $_GET["style_name"];
    $filePath = '../react-app/public/cuid-styles/custom_'.$newversion.'.css';

}else{

    $styleNameFile = "test";

    $filePath = '../react-app/public/cuid-styles/custom_'.$newversion.'.css';

}

// Retrieve all GET, POST, and COOKIE parameters
$allParameters = $_REQUEST;

// Convert the parameters to a JSON string
$jsonData = json_encode($allParameters, JSON_PRETTY_PRINT);

$data = json_decode($jsonData, true);


           /* // Write the updated JSON data back to the file
            if ( $_GET["mode"] == "multi") {

                $tempPath = "temp.json";

                if($_GET["count"] == 0){

                    $jsonData = "[".$jsonData.",";
                    file_put_contents($tempPath, $jsonData, FILE_APPEND);

                }

                elseif($_GET["count"] + 1 == $_GET["maxcount"]){

                    $jsonData = $jsonData."]";
                    file_put_contents($tempPath, $jsonData, FILE_APPEND);
                    file_put_contents($filePath, file_get_contents($tempPath));
                    file_put_contents($tempPath,"");

                }else{

                    $jsonData = $jsonData.",";
                    file_put_contents($tempPath, $jsonData, FILE_APPEND);
                }



            }
            */



            $bg = $data["backgroundImage"];
            $bgrepeat = $data["backgroundRepeat"];

            if($bg == "" || $bg == NULL){

                $bgimage = "none";

            }else{

                $bgimage = "url(".$bg.")";
            }


            if($bgrepeat == 1){

                $bgrepeat = "repeat";

            }else{

                $bgrepeat = "no-repeat";
            }

            

            $css ="


                @import url('https://127.0.0.1:8000/cuid/font.scss');


            .primary-color{

                background-color:".$data["primaryColor"].";
            
            }


            .secondary-color{

                background-color:".$data["secondaryColor"].";
            
            }


            .third-color{

                background-color:".$data["thirdColor"].";
            
            }


            header{

                background-color:".$data["headerColor"].";
            
            }

            h1,h2,h3{

            font-family:".$data["fontTitle"].";
            font-weight:".$data["fontTitleWeight"].";

            }

            body{

            background-image:".$bgimage.";
            background-repeat:".$bgrepeat.";
            font-family:".$data["fontText"].";
            font-weight:".$data["fontTextWeight"].";
            background-size: cover;
            }

            
            footer{

                background-color:".$data["footerColor"].";
            
            }
            
            ";

            

                file_put_contents($filePath, $css);

            

// Get the contents of the JSON file
$jsonVersionData = file_get_contents("version.json");

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonVersionData, true);

// Check if decoding was successful
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// Modify the data

$data["graphics"] = $newversion;   

// Update a value
/* $data['newKey'] = 'newElement';  // Add a new element
unset($data['keyToRemove']);     // Remove an element */

// Encode the array back to JSON
$newJsonData = json_encode($data, JSON_PRETTY_PRINT);

$versionArray = array(
    "version" => $newversion,

);

// Convert the array to a JSON string
$jsonString = json_encode($versionArray, JSON_PRETTY_PRINT);

// Write the updated JSON data back to the file
if (file_put_contents("version.json", $newJsonData)) {
    echo $jsonString;
} else {
    echo "Error writing to JSON file.";
}
?>
