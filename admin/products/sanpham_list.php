<?php
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    require_once '../assets/toast.php';
    unset($_SESSION['update_success']);
}
?>

<div class="container">
    <h1 class="text-center alert alert-primary">Xem Sản Phẩm</h1>
    <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-4">TÊN SẢN PHẨM</th>
                    <th class="col-2">ĐƠN GIÁ (VNĐ)</th>
                    <th class="col-1">HÌNH ẢNH</th>
                    <th class="col-1">LƯỢT XEM</th>
                    <th class="col-1">CÀI ĐẶT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listProducts as $row) {
                    extract($row);
                    $edit   = "admin.php?page=sua-san-pham&id=" . $product_id;
                    $delete = "admin.php?page=xoa-san-pham&id=" . $product_id;
                    echo '
                        <tr>
                            <td>' . $product_id    . '</td>
                            <td>' . $product_name  . '</td>
                            <td>' . $product_price . '</td>
                            <td>
                                <img src="../upload/' . $product_image . '">
                            </td>
                            <td>' . $product_view  . '</td>
                            <td>
                                <a href="' . $edit . '" class="btn btn-sm btn-success w-100">Chỉnh sửa</a>
                                <button class="btn btn-sm btn-danger w-100 mt-2" onclick="openModal(' . $product_id . ')">Xóa</button>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="bg-menu"></div>
<div class="menu container d-flex align-items-center justify-content-between">
    <div>
        <a href="admin.php?page=them-san-pham" class="btn btn-outline-primary" type="button">Thêm mới</a>
    </div>
    <form action="admin.php?page=danh-sach-san-pham" method="post" class="d-flex gap-2">
        <input class="form-control border border-dark" type="text" name="inputSearch" placeholder="Tên sản phẩm" require>
        <select name="selectDanhMuc" class="form-control border-dark fw-bold" style="width: 200px;">
            <option value="0" selected>Tất cả</option>
            <?php
            foreach ($listCategories as $item) {
                extract($item);
                echo '
                    <option value="' . $category_id . '">' . $category_name . '</option>
                ';
            }
            ?>
        </select>
        <button class="btn btn-primary form-control" type="submit" name="btnSearch">Tìm kiếm</button>
    </form>

</div>
<?php
require_once '../assets/modal_window.php';
?>
<script>
    function openModal(id) {
        // Open the modal
        document.getElementById('myModal').style.display = 'block';

        // Set the href attribute dynamically for the "OK" button
        document.getElementById('ok-btn').href = 'admin.php?page=xoa-san-pham&id=' + id;
    }
</script>