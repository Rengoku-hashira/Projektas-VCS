<?php
$request_uri = $_SERVER['REQUEST_URI'];

$request_uri = strtok($request_uri, '?');

if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif|svg|ico)$/', $request_uri)) {
    // Determine content type based on file extension
    $extension = pathinfo($request_uri, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'css':
            header("Content-Type: text/css");
            break;
        case 'js':
            header("Content-Type: application/javascript");
            break;
        case 'png':
            header("Content-Type: image/png");
            break;
        case 'jpg':
        case 'jpeg':
            header("Content-Type: image/jpeg");
            break;
        case 'gif':
            header("Content-Type: image/gif");
            break;
        case 'svg':
            header("Content-Type: image/svg+xml");
            break;
        case 'ico':
            header("Content-Type: image/x-icon");
            break;
        default:
            header("Content-Type: application/octet-stream");
            break;
    }
    readfile(__DIR__ . $request_uri);
    exit;
}

switch ($request_uri) {
    case '/api/visitors':
        include 'server/api.php';
        break;
    case '/init-db':
        include 'server/init_database.php';
        break;
    case '/':
        include 'carshow.html';
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Not Found"]);
        break;
}
