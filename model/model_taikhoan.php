<?php 
// Thêm một tài khoản mới vào cơ sở dữ liệu
// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng accounts
function insert_taikhoan($name, $password, $email) {
    $sql = "INSERT INTO accounts (user_name, user_password, user_email)
            VALUE ('$name', '$password', '$email')";
    $result = pdo_query($sql);
    return $result;
}
// Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu với 
// email và mật khẩu đã cho hay không
function check_user($email, $password) {
    $sql = "SELECT * FROM accounts WHERE user_email='" . $email . "' AND user_password='" . $password . "'";
    $result = pdo_query_one($sql);
    return $result;
}
// Kiểm tra xem mật khẩu của người dùng 
// có đúng với ID đã cho hay không
function check_password($id, $password) {
    $sql = "SELECT * FROM accounts WHERE user_id = ? AND user_password = ? ";
    $result = pdo_query_one($sql, $id, $password);
    return $result;
}
// Cập nhật mật khẩu của người dùng
function update_password($id, $confirmPassword) {
    $sql = "UPDATE accounts SET user_password = ? WHERE user_id = ?";
    $updateStmt = pdo_execute($sql, $confirmPassword, $id);
    return $updateStmt;
}
// Cập nhật thông tin tài khoản người dùng
function update_thongtin($id, $name, $email, $address, $phone, $img) {
    $sql = "UPDATE accounts 
            SET user_name     = '" . $name    . "',
                user_email    = '" . $email   . "',
                user_address  = '" . $address . "',
                user_phone    = '" . $phone   . "',
                user_avatar   = '" . $img     . "'
            WHERE user_id=" . $id;
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["update_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}
// Cập nhật địa chỉ và số điện thoại của người dùng
function update_address_phone($id, $address, $phone) {
    $sql = "UPDATE accounts 
            SET user_address  = '" . $address . "',
                user_phone    = '" . $phone   . "'
            WHERE user_id=" . $id;
    try {
        pdo_execute($sql);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}
// Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
function check_email($email) {
    $sql = "SELECT * FROM accounts WHERE user_email='" . $email . "'";
    $result = pdo_query_one($sql);
    return $result;
}
// Lấy tất cả tài khoản người dùng từ cơ sở dữ liệu
function select_account() {
    $sql = "SELECT * FROM accounts ORDER BY role DESC, user_id ASC";
    $result = pdo_query( $sql);
    return $result;
}