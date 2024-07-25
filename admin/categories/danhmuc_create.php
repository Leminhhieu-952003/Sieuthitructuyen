<?php 
if (isset($_SESSION['add_success']) && $_SESSION['add_success']) {
    require_once '../assets/toast.php';
    unset($_SESSION['add_success']);
}
?>

<div class="container">
    <h1 class="text-center alert alert-success">Thêm mới danh mục</h1>
    <div class="row">
        <div class="mx-auto col-lg-6 col-md-8">
            <form action="admin.php?page=them-danh-muc" method="post">
                <label class="fw-semibold" for="maDanhMuc">Mã danh mục:</label>
                <input class="form-control" type="text" name="maDanhMuc" id="maDanhMuc" placeholder="auto" disabled>
                <br>
                <label class="fw-semibold" for="tenDanhMuc">Tên danh mục:</label>
                <input class="form-control" type="text" name="tenDanhMuc" id="tenDanhMuc" required>
                <br>
                <button class="btn btn-success" type="reset">Nhập lại</button>
                <button class="btn btn-success" type="submit" name="btnAdd">Đồng ý</button>
            </form>
        </div>
    </div>
</div>