<?php
session_start();
if (!isset($_SESSION['isLogon'])) {
    header("Location: /Sun_Mini_Project_login/views/login.php");
}
include('/var/www/Sun_Mini_Project_login/models/User.php');
$user = new User();
$totalPages = $user->getTotalPages();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <?php include('/var/www/Sun_Mini_Project_login/views/layouts/User/css.php'); ?>

</head>
<style>
    li.active a {
        background: red;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include('/var/www/Sun_Mini_Project_login/views/layouts/sidebar.php'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Trang quản trị</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Danh sách nhân viên</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <?php echo $user->checkRow() ? '<button type="button" class="btn btn-success add" data-toggle="modal" data-target="#modal-default">Thêm</button>' :""?>
                                    </div>
                                </div>
                            </div> <!-- /.card-header -->
                            <div id="target-content" class="card-body table-responsive p-0">
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-default" style="display: none" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Khách Hàng</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <input type="hidden" name="id">
                                <div class="modal-body">
                                    <input type="text" name="email" placeholder="nhập email">
                                </div>
                                <div class="modal-body">
                                    <input type="password" name="password" placeholder="nhập mật khẩu">
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="address" placeholder="nhập số địa chỉ">
                                </div>
                                <div>
                                    <input type="file" name="image">
                                </div>
                                <div class="modal-body">
                                    <select name="role" id="role">
                                        <option value="0" selected>Quản lý</option>
                                        <option value="1">Nhân viên</option>
                                    </select>
                                </div>

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary add">Lưu lại</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
        </section>
        <?php include('/var/www/Sun_Mini_Project_login/views/layouts/panigation.php'); ?>

    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php include('/var/www/Sun_Mini_Project_login/views/layouts/footer.php'); ?>

<!-- jQuery -->

</body>
<?php include('/var/www/Sun_Mini_Project_login/views/layouts/User/script.php'); ?>
<!--ajax-->
<?php include('/var/www/Sun_Mini_Project_login/views/layouts/User/ajax.php'); ?>
</html>
