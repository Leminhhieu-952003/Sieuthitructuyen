<?php 
//  Đếm số lượng hàng trong một bảng cơ sở dữ liệu
function numRowTable($table){
    $sql = "SELECT * FROM $table ";
    $result = pdo_query($sql);
    $num = 0;
    foreach ($result as $item){
        $num++;
    }
    return $num;
}
// Tính tổng doanh thu từ bảng bills
function revenue(){
    $sql = "SELECT SUM(bills.bill_total) AS revenue FROM bills";
    $result = pdo_query_one($sql);
    return $result;
}
// Thống kê số lượng đơn hàng theo từng ngày trong vòng 7 ngày qua
function statis(){
    // Chuẩn bị câu lệnh SQL để lấy ngày (DATE(bill_time)) và
    //  đếm số lượng đơn hàng (COUNT(*)) từ bảng bills
    $sql = "SELECT DATE(bill_time) AS order_date, COUNT(*) AS total_orders 
    FROM bills 
    -- Điều kiện lọc (WHERE) chỉ lấy các đơn hàng 
    -- có thời gian (bill_time) trong khoảng từ 7 ngày trước 
    -- cho đến ngày hiện tại.
    WHERE bill_time >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
    AND bill_time <= CURDATE()
    -- Nhóm kết quả theo ngày (GROUP BY DATE(bill_time))
    GROUP BY DATE(bill_time);";
    $result = pdo_query($sql);
    return $result;
}