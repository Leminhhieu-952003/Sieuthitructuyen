<?php
// 1. Khởi tạo và Kết nối

// Nhúng các file cần thiết, bao gồm kết nối cơ sở dữ liệu (pdo.php), 
// các mô hình dữ liệu (model_*.php), 
// và các view (header.php, variable.php)
session_start();
require_once './model/pdo.php';
require_once './model/model_danhmuc.php';
require_once './model/model_sanpham.php';
require_once './model/model_taikhoan.php';
require_once './model/model_giohang.php';
require_once './views/header.php';
require_once './variable.php';

// 2.Khởi tạo Giỏ Hàng

//  Kiểm tra và khởi tạo giỏ hàng nếu chưa tồn tại.
if (!isset($_SESSION["myCart"])) {
    $_SESSION["myCart"] = [];
}

// 3.Lấy Dữ Liệu

// Gọi các hàm để lấy dữ liệu từ cơ sở dữ liệu như danh mục, 
// sản phẩm trên trang chính, 
// tất cả sản phẩm 
// và top 10 sản phẩm.
$selectCategories  = select_danhmuc();
$selectProducts    = select_sanpham_home();
$selectAllProducts = select_sanpham_all();
$selectTop10       = select_sanpham_top10();

// 4.Xử Lý Các Trang Theo Yêu Cầu

if (isset($_GET["page"])) {
    // Xác định trang yêu cầu từ URL và xử lý theo từng giá trị của biến $trang.
    $trang = $_GET["page"];
    switch ($trang) {

        //------------------------------------------------ĐĂNG NHẬP//------------------------------------------------ //
        case 'dang-ky':
            //  Xử lý đăng ký tài khoản.
            if (isset($_POST['btnRegister'])) {
                $name     = $_POST["name"];
                $password = $_POST["password"];
                $email    = $_POST["email"];
                $check = check_email($email);
                if (is_array($check)) {
                    $_SESSION["email_exists"] = true;
                } else {
                    insert_taikhoan($name, $password, $email);
                    $_SESSION["register_success"] = true;
                }
            }
            require './views/account/register.php';
            break;

        case 'dang-nhap':
            // Xử lý đăng nhập
            if (isset($_POST['btnLogin'])) {
                $email    = $_POST["email"];
                $password = $_POST["password"];
                $check    = check_user($email, $password);
                if (is_array($check)) {
                    $_SESSION["user"] = $check;
                    echo '<script>window.location.href = "index.php";</script>';
                } else {
                    echo "<script>alert('Đăng nhập thất bại');</script>";
                    echo '<script>window.location.href = "index.php";</script>';
                }
            }
            require './views/account/register.php';
            break;

        case 'dang-xuat':
            // Xử lý đăng xuất
            session_unset();
            echo '<script>window.location.href = "index.php";</script>';
            break;

        case 'settings-profile':
            // Xử lí cài đặt thông tin người dùng
            // settings.php
            if (isset($_POST['btnSave'])) {
                $id         = $_POST["id"];
                $name       = $_POST["name"];
                $email      = $_POST["email"];
                $address    = $_POST["address"];
                $phone      = $_POST["phone"];
                $imgCurrent = $_POST['img-current'];
                $fileName   = '';
                // Check if a file was selected
                if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
                    $fileName     = $_FILES["avatar"]['name'];
                    $target_dir   = "./upload/";
                    $target_file  = $target_dir . basename($_FILES["avatar"]["name"]);
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        // File uploaded successfully, now insert into the database
                        update_thongtin($id, $name, $email, $address, $phone, $fileName);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    update_thongtin($id, $name, $email, $address, $phone, $imgCurrent);
                }
                $_SESSION["user"] = check_email($email);
            }
            require './views/account/settings.php';
            break;


        case 'forgot-password':
            // Xử lý quên mật khẩu
            if (isset($_POST['btnSendEmail'])) {
                $email = $_POST["email"];
                $check = check_email($email);
                if (is_array($check)) {
                    $_SESSION["show_password"] = $check;
                } else {
                    $_SESSION["email_error"] = true;
                }
            }
            require './views/account/fogotPassword.php';
            break;

        case 'change-password':
            // Xử lý thay đổi mật khẩu
            if (isset($_POST['btnChangePassword'])) {
                $id        = $_SESSION['user']['user_id'];
                $presentpw = $_POST["presentPassword"];
                $newpw     = $_POST["newPassword"];
                $confirmpw = $_POST["confirmPassword"];

                $check = check_password($id, $presentpw);

                if (is_array($check)) {
                    $newpw     = trim($newpw);
                    $confirmpw = trim($confirmpw);

                    if ($newpw === $confirmpw) {
                        $updateResult = update_password($id, $confirmpw);
                        if (!$updateResult) {
                            $_SESSION['success'] = array('😊 Mật khẩu đã được thay đổi. ✔');
                        }
                    } else {
                        $_SESSION['error'] = array('☹️ Mật khẩu không khớp! ❌');
                    }
                } else {
                    $_SESSION['error'] = array('☹️ Mật khẩu hiện tại không đúng! ❌');
                }
            }
            require './views/account/changePassword.php';
            break;

        //------------------------------------------------SẢN PHẨM------------------------------------------------ //
        case 'san-pham':
            // Xử lý tìm kiếm và lọc sản phẩm
            if (isset($_POST["inputTenSP"]) && ($_POST["inputTenSP"]) != '') {
                $productName = $_POST["inputTenSP"];
            } else {
                $productName = '';
            }
            if (isset($_GET["category-id"]) && ($_GET["category-id"]) > 0) {
                $categoryId = $_GET["category-id"];
            } else {
                $categoryId = 0;
            }
            $listProducts = select_sanpham($productName, $categoryId);
            $categoryName = select_ten_danhmuc($categoryId);
            require './views/sanpham.php';
            break;

        case 'chi-tiet-san-pham':
            // Hiển thị chi tiết sản phẩm
            if (isset($_GET["product-id"]) && ($_GET["product-id"]) > 0) {
                $oneItem  = select_one_sanpham($_GET["product-id"]);
                extract($oneItem);
                $sameItem = select_sanpham_same($_GET["product-id"], $category_id);
                require './views/chitietsanpham.php';
            } else {
                require './views/trangchu.php';
            }
            break;

        case 'tat-ca-san-pham':
            // Hiển thị tất cả sản phẩm
            $listAllProducts = select_sanpham_all();
            require './views/tatcasanpham.php';
            break;
        //------------------------------------------------GIỎ HÀNG------------------------------------------------ //
        case 'view-cart':
            // Hiển thị giỏ hàng
            require './views/cart/viewCart.php';
            break;

        case 'add-to-cart':
            // Thêm sản phẩm vào giỏ hàng.
            if (isset($_POST['btnAddToCart'])) {
                $id       = $_POST["idsp"];
                $name     = $_POST["tensp"];
                $image    = $_POST["imgsp"];
                $qty      = $_POST["hiddenQty"];;
                $price    = $_POST["hiddenPrice"];
                $item = [$id, $name, $image, $qty, $price];
                // Check sản phẩm có sẵn trong cart
                $itemExists = false;
                foreach ($_SESSION["myCart"] as &$updateItem) {
                    if ($updateItem[0] == $id) {
                        // cập nhật qty
                        $updateItem[3] += $qty;
                        $itemExists = true;
                        break;
                    }
                }
                // Nếu sản phẩm không có trong cart
                if (!$itemExists) {
                    $item = [$id, $name, $image, $qty, $price];
                    $_SESSION["myCart"][] = $item;
                }
            }
            require './views/cart/viewCart.php';
            break;

        case 'delete-one-item':
            // Xóa một sản phẩm khỏi giỏ hàng
            $id = (isset($_GET["id"])) ? $_GET["id"] : "";
            if (!empty($id) && is_numeric($id)) {
                foreach ($_SESSION["myCart"] as $key => &$item) {
                    if ($item[0] == $id) {
                        // Xóa phần tử nếu tồn tại
                        unset($_SESSION["myCart"][$key]);
                        break;
                    }
                }
            }
            require './views/cart/viewCart.php';
            break;

        case 'delete-all-cart':
            // Xóa tất cả sản phẩm khỏi giỏ hàng
            unset($_SESSION["myCart"]);
            require './views/cart/viewCart.php';
            break;

        case 'checkout':
            // Hiển thị thanh toán 
            require './views/cart/checkout.php';
            break;

        case 'place-an-order':
            // Xử lý đặt hàng
            if (isset($_POST['btnOrder'])) {
                $idUser  = isset($_SESSION["user"]) ? $_SESSION["user"]['user_id'] : 0;
                $name    = $_POST["name"];
                $email   = $_POST["email"];
                $address = $_POST["address"];
                $phone   = $_POST["phone"];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $time      = date("Y-m-d H:i:s");
                $total     = thanh_tien();
                $paymethod = $_POST["pay_method"];

                if (empty($address) || empty($phone)) {
                    $_SESSION['error'] = array('Thông tin của bạn còn thiếu.');
                    echo '<script>window.location.href = "index.php?page=checkout";</script>';
                } else {
                    update_address_phone($idUser, $address, $phone);
                    $_SESSION["user"]["user_address"] = $address;
                    $_SESSION["user"]["user_phone"]   = $phone;
                    $_SESSION["user"]["paymethod"]    = $paymethod;
                    $idBill = insert_bill($idUser, $name, $email, $address, $phone, $time, $total, $paymethod);
                    insert_bill_details($idBill);
                    unset($_SESSION["myCart"]);
                }
                $bill = select_one_bill($idBill);
            }
            require './views/cart/orderSuccess.php';
            break;

        //------------------------------------------------HÓA ĐƠN------------------------------------------------ //
        case 'your-bills':
            // Hiển thị hóa đơn người dùng
            $listBills = selectBillUser($_SESSION["user"]["user_id"]);
            require './views/account/bills.php';
            break;
        case 'don-hang-chi-tiet':
            // Hiển thị đơn hàng chi tiết
            $billId = $_GET["id"];
            $billDetail = select_one_bill($billId);
            if(!empty($billDetail)){
                require './views/account/bill_details.php';
            }
            break;
        //------------------------------------------------GIỚI THIỆU------------------------------------------------ //
        case 'gioi-thieu':
            require './views/gioithieu.php';
            break;
        //------------------------------------------------NOTE------------------------------------------------ //
        // Nếu không có tham số page, hiển thị trang chủ.
        default:
            require './views/trangchu.php';
            break;
    }
} else {
    require './views/trangchu.php';
}
// Chèn footer
require_once './views/footer.php';
