<?php
class Manufacturer
{

    // database connection and table name
    private $conn;
    public $table_name = "manufacturer";

    // object properties
    public $manufacturername;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read car
    function fetchManufacturer()
    {

        // select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function addManufacturer(){
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                manufacturername=:manufacturername";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->manufacturername = htmlspecialchars(strip_tags($this->manufacturername));

        // bind values
        $stmt->bindParam(":manufacturername", $this->manufacturername);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
