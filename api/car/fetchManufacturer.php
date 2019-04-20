<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/manufacturer.php';

// instantiate database and Manufacturer object
$database = new Database();
$db = $database->getConnection();

// initialize object
$manufacturer = new Manufacturer($db);
// query categorys
$stmt = $manufacturer->fetchManufacturer();
$num = $stmt->rowCount();
// check if more than 0 record found
if ($num > 0) {
    // products array
    $products_arr = array();
    $products_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            "manufacturername" => $manufacturername
        );

        array_push($products_arr["records"], $product_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($products_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No Manufacturer found.")
    );
}
 
// no products found will be here
