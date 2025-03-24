<?php
include 'config.php';

$MaSV = $_GET['MaSV'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

// Lấy tên ngành từ bảng NganhHoc
$query_nganh = "SELECT TenNganh FROM NganhHoc WHERE MaNganh = '{$row['MaNganh']}'";
$result_nganh = $conn->query($query_nganh);
$row_nganh = $result_nganh->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chi tiết sinh viên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
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
            <a class="nav-link" href="register.php">Đăng ký</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Đăng nhập</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-5">
    <h2 class="text-center text-primary mb-4">Chi tiết sinh viên</h2>
    <div class="card shadow">
      <div class="card-header text-center bg-primary text-white">
        Thông tin sinh viên
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Ảnh sinh viên -->
          <div class="col-md-4 text-center">
            <?php 
              $imagePath = "public/images/" . htmlspecialchars($row['Hinh']);
              $imgSrc = (!empty($row['Hinh']) && file_exists($imagePath)) ? $imagePath : "public/images/default.jpg";
            ?>
            <img src="<?= $imgSrc ?>" alt="Hình sinh viên" class="img-fluid rounded">
          </div>
          <!-- Thông tin chi tiết -->
          <div class="col-md-8">
            <dl class="row">
              <dt class="col-sm-4">Mã Sinh Viên:</dt>
              <dd class="col-sm-8"><?= htmlspecialchars($row['MaSV']) ?></dd>

              <dt class="col-sm-4">Họ và Tên:</dt>
              <dd class="col-sm-8"><?= htmlspecialchars($row['HoTen']) ?></dd>

              <dt class="col-sm-4">Giới tính:</dt>
              <dd class="col-sm-8"><?= htmlspecialchars($row['GioiTinh']) ?></dd>

              <dt class="col-sm-4">Ngày sinh:</dt>
              <dd class="col-sm-8"><?= htmlspecialchars($row['NgaySinh']) ?></dd>

              <dt class="col-sm-4">Ngành học:</dt>
              <dd class="col-sm-8"><?= htmlspecialchars($row['MaNganh']) ?> - <?= htmlspecialchars($row_nganh['TenNganh']) ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
