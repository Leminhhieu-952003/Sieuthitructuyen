<div class="container">
    <h1 class="text-center alert alert-warning">Quản lí khách hàng</h1>
    <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <thead>
                <tr>
                    <th class="col-1">iD</th>
                    <th class="col-2">HỌ VÀ TÊN</th>
                    <th class="col-2">EMAIL</th>
                    <th class="col-2">ĐỊA CHỈ</th>
                    <th class="col-1">ĐIỆN THOẠI</th>
                    <th class="col-1">VAI TRÒ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listUsers as $row) {
                    extract($row);
                    $edit   = "admin.php?page=sua-user&id=" . $user_id;
                    $delete = "admin.php?page=xoa-user&id=" . $user_id;
                    if ($role == 1) {
                        $role  = 'Admin';
                        $color = 'red';
                    } else {
                        $role  = 'Member';
                        $color = 'black';
                    }
                    echo '
                        <tr>
                            <td>' . $user_id      . '</td>
                            <td>' . $user_name    . '</td>
                            <td>' . $user_email   . '</td>
                            <td>' . $user_address . '</td>
                            <td>' . $user_phone   . '</td>
                            <td style="color: '.$color.';">' . $role . '</td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>