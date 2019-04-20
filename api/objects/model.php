<?php
class Model
{

    // database connection and table name
    private $conn;
    public $table_name = "model";

    // object properties
    public $model;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read car
    function fetchModel()
    {

        // select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function addModel(){
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                model=:model,
                manufacturer=:manufacturer";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->manufacturer = htmlspecialchars(strip_tags($this->manufacturer));

        // bind values
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":manufacturer", $this->manufacturer);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
