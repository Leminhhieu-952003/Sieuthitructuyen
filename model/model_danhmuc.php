<?php

function select_danhmuc() {
    $sql = "SELECT * FROM categories ORDER BY category_name ASC";//Tăng dần
    $result = pdo_query( $sql);
    return $result;
}
// Thêm mới vào bảng
function insert_danhmuc($name) {
    $sql = "INSERT INTO categories (category_name) VALUES ('$name')";
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["add_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}
// Xóa một danh mục khỏi bảng dựa trên "category_id"
function delete_danhmuc($id) {
    $sql = "DELETE FROM categories WHERE category_id=" . $id;
    pdo_execute($sql);
}
// Lấy thông tin một danh mục cụ thể dựa trên "category_id"
function select_one_danhmuc($id) {
    $sql = "SELECT * FROM categories WHERE category_id=" . $id;
    $result = pdo_query_one($sql);
    return $result;
}
// Cập nhật tên của  của một danh mục dựa trên "category_id"
function update_danhmuc($id, $name) {
    $sql = "UPDATE categories SET category_name = '" . $name . "' WHERE category_id=" . $id;
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["update_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}