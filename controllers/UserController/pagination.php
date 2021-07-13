<?php
require("/var/www/Sun_Mini_Project_login/models/User.php");
$user = new User();
$checkRole = $user->checkRow();
if ($checkRole > 0) {
    $page = $_GET['page'];
    $result = $user->paginate($page);
} else {
    $result = $user->auth($_SESSION['email'], md5($_SESSION['password']));
}
?>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Hình Ảnh</th>
        <th>Vai trò</th>
        <?php
        echo ($checkRole > 0) ? "<th>Status</th>" : "";
        ?>

    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr id="<?php echo "row" . $row["id"]; ?>">
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["address"]; ?></td>
            <td><img width="80px" height="80px" src="<?php echo "/Sun_Mini_Project_login/" . $row["image"]; ?>" alt="">
            </td>
            <td><?php if ($row["role"] == 0) {
                    echo "Quản lý";
                } else {
                    echo "Nhân viên";
                } ?></td>
            <?php
            echo ($checkRole > 0) ? "<td><button class='btn btn-default editUser' data-toggle='modal' data-target='#modal-default' data-id =" . $row['id'] . ">Sửa</button>
                                        |<button class='delete btn btn-default' data-id=" . $row['id'] . ">Xóa</button>
                                    </td>" : "";
            ?>
        </tr>
        <?php
    };
    ?>
    </tbody>
</table>