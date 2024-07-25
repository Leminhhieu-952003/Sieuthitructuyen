<div class="container">
    <div class="row">
        <!--  Carousel (Slider hình ảnh) -->
        <div class="col-md-12 col-lg-8">
            <?php
            // Một mảng chứa đường dẫn đến các hình ảnh cho carousel
            $carouselImages = [
                "./assets/images/ex1.png",
                "./assets/images/ex2.jpeg",
                "./assets/images/ex3.png",
                "./assets/images/ex4.png"
            ];
            ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <!-- Các nút chỉ thị để điều hướng carousel -->
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($carouselImages); $i++) : ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?> aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endfor; ?>
                </div>
            <!-- Chứa các item (hình ảnh) của carousel. Mỗi item được xác định là active nếu là hình ảnh đầu tiên. -->
                <div class="carousel-inner" style="max-height: 355px;">
                    <?php foreach ($carouselImages as $index => $image) : ?>
                        <div data-bs-interval="2000" class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="<?= $image ?>" class="d-block w-100" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
            <!-- Các nút điều khiển để chuyển slide trước và sau. -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <br>
        </div>
        <!-- Thông tin tài khoản -->
        <div class="col-md-12 col-lg-4">
            <div class="card card-account" style="border: 1px solid #006db5ff;">
                <h5 class="card-header border-0 text-uppercase fw-bold text-light" style="background-color: #006db5ff;">
                    Tài khoản
                </h5>
                <div class="card-body">
                    <!--  Kiểm tra xem người dùng đã đăng nhập hay chưa.
                     Nếu có, hiển thị thông tin tài khoản, nếu không, hiển thị form đăng nhập. -->
                    <?php if (isset($_SESSION["user"]) && (is_array($_SESSION["user"]))) { extract($_SESSION["user"]) ?>
                        <?php $avatar = $img_path . $user_avatar; ?>
                        <div class="personal-image">
                            <label class="label">
                                <a href="index.php?page=settings-profile" class="personal-figure">
                                    <img class="personal-avatar" src="<?= $avatar ?>">
                                    <figcaption class="personal-figcaption">
                                        <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png" alt="camera icon">
                                    </figcaption>
                                </a>
                            </label>
                        </div>
                        <h6 class="fs-5 fw-bold text-nowrap overflow-hidden text-center text-primary" style="text-overflow: ellipsis;">
                            <?= $user_name ?>
                        </h6>
                        <ul class="mt-3 list-unstyled">
                            <?php if ($role == 1) { ?>
                                <li>👑
                                    <a href="admin/admin.php" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                        Admin
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="mt-2">📑
                                <a href="index.php?page=your-bills" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                    Đơn hàng của tôi
                                </a>
                            </li>
                            <li class="mt-2">🔒
                                <a href="index.php?page=update-password" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                    Thay đổi mật khẩu
                                </a>
                            </li>
                            <li class="mt-2">⚙️
                                <a href="index.php?page=settings-profile" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                    Chỉnh sửa thông tin
                                </a>
                            </li>
                        </ul>
                        <a href="index.php?page=dang-xuat" class="btn btn-outline-primary w-100 mb-1">Đăng xuất</a>
                    <?php } else { ?>
                        <!-- Form đăng nhập và các chức năng -->
                        <form action="index.php?page=dang-nhap" method="post">
                            <div class="form-group">
                                <label class="fw-semibold" for="email">Email:</label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                            <div class="form-group mt-2" onclick="">
                                <label class="fw-semibold" for="password">Password:</label>
                                <div class="position-relative">
                                    <!--  Hàm JavaScript để thay đổi chế độ hiển thị mật khẩu (ẩn/hiện). -->
                                    <svg onclick="togglePasswordVisibility()" style="right: 0; cursor: pointer;" class="eye-open position-absolute top-50 translate-middle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" width="25px" height="25px" viewBox="0 0 442.04 442.04" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M221.02,341.304c-49.708,0-103.206-19.44-154.71-56.22C27.808,257.59,4.044,230.351,3.051,229.203    c-4.068-4.697-4.068-11.669,0-16.367c0.993-1.146,24.756-28.387,63.259-55.881c51.505-36.777,105.003-56.219,154.71-56.219    c49.708,0,103.207,19.441,154.71,56.219c38.502,27.494,62.266,54.734,63.259,55.881c4.068,4.697,4.068,11.669,0,16.367    c-0.993,1.146-24.756,28.387-63.259,55.881C324.227,321.863,270.729,341.304,221.02,341.304z M29.638,221.021    c9.61,9.799,27.747,27.03,51.694,44.071c32.83,23.361,83.714,51.212,139.688,51.212s106.859-27.851,139.688-51.212    c23.944-17.038,42.082-34.271,51.694-44.071c-9.609-9.799-27.747-27.03-51.694-44.071    c-32.829-23.362-83.714-51.212-139.688-51.212s-106.858,27.85-139.688,51.212C57.388,193.988,39.25,211.219,29.638,221.021z" />
                                            </g>
                                            <g>
                                                <path d="M221.02,298.521c-42.734,0-77.5-34.767-77.5-77.5c0-42.733,34.766-77.5,77.5-77.5c18.794,0,36.924,6.814,51.048,19.188    c5.193,4.549,5.715,12.446,1.166,17.639c-4.549,5.193-12.447,5.714-17.639,1.166c-9.564-8.379-21.844-12.993-34.576-12.993    c-28.949,0-52.5,23.552-52.5,52.5s23.551,52.5,52.5,52.5c28.95,0,52.5-23.552,52.5-52.5c0-6.903,5.597-12.5,12.5-12.5    s12.5,5.597,12.5,12.5C298.521,263.754,263.754,298.521,221.02,298.521z" />
                                            </g>
                                            <g>
                                                <path d="M221.02,246.021c-13.785,0-25-11.215-25-25s11.215-25,25-25c13.786,0,25,11.215,25,25S234.806,246.021,221.02,246.021z" />
                                            </g>
                                        </g>
                                    </svg>
                                    <svg onclick="togglePasswordVisibility()" style="right: 0; cursor: pointer;" class="eye-close position-absolute top-50 translate-middle" xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24" fill="#000000">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.2954 6.31083C22.6761 6.474 22.8524 6.91491 22.6893 7.29563L21.9999 7.00019C22.6893 7.29563 22.6894 7.29546 22.6893 7.29563L22.6886 7.29731L22.6875 7.2998L22.6843 7.30716L22.6736 7.33123C22.6646 7.35137 22.6518 7.37958 22.6352 7.41527C22.6019 7.48662 22.5533 7.58794 22.4888 7.71435C22.3599 7.967 22.1675 8.32087 21.9084 8.73666C21.4828 9.4197 20.8724 10.2778 20.0619 11.1304L21.0303 12.0987C21.3231 12.3916 21.3231 12.8665 21.0303 13.1594C20.7374 13.4523 20.2625 13.4523 19.9696 13.1594L18.969 12.1588C18.3093 12.7115 17.5528 13.2302 16.695 13.6564L17.6286 15.0912C17.8545 15.4383 17.7562 15.9029 17.409 16.1288C17.0618 16.3547 16.5972 16.2564 16.3713 15.9092L15.2821 14.2353C14.5028 14.4898 13.659 14.6628 12.7499 14.7248V16.5002C12.7499 16.9144 12.4141 17.2502 11.9999 17.2502C11.5857 17.2502 11.2499 16.9144 11.2499 16.5002V14.7248C10.3689 14.6647 9.54909 14.5004 8.78982 14.2586L7.71575 15.9093C7.48984 16.2565 7.02526 16.3548 6.67807 16.1289C6.33089 15.903 6.23257 15.4384 6.45847 15.0912L7.37089 13.689C6.5065 13.2668 5.74381 12.7504 5.07842 12.1984L4.11744 13.1594C3.82455 13.4523 3.34968 13.4523 3.05678 13.1594C2.76389 12.8665 2.76389 12.3917 3.05678 12.0988L3.98055 11.175C3.15599 10.3153 2.53525 9.44675 2.10277 8.75486C1.83984 8.33423 1.6446 7.97584 1.51388 7.71988C1.44848 7.59182 1.3991 7.48914 1.36537 7.41683C1.3485 7.38067 1.33553 7.35207 1.32641 7.33167L1.31562 7.30729L1.31238 7.29984L1.31129 7.29733L1.31088 7.29638C1.31081 7.2962 1.31056 7.29563 1.99992 7.00019L1.31088 7.29638C1.14772 6.91565 1.32376 6.474 1.70448 6.31083C2.08489 6.1478 2.52539 6.32374 2.68888 6.70381C2.68882 6.70368 2.68894 6.70394 2.68888 6.70381L2.68983 6.706L2.69591 6.71972C2.7018 6.73291 2.7114 6.7541 2.72472 6.78267C2.75139 6.83983 2.79296 6.92644 2.84976 7.03767C2.96345 7.26029 3.13762 7.58046 3.37472 7.95979C3.85033 8.72067 4.57157 9.70728 5.55561 10.6218C6.42151 11.4265 7.48259 12.1678 8.75165 12.656C9.70614 13.0232 10.7854 13.2502 11.9999 13.2502C13.2416 13.2502 14.342 13.013 15.3124 12.631C16.5738 12.1345 17.6277 11.3884 18.4866 10.5822C19.4562 9.67216 20.1668 8.69535 20.6354 7.9434C20.869 7.5685 21.0405 7.25246 21.1525 7.03286C21.2085 6.92315 21.2494 6.83776 21.2757 6.78144C21.2888 6.75328 21.2983 6.73242 21.3041 6.71943L21.31 6.70595L21.3106 6.70475C21.3105 6.70485 21.3106 6.70466 21.3106 6.70475M22.2954 6.31083C21.9147 6.14771 21.4738 6.32423 21.3106 6.70475L22.2954 6.31083ZM2.68888 6.70381C2.68882 6.70368 2.68894 6.70394 2.68888 6.70381V6.70381Z" fill="#1C274C" />
                                    </svg>
                                    <input class="form-control password" type="password" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="form-check my-2">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>
                            <button type="submit" name="btnLogin" class="btn btn-primary w-100">Đăng nhập</button>
                        </form>
                        <ul class="mb-0 mt-3 list-unstyled">
                            <li>
                                <a href="index.php?page=forgot-password" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                    Quên mật khẩu?
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="index.php?page=dang-ky" class="link-body-emphasis link-offset-2 link-underline-opacity-10 link-underline-opacity-100-hover">
                                    Đăng ký thành viên
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h5 class="my-4">
        ➤ Sản phẩm nổi bật
    </h5>
    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="row g-3">
                <?php 
                // Danh sách sản phẩm nổi bật và tìm kiếm
                foreach ($selectProducts as $item) {
                    extract($item);
                    $hinh = $img_path . $product_image;
                    echo '
                        <div class="col-6 col-md-4">
                            <div class="product-item border w-100" onclick="redirect(' . $product_id . ')">
                                <div class="col-8 col-md-6 mx-auto mt-4" style="height: 200px">
                                    <img src="' . $hinh . '">
                                </div>
                                <div class="p-3">
                                    <h5 class="text-nowrap overflow-hidden">' . $product_name . '</h5>
                                    <p class="fw-bold fs-5">' . $product_price . ' VNĐ</p>
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
        <div class="col-md-12 col-lg-4">
            <form action="index.php?page=san-pham" method="post" class="input-group mb-3">
                <input type="text" class="form-control" name="inputTenSP" placeholder="Tên sản phẩm">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </form>
            <!-- Các danh mục và top 10 sản phẩm yêu thích -->
            <div class="card card-categories" style="border: 1px solid #f07e1aff;">
                <h5 class="card-header border-0 text-uppercase fw-bold" style="background-color: #f07e1aff;">
                    Danh mục
                </h5>
                <div class="card-body">
                    <div class="list-group">
                        <?php
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
    //  Chuyển hướng đến trang chi tiết sản phẩm
    function redirect(id) {
        window.location.href = "index.php?page=chi-tiet-san-pham&product-id=" + id;
    }
    // Thay đổi chế độ hiển thị của trường mật khẩu khi nhấp vào các biểu tượng mắt
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