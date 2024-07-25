<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- /* ---------------------------------- HTML ---------------------------------- */ -->
<div class="container">
    <h1 class="text-center alert alert-secondary">Số liệu thống kê 2024</h1>
    <div class="row">
        <div class="container-statis">
            <div class="box-statis alert alert-warning">
                <div class="title-statis">Người dùng</div>
                <span><?= $numUser ?></span>
            </div>
            <div class="box-statis alert alert-primary"">
                <div class="title-statis">Bình luận</div>
                <span><?= $numComment ?></span>
            </div>
            <div class="box-statis alert alert-danger"">
                <div class="title-statis">Đơn hàng</div>
                <span><?= $numBill ?></span>
            </div>
            <div class="box-statis alert alert-success">
                <div class="title-statis">Doanh thu</div>
                <span><?= number_format($numRevenue['revenue']) ?>VNĐ</span>
            </div>
        </div>
    </div>
    <canvas id="myChart"></canvas>
</div>
<!-- /* ---------------------------------- HTML ---------------------------------- */ -->
<style>
    canvas{
        margin-bottom: 50px;
    }
</style>
<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Số đơn hàng trong 1 ngày',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 4
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<!-- /* --------------------------------- CSS --------------------------------- */ -->
<style>
    .container-statis{
        display: grid;
        grid-template-columns: repeat(4,1fr);
        gap: 20px;
    }
    .box-statis{
        border-radius: 5px;
        font-size: 20px;
    }
</style>
<!-- /* --------------------------------- CSS --------------------------------- */ -->