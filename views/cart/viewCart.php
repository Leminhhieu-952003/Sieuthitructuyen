<div class="container">
    <div class="cart-container mt-4" style="min-height: 600px;">
        <h5 class="cart-heading">
            ➤ Giỏ hàng của bạn
        </h5>
        <br>
        
        <?php
        // Hiển thị thông tin giỏ hàng
        // Biến để tính tổng tiền và số lượng sản phẩm trong giỏ hàng
        $subtotal = 0;
        $countProduct = 0;
        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if (!empty($_SESSION["myCart"])) { ?>
            <div class="cart-body">
                <!-- When has items -->
                <!-- Add HTML string here -->
                <?php
                // Duyệt qua từng sản phẩm trong giỏ hàng
                foreach ($_SESSION["myCart"] as $row) {
                    // Tính tổng giá của sản phẩm
                    $totalPrice = $row[3] * $row[4];
                    $subtotal  += $totalPrice;
                    $countProduct++;
                    // Tạo và hiển thị mã HTML cho mỗi sản phẩm,
                    //  bao gồm hình ảnh, tên, mã sản phẩm, giá, và số lượng
                    echo '
                        <div class="cart-item row p-3 mx-0 mb-3 shadow  border">
                            <div class="col-6 col-md-2 hover" onclick="redirect(' . $row[0] . ')">
                                <img src="' . $row[2] . '" alt="product image" class="cart-item-img" style="width: 70px;">
                            </div>

s
                            <div class="col-6 col-md-4 col-lg-4 my-auto hover" onclick="redirect(' . $row[0] . ')">
                                <h5 class="cart-item-name fw-semibold m-0 pb-1 text-nowrap overflow-hidden">' . $row[1] . '</h5>
                                <span class="cart-item-code text-black-50" style="font-size: 14px;">item code: #' . $row[0] . '</span>
                                <br>
                                <span class="cart-item-price" style="font-size: 14px;">' . $row[4] . ' VNĐ</span>
                            </div>
                            <div class="col-6 col-md-3 col-lg-3 my-auto mt-4">
                                <div class="cart-item-controls d-flex gap-3">
                                    <div onclick="updateQuantity(-1)" style="padding: 0 12px;" class="qty-minus my-auto fw-semibold border"><span class="fs-3">−</span></div>
                                    <div class="qty-number fs-5 my-auto fw-semibold">' . $row[3] . '</div>
                                    <div onclick="updateQuantity(1)" style="padding: 0 12px;" class="qty-plus my-auto fw-semibold border"><span class="fs-3">+</span></div>
                                </div>
                            </div>
                            <div class="col-4 col-md-2 col-lg-2 my-auto">
                                <span class="cart-item-total fs-4 fw-bold">' . $totalPrice . ' VNĐ</span>
                            </div>
                            <div class="col-2 col-md-1 col-lg-1 my-auto">
                                <a href="?page=delete-one-item&id='.$row[0].'" class="cart-item-remove">
                                    <svg width="25" height="25" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.25 5.25H3.75V9.75H5.25V5.25Z" fill="#524646"></path>
                                        <path d="M8.25 5.25H6.75V9.75H8.25V5.25Z" fill="#524646"></path>
                                        <path d="M9 0.75C9 0.3 8.7 0 8.25 0H3.75C3.3 0 3 0.3 3 0.75V2.25H0V3.75H0.75V11.25C0.75 11.7 1.05 12 1.5 12H10.5C10.95 12 11.25 11.7 11.25 11.25V3.75H12V2.25H9V0.75ZM4.5 1.5H7.5V2.25H4.5V1.5ZM9.75 3.75V10.5H2.25V3.75H9.75Z" fill="#524646"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
            <input type="hidden" name="count" id="countItem" value="<?= $countProduct ?>">
        <?php } else { ?>
            <input type="hidden" name="count" id="countItem" value="0">
            <div class="cart-body">
                <img class="mx-auto" src="./assets/images/egg.png" style="width: 180px;">
                <h3 class="text-center">Bạn ăn trứng ngỗng không?</h3>
                <h5 class="text-center">
                    <a href="index.php?page=tat-ca-san-pham" class="link-primary link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">Không ăn</a>
                </h5>
            </div>
        <?php } ?>
        <div class="cart-footer fixed py-3 bg-light shadow-lg border-top">
            <div class="container d-flex justify-content-between">
                <div class="fs-4 fw-bold my-auto">
                    <span>Tổng tiền hàng:</span>
                    <span><?= $subtotal ?> VNĐ</span>
                </div>
                <?php 
                // Hiển thị nút thanh toán nếu giỏ hàng không rỗng
                if (!empty($_SESSION["myCart"])) {
                    echo '<a href="index.php?page=checkout" class="btn btn-outline-danger fs-5">Go to Checkout</a>';
                } 
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var countItem = document.getElementById('countItem').value;
    document.getElementById('cart-link').setAttribute('data-item-count', countItem);
</script>