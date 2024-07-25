<div class="container">
    <div class="mt-4" style="min-height: 600px;">
        <h5 class="heading">
            ➤ Đã đặt hàng
        </h5>
        <br>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Đặt hàng thành công!</h4>
                    <p>Aww yeah, Nếu quý khách có bất kỳ câu hỏi hoặc cần hỗ trợ gì thêm, đừng ngần ngại liên hệ với chúng tôi. Chúng tôi luôn sẵn lòng giúp đỡ và đảm bảo rằng trải nghiệm mua sắm của quý khách là hoàn hảo nhất.</p>
                    <hr>
                    <p class="mb-0">Cảm ơn quý khách một lần nữa và chúc quý khách một ngày mua sắm thật tuyệt vời 🥰</p>
                </div>
                <div class="card mt-4">
                    <h6 class="card-header fw-bold">
                        Phương thức thanh toán
                    </h6>
                    <div class="card-body">
                        <?php
                        // Hàm trả về mô tả phương thức thanh toán dựa trên giá trị của $method.
                        function getPaymentMethodDescription($method)
                        {
                            switch ($method) {
                                case 1:
                                    return 'Thanh toán khi nhận hàng';
                                case 2:
                                    return 'Chuyển khoản ngân hàng';
                                case 3:
                                    return 'Ví điện tử MoMo';
                                default:
                                    return 'Unknown';
                            }
                        }

                        // Kiểm tra xem thông tin người dùng có tồn tại trong phiên và là một mảng.
                        if (isset($_SESSION["user"]) && is_array($_SESSION["user"])) {
                            extract($_SESSION["user"]);
                            // Trích xuất các giá trị từ mảng phiên thành các biến riêng biệt.
                            $paymentMethodDescription = getPaymentMethodDescription($paymethod);
                            // Hiển thị mô tả phương thức thanh toán.
                            echo $paymentMethodDescription;
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <h6 class="card-header fw-bold">
                        Địa chỉ nhận hàng
                    </h6>
                    <div class="card-body">
                        <!-- Kiểm tra xem thông tin người dùng có tồn tại trong phiên và là một mảng. -->
                        <?php if (isset($_SESSION["user"]) && (is_array($_SESSION["user"]))) {
                            // Trích xuất các giá trị từ mảng phiên thành các biến riêng biệt.
                            extract($_SESSION["user"]) ?>
                            <div class="list-group">
                                <?php if (isset($bill) && (is_array($bill))) {
                                    extract($bill) ?>
                                <?php } else { ?>
                                    <span>...</span>
                                <?php } ?>
                            </div>
                            <!-- Hiển thị tên, email, địa chỉ và số điện thoại
                             của người dùng từ các biến đã trích xuất. -->
                            <div class="list-group mt-3">
                                <label class="fw-semibold" for="name">Họ và tên:</label>
                                <span><?= $user_name ?></span>
                            </div>
                            <div class="list-group mt-3">
                                <label class="fw-semibold" for="email">Email:</label>
                                <span><?= $user_email ?></span>
                            </div>
                            <div class="list-group mt-3">
                                <label class="fw-semibold" for="address">Địa chỉ:</label>
                                <span><?= $user_address ?></span>
                            </div>
                            <div class="list-group mt-3">
                                <label class="fw-semibold" for="phone">Số điện thoại:</label>
                                <span><?= $user_phone ?></span>
                            </div>
                        <?php } else { ?>
                            <!-- Hiển thị thông báo yêu cầu đăng nhập 
                             và cung cấp liên kết đến trang đăng nhập. -->
                            <div class="text-center p-5">
                                <span>Vui lòng đăng nhập!</span>
                                <a href="index.php" class="btn btn-primary">Đăng nhập</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>