<?php
if (is_array($result)) {
    extract($result);
}
?>

<div class="container">
    <h1 class="text-center alert alert-success">Chỉnh sửa danh mục</h1>
    <div class="row">
        <div class="mx-auto col-lg-6 col-md-8">
            <form action="admin.php?page=cap-nhat-danh-muc" method="post">
                <label class="fw-semibold" for="maDanhMuc">Mã danh mục:</label>
                <input class="form-control" type="text" name="maDanhMuc" id="maDanhMuc" placeholder="<?= (isset($category_id) && is_numeric($category_id) && $category_id > 0) ? $category_id : '' ?>" disabled>
                <br>
                <label class="fw-semibold" for="tenDanhMuc">Tên danh mục:</label>
                <input class="form-control" type="text" name="tenDanhMuc" id="tenDanhMuc" value="<?= isset($category_name) && !empty($category_name) ? $category_name : '' ?>" required>
                <br>
                <input type="hidden" name="maDanhMuc" value="<?= (isset($category_id) && is_numeric($category_id) && $category_id > 0) ? $category_id : '' ?>">
                <button class="btn btn-success" type="reset">Nhập lại</button>
                <button class="btn btn-success" type="submit" name="btnUpdate">Lưu thay đổi</button>
                <a href="admin.php?page=danh-sach-danh-muc" class="btn btn-success float-end" type="button">Danh sách</a>
            </form>
        </div>
    </div>
</div>