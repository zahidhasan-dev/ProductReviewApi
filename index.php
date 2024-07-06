<?php 

require_once 'core/Database.php';
require_once 'core/Response.php';
require_once 'app/Models/Review.php';
require_once 'app/Http/Controllers/ReviewController.php';
require_once 'app/Http/Requests/ReviewRequest.php';

use Core\Database;
use Core\Response;
use App\Http\Controllers\ReviewController;
use App\Models\Review;

$dbConfig = require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    Response::json([
        'status' => 'error',
        "error" => [
            'code' => 405,
            'message' => "Only POST method is allowed"
        ],
    ], 405);
}

try {
    $database = new Database($dbConfig['host'], $dbConfig['dbname'], $dbConfig['username'], $dbConfig['password']);
    $db = $database->getConnection();

    $review = new Review($db);
    
    $controller = new ReviewController($review);
    $controller->store();
} catch (Exception $e) {
    Response::json([
        'status' => 'error',
        "error" => [
            'code' => 500,
            'message' => $e->getMessage()
        ]
    ], 500);
}