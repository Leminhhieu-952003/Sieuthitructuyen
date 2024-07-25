<div class="container">
    <h5 class="my-4">
        ➤ Tất cả sản phẩm
    </h5>
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="row g-3">
                <?php 
                // Vòng lặp PHP để hiển thị tất cả sản phẩm từ mảng $selectAllProducts
                foreach ($selectAllProducts as $item) {
                    extract($item);
                    $hinh = $img_path . $product_image;
                    // Khi nhấp vào sản phẩm, gọi hàm redirect với product_id
                    echo '
                        <div class="col-6 col-md-4">
                            <div class="product-item border w-100" onclick="redirect(' . $product_id . ')">
                                <div class="col-8 col-md-6 mx-auto mt-4" style="height: 200px">
                                    <img src="' . $hinh . '">
                                </div>
                                <div class="p-3">
                                    <h5 class="fs-5 text-nowrap overflow-hidden">' . $product_name . '</h5>
                                    <p class="fw-bold fs-4">' . $product_price . ' VNĐ</p>
                                    <a href="#" class="btn btn-outline-danger w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
            <br>
        </div>
        <!-- Thanh Tìm Kiếm và Danh Mục Bên -->
        <div class="col-md-12 col-lg-4">
            <!-- Form tìm kiếm sản phẩm gửi dữ liệu đến trang san-pham qua phương thức POST -->
            <form action="index.php?page=san-pham" method="post" class="input-group mb-3">
                <input type="text" class="form-control" name="inputTenSP" placeholder="Tên sản phẩm">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </form>
            <div class="card card-categories" style="border: 1px solid #f07e1aff;">
                <h5 class="card-header border-0 text-uppercase fw-bold" style="background-color: #f07e1aff;">
                    Danh mục
                </h5>
                <div class="card-body">
                    <div class="list-group">
                        <?php
                        // Vòng lặp PHP để hiển thị danh mục từ $selectCategories
                        foreach ($selectCategories as $item) {
                            extract($item);
                            $link = "index.php?page=san-pham&category-id=" . $category_id;
                            echo '
                                <a href="' . $link . '" class="list-group-item list-group-item-action">' . $category_name . '</a>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="card card-top10" style="border: 1px solid #78b833ff;">
                <h5 class="card-header border-0 text-uppercase fw-bold" style="background-color: #78b833ff;">
                    Top 10 yêu thích
                </h5>
                <div class="card-body">
                    <div class="list-group">
                        <?php 
                        // Vòng lặp PHP để hiển thị top 10 sản phẩm từ $selectTop10
                        foreach ($selectTop10 as $item) {
                            extract($item);
                            $link = "index.php?page=chi-tiet-san-pham&product-id=" . $product_id;
                            $hinh = $img_path . $product_image;
                            echo '
                                <li class="d-flex my-1 position-relative">
                                    <img src="' . $hinh . '" alt="" class="list-group-img p-1">
                                    <a href="' . $link . '" class="list-group-item list-group-item-action">' . $product_name . '</a>
                                    <p class="position-absolute top-0 end-0 m-2">👁️‍🗨️' . $product_view . '</p>
                                </li>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm JavaScript để chuyển hướng người dùng đến trang chi tiết sản phẩm với product_id cụ thể
    // . Được gọi khi người dùng nhấp vào sản phẩm.
    function redirect(id) {
        window.location.href = "index.php?page=chi-tiet-san-pham&product-id=" + id;
    }

    function togglePasswordVisibility() {
        const eyeOpen = document.querySelector('.eye-open');
        const eyeClose = document.querySelector('.eye-close');
        const passwordInput = document.querySelector('.password');

        eyeOpen.addEventListener('click', () => {
            eyeOpen.style.display = 'none';
            eyeClose.style.display = 'block';
            passwordInput.type = 'password';
        });

        eyeClose.addEventListener('click', () => {
            eyeOpen.style.display = 'block';
            eyeClose.style.display = 'none';
            passwordInput.type = 'text';
        });
    }
</script>