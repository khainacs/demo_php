<?php
include 'config.php';

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Student Portal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sinh viên</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hocphan.php">Học phần</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Đăng Nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Đăng Kí</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Form Chỉnh sửa -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white text-center">
            Chỉnh sửa thông tin sinh viên
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Họ và Tên:</label>
                <input type="text" name="hoten" class="form-control" value="<?= htmlspecialchars($row['HoTen']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Giới tính:</label>
                <select name="gioitinh" class="form-select">
                  <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                  <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngày sinh:</label>
                <input type="date" name="ngaysinh" class="form-control" value="<?= htmlspecialchars($row['NgaySinh']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Mã Ngành:</label>
                <select name="manganh" class="form-select" required>
                  <?php while ($nganh = $result_nganh->fetch_assoc()) { ?>
                    <option value="<?= htmlspecialchars($nganh['MaNganh']) ?>" <?= $nganh['MaNganh'] == $row['MaNganh'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($nganh['MaNganh']) ?> - <?= htmlspecialchars($nganh['TenNganh']) ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3 text-center">
                <label class="form-label">Hình ảnh hiện tại:</label><br>
                <img src="public/images/<?= htmlspecialchars($row['Hinh']) ?>" id="preview" alt="Hình ảnh" class="img-fluid">
              </div>
              <div class="mb-3">
                <label class="form-label">Chọn hình ảnh mới:</label>
                <input type="file" name="hinhanh" class="form-control" onchange="previewImage(event)">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-3">
          <a href="index.php" class="btn btn-secondary w-100">Quay lại</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
