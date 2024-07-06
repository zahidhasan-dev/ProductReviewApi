<?php 

namespace App\Http\Controllers;

use Core\Response;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;

class ReviewController {
    private $review;

    public function __construct(Review $review) {
        $this->review = $review;
    }

    public function store() {
        // get form data
        $data = json_decode(file_get_contents("php://input"), true);

        // validate form data
        $request = ReviewRequest::validate($data);
        
        // check if validation fails
        if($request->fails()) {
            Response::json([
                'status' => 'fail',
                'error' => [
                    'code' => 400,
                    'message' => "There was a validation error"
                ],
                'errors' => $request->errors()
            ], 400);
        }

        // if validation passes then create review
        $this->review->product_id = $data['product_id'];
        $this->review->user_id = $data['user_id'];
        $this->review->review_text = $data['review_text'];

        $saveResult = $this->review->save();

        if ($saveResult) {
            return Response::json([
                'status' => 'success',
                'message' => "Review submitted successfully"
            ], 201);
        }

        return Response::json([
            'status' => 'error',
            "error" => [
                'code' => 500,
                'message' => "Failed to submit review"
            ],
        ], 500);
    }
}