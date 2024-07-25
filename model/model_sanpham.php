<?php

function select_sanpham($tenSP = '', $maDM = 0) {
    $sql = "SELECT * FROM products WHERE 1 ";
    if ($tenSP != '') {
        $sql .= " AND product_name LIKE '%" . $tenSP . "%' ";
    }
    if ($maDM > 0) {
        $sql .= " AND category_id = '" . $maDM . "' ";
    }
    $sql .= " ORDER BY products.product_id ASC";
    $result = pdo_query($sql);
    return $result;
}

function insert_sanpham($name, $price, $image, $description, $categoryId) {
    $sql = "INSERT INTO products (product_name, product_price, product_image, product_description, category_id)
            VALUES ('$name', '$price', '$image', '$description', '$categoryId')";
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["add_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function delete_sanpham($id) {
    $sql = "DELETE FROM products WHERE product_id=" . $id;
    pdo_execute($sql);
}

function select_one_sanpham($id) {
    $sql = "SELECT * FROM products WHERE product_id=" . $id;
    $result = pdo_query_one($sql);
    return $result;
}

function update_sanpham($id, $name, $price, $image, $description, $categoryId) {
    if ($image != '') {
        $sql = "UPDATE products 
                SET product_name        = '" . $name        . "',
                    product_price       = '" . $price       . "',
                    product_image       = '" . $image       . "',
                    product_description = '" . $description . "',
                    category_id         = '" . $categoryId  . "' WHERE product_id=" . $id;
    } else {
        $sql = "UPDATE products 
                SET product_name        = '" . $name        . "',
                    product_price       = '" . $price       . "',
                    product_description = '" . $description . "',
                    category_id         = '" . $categoryId  . "' WHERE product_id=" . $id;
    }

    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["update_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function select_sanpham_home() {
    $sql = "SELECT * FROM products WHERE 1 ORDER BY product_view DESC LIMIT 0,9";
    $result = pdo_query($sql);
    return $result;
}

function select_sanpham_all() {
    $sql = "SELECT * FROM products WHERE 1 ORDER BY product_view DESC";
    $result = pdo_query($sql);
    return $result;
}

function select_sanpham_top10() {
    $sql = "SELECT * FROM products WHERE 1 ORDER BY product_view DESC LIMIT 0,10";
    $result = pdo_query($sql);
    return $result;
}

function select_sanpham_same($maSanPham, $maDanhMuc) {
    $sql = "SELECT * FROM products WHERE category_id=" . $maDanhMuc . " AND product_id<>" . $maSanPham;
    $result = pdo_query($sql);
    return $result;
}

function select_ten_danhmuc($id) {
    if ($id > 0) {
        $sql = "SELECT * FROM categories WHERE category_id=" . $id;
        $result = pdo_query_one($sql);
        extract($result);
        return $category_name;
    } else {
        return '';
    }
}