<?php 

function insert_binhluan($text, $userId, $productId, $date) {
    $sql = "INSERT INTO comments (comment_text, user_id, product_id, comment_date) 
            VALUES ('$text', '$userId', '$productId', '$date')";
    try {
        pdo_execute($sql);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function select_binhluan($productId) {
    $sql = "SELECT comments.*, accounts.user_name
            FROM comments
            JOIN accounts ON comments.user_id = accounts.user_id
            WHERE comments.product_id = "  .$productId . "
            ORDER BY comments.comment_date ASC;";
    $result = pdo_query( $sql);
    return $result;
}
function showAllComment(){
    $sql = "SELECT * FROM comments";
    $result = pdo_query($sql);
    return $result;
}
function deleteComment($commentId){
    $sql = "DELETE FROM comments WHERE comment_id = $commentId ";
    pdo_query($sql);
}