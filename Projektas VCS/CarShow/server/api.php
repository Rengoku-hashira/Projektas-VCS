<?php
header("Content-Type: application/json");
include 'database.php'; // Include your database connection logic

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        getVisitors();
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        insertVisitor($data);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}

function getVisitors()
{
    global $connection;

    $sql = "SELECT * FROM visitors";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
    } else {
        echo json_encode(["message" => "No visitors found"]);
    }

    $connection->close();
}

function insertVisitor($data) {
    global $connection;

    $sql = "INSERT INTO visitors (
                first_name,
                last_name,
                email,
                phone_number,
                car_manufacturer,
                car_model,
                car_build_year,
                car_engine_capacity,
                car_engine_power_kw,
                license_plate_number,
                car_modifications
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssssss",
        $data->first_name,
        $data->last_name,
        $data->email,
        $data->phone_number,
        $data->car_manufacturer,
        $data->car_model,
        $data->car_build_year,
        $data->car_engine_capacity,
        $data->car_engine_power_kw,
        $data->license_plate_number,
        $data->car_modifications
    );

    try {
        $stmt->execute();
        $response = ["message" => "Visitor inserted successfully"];
    } catch (Exception $e) {
        http_response_code(500);
        $response = ["error" => "Error inserting visitor: " . $e->getMessage()];
    }

    echo json_encode($response);

    $stmt->close();
    $connection->close();
}
