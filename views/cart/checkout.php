<div class="container">
    <div class="mt-4" style="min-height: 600px;">
        <h5 class="heading">
            ➤ Kiểm tra thanh toán
        </h5>
        <br>
        <div class="row g-5">
            <div class="col-12 col-md-6">
                <!-- show message -->
                 <!-- thông báo lỗi hoặc thành công -->
                <?php require_once './assets/message.php'; ?>
                
                <div class="card">
                    <h6 class="card-header fw-bold">
                        Thông tin của bạn
                    </h6>
                    <div class="card-body">
                        <!-- Kiểm tra xem thông tin người dùng đã được lưu trong phiên ($_SESSION) và là mảng.
                         Nếu có, hiển thị thông tin và form đặt hàng; nếu không, yêu cầu người dùng đăng nhập. -->
                        <?php if (isset($_SESSION["user"]) && (is_array($_SESSION["user"]))) {
                            extract($_SESSION["user"]) ?>
                            <form action="?page=place-an-order" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label class="fw-semibold" for="name">Họ và tên:</label>
                                    <input class="form-control text-primary-emphasis" type="text" name="name" id="name" value="<?= $user_name ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="fw-semibold" for="email">Email:</label>
                                    <input class="form-control text-primary-emphasis" type="email" name="email" id="email" value="<?= $user_email ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="fw-semibold" for="address">Địa chỉ:</label>
                                    <input class="form-control text-primary-emphasis" type="text" name="address" id="address" value="<?= $user_address ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label class="fw-semibold" for="phone">Số điện thoại:</label>
                                    <input class="form-control text-primary-emphasis" type="tel" name="phone" id="phone" value="<?= $user_phone ?>">
                                </div>

                                <div class="card mt-5 border-0">
                                    <h6 class="card-header fw-bold">
                                        Phương thức thanh toán
                                    </h6>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="pay_method" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">Thanh toán khi nhận hàng</label>
                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="2" name="pay_method" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">Chuyển khoản ngân hàng</label>
                                        </div>
                                        <br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="3" name="pay_method" id="flexRadioDefault3">
                                            <label class="form-check-label" for="flexRadioDefault3">Ví điện tử MoMo</label>
                                        </div>
                                        <button type="submit" name="btnOrder" class="btn btn-danger w-100 mt-5 fs-5">Đặt hàng</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="text-center p-5">
                                <span>Đăng nhập để đặt hàng!</span>
                                <a href="index.php" class="btn btn-outline-primary">Đăng nhập</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Hiển thị thông tin chi tiết của từng sản phẩm trong giỏ hàng -->
            <div class="col-12 col-md-6">
                <div class="cart-info">
                    <?php
                    $subtotal = 0;
                    $shipping = 20000;
                    if (!empty($_SESSION["myCart"])) {
                        foreach ($_SESSION["myCart"] as $row) {
                            $totalPrice = $row[3] * $row[4];
                            $subtotal  += $totalPrice;
                            echo '
                                    <div class="cart-item row py-2 mx-0 mb-2 border">
                                        <div class="col-6 col-md-2">
                                            <img src="' . $row[2] . '" alt="product image" class="cart-item-img" style="width: 60px;">
                                        </div>
                                        <div class="col-6 col-md-7">
                                            <h5 class="cart-item-name fw-semibold m-0 pb-1 text-nowrap overflow-hidden">' . $row[1] . '</h5>
                                            <span class="cart-item-price" style="font-size: 14px;">Đơn giá: ' . $row[4] . ' VNĐ</span>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <span class="float-end" style="font-size: 14px;">Số lượng: ' . $row[3] . '</span>
                                            <span class="float-end fs-4 fw-bold">' . $totalPrice . ' VNĐ</span>
                                        </div>
                                    </div>
                                ';
                        }
                    }
                    ?>
                </div>
                <div class="cart-footer mt-5" style="border-top: dashed 2px #000;">
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <span class="fs-5">Tổng tiền hàng</span>
                            <span class="fs-5"><?= $subtotal ?> VNĐ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="fs-5">Phí vận chuyển</span>
                            <span class="fs-5"><?= $shipping ?> VNĐ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="fs-5 fw-bold">Tổng thanh toán</span>
                            <span class="fs-5 fw-bold"><?= $subtotal + $shipping ?> VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>