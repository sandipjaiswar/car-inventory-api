<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/car.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare car object
$car = new Car($db);
 
// set ID property of record to read
$car->registrationno = isset($_GET['registrationno']) ? $_GET['registrationno'] : die();
 
// read the details of car to be edited
$car->readOne();
 
if($car->manufacturername!=null){
    // create array
    $car_arr = array(
        "manufacturername" => $car->manufacturername,
        "modelname" => $car->modelname,
        "color" => $car->color,
        "registrationno" => $car->registrationno,
        "note" => $car->note 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($car_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user car does not exist
    echo json_encode(array("message" => "car does not exist."));
}
?>
