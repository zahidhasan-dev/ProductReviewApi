
## Installation

1. **Clone the Repository**

    ```sh
    git clone https://github.com/zahidhasan-dev/ProductReviewApi.git
    cd ProductReviewApi
    ```

2. **Set Up the Database**

    Create a MySQL database named `product_reviews` and a table named `reviews`.

    ```sql
    CREATE DATABASE product_reviews;

    USE product_reviews;

    CREATE TABLE reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        user_id INT NOT NULL,
        review_text TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

## Running the API

Ensure your web server is configured to serve the `index.php` file and accessible via `http://localhost/ProductReviewApi/index.php`.

## Testing the API

You can test the API using tools like Postman or cURL.

### Using Postman

1. Open Postman.
2. Set the request type to POST.
3. Enter the URL `http://localhost/ProductReviewApi/index.php`.
4. In the body section, select `raw`.
4. Add the following JSON data:
   {"product_id": 1, "user_id": 1, "review_text": "Great product!"}
5. Send the request.

### Using cURL

```sh
curl -X POST http://localhost/ProductReviewApi/index.php \
    -H "Content-Type: application/json" \
    -d '{"product_id": 1, "user_id": 1, "review_text": "Great product!"}'
