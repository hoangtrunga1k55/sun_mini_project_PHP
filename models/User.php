<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
require('/var/www/Sun_Mini_Project_login/connection.php');
session_start();

class User
{
    private $__conn;

    public function __construct()
    {
        $this->__conn = connection::connectDb();
    }

    public function getAll()
    {
        $sql = "SELECT id,email,password,address,image,role FROM nhanvien";
    }

    function is_email($str)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }

    public function uniqueEmail($email)
    {
        $sql = "SELECT * FROM nhanvien  WHERE email='" . $email . "'";
        $result = $this->__conn->query($sql);
        return $result->num_rows;
    }

    public function userRequest($data, $file)
    {
        $errors = array();
        if (empty($data['email'])) {
            $errors['email'] = 'Bạn chưa nhập email';
        } else if (!$this->is_email($data['email'])) {
            $errors['email'] = 'Email không đúng định dạng';
        } else if ($this->uniqueEmail($data['email']) > 0) {
            $errors['email'] = 'Không được trùng email';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Bạn chưa nhập password';
        }

        if (isset($file['image'])) {
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_tmp = $file['image']['tmp_name'];
            $file_type = $file['image']['type'];
            $file_ext = strtolower(end(explode('.', $file['image']['name'])));
            $expensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $expensions) === false) {
                $errors['image'] = "Vui lòng chọn định dạng jpeg, jpg, png";
            }

            if ($file_size > 2097152) {
                $errors['image'] = 'Vui lòng nhập hình ảnh có độ dài nhỏ hơn 2MB';
            }
        } else {
            $errors['image'] = 'Vui lòng chọn hình ảnh';
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "/var/www/Sun_Mini_Project_login/assets/images/" . $file_name);
        }
        return json_encode([
                'error' => $errors,
                'status' => 500
            ]
        );
    }

    public function editRequest($data, $file)
    {
        $errors = array();
        if (empty($data['email'])) {
            $errors['email'] = 'Bạn chưa nhập email';
        } else if (!$this->is_email($data['email'])) {
            $errors['email'] = 'Email không đúng định dạng';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Bạn chưa nhập password';
        }

        if (isset($file['image'])) {
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_tmp = $file['image']['tmp_name'];
            $file_type = $file['image']['type'];
            $file_ext = strtolower(end(explode('.', $file['image']['name'])));
            $expensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $expensions) === false) {
                $errors['image'] = "Vui lòng chọn định dạng jpeg, jpg, png";
            }

            if ($file_size > 2097152) {
                $errors['image'] = 'Vui lòng nhập hình ảnh có độ dài nhỏ hơn 2MB';
            }
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "/var/www/Sun_Mini_Project_login/assets/images/" . $file_name);
        }
        return json_encode([
                'error' => $errors,
                'status' => 500
            ]
        );
    }

    public function isValidMd5($md5)
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }

    public function editUser($data)
    {
        $errorCheck = json_decode($this->editRequest($data, $_FILES));
        if (empty($errorCheck->error)) {
            $email = $data['email'];
            if ($this->isValidMd5($data['password']) == 1) {
                $password = $data['password'];
            } else {
                $password = md5($data['password']);
            }
            $address = $data['address'] ?? null;
            $role = $data['role'] ?? 1;
            if (isset($_FILES["image"])) {
                $image = "assets/images/" . $_FILES["image"]["name"];
                $sql = "UPDATE nhanvien SET email = '" . $email . "',password = '" . $password . "',address = '" . $address . "',role = '" . $role . "',image = '" . $image . "'  WHERE id='" . $data['id'] . "'";
            } else {
                $sql = "UPDATE nhanvien SET email = '" . $email . "',password = '" . $password . "',address = '" . $address . "',role = '" . $role . "' WHERE id='" . $data['id'] . "'";
            }
            $this->__conn->query($sql);
            $lastId = $data['id'];
            $respone = json_encode([
                'error' => '',
                'status' => 300,
                'data' => $this->getEdit($lastId)
            ]);
            echo $respone;
        } else {
            echo $this->editRequest($data, $_FILES);
        }
        connection::disconnect();
    }

    public function createUser($data)
    {
        $errorCheck = json_decode($this->userRequest($data, $_FILES));
        if (empty($errorCheck->error)) {
            $email = $data['email'];
            $password = md5($data['password']);
            $address = $data['address'] ?? null;
            $image = "assets/images/" . $_FILES["image"]["name"];
            $role = $data['role'] ?? 1;
            $sql = "INSERT INTO `nhanvien` (`id`,`email`,`password`,`address`,`image`,`role`) 
						VALUES (null,'$email','$password','$address','$image','$role')";
            $this->__conn->query($sql);
            $lastId = $this->__conn->insert_id;
            $respone = json_encode([
                'error' => '',
                'status' => 200,
                'data' => $this->getEdit($lastId)
            ]);
            echo $respone;
        } else {
            echo $this->userRequest($data, $_FILES);
        }
        connection::disconnect();
    }

    public function deleteUser($id)
    {
        if (isset($id)) {
            $sql = "DELETE FROM nhanvien WHERE id='" . $id . "'";
            $this->__conn->query($sql);
        }
    }

    public function getEdit($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE id='" . $id . "'";
        $user = $this->__conn->query($sql);
        return $user->fetch_row();
    }

    public function paginate($page)
    {
        $limit = 4;
        if (isset($page)) {
            $page = $page;
        } else {
            $page = 1;
        }
        $startFrom = ($page - 1) * $limit;
        $sql = " SELECT  * FROM nhanvien LIMIT $startFrom, $limit";
        $result = $this->__conn->query($sql);
        return $result;
    }

    public function getTotalPages()
    {
        $sql = "SELECT COUNT(id) FROM nhanvien";
        $result = $this->__conn->query($sql);
        $row = mysqli_fetch_row($result);
        $totalPages = $row[0];
        $total_pages = ceil($totalPages / 4);
        return $total_pages;
    }

    public function auth($email, $password)
    {
        $sql = "SELECT * FROM nhanvien  WHERE email='" . $email . "' AND password='" . $password . "'";
        $result = $this->__conn->query($sql);
        return $result;
    }

    public function checkRow()
    {
        $email = $_SESSION['email'];
        $password = md5($_SESSION['password']);
        $sql = "SELECT * FROM nhanvien  WHERE role = 0 AND email='" . $email . "' AND password='" . $password . "'";
        $result = $this->__conn->query($sql);
        return $result->num_rows;
    }

}