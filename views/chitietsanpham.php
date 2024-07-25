<div class="container">
    <h5 class="my-4">
        ➤ Chi tiết sản phẩm
    </h5>
    <div class="row position-relative">
        <?php
        extract($oneItem);
        $image = $img_path . $product_image;
        ?>
        <h2 class="text-center position-absolute start-50 fw-bold" style="transform: translateX(-50%);">
            <?php echo $product_name; ?>
        </h2>

        <div class="col-12 col-md-6 p-5">
            <div class="col-6 mx-auto">
                <img src="<?php echo $image; ?>">
            </div>
        </div>

        <div class="col-12 col-md-6 p-5" style="background: #eee">
            <p class="added__animation fw-bold">
                <span>+1</span>
            </p>

            <p class="mt-5 fs-5">
                <?php echo $product_description; ?>
            </p>

            <?php $current_qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; ?>

            <span class="fs-4 fw-semibold">Số lượng:</span>
            <div class="d-flex justify-content-between mt-2">
                <div class="d-flex gap-3">
                    <button class="btnQty fs-4 fw-bold px-3" onclick="updateQuantity(-1)">–</button>
                    <p id="quantity" class="fs-4 m-0"></p>
                    <button class="btnQty fs-4 fw-bold px-3" onclick="updateQuantity(1)">+</button>
                </div>
                <span id="price" class="fs-4 fw-bold"><?php echo $product_price * $current_qty; ?> VNĐ</span>

            </div>

            <script>
                document.getElementById('quantity').innerText = <?php echo $current_qty; ?>;

                function updateQuantity(change) {
                    var currentQuantity = parseInt(document.getElementById('quantity').innerText);
                    var newQuantity = Math.max(1, currentQuantity + change);
                    document.getElementById('quantity').innerText = newQuantity;

                    var productPrice = <?php echo $product_price; ?>;
                    var newPrice = productPrice * newQuantity;

                    document.getElementById('price').innerText = '$' + newPrice;
                    document.getElementById('hiddenQty').value = newQuantity;
                }
            </script>
            <!-- Form thêm vào giỏ hàng -->
            <form action="index.php?page=add-to-cart" method="post">
                <input type="hidden" name="idsp" value="<?php echo $product_id; ?>">
                <input type="hidden" name="tensp" value="<?php echo $product_name; ?>">
                <input type="hidden" name="imgsp" value="<?php echo $image; ?>">
                <?php echo '<input type="hidden" id="hiddenQty" name="hiddenQty"     value="' . $current_qty . '">'; ?>
                <?php echo '<input type="hidden" id="hiddenPrice" name="hiddenPrice" value="' . $product_price . '">'; ?>

                <div class="d-flex gap-5 justify-content-center mt-5">
                    <button type="submit" name="btnAddToCart" class="btn-add-to-cart btn btn-outline-secondary text-uppercase fw-bold w-50 py-2">Add to cart</button>
                    <a href="#" class="btn btn-danger text-uppercase fw-bold w-50 py-2">Buy now</a>
                </div>
            </form>

        </div>
    </div>

    <hr class="w-50 mt-5">

    <div class="row">
        <!-- Comments here -->
        <div class="col-12 col-md-6">
            <h4 class="fw-bold">
                Bình luận:
            </h4>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#comments-container').load("views/binhluan.php", {
                        data: <?= $product_id ?>
                    }, function() {
                        // Sau khi nội dung đã được load, kiểm tra số lượng phần tử có class "has-comment"
                        var hasCommentElements = $('#comments-container .has-comment');

                        if (hasCommentElements.length > 3) {
                            $('#btnLoadMore').css('display', 'inline-block');
                        } else {
                            $('#btnLoadMore').css('display', 'none');
                        }
                    });
                });
            </script>
            <div id="comments-container" class="comments-container overflow-y-hidden" style="max-height: 365px;"></div>
            <span onclick="loadMoreComments()" class="fw-semibold" id="btnLoadMore" style="margin-left: 10px; cursor: pointer; text-decoration: none; transition: text-decoration 0.3s;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                Xem thêm bình luận
            </span>
            <!-- Button trigger modal -->
            <p type="button" class="btnTrigger col-10 py-2 px-3 mt-4 rounded-pill border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Viết bình luận...
            </p>
        </div>
        <!-- Other products -->
        <!-- Hiển thị các sản phẩm cùng loại với thông tin về
          tên, giá và hình ảnh của từng sản phẩm -->
        <div class="col-12 col-md-6">
            <br>
            <h4 class="fw-bold">
                Sản phẩm cùng loại:
            </h4>
            <div class="row g-2">
                <?php
                foreach ($sameItem as $item) {
                    extract($item);
                    $image = $img_path . $product_image;
                    echo '
                        <div class="col-6 col-md-4">
                            <div class="product-item border w-100" onclick="redirect(' . $product_id . ')">
                                <div class="w-50 mx-auto mt-4" style="height: 100px">
                                    <img src="' . $image . '">
                                </div>
                                <div class="mx-3 mt-5">
                                    <h5 class="fs-5 text-nowrap overflow-hidden">' . $product_name . '</h5>
                                    <p class="my-2 fw-bold fs-4">$' . $product_price . '</p>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function redirect(id) {
        window.location.href = "index.php?page=chi-tiet-san-pham&product-id=" + id;
    }

    const btnLoadMore = document.getElementById('btnLoadMore');
    const commentsContainer = document.querySelector('.comments-container');

    function loadMoreComments() {
        const currentMaxHeight = commentsContainer.style.maxHeight;
        if (currentMaxHeight === '365px') {
            // Change max-height to another value (100%)
            commentsContainer.style.maxHeight = '100%';
            btnLoadMore.textContent = 'Đóng bình luận';
        } else {
            // Reset max-height to the original value
            commentsContainer.style.maxHeight = '365px';
            btnLoadMore.textContent = 'Xem thêm bình luận';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var addToCartBtn = document.querySelector('.btn-add-to-cart');
        addToCartBtn.addEventListener('click', function() {
            var addedAnimation = document.querySelector('.added__animation');
            var cartAnimation = document.querySelector('.cart');

            addedAnimation.classList.add('active');
            setTimeout(function() {
                addedAnimation.classList.remove('active');
            }, 800);

            cartAnimation.classList.add('shake');
            setTimeout(function() {
                cartAnimation.classList.remove('shake');
            }, 800);

        });
    });
</script>