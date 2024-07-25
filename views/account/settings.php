<?php
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    require_once './assets/toast.php';
    unset($_SESSION['update_success']);
}
?>

<div class="container col-12 col-md-6">
    <h1 class="text-center mt-4">
        Thông tin cá nhân
    </h1>
    <?php
        if (isset($_SESSION["user"]) && (is_array($_SESSION["user"]))) {
            extract($_SESSION["user"]);
            $img = $img_path . $user_avatar;
        }
    ?>
    <form action="index.php?page=settings-profile" enctype="multipart/form-data" method="post" class="mt-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="fw-semibold" for="name">Họ và tên:</label>
                    <input class="form-control text-primary-emphasis" type="text" name="name" id="name" value="<?= $user_name ?>" required>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="fw-semibold" for="email">Email:</label>
                    <input class="form-control text-primary-emphasis" type="email" name="email" id="email" value="<?= $user_email ?>" required>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="fw-semibold" for="address">Địa chỉ:</label>
                    <input class="form-control text-primary-emphasis" type="text" name="address" id="address" value="<?= $user_address ?>">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="fw-semibold" for="phone">Số điện thoại:</label>
                    <input class="form-control text-primary-emphasis" type="tel" name="phone" id="phone" value="<?= $user_phone ?>">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="fw-semibold" for="avatar">Hình ảnh:</label>
                    <input class="form-control" type="file" name="avatar" id="avatar" onchange="previewImage()">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!-- show image -->
                <input type="hidden" name="img-current" id="img-current" value="<?= !empty($img) ? $img : '' ?>">
                <div class="d-flex">
                    <div class="mt-2 border d-flex" style="width: 150px; height: 150px;">
                        <img src="<?= !empty($img) ? $img : '' ?>" id="img-preview">
                    </div>
                    <p class="mt-2 ms-2 fw-semibold text-danger btnDeleteImage" onclick="deleteImage()">Xóa</p>
                </div>
            </div>
        </div>
        <br>
        <input type="hidden" name="id" value="<?= $user_id ?>">
        <button type="submit" name="btnSave" class="btn btn-dark w-100">Lưu thay đổi</button>
    </form>
    <h6 class="mt-3">
        Bảo vệ tài khoản?
        <a href="index.php?page=update-password" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Đổi mật khẩu</a>
    </h6>
</div>

<script>
    var imgPreview = document.getElementById('img-preview');
    var imgCurrent = document.getElementById('img-current');
    var input      = document.getElementById('avatar');

    function previewImage() {
        // Check if a file is selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
            // Update the hidden input value to the new image data
            imgCurrent.value = '';
        } else {
            // If no file is selected, keep the current image
            imgPreview.src = imgCurrent.value;
        }
    }

    function deleteImage() {
        imgPreview.src = '';
        imgCurrent.value = '';
    }
</script>