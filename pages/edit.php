<?php
include '../config.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

$query_nganh = "SELECT * FROM NganhHoc";
$result_nganh = $conn->query($query_nganh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $MaNganh = $_POST['manganh'];

    if ($_FILES['hinhanh']['name']) {
        $hinhanh = $_FILES['hinhanh']['name'];
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], "public/images/" . $hinhanh);
    } else {
        $hinhanh = $row['Hinh'];
    }

    $sql = "UPDATE SinhVien SET HoTen='$hoten', GioiTinh='$gioitinh', NgaySinh='$ngaysinh', Hinh='$hinhanh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa sinh viên</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
  </style>
  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = "block";
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</head>
<body>
  <!-- Navigation Bar -->
  <nav style="background-color:#007bff; color:#fff; padding:10px 20px; display:flex; justify-content:space-between; align-items:center;">
    <div>
      <a href="index.php" style="color:#fff; text-decoration:none; font-size:20px;">Student Portal</a>
    </div>
    <div>
      <a href="index.php" style="color:#fff; text-decoration:none; margin-right:15px;">Sinh viên</a>
      <a href="hocphan.php" style="color:#fff; text-decoration:none; margin-right:15px;">Học phần</a>
      <a href="login.php" style="color:#fff; text-decoration:none; margin-right:15px;">Đăng Nhập</a>
      <a href="register.php" style="color:#fff; text-decoration:none;">Đăng Kí</a>
    </div>
  </nav>

  <!-- Form Chỉnh sửa -->
  <div style="max-width:600px; margin:50px auto; padding:0 20px;">
    <div style="background-color:#fff; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1); overflow:hidden;">
      <div style="background-color:#007bff; padding:15px; text-align:center; color:#fff; font-size:20px;">
        Chỉnh sửa thông tin sinh viên
      </div>
      <div style="padding:20px;">
        <form method="POST" enctype="multipart/form-data">
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Họ và Tên:</label>
            <input type="text" name="hoten" value="<?= htmlspecialchars($row['HoTen']) ?>" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Giới tính:</label>
            <select name="gioitinh" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
              <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
              <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
            </select>
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Ngày sinh:</label>
            <input type="date" name="ngaysinh" value="<?= htmlspecialchars($row['NgaySinh']) ?>" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Mã Ngành:</label>
            <select name="manganh" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
              <?php while ($nganh = $result_nganh->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($nganh['MaNganh']) ?>" <?= $nganh['MaNganh'] == $row['MaNganh'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($nganh['MaNganh']) ?> - <?= htmlspecialchars($nganh['TenNganh']) ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div style="margin-bottom:15px; text-align:center;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Hình ảnh hiện tại:</label>
            <img src="http://localhost/demo_php/public/images/<?= htmlspecialchars($row['Hinh']) ?>" id="preview" alt="Hình ảnh" style="max-width:100%; height:auto;">
          </div>
          <div style="margin-bottom:15px;">
            <label style="display:block; margin-bottom:5px; font-weight:bold;">Chọn hình ảnh mới:</label>
            <input type="file" name="hinhanh" onchange="previewImage(event)" style="width:100%;">
          </div>
          <div style="text-align:center;">
            <button type="submit" style="padding:10px 20px; background-color:#007bff; border:none; border-radius:4px; color:#fff; font-size:16px; cursor:pointer;">
              Cập nhật
            </button>
          </div>
        </form>
      </div>
    </div>
    <div style="margin-top:20px;">
      <a href="index.php" style="display:block; text-align:center; padding:10px 20px; background-color:#6c757d; color:#fff; text-decoration:none; border-radius:4px;">
        Quay lại
      </a>
    </div>
  </div>
</body>
</html>
