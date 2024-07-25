<?php
if (isset($_SESSION['add_success']) && $_SESSION['add_success']) {
    require_once '../assets/toast.php';
    unset($_SESSION['add_success']);
}
if (isset($_SESSION['no_file']) && $_SESSION['no_file']) {
    require_once '../assets/toast.php';
    unset($_SESSION['no_file']);
}
?>

<div class="container">
    <h1 class="text-center alert alert-primary">Thêm mới sản phẩm</h1>
    <div class="row" style="margin-bottom: 10rem;">
        <div class="mx-auto col-lg-6 col-md-8">
            <form action="admin.php?page=them-san-pham" enctype="multipart/form-data" method="post">
                <label class="fw-semibold" for="maSanPham">Mã sản phẩm:</label>
                <input class="form-control" type="text" name="maSanPham" id="maSanPham" placeholder="auto" disabled>
                <br>
                <!-- Combo box danh mục -->
                <label class="fw-semibold" for="maDanhMucSP">Danh mục:</label>
                <select name="maDanhMucSP" id="maDanhMucSP" class="form-control">
                    <?php foreach ($listCategories as $categories) : ?>
                        <option value="<?= $categories['category_id'] ?>">
                            <?= $categories['category_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label class="fw-semibold" for="tenSanPham">Tên sản phẩm:</label>
                <input class="form-control" type="text" name="tenSanPham" id="tenSanPham" required>
                <br>
                <label class="fw-semibold" for="giaSanPham">Giá sản phẩm:</label>
                <input class="form-control" type="number" name="giaSanPham" id="giaSanPham" required>
                <br>
                <label class="fw-semibold" for="hinhSanPham">Hình ảnh:</label>
                <input class="form-control" type="file" name="hinhSanPham" id="hinhSanPham">
                <br>
                <label class="fw-semibold" for="moTaSanPham">Mô tả:</label>
                <textarea class="form-control" id="moTaSanPham" name="moTaSanPham" rows="4" cols="50"></textarea>
                <br>
                <button class="btn btn-primary" type="reset">Nhập lại</button>
                <button class="btn btn-primary" type="submit" name="btnAdd">Đồng ý</button>
            </form>
        </div>
    </div>
</div>