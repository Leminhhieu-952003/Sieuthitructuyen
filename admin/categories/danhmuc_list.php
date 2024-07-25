<?php 
// Thông báo cập nhập thành công
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    require_once '../assets/toast.php';
    unset($_SESSION['update_success']);
}
?>
<!-- Hiển thị Danh mục -->
<div class="container">
    <h1 class="text-center alert alert-success">Xem Danh mục</h1>
    <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <thead>
                <tr>
                    <th class="col-3">ID</th>
                    <th class="col-6">TÊN DANH MỤC</th>
                    <th class="col-1">CÀI ĐẶT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lặp qua từng danh mục trong danh sách "$listCategories"
                foreach ($listCategories as $row) {
                    extract($row);
                    $edit   = "admin.php?page=sua-danh-muc&id=" . $category_id;
                    $delete = "admin.php?page=xoa-danh-muc&id=" . $category_id;
                    // "edit" và "delete" : Tạo liên kết cho các hành động sửa và xóa ID danh mục
                    echo '
                        <tr>
                            <td>' . $category_id   . '</td>
                            <td>' . $category_name . '</td>
                            <td>
                            
                                <a href="' . $edit . '" class="btn btn-sm btn-success w-100">Chỉnh sửa</a>
                                <button class="btn btn-sm btn-danger w-100 mt-2" onclick="openModal(' . $category_id . ')">Xóa</button>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-menu"></div>
<div class="menu container d-flex align-items-center gap-2">
    <a href="admin.php?page=them-danh-muc" class="btn btn-outline-success" type="button">Thêm mới</a>
</div>

<?php
// Xác nhận xóa
require_once '../assets/modal_window.php';
?>

<script>
    function openModal(id) {
        // Open the modal
        document.getElementById('myModal').style.display = 'block';

        // Set the href attribute dynamically for the "OK" button
        document.getElementById('ok-btn').href = 'admin.php?page=xoa-danh-muc&id=' + id;
    }
</script>