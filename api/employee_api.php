<?php

header("Content-Type: application/json");

require_once 'database.php';
require_once '../class/Employee.php';

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Create Employee object
$employee = new Employee($db);

// Get HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // =========================
    // GET
    // =========================
    case 'GET':

        if (isset($_GET['id'])) {

            $employee->id = $_GET['id'];

            $stmt = $employee->getOne();
            $employeeData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($employeeData) {

                echo json_encode([
                    "status" => "success",
                    "data" => $employeeData
                ]);

            } else {

                http_response_code(404);

                echo json_encode([
                    "status" => "error",
                    "message" => "Employee not found"
                ]);
            }

        } else {

            $stmt = $employee->getAll();

            $employees = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $employees[] = $row;
            }

            echo json_encode([
                "status" => "success",
                "data" => $employees
            ]);
        }

        break;


    // =========================
    // POST
    // =========================
    case 'POST':

        $data = json_decode(file_get_contents("php://input"));

        if (
            !isset($data->first_name) ||
            !isset($data->last_name) ||
            !isset($data->email) ||
            !isset($data->department) ||
            !isset($data->salary)
        ) {

            http_response_code(400);

            echo json_encode([
                "status" => "error",
                "message" => "Missing required fields"
            ]);

            break;
        }

        $employee->first_name = $data->first_name;
        $employee->last_name = $data->last_name;
        $employee->email = $data->email;
        $employee->department = $data->department;
        $employee->salary = $data->salary;

        if ($employee->create()) {

            echo json_encode([
                "status" => "success",
                "message" => "Employee created successfully"
            ]);

        } else {

            http_response_code(500);

            echo json_encode([
                "status" => "error",
                "message" => "Unable to create employee"
            ]);
        }

        break;


    // =========================
    // PUT
    // =========================
    case 'PUT':

        $data = json_decode(file_get_contents("php://input"));

        if (
            !isset($data->id) ||
            !isset($data->first_name) ||
            !isset($data->last_name) ||
            !isset($data->email) ||
            !isset($data->department) ||
            !isset($data->salary)
        ) {

            http_response_code(400);

            echo json_encode([
                "status" => "error",
                "message" => "Missing required fields"
            ]);

            break;
        }

        $employee->id = $data->id;
        $employee->first_name = $data->first_name;
        $employee->last_name = $data->last_name;
        $employee->email = $data->email;
        $employee->department = $data->department;
        $employee->salary = $data->salary;

        if ($employee->update()) {

            echo json_encode([
                "status" => "success",
                "message" => "Employee updated successfully"
            ]);

        } else {

            http_response_code(500);

            echo json_encode([
                "status" => "error",
                "message" => "Unable to update employee"
            ]);
        }

        break;


    // =========================
    // DELETE
    // =========================
    case 'DELETE':

        if (!isset($_GET['id'])) {

            http_response_code(400);

            echo json_encode([
                "status" => "error",
                "message" => "Employee ID is required"
            ]);

            break;
        }

        $employee->id = $_GET['id'];

        if ($employee->delete()) {

            echo json_encode([
                "status" => "success",
                "message" => "Employee deleted successfully"
            ]);

        } else {

            http_response_code(500);

            echo json_encode([
                "status" => "error",
                "message" => "Unable to delete employee"
            ]);
        }

        break;


    // =========================
    // INVALID METHOD
    // =========================
    default:

        http_response_code(405);

        echo json_encode([
            "status" => "error",
            "message" => "Method not allowed"
        ]);

        break;
}
?>