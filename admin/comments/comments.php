<div class="container">
    <h1 class="text-center alert alert-danger">Quản lí bình luận</h1>
    <div class="row">
        <div style="width: 100%; margin-bottom: 10rem;" class="mx-auto col-lg-6 col-md-8">
        <?php
        // kiểm tra $listComments là mảng hay rỗng
        if(is_array($listComments) && !empty($listComments)){
            ?>
            <!-- /* ---------------------------------- TABLE --------------------------------- */ -->
            <table>
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-3">NỘI DUNG</th>
                        <th class="col-3">MÃ NGƯỜI DÙNG</th>
                        <th class="col-2">MÃ SẢN PHẨM</th>
                        <th class="col-2">NGÀY BÌNH LUẬN</th>
                        <th class="col-3">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listComments as $row) {
                        extract($row);
                        $timeFormat = DateTime::createFromFormat('Y-m-d H:i:s', $row['comment_date'])->format('H:i, d/m/Y');
                        $delete = "admin.php?page=xoa-binh-luan&id=" . $row['comment_id'];
                        echo '
                            <tr>
                                <td>' . $row['comment_id']   . '</td>
                                <td>' . $row['comment_text'] . '</td>
                                <td>' . $row['user_id'] . '</td>
                                <td>' . $row['product_id'] . '</td>
                                <td>' . $timeFormat . '</td>
                                <td>
                                    <button class="btn btn-sm btn-danger w-100 mt-2" onclick="openModal(' . $row['comment_id'] . ')">Xóa</button>
                                </td>
                            </tr>';
                            ?><a href="<?= $row['comment_id'] ?>"></a><?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- /* ---------------------------------- TABLE --------------------------------- */ -->
            <?php //HTML
        }else{
            echo "Chưa có bình luận nào";
        }
        ?>
        </div>
    </div>
</div>
<?php
require_once '../assets/modal_window.php';
?>
<script>
    function openModal(id) {
        // Open the modal
        document.getElementById('myModal').style.display = 'block';

        // Set the href attribute dynamically for the "OK" button
        document.getElementById('ok-btn').href = 'admin.php?page=xoa-binh-luan&id=' + id;
    }
</script>