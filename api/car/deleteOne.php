<?php
// required headers
header ("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/car.php';
include_once '../objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare car object
$car = new Car($db);

// get car id
$data = json_decode(file_get_contents("php://input"));

// set car id to be deleted
$car->id = $data->registrationno;

// delete the car
if ($car->deleteOne()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "car was deleted."));
}

// if unable to delete the car
else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete car."));
}
