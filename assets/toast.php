<?php
//Hàm hiển thị thông báo dựa trên biến session
function displayToast($sessionVariable, $successMessage, $errorMessage)
{
    $toastClass = 'myToast--success'; // Default class
    //Kiểm tra session có tồn tại không
    if (isset($_SESSION[$sessionVariable]) && $_SESSION[$sessionVariable]) {
        if ($sessionVariable == 'no_file' || $sessionVariable == 'email_exists' || $sessionVariable == 'email_error' || $sessionVariable == 'currentPassword_error') {
            $toastClass = 'myToast--error';
        } else {
            $toastClass = 'myToast--success';
        }

        echo '
            <div class="myToast-wrapper">
                <div class="myToast ' . $toastClass . '">
                    <div class="myToast__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="30px" height="30px" viewBox="0 0 24 24" id="check-mark-circle" data-name="Flat Color" class="icon flat-color">
                            <circle id="primary" cx="12" cy="12" r="10" />
                            <path id="secondary" d="M11,15.5a1,1,0,0,1-.71-.29l-3-3a1,1,0,1,1,1.42-1.42L11,13.09l4.29-4.3a1,1,0,0,1,1.42,1.42l-5,5A1,1,0,0,1,11,15.5Z" />
                        </svg>
                    </div>
                    <div class="myToast__body">
                        <h3 class="myToast__title">' . $successMessage . '</h3>
                        <h3 class="myToast__title">' . $errorMessage   . '</h3>
                    </div>
                    <div class="myToast__close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                            <path d="M16 8L8 16M8 8L16 16" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
            </div>
        ';
        unset($_SESSION[$sessionVariable]);
    }
}

displayToast('currentPassword_error', 'Mật khẩu hiện tại không đúng', '');
displayToast('add_success', 'Thêm mới thành công', '');
displayToast('update_success', 'Cập nhật thành công', '');
displayToast('no_file', 'Vui lòng tải ảnh lên', '');
displayToast('register_success', 'Đăng ký thành công', '');
displayToast('email_error', 'Email không tồn tại', '');
displayToast('email_exists', 'Email này đã được sử dụng', '');


?>

<style>
    .myToast-wrapper {
        position: fixed;
        top: 30px;
        right: 30px;
        z-index: 999;
    }

    .myToast {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 8px;
        border-left: 6px solid;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        min-width: 400px;
        max-width: 500px;
        min-height: 75px;
        animation: slideInleft ease 1s, fadeOut linear 2s 5s forwards;
    }

    @keyframes slideInleft {
        from {
            opacity: 0;
            transform: translateX(calc(100% + 35px));
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }

    .myToast__icon path {
        fill: #fff;
    }

    .myToast--success {
        border-color: #47d864;
    }

    .myToast--success svg {
        fill: #47d864;
    }

    .myToast--error {
        border-color: #dd1c21;
    }

    .myToast--error svg {
        fill: #dd1c21;
    }

    .myToast__icon,
    .myToast__close {
        margin: 0 1rem;
    }

    .myToast__body {
        flex-grow: 1;
        padding: 1rem 0;
    }

    .myToast__title {
        font-size: 18px;
        font-weight: 600;
        color: #000;
        margin: 0;
    }

    .myToast__mess {
        font-size: 16px;
        font-weight: 500;
        color: #555;
        line-height: 1.5;
        margin: 0;
    }

    .myToast__close {
        cursor: pointer;
        margin-bottom: 1rem;
    }

    .myToast__close path {
        stroke: #888;
    }

    .myToast__close:hover path {
        stroke: #000;
    }
</style>