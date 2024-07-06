<?php 

namespace App\Models;

use PDO;

class Review {
    private $db;
    private $table = 'reviews';

    public $product_id;
    public $user_id;
    public $review_text;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table . " (product_id, user_id, review_text) VALUES (:product_id, :user_id, :review_text)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':review_text', $this->review_text);

        return $stmt->execute();
    }
}