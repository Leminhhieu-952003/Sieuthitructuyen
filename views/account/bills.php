<style>
    table,td,th{
        padding: 10px;
        border: 2px solid;
    }
</style>
<div class="container">
    <div class="mt-4" style="min-height: 600px;">
        <h5 class="heading">
            ➤ Đơn hàng của tôi
        </h5>
        <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <?php 
                if(!empty($listBills)){
                    echo "
                    <thead>
                    <tr>
                        <th class='col-2'>NGÀY ĐẶT HÀNG</th>
                        <th class='col-2'>ĐỊA CHỈ</th>
                        <th class='col-2'>TỔNG TIỀN</th>
                        <th class='col-1'>CÀI ĐẶT</th>
                    </tr>
                    </thead>
                    ";
                    echo "<tbody>";
                    foreach ($listBills as $row) {
                        extract($row);
                        echo '
                            <tr>
                                <td>' . $bill_time   . '</td>
                                <td>'. $bill_address   . '</td>
                                <td>' . $bill_total   . ' VNĐ</td>
                                <td>
                                    <a href="?page=don-hang-chi-tiet&id=' . $bill_id . '" class="btn btn-sm btn-success w-100">Chi tiết</a>
                                </td>
                            </tr>';
                    }
                    echo "</tbody>";
                }else{
                    echo "Chưa có đơn hàng nào";
                }
                ?>
        </table>
    </div>
    </div>
</div>