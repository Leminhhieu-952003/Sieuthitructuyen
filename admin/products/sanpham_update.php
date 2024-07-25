<?php
if (is_array($result)) {
    extract($result);
}
?>

<div class="container">
    <h1 class="text-center alert alert-primary">Chỉnh sửa sản phẩm</h1>
    <div class="row" style="margin-bottom: 10rem;">
        <div class="mx-auto col-lg-6 col-md-8">
            <form action="admin.php?page=cap-nhat-san-pham" enctype="multipart/form-data" method="post">
                <input type="hidden" name="maSanPham" value="<?= (isset($product_id) && is_numeric($product_id) && $product_id > 0) ? $product_id : '' ?>">
                <!-- Combo box danh mục -->
                <label class="fw-semibold" for="boxDanhMuc">Danh mục:</label>
                <select name="boxDanhMuc" id="boxDanhMuc" class="form-control">
                    <?php foreach ($listCategories as $categories) : ?>
                        <option <?= $categories['category_id'] == $result['category_id'] ? 'selected' : '' ?> value="<?= $categories['category_id'] ?>">
                            <?= $categories['category_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label class="fw-semibold" for="tenSanPham">Tên sản phẩm:</label>
                <input class="form-control" type="text" name="tenSanPham" id="tenSanPham" value="<?= isset($product_name) && !empty($product_name) ? $product_name : '' ?>" required>
                <br>
                <label class="fw-semibold" for="giaSanPham">Giá sản phẩm:</label>
                <input class="form-control" type="number" name="giaSanPham" id="giaSanPham" value="<?= isset($product_price) && !empty($product_price) ? $product_price : '' ?>" required>
                <br>
                <label class="fw-semibold" for="hinhSanPham">Hình ảnh:</label>
                <?php echo '<img src="../upload/' . $product_image . '" style="width: 120px; height: 120px;">';?>
                <input class="form-control mt-2" type="file" name="hinhSanPham" id="hinhSanPham">
                <input type="hidden" name="img-current" value="<?= $product_image ?>">
                <br>
                <label class="fw-semibold" for="moTaSanPham">Mô tả:</label>
                <textarea class="form-control" id="moTaSanPham" name="moTaSanPham" rows="4" cols="50"><?= isset($product_description) && !empty($product_description) ? $product_description : '' ?></textarea>
                <br>
                <button class="btn btn-primary" type="reset">Nhập lại</button>
                <button class="btn btn-primary" type="submit" name="btnUpdate">Lưu thay đổi</button>
                <a href="admin.php?page=danh-sach-san-pham" class="btn btn-primary float-end" type="button">Danh sách</a>
            </form>
        </div>
    </div>
</div>