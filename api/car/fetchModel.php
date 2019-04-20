<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/model.php';

// instantiate database and model object
$database = new Database();
$db = $database->getConnection();

// initialize object
$model = new Model($db);
// query categorys
$stmt = $model->fetchmodel();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num > 0) {
    // model array
    $model_arr = array();
    $model_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            "model" => $model,
            "manufacturer" => $manufacturer
        );

        array_push($model_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show model data in json format
    echo json_encode($model_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no model found
    echo json_encode(
        array("message" => "No model found.")
    );
}
 
