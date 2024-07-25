<?php 
$count = 0;
$countArray = array();
if (isset($_SESSION["myCart"])) {
    $myCart = $_SESSION["myCart"];
    $qtt = 0;

    foreach ($myCart as $item) {
        $qtt++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/main.css">
    <!-- TITLE -->
    <title>Siêu thị trực tuyến</title>
    <style>
        .bg-nav {
            position: absolute;
            width: 100%;
            height: 86px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: -1;
        }

        .tip {
            width: 0px;
            height: 0px;
            position: absolute;
            background: transparent;
            border: 10px solid #d0d0d0;
        }

        .tip-up {
            top: -25px;
            left: 10px;
            border-right-color: transparent;
            border-left-color: transparent;
            border-top-color: transparent;
        }

        .tip-down {
            bottom: -25px;
            left: 10px;
            border-right-color: transparent;
            border-left-color: transparent;
            border-bottom-color: transparent;
        }

        .tip-left {
            top: 10px;
            left: -24px;
            border-top-color: transparent;
            border-left-color: transparent;
            border-bottom-color: transparent;
        }

        .tip-right {
            top: 10px;
            right: -25px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
        }

        .dialogbox .dialogbox-content {
            position: relative;
            height: auto;
            margin: 20px 0 20px 10px;
            padding: 0 8px;
            background-color: #FFF;
            border-radius: 5px;
            border: 5px solid #FFF;
            outline: 1px solid #dcdcdc;
        }

        .dialogbox-content .message {
            min-height: 30px;
            line-height: 1.5;
            color: #333;
        }

        .btnTrigger {
            background-color: #f0f2f5ff;
            transition: all ease 0.3s;
            color: #8a8a8a;
        }

        .btnTrigger:hover {
            background-color: #ebebeb;
            color: #000;
        }

        .cart:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .cart.shake {
            animation: shake 0.5s ease-in-out;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .added__animation {
            width: fit-content;
            border-radius: 50%;
            border: 1px solid #333;
            padding: 8px 12px;
            position: relative;
            left: 50%;
            top: 50%;
            opacity: 0;
            transform: translateY(100%);
            transition: all ease 0.5s;
        }

        .added__animation.active {
            opacity: 1;
            transform: translateY(0%);
        }

        .added__animation span {
            color: #666;
            font-size: 18px;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25%, 75% {
                transform: translateX(-8px);
            }
            50% {
                transform: translateX(8px);
            }
        }
    </style>
</head>

<body>
    <header class="py-2">
        <div class="container">
            <marquee class="text-uppercase mx-auto" behavior="scroll" direction="left" scrollamount="15">
                <h1>Siêu Thị Trực Tuyến</h1>
            </marquee>
        </div>
        <nav class="d-flex" style="background-color: transparent;" id="myNavbar">
            <div class="bg-nav"></div>
            <div class="container d-flex justify-content-between">
                <ul class="list-unstyled m-0 fs-5 py-3">
                    <a href="index.php">Trang Chủ</a>
                    <a href="index.php?page=tat-ca-san-pham">Sản Phẩm</a>
                    <a href="index.php?page=gioi-thieu">Giới Thiệu</a>
                    <a href="index.php?page=lien-he">Liên Hệ</a>
                    <a href="index.php?page=gop-y">Góp Ý</a>
                    <a href="index.php?page=hoi-dap">Hỏi Đáp</a>   
                </ul>
                <!-- ICON CART -->
                <a href="index.php?page=view-cart" data-item-count="<?= (isset($qtt) && !empty($qtt)) ? $qtt : 0 ?>" id="cart-link" class="cart cart-icon active position-relative my-auto mx-0 p-2 rounded-3 border">🛒</a>
            </div>
        </nav>
    </header>