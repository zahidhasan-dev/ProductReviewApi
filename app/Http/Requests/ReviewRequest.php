<?php

namespace App\Http\Requests;

class ReviewRequest {
    protected $errors = [];

    public function __construct(array $attributes)
    {
        if (!isset($attributes['product_id']) || !is_numeric($attributes['product_id'])) {
            $this->error("product_id", "Product ID is required and must be numeric");
        }
        
        if (!isset($attributes['user_id']) || !is_numeric($attributes['user_id'])) {
            $this->error("user_id", "User ID is required and must be numeric");
        }
        
        if (!isset($attributes['review_text']) || empty(trim($attributes['review_text']))) {
            $this->error("review_text", "Review text is required and must not be empty");
        }
    }

    public static function validate(array $attributes)
    {
        $instance = new static($attributes);

        return $instance;
    }

    public function fails()
    {
        return count($this->errors) > 0;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error(string $field, string $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}