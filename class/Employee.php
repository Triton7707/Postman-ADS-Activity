<?php

class Employee
{
    private $conn;
    private $table = "employees";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $department;
    public $salary;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL EMPLOYEES
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // GET ONE EMPLOYEE
    public function getOne()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt;
    }

    // CREATE EMPLOYEE
    public function create()
    {
        $query = "INSERT INTO " . $this->table . "
                  (first_name, last_name, email, department, salary)
                  VALUES
                  (:first_name, :last_name, :email, :department, :salary)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":salary", $this->salary);

        return $stmt->execute();
    }

    // UPDATE EMPLOYEE
    public function update()
    {
        $query = "UPDATE " . $this->table . "
                  SET
                    first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    department = :department,
                    salary = :salary
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":salary", $this->salary);

        return $stmt->execute();
    }

    // DELETE EMPLOYEE
    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>