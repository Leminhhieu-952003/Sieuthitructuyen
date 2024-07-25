<?php
// Hệ thống quản lý nội dung 
// Xử lý các yêu cầu thông qua URL và thực hiện các hành động
// như hiển thị , CRUD ,...
require_once '../model/pdo.php';
require_once '../model/model_danhmuc.php';
require_once '../model/model_sanpham.php';
require_once '../model/model_binhluan.php';
require_once '../model/model_taikhoan.php';
require_once '../model/model_thongke.php';
require_once '../model/model_giohang.php';
require_once './admin_header.php';

// Kiểm tra xem có tham số "page"trong URL không
if (isset($_GET["page"])) {
    // Gán giá trị "page" cho biến "trang"
    $trang = $_GET["page"];
    switch ($trang) {
        // <======================= Controler Danh Mục =======================>
        case 'danh-sach-danh-muc':
            $listCategories = select_danhmuc();
            require './categories/danhmuc_list.php';
            break;

        case 'them-danh-muc':
            // kiểm tra người dùng bấm nút thêm mới
            if (isset($_POST["btnAdd"])) {
                $categoryName = $_POST["tenDanhMuc"];
                insert_danhmuc($categoryName);
            }
            require './categories/danhmuc_create.php';
            break;

        case 'xoa-danh-muc':
            if (isset($_GET["id"]) && ($_GET["id"]) > 0) {
                delete_danhmuc($_GET["id"]);
            }
            $listCategories = select_danhmuc();
            require './categories/danhmuc_list.php';
            break;

        case 'sua-danh-muc':
            if (isset($_GET["id"]) && ($_GET["id"]) > 0) {
                $result = select_one_danhmuc($_GET["id"]);
            }
            require './categories/danhmuc_update.php';
            break;

        case 'cap-nhat-danh-muc':
            // kiểm tra người dùng bấm nút lưu
            if (isset($_POST["btnUpdate"])) {
                $categoryId   = $_POST["maDanhMuc"];
                $categoryName = $_POST["tenDanhMuc"];
                update_danhmuc($categoryId, $categoryName);
            }
            $listCategories = select_danhmuc();
            require './categories/danhmuc_list.php';
            break;

        // <======================= Controler Sản Phẩm =======================>
        case 'danh-sach-san-pham':
            // Lấy danh sach cả sản phẩm dựa trên tên sản phẩm và danh mục
            if (isset($_POST["btnSearch"])) {
                $productName = $_POST["inputSearch"];
                $categoryId  = $_POST["selectDanhMuc"];
            } else {
                $productName = '';
                $categoryId  = 0;
            }

            $listCategories = select_danhmuc();
            $listProducts   = select_sanpham($productName, $categoryId);
            require './products/sanpham_list.php';
            break;

        case 'them-san-pham':
            // kiểm tra người dùng bấm nút thêm mới
            if (isset($_POST["btnAdd"])) {
                $categoryId          = $_POST["maDanhMucSP"];
                $productName         = $_POST["tenSanPham"];
                $productPrice        = $_POST["giaSanPham"];
                $productDescription  = $_POST["moTaSanPham"];
                // Kiểm tra tệp hình ảnh có được tải lên không
                if (isset($_FILES["hinhSanPham"]) && $_FILES["hinhSanPham"]["error"] == 0) {
                    $fileName    = $_FILES["hinhSanPham"]['name'];
                    $target_dir  = "../upload/";
                    $target_file = $target_dir . basename($_FILES["hinhSanPham"]["name"]);
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["hinhSanPham"]["tmp_name"], $target_file)) {
                        // File uploaded successfully, now insert into the database
                        insert_sanpham($productName, $productPrice, $fileName, $productDescription, $categoryId);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $_SESSION["no_file"] = true;
                }
            }
            $listCategories = select_danhmuc();
            require './products/sanpham_create.php';
            break;

        case 'xoa-san-pham':
            if (isset($_GET["id"]) && ($_GET["id"]) > 0) {
                delete_sanpham($_GET["id"]);
            }
            $listProducts = select_sanpham('', 0);
            require './products/sanpham_list.php';
            break;

        case 'sua-san-pham':
            if (isset($_GET["id"]) && ($_GET["id"]) > 0) {
                $result = select_one_sanpham($_GET["id"]);
            }
            $listCategories = select_danhmuc();
            require './products/sanpham_update.php';
            break;

        case 'cap-nhat-san-pham':
            // kiểm tra người dùng bấm nút lưu
            if (isset($_POST["btnUpdate"])) {
                $categoryId          = $_POST["boxDanhMuc"];
                $productId           = $_POST["maSanPham"];
                $productName         = $_POST["tenSanPham"];
                $productPrice        = $_POST["giaSanPham"];
                $productDescription  = $_POST["moTaSanPham"];
                $imgCurrent          = $_POST['img-current'];
                $fileName            = '';
                // Check if a file was selected
                if (isset($_FILES["hinhSanPham"]) && $_FILES["hinhSanPham"]["error"] == 0) {
                    $fileName     = $_FILES["hinhSanPham"]['name'];
                    $target_dir   = "../upload/";
                    $target_file  = $target_dir . basename($_FILES["hinhSanPham"]["name"]);
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["hinhSanPham"]["tmp_name"], $target_file)) {
                        // File uploaded successfully, now insert into the database
                        update_sanpham($productId, $productName, $productPrice, $fileName, $productDescription, $categoryId);
                        header("Location: index.php?page=cap-nhat-san-pham");
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    update_sanpham($productId, $productName, $productPrice, $imgCurrent, $productDescription, $categoryId);
                }
            }
            $listCategories = select_danhmuc();
            $listProducts   = select_sanpham('', 0);
            require './products/sanpham_list.php';
            break;
        case 'khach-hang':
            $listUsers = select_account();
            require './users/users.php';
            break;

        case 'binh-luan':
            $listComments = showAllComment();
            require './comments/comments.php';
            break;
            
        case 'xoa-binh-luan':
        $commentId = (isset($_GET["id"])) ? $_GET["id"] : "";
        deleteComment($commentId);
        $listComments = showAllComment();
        require './comments/comments.php';
        break;

        /* -------------------------------- ĐƠN HÀNG -------------------------------- */
        case 'don-hang':
            $listBills = selectAllBill();
            require './bills/donhang_list.php';
            break;
        case 'xoa-don-hang':
            $billId = $_GET["id"];
            if(deleteBill($billId)){
                header("Location: ?page=don-hang");
            }
            break;
        case 'don-hang-chi-tiet':
            $billId = $_GET["id"];
            $billDetail = select_one_bill($billId);
            if(!empty($billDetail)){
                require './bills/donhangchitiet.php';
            }
            break;
        /* -------------------------------- ĐƠN HÀNG -------------------------------- */
        default:
            // Tính toán số liệu từ các bảng
            $numUser = numRowTable('accounts');
            $numComment = numRowTable('comments');
            $numBill = numRowTable('bills');
            // Tính tổng doanh thu
            $numRevenue = revenue();
            // Chuẩn bị dữ liệu cho biểu đồ
            $result = statis();
            $labels = [];
            $data = [];
            foreach ($result as $row){
                $labels[] = $row['order_date'];
                $data[] = $row['total_orders'];
            }
            require './statistics/statistics.php';
            break;
        }
} else {
    // NUM
    $numUser = numRowTable('accounts');
    $numComment = numRowTable('comments');
    $numBill = numRowTable('bills');
    $numRevenue = revenue();
    // DATA CHART
    $result = statis();
    $labels = [];
    $data = [];
    foreach ($result as $row){
        $labels[] = $row['order_date'];
        $data[] = $row['total_orders'];
    }
    require './statistics/statistics.php';
}

require_once './admin_footer.php';
