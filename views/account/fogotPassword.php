<?php 
if (isset($_SESSION['email_error']) && $_SESSION['email_error']) {
    require_once './assets/toast.php';
    unset($_SESSION['email_error']);
}
?>

<div class="container col-12 col-md-4" style="min-height: 600px;">
    <h1 class="text-center mt-4">
        Tìm lại mật khẩu
    </h1>
    <form action="index.php?page=forgot-password" method="post" class="mt-5">
        <div class="form-group">
            <label class="fw-semibold" for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" autofocus required>
        </div>
        <br>
        <button type="submit" name="btnSendEmail" class="btn btn-dark w-100">Gửi</button>
    </form>
    <h6 class="mt-3">
        Bạn đã nhớ mật khẩu? trở về
        <a href="index.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Đăng nhập</a>
    </h6>
    <?php 
    if (isset($_SESSION["show_password"]) && is_array($_SESSION["show_password"])) {
        extract($_SESSION["show_password"]);
        echo '<span class="text-danger">Mật khẩu của bạn là:
        <span class="fw-bold">'.$user_password.'</span></span>';
        unset($_SESSION["show_password"]);
    }
    ?>
</div>