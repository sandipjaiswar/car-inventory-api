<?php
class Car
{

    // database connection and table name
    private $conn;
    public $table_name = "cars";

    // object properties
    public $id;
    public $manufacturername;
    public $modelname;
    public $color;
    public $manufacturingyear;
    public $registrationno;
    public $note;
    public $image;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read car
    function read()
    {

        // select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update car form
    function readOne()
    {

        // query to read single record
        $query = "SELECT * FROM $this->table_name WHERE id = ?";;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of car to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->manufacturername = $row['manufacturername'];
        $this->modelname = $row['modelname'];
        $this->color = $row['color'];
        $this->manufacturingyear = $row['manufacturingyear'];
        $this->registrationno = $row['registrationno'];
        $this->note = $row['note'];
        $this->image = $row['image'];
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

    // create car
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                manufacturername=:manufacturername, modelname=:modelname, color=:color, note=:note";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->manufacturername = htmlspecialchars(strip_tags($this->manufacturername));
        $this->modelname = htmlspecialchars(strip_tags($this->modelname));
        $this->color = htmlspecialchars(strip_tags($this->color));
        // $this->registrationno = htmlspecialchars(strip_tags($this->registrationno));
        $this->note = htmlspecialchars(strip_tags($this->note));
        // $this->image = htmlspecialchars(strip_tags($this->image));


        // bind values
        $stmt->bindParam(":manufacturername", $this->manufacturername);
        $stmt->bindParam(":modelname", $this->modelname);
        $stmt->bindParam(":color", $this->color);
        // $stmt->bindValue(":registrationno", $this->registrationno);
        $stmt->bindParam(":note", $this->note);
        // $stmt->bindParam(":image", $this->image);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // read one car
    function deleteOne()
    {

        // select Filtered query
        $query = "DELETE
        FROM
            $this->table_name
        WHERE
            id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // update the product
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                id=:id,
                manufacturername = :manufacturername,
                modelname = :modelname,
                color = :color,
                registrationno = :registrationno
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->manufacturername = htmlspecialchars(strip_tags($this->manufacturername));
        $this->modelname = htmlspecialchars(strip_tags($this->modelname));
        $this->color = htmlspecialchars(strip_tags($this->color));
        // $this->manufacturingyear = htmlspecialchars(strip_tags($this->manufacturingyear));
        $this->registrationno = htmlspecialchars(strip_tags($this->registrationno));

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':manufacturername', $this->manufacturername);
        $stmt->bindParam(':modelname', $this->modelname);
        $stmt->bindParam(':color', $this->color);
        // $stmt->bindParam(':manufacturingyear', $this->manufacturingyear);
        $stmt->bindParam(':registrationno', $this->registrationno);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
